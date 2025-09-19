const { DataTypes } = require('sequelize');
const BaseModel = require('./BaseModel');

class Numerador extends BaseModel {
  static init(sequelize) {
    return super.init({
      numetipos: {
        type: DataTypes.STRING(20),
        primaryKey: true,
        allowNull: false,
        comment: 'Tipo de numerador'
      },
      numevalors: {
        type: DataTypes.INTEGER,
        allowNull: false,
        defaultValue: 1,
        comment: 'Valor actual del numerador'
      },
      numeprefijos: {
        type: DataTypes.STRING(10),
        allowNull: true,
        defaultValue: '',
        comment: 'Prefijo del numerador'
      },
      numesufijos: {
        type: DataTypes.STRING(10),
        allowNull: true,
        defaultValue: '',
        comment: 'Sufijo del numerador'
      },
      numelongituds: {
        type: DataTypes.INTEGER,
        allowNull: false,
        defaultValue: 6,
        comment: 'Longitud del número con padding'
      }
    }, {
      sequelize,
      modelName: 'Numerador',
      tableName: 'numerador',
      timestamps: false,
      indexes: [
        {
          fields: ['numetipos']
        }
      ]
    });
  }

  // Métodos de instancia
  getNext(cantidad = 1) {
    const currentValue = this.numevalors;
    this.numevalors += cantidad;
    
    return cantidad === 1 ? 
      this.formatNumber(currentValue) : 
      {
        start: this.formatNumber(currentValue),
        end: this.formatNumber(currentValue + cantidad - 1),
        count: cantidad
      };
  }

  formatNumber(number) {
    const paddedNumber = number.toString().padStart(this.numelongituds, '0');
    return `${this.numeprefijos}${paddedNumber}${this.numesufijos}`;
  }

  getCurrent() {
    return this.formatNumber(this.numevalors - 1);
  }

  getExample() {
    return this.formatNumber(this.numevalors);
  }

  reset(newValue = 1) {
    this.numevalors = newValue;
    return this;
  }

  configure(config) {
    if (config.prefix !== undefined) {
      this.numeprefijos = config.prefix;
    }
    if (config.suffix !== undefined) {
      this.numesufijos = config.suffix;
    }
    if (config.length !== undefined) {
      this.numelongituds = config.length;
    }
    if (config.startValue !== undefined) {
      this.numevalors = config.startValue;
    }
    
    return this;
  }

  // Métodos estáticos
  static async getOrCreate(tipo, config = {}) {
    let numerador = await this.findByPk(tipo);
    
    if (!numerador) {
      numerador = await this.create({
        numetipos: tipo,
        numevalors: config.startValue || 1,
        numeprefijos: config.prefix || '',
        numesufijos: config.suffix || '',
        numelongituds: config.length || 6
      });
    }
    
    return numerador;
  }

  static async getNextValue(tipo, cantidad = 1) {
    const numerador = await this.getOrCreate(tipo);
    const result = numerador.getNext(cantidad);
    await numerador.save();
    
    return result;
  }

  static async getCurrentValue(tipo) {
    const numerador = await this.findByPk(tipo);
    return numerador ? numerador.getCurrent() : null;
  }

  static async resetNumerador(tipo, newValue = 1) {
    const numerador = await this.findByPk(tipo);
    if (numerador) {
      numerador.reset(newValue);
      await numerador.save();
      return true;
    }
    return false;
  }

  static async configureNumerador(tipo, config) {
    let numerador = await this.findByPk(tipo);
    
    if (!numerador) {
      numerador = await this.create({
        numetipos: tipo,
        numevalors: config.startValue || 1,
        numeprefijos: config.prefix || '',
        numesufijos: config.suffix || '',
        numelongituds: config.length || 6
      });
    } else {
      numerador.configure(config);
      await numerador.save();
    }
    
    return numerador;
  }

  static async getAllWithStats() {
    const numeradores = await this.findAll({
      order: [['numetipos', 'ASC']]
    });

    return numeradores.map(num => ({
      tipo: num.numetipos,
      valorActual: num.numevalors,
      totalGenerados: num.numevalors - 1,
      prefijo: num.numeprefijos,
      sufijo: num.numesufijos,
      longitud: num.numelongituds,
      ejemplo: num.getExample(),
      ultimoGenerado: num.getCurrent()
    }));
  }

  static async validateFormat(numero, tipo) {
    const numerador = await this.findByPk(tipo);
    if (!numerador) {
      return false;
    }

    // Validar estructura básica
    if (!numero || typeof numero !== 'string') {
      return false;
    }

    // Validar prefijo
    if (numerador.numeprefijos && !numero.startsWith(numerador.numeprefijos)) {
      return false;
    }

    // Validar sufijo
    if (numerador.numesufijos && !numero.endsWith(numerador.numesufijos)) {
      return false;
    }

    // Extraer parte numérica
    let numericPart = numero;
    if (numerador.numeprefijos) {
      numericPart = numericPart.substring(numerador.numeprefijos.length);
    }
    if (numerador.numesufijos) {
      numericPart = numericPart.substring(0, numericPart.length - numerador.numesufijos.length);
    }

    // Validar que sea numérico y tenga la longitud correcta
    const isNumeric = /^\d+$/.test(numericPart);
    const hasCorrectLength = numericPart.length === numerador.numelongituds;

    return isNumeric && hasCorrectLength;
  }

  static async getUsageStats(tipo = null) {
    const where = tipo ? { numetipos: tipo } : {};
    const numeradores = await this.findAll({ where });

    const stats = numeradores.map(num => ({
      tipo: num.numetipos,
      valorActual: num.numevalors,
      totalGenerados: num.numevalors - 1,
      configuracion: {
        prefijo: num.numeprefijos,
        sufijo: num.numesufijos,
        longitud: num.numelongituds
      },
      ejemplo: num.getExample()
    }));

    return tipo ? stats[0] : stats;
  }

  static async backup() {
    const numeradores = await this.getAllWithStats();
    
    const backup = {
      timestamp: new Date().toISOString(),
      version: '1.0',
      numeradores
    };

    return backup;
  }

  static async restore(backupData) {
    const transaction = await require('../../config/database').transaction();
    
    try {
      for (const numData of backupData.numeradores) {
        await this.upsert({
          numetipos: numData.tipo,
          numevalors: numData.valorActual,
          numeprefijos: numData.prefijo,
          numesufijos: numData.sufijo,
          numelongituds: numData.longitud
        }, { transaction });
      }

      await transaction.commit();
      return true;

    } catch (error) {
      await transaction.rollback();
      throw error;
    }
  }

  // Validaciones
  validateLength() {
    if (this.numelongituds <= 0) {
      throw new Error('La longitud debe ser mayor a 0');
    }
    if (this.numelongituds > 20) {
      throw new Error('La longitud no puede ser mayor a 20');
    }
  }

  validateValue() {
    if (this.numevalors < 1) {
      throw new Error('El valor debe ser mayor o igual a 1');
    }
  }

  validatePrefixSuffix() {
    const totalLength = (this.numeprefijos?.length || 0) + 
                       this.numelongituds + 
                       (this.numesufijos?.length || 0);
    
    if (totalLength > 50) {
      throw new Error('La longitud total (prefijo + número + sufijo) no puede exceder 50 caracteres');
    }
  }

  // Hook antes de guardar
  async beforeSave() {
    this.validateLength();
    this.validateValue();
    this.validatePrefixSuffix();
  }

  // Métodos de utilidad
  static getDefaultConfigurations() {
    return {
      orden: {
        prefix: '',
        suffix: '',
        length: 10,
        startValue: 1
      },
      cliente: {
        prefix: 'CLI',
        suffix: '',
        length: 3,
        startValue: 1
      },
      tarea: {
        prefix: 'T',
        suffix: '',
        length: 6,
        startValue: 1
      },
      proceso: {
        prefix: 'PROC',
        suffix: '',
        length: 3,
        startValue: 1
      },
      actividad: {
        prefix: 'ACT',
        suffix: '',
        length: 3,
        startValue: 1
      },
      regla: {
        prefix: 'R',
        suffix: '',
        length: 3,
        startValue: 1
      },
      archivos: {
        prefix: 'ARCH',
        suffix: '',
        length: 6,
        startValue: 1
      }
    };
  }

  static async initializeDefaults() {
    const defaults = this.getDefaultConfigurations();
    const results = [];

    for (const [tipo, config] of Object.entries(defaults)) {
      const numerador = await this.getOrCreate(tipo, config);
      results.push({
        tipo,
        created: numerador.isNewRecord,
        config: numerador.toJSON()
      });
    }

    return results;
  }
}

module.exports = Numerador;