const BaseService = require('./BaseService');

class NumeradorService extends BaseService {
  
  constructor() {
    super();
    this.cache = new Map(); // Cache para numeradores
  }

  /**
   * Obtener siguiente número de secuencia
   * Migrado de: NumeradorManager::fncgetByIdNumerador()
   */
  async getNext(tipo, cantidad = 1) {
    return await this.executeInTransaction(async (transaction) => {
      try {
        const Numerador = require('../Models/Numerador');
        
        // Buscar o crear numerador
        let numerador = await Numerador.findByPk(tipo, {
          transaction,
          lock: transaction.LOCK.UPDATE // Lock para evitar concurrencia
        });

        if (!numerador) {
          // Crear numerador si no existe
          numerador = await Numerador.create({
            numetipos: tipo,
            numevalors: 1,
            numeprefijos: '',
            numesufijos: '',
            numelongituds: 6
          }, { transaction });
        }

        const currentValue = numerador.numevalors;
        const nextValue = currentValue + cantidad;

        // Actualizar valor
        await numerador.update({
          numevalors: nextValue
        }, { transaction });

        // Formatear número con padding
        const formattedNumber = this.formatNumber(
          currentValue,
          numerador.numelongituds,
          numerador.numeprefijos,
          numerador.numesufijos
        );

        // Actualizar cache
        this.cache.set(tipo, nextValue);

        this.logger.info(`Numerador generado: ${tipo} = ${formattedNumber}`);

        return cantidad === 1 ? formattedNumber : {
          start: formattedNumber,
          end: this.formatNumber(
            currentValue + cantidad - 1,
            numerador.numelongituds,
            numerador.numeprefijos,
            numerador.numesufijos
          ),
          count: cantidad
        };

      } catch (error) {
        this.logger.error(`Error generando numerador ${tipo}:`, error);
        throw error;
      }
    });
  }

  /**
   * Obtener múltiples números consecutivos
   */
  async getRange(tipo, cantidad) {
    if (cantidad <= 1) {
      return [await this.getNext(tipo)];
    }

    const result = await this.getNext(tipo, cantidad);
    const numbers = [];
    
    const Numerador = require('../Models/Numerador');
    const numerador = await Numerador.findByPk(tipo);
    
    const startValue = result.start.replace(/\D/g, ''); // Extraer solo números
    
    for (let i = 0; i < cantidad; i++) {
      const value = parseInt(startValue) + i;
      numbers.push(this.formatNumber(
        value,
        numerador.numelongituds,
        numerador.numeprefijos,
        numerador.numesufijos
      ));
    }

    return numbers;
  }

  /**
   * Formatear número con prefijo, sufijo y padding
   */
  formatNumber(number, length = 6, prefix = '', suffix = '') {
    const paddedNumber = number.toString().padStart(length, '0');
    return `${prefix}${paddedNumber}${suffix}`;
  }

  /**
   * Obtener valor actual sin incrementar
   */
  async getCurrent(tipo) {
    try {
      const Numerador = require('../Models/Numerador');
      
      const numerador = await Numerador.findByPk(tipo);
      if (!numerador) {
        return null;
      }

      return this.formatNumber(
        numerador.numevalors - 1, // Valor actual (último usado)
        numerador.numelongituds,
        numerador.numeprefijos,
        numerador.numesufijos
      );

    } catch (error) {
      this.logger.error(`Error obteniendo numerador actual ${tipo}:`, error);
      throw error;
    }
  }

  /**
   * Configurar numerador
   */
  async configure(tipo, config) {
    try {
      const Numerador = require('../Models/Numerador');
      
      const numerador = await Numerador.findByPk(tipo);
      if (!numerador) {
        // Crear nuevo numerador
        await Numerador.create({
          numetipos: tipo,
          numevalors: config.startValue || 1,
          numeprefijos: config.prefix || '',
          numesufijos: config.suffix || '',
          numelongituds: config.length || 6
        });
      } else {
        // Actualizar configuración existente
        await numerador.update({
          numeprefijos: config.prefix !== undefined ? config.prefix : numerador.numeprefijos,
          numesufijos: config.suffix !== undefined ? config.suffix : numerador.numesufijos,
          numelongituds: config.length !== undefined ? config.length : numerador.numelongituds,
          numevalors: config.startValue !== undefined ? config.startValue : numerador.numevalors
        });
      }

      // Limpiar cache
      this.cache.delete(tipo);

      this.logger.info(`Numerador configurado: ${tipo}`, config);
      return true;

    } catch (error) {
      this.logger.error(`Error configurando numerador ${tipo}:`, error);
      throw error;
    }
  }

  /**
   * Resetear numerador
   */
  async reset(tipo, newValue = 1) {
    try {
      const Numerador = require('../Models/Numerador');
      
      const numerador = await Numerador.findByPk(tipo);
      if (!numerador) {
        throw new Error(`Numerador ${tipo} no existe`);
      }

      await numerador.update({ numevalors: newValue });
      
      // Limpiar cache
      this.cache.delete(tipo);

      this.logger.info(`Numerador reseteado: ${tipo} = ${newValue}`);
      return true;

    } catch (error) {
      this.logger.error(`Error reseteando numerador ${tipo}:`, error);
      throw error;
    }
  }

  /**
   * Listar todos los numeradores
   */
  async getAll() {
    try {
      const Numerador = require('../Models/Numerador');
      
      const numeradores = await Numerador.findAll({
        order: [['numetipos', 'ASC']]
      });

      return numeradores.map(num => ({
        tipo: num.numetipos,
        valorActual: num.numevalors,
        prefijo: num.numeprefijos,
        sufijo: num.numesufijos,
        longitud: num.numelongituds,
        ejemplo: this.formatNumber(
          num.numevalors,
          num.numelongituds,
          num.numeprefijos,
          num.numesufijos
        )
      }));

    } catch (error) {
      this.logger.error('Error listando numeradores:', error);
      throw error;
    }
  }

  /**
   * Validar formato de numerador
   */
  validateFormat(numero, tipo) {
    try {
      const Numerador = require('../Models/Numerador');
      
      // Esta sería una validación asíncrona en un caso real
      // Por simplicidad, validamos el formato básico
      
      if (!numero || typeof numero !== 'string') {
        return false;
      }

      // Validar que contenga solo caracteres alfanuméricos
      const alphanumericRegex = /^[A-Z0-9]+$/;
      return alphanumericRegex.test(numero);

    } catch (error) {
      this.logger.error(`Error validando formato de numerador:`, error);
      return false;
    }
  }

  /**
   * Obtener estadísticas de uso
   */
  async getStats(tipo = null) {
    try {
      const Numerador = require('../Models/Numerador');
      
      const where = tipo ? { numetipos: tipo } : {};
      const numeradores = await Numerador.findAll({ where });

      const stats = numeradores.map(num => ({
        tipo: num.numetipos,
        valorActual: num.numevalors,
        totalGenerados: num.numevalors - 1,
        configuracion: {
          prefijo: num.numeprefijos,
          sufijo: num.numesufijos,
          longitud: num.numelongituds
        }
      }));

      return tipo ? stats[0] : stats;

    } catch (error) {
      this.logger.error('Error obteniendo estadísticas de numeradores:', error);
      throw error;
    }
  }

  /**
   * Backup de numeradores
   */
  async backup() {
    try {
      const numeradores = await this.getAll();
      const backup = {
        timestamp: new Date().toISOString(),
        numeradores
      };

      // Guardar backup en archivo
      const fs = require('fs').promises;
      const path = require('path');
      
      const backupPath = path.join(
        process.cwd(),
        'storage',
        'backups',
        `numeradores-${Date.now()}.json`
      );

      await fs.mkdir(path.dirname(backupPath), { recursive: true });
      await fs.writeFile(backupPath, JSON.stringify(backup, null, 2));

      this.logger.info(`Backup de numeradores creado: ${backupPath}`);
      return backupPath;

    } catch (error) {
      this.logger.error('Error creando backup de numeradores:', error);
      throw error;
    }
  }

  /**
   * Restaurar numeradores desde backup
   */
  async restore(backupPath) {
    try {
      const fs = require('fs').promises;
      const backupData = JSON.parse(await fs.readFile(backupPath, 'utf8'));

      const Numerador = require('../Models/Numerador');

      for (const numData of backupData.numeradores) {
        await Numerador.upsert({
          numetipos: numData.tipo,
          numevalors: numData.valorActual,
          numeprefijos: numData.configuracion.prefijo,
          numesufijos: numData.configuracion.sufijo,
          numelongituds: numData.configuracion.longitud
        });
      }

      // Limpiar cache
      this.cache.clear();

      this.logger.info(`Numeradores restaurados desde: ${backupPath}`);
      return true;

    } catch (error) {
      this.logger.error('Error restaurando numeradores:', error);
      throw error;
    }
  }

  /**
   * Limpiar cache
   */
  clearCache() {
    this.cache.clear();
    this.logger.info('Cache de numeradores limpiado');
  }
}

module.exports = new NumeradorService();