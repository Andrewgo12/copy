const logger = require('./LoggerService');
const database = require('../../config/database');

class BaseService {
  constructor() {
    this.logger = logger;
    this.db = database;
  }

  /**
   * Ejecutar en transacción
   */
  async executeInTransaction(callback) {
    const transaction = await this.db.transaction();
    
    try {
      const result = await callback(transaction);
      await transaction.commit();
      return result;
    } catch (error) {
      await transaction.rollback();
      throw error;
    }
  }

  /**
   * Validar datos requeridos
   */
  validateRequired(data, requiredFields) {
    const missing = [];
    
    for (const field of requiredFields) {
      if (!data[field] || data[field] === '') {
        missing.push(field);
      }
    }

    if (missing.length > 0) {
      throw new Error(`Campos requeridos faltantes: ${missing.join(', ')}`);
    }

    return true;
  }

  /**
   * Limpiar datos de entrada
   */
  sanitizeData(data, allowedFields) {
    const sanitized = {};
    
    for (const field of allowedFields) {
      if (data[field] !== undefined) {
        sanitized[field] = data[field];
      }
    }
    
    return sanitized;
  }

  /**
   * Validar formato de email
   */
  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  /**
   * Validar formato de fecha
   */
  isValidDate(dateString) {
    const date = new Date(dateString);
    return date instanceof Date && !isNaN(date);
  }

  /**
   * Convertir fecha a timestamp
   */
  dateToTimestamp(date) {
    return Math.floor(new Date(date).getTime() / 1000);
  }

  /**
   * Convertir timestamp a fecha
   */
  timestampToDate(timestamp) {
    return new Date(timestamp * 1000);
  }

  /**
   * Generar código único
   */
  generateUniqueCode(prefix = '', length = 6) {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let result = prefix;
    for (let i = 0; i < length; i++) {
      result += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return result;
  }

  /**
   * Formatear número con padding
   */
  padNumber(number, length = 6, char = '0') {
    return number.toString().padStart(length, char);
  }

  /**
   * Validar rango de fechas
   */
  validateDateRange(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    
    if (!this.isValidDate(startDate) || !this.isValidDate(endDate)) {
      throw new Error('Formato de fecha inválido');
    }
    
    if (start >= end) {
      throw new Error('La fecha de inicio debe ser anterior a la fecha de fin');
    }
    
    return true;
  }

  /**
   * Calcular diferencia en días
   */
  daysDifference(date1, date2) {
    const oneDay = 24 * 60 * 60 * 1000;
    const firstDate = new Date(date1);
    const secondDate = new Date(date2);
    
    return Math.round(Math.abs((firstDate - secondDate) / oneDay));
  }

  /**
   * Obtener fecha actual como timestamp
   */
  getCurrentTimestamp() {
    return Math.floor(Date.now() / 1000);
  }

  /**
   * Validar estructura de objeto
   */
  validateObjectStructure(obj, requiredStructure) {
    for (const [key, type] of Object.entries(requiredStructure)) {
      if (!(key in obj)) {
        throw new Error(`Propiedad requerida '${key}' no encontrada`);
      }
      
      if (typeof obj[key] !== type) {
        throw new Error(`Propiedad '${key}' debe ser de tipo ${type}`);
      }
    }
    
    return true;
  }

  /**
   * Retry con backoff exponencial
   */
  async retryWithBackoff(fn, maxRetries = 3, baseDelay = 1000) {
    let lastError;
    
    for (let attempt = 1; attempt <= maxRetries; attempt++) {
      try {
        return await fn();
      } catch (error) {
        lastError = error;
        
        if (attempt === maxRetries) {
          break;
        }
        
        const delay = baseDelay * Math.pow(2, attempt - 1);
        this.logger.warn(`Intento ${attempt} falló, reintentando en ${delay}ms`, error);
        
        await new Promise(resolve => setTimeout(resolve, delay));
      }
    }
    
    throw lastError;
  }

  /**
   * Procesar en lotes
   */
  async processBatch(items, batchSize, processor) {
    const results = [];
    
    for (let i = 0; i < items.length; i += batchSize) {
      const batch = items.slice(i, i + batchSize);
      const batchResults = await Promise.all(
        batch.map(item => processor(item))
      );
      results.push(...batchResults);
    }
    
    return results;
  }

  /**
   * Debounce para funciones
   */
  debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  /**
   * Throttle para funciones
   */
  throttle(func, limit) {
    let inThrottle;
    return function() {
      const args = arguments;
      const context = this;
      if (!inThrottle) {
        func.apply(context, args);
        inThrottle = true;
        setTimeout(() => inThrottle = false, limit);
      }
    };
  }

  /**
   * Memoización simple
   */
  memoize(fn, keyGenerator = (...args) => JSON.stringify(args)) {
    const cache = new Map();
    
    return async (...args) => {
      const key = keyGenerator(...args);
      
      if (cache.has(key)) {
        return cache.get(key);
      }
      
      const result = await fn(...args);
      cache.set(key, result);
      
      return result;
    };
  }

  /**
   * Validar permisos de usuario
   */
  async validateUserPermission(userId, permission) {
    // Implementar lógica de permisos
    const ProfileService = require('./ProfileService');
    return await ProfileService.hasPermission(userId, permission);
  }

  /**
   * Log de auditoría
   */
  async auditLog(action, userId, entityType, entityId, changes = {}) {
    try {
      const AuditLog = require('../Models/AuditLog');
      
      await AuditLog.create({
        action,
        userId,
        entityType,
        entityId,
        changes: JSON.stringify(changes),
        timestamp: this.getCurrentTimestamp(),
        ipAddress: this.currentIpAddress || null
      });
    } catch (error) {
      this.logger.error('Error creating audit log:', error);
    }
  }

  /**
   * Establecer IP actual para auditoría
   */
  setCurrentIpAddress(ipAddress) {
    this.currentIpAddress = ipAddress;
  }

  /**
   * Formatear respuesta estándar
   */
  formatResponse(success, data = null, message = null, code = null) {
    return {
      success,
      data,
      message,
      code,
      timestamp: new Date().toISOString()
    };
  }

  /**
   * Manejar errores de servicio
   */
  handleServiceError(error, context = 'Service operation') {
    this.logger.error(`${context}:`, error);
    
    if (error.name === 'SequelizeValidationError') {
      throw new Error(`Validation error: ${error.errors.map(e => e.message).join(', ')}`);
    }
    
    if (error.name === 'SequelizeUniqueConstraintError') {
      throw new Error('Duplicate entry found');
    }
    
    throw error;
  }
}

module.exports = BaseService;