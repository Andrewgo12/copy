const database = require('../../config/database');
const logger = require('../Services/LoggerService');

class BaseController {
  constructor() {
    this.db = database;
    this.logger = logger;
  }

  /**
   * Respuesta exitosa estándar
   */
  successResponse(res, data = {}, code = 200) {
    return res.status(200).json({
      success: true,
      code,
      data,
      timestamp: new Date().toISOString()
    });
  }

  /**
   * Respuesta de error estándar
   */
  errorResponse(res, message, code = 500, details = null) {
    const statusCode = this.getHttpStatusCode(code);
    
    return res.status(statusCode).json({
      success: false,
      code,
      error: message,
      details,
      timestamp: new Date().toISOString()
    });
  }

  /**
   * Manejo de errores genérico
   */
  handleError(res, error, message = 'Error interno') {
    this.logger.error(message, error);

    // Error de validación de Sequelize
    if (error.name === 'SequelizeValidationError') {
      return this.errorResponse(res, 'Error de validación', 400, error.errors);
    }

    // Error de constraint de BD
    if (error.name === 'SequelizeUniqueConstraintError') {
      return this.errorResponse(res, 'Registro duplicado', 409, error.errors);
    }

    // Error de foreign key
    if (error.name === 'SequelizeForeignKeyConstraintError') {
      return this.errorResponse(res, 'Error de integridad referencial', 409);
    }

    // Error genérico
    return this.errorResponse(res, message, 500);
  }

  /**
   * Convertir código de error a HTTP status
   */
  getHttpStatusCode(code) {
    const statusMap = {
      1: 409,   // Ya existe
      2: 404,   // No encontrado
      3: 200,   // Éxito
      5: 500,   // Error interno
      6: 500,   // Error de actualización
      8: 400,   // Proceso no válido
      10: 409,  // Dependencias
      11: 400,  // Error columnas dinámicas
      18: 403,  // No se puede modificar
      19: 403,  // Datos no modificables
      25: 409,  // Identificación duplicada
      36: 403,  // Sin ente organizacional
      37: 403,  // Sin permisos
      38: 400,  // Fecha futura
      51: 403,  // Ingresado vía web
      59: 400,  // Contacto no válido
      70: 400,  // Llave no válida
      77: 400,  // Localización no válida
      100: 500  // Error general
    };

    return statusMap[code] || 500;
  }

  /**
   * Validar parámetros requeridos
   */
  validateRequired(data, requiredFields) {
    const missing = [];
    
    for (const field of requiredFields) {
      if (!data[field] || data[field] === '') {
        missing.push(field);
      }
    }

    return missing;
  }

  /**
   * Obtener parámetro del sistema
   */
  async getParam(module, param) {
    try {
      const GeneralService = require('../Services/GeneralService');
      return await GeneralService.getParam(module, param);
    } catch (error) {
      this.logger.error('Error obteniendo parámetro:', error);
      return null;
    }
  }

  /**
   * Obtener usuario actual
   */
  getCurrentUser(req) {
    return req.user || null;
  }

  /**
   * Validar permisos
   */
  async validatePermission(req, permission) {
    const user = this.getCurrentUser(req);
    if (!user) return false;

    // Implementar lógica de permisos
    const ProfileService = require('../Services/ProfileService');
    return await ProfileService.hasPermission(user.usuacodigos, permission);
  }

  /**
   * Paginación estándar
   */
  getPaginationParams(req) {
    const page = parseInt(req.query.page) || 1;
    const limit = parseInt(req.query.limit) || 10;
    const offset = (page - 1) * limit;

    return { page, limit, offset };
  }

  /**
   * Respuesta paginada
   */
  paginatedResponse(res, data, total, page, limit) {
    return this.successResponse(res, {
      items: data,
      pagination: {
        total,
        page,
        limit,
        pages: Math.ceil(total / limit),
        hasNext: page * limit < total,
        hasPrev: page > 1
      }
    });
  }

  /**
   * Filtros de búsqueda
   */
  buildSearchFilters(req, searchableFields = []) {
    const { search } = req.query;
    if (!search || searchableFields.length === 0) return {};

    const { Op } = require('sequelize');
    return {
      [Op.or]: searchableFields.map(field => ({
        [field]: { [Op.iLike]: `%${search}%` }
      }))
    };
  }

  /**
   * Validar formato de fecha
   */
  isValidDate(dateString) {
    const date = new Date(dateString);
    return date instanceof Date && !isNaN(date);
  }

  /**
   * Convertir timestamp a fecha
   */
  timestampToDate(timestamp) {
    return new Date(timestamp * 1000);
  }

  /**
   * Convertir fecha a timestamp
   */
  dateToTimestamp(date) {
    return Math.floor(new Date(date).getTime() / 1000);
  }

  /**
   * Limpiar objeto de propiedades undefined/null
   */
  cleanObject(obj) {
    const cleaned = {};
    for (const [key, value] of Object.entries(obj)) {
      if (value !== undefined && value !== null) {
        cleaned[key] = value;
      }
    }
    return cleaned;
  }

  /**
   * Generar respuesta de archivo
   */
  fileResponse(res, filePath, filename = null) {
    const path = require('path');
    const fs = require('fs');

    if (!fs.existsSync(filePath)) {
      return this.errorResponse(res, 'Archivo no encontrado', 404);
    }

    const fileName = filename || path.basename(filePath);
    res.setHeader('Content-Disposition', `attachment; filename="${fileName}"`);
    res.sendFile(path.resolve(filePath));
  }

  /**
   * Validar formato de email
   */
  isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
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
}

module.exports = BaseController;