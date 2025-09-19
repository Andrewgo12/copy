const { DataTypes } = require('sequelize');
const BaseModel = require('./BaseModel');

class Proceso extends BaseModel {
  static init(sequelize) {
    return super.init({
      proccodigos: {
        type: DataTypes.STRING(20),
        primaryKey: true,
        allowNull: false,
        comment: 'Código único del proceso'
      },
      procnombres: {
        type: DataTypes.STRING(200),
        allowNull: false,
        comment: 'Nombre del proceso'
      },
      procdescripc: {
        type: DataTypes.TEXT,
        allowNull: true,
        comment: 'Descripción del proceso'
      },
      proctiempon: {
        type: DataTypes.INTEGER,
        allowNull: true,
        comment: 'Tiempo de duración en días'
      },
      procestinis: {
        type: DataTypes.STRING(10),
        allowNull: false,
        comment: 'Estado inicial del proceso'
      },
      procpriorids: {
        type: DataTypes.INTEGER,
        allowNull: true,
        defaultValue: 1,
        comment: 'Prioridad del proceso'
      },
      orgacodigos: {
        type: DataTypes.STRING(20),
        allowNull: true,
        comment: 'Organización responsable por defecto'
      },
      procactivos: {
        type: DataTypes.BOOLEAN,
        defaultValue: true,
        comment: 'Proceso activo'
      }
    }, {
      sequelize,
      modelName: 'Proceso',
      tableName: 'proceso',
      timestamps: false,
      indexes: [
        {
          fields: ['procnombres']
        },
        {
          fields: ['procpriorids']
        },
        {
          fields: ['procactivos']
        },
        {
          fields: ['orgacodigos']
        }
      ]
    });
  }

  static associate(models) {
    // Relación con Orden
    this.hasMany(models.Orden, {
      foreignKey: 'proccodigos',
      as: 'ordenes'
    });

    // Relación con Actividad
    this.hasMany(models.Actividad, {
      foreignKey: 'proccodigos',
      as: 'actividades'
    });

    // Relación con Organización
    this.belongsTo(models.Organizacion, {
      foreignKey: 'orgacodigos',
      as: 'organizacion'
    });
  }

  // Métodos de instancia
  isActive() {
    return this.procactivos === true;
  }

  getDurationInDays() {
    return this.proctiempon || 0;
  }

  getDurationInHours() {
    return (this.proctiempon || 0) * 24;
  }

  async getActividades() {
    const Actividad = require('./Actividad');
    return await Actividad.findAll({
      where: { 
        proccodigos: this.proccodigos,
        actiactivas: true 
      },
      order: [['actiorden', 'ASC']]
    });
  }

  async getActividadesIniciales() {
    const Actividad = require('./Actividad');
    return await Actividad.findAll({
      where: { 
        proccodigos: this.proccodigos,
        actiinicial: true,
        actiactivas: true 
      },
      order: [['actiorden', 'ASC']]
    });
  }

  async getReglas() {
    const Regla = require('./Regla');
    const actividades = await this.getActividades();
    const actividadCodes = actividades.map(a => a.acticodigos);
    
    return await Regla.findAll({
      where: {
        acticodigos: actividadCodes,
        reglactivas: true
      },
      order: [['reglpriorid', 'ASC']]
    });
  }

  // Métodos estáticos
  static async findActive() {
    return await this.findAll({
      where: { procactivos: true },
      order: [['procpriorids', 'ASC'], ['procnombres', 'ASC']]
    });
  }

  static async findByPriority(priority) {
    return await this.findAll({
      where: { 
        procpriorids: priority,
        procactivos: true 
      },
      order: [['procnombres', 'ASC']]
    });
  }

  static async findByOrganization(orgacodigos) {
    return await this.findAll({
      where: { 
        orgacodigos,
        procactivos: true 
      },
      order: [['procpriorids', 'ASC']]
    });
  }

  static async searchByName(nombre) {
    const { Op } = require('sequelize');
    return await this.findAll({
      where: {
        procnombres: {
          [Op.iLike]: `%${nombre}%`
        },
        procactivos: true
      },
      order: [['procnombres', 'ASC']]
    });
  }

  static async getWithStats() {
    const { Op } = require('sequelize');
    const Orden = require('./Orden');
    
    return await this.findAll({
      where: { procactivos: true },
      include: [{
        model: Orden,
        as: 'ordenes',
        attributes: [],
        required: false
      }],
      attributes: [
        'proccodigos',
        'procnombres',
        'procdescripc',
        'proctiempon',
        'procpriorids',
        [require('sequelize').fn('COUNT', require('sequelize').col('ordenes.ordenumeros')), 'totalOrdenes']
      ],
      group: ['Proceso.proccodigos'],
      order: [['procpriorids', 'ASC']]
    });
  }

  // Validaciones
  validateDuration() {
    if (this.proctiempon && this.proctiempon <= 0) {
      throw new Error('La duración del proceso debe ser mayor a 0');
    }
  }

  validatePriority() {
    if (this.procpriorids && this.procpriorids <= 0) {
      throw new Error('La prioridad debe ser mayor a 0');
    }
  }

  // Hook antes de guardar
  async beforeSave() {
    this.validateDuration();
    this.validatePriority();
  }

  // Métodos de workflow
  async calculateEndDate(startDate) {
    if (!this.proctiempon) {
      return startDate;
    }

    const GeneralService = require('../Services/GeneralService');
    return await GeneralService.addBusinessDays(startDate, this.proctiempon);
  }

  async canBeExecutedBy(orgacodigos) {
    // Si el proceso no tiene organización específica, cualquiera puede ejecutarlo
    if (!this.orgacodigos) {
      return true;
    }

    // Verificar si la organización coincide
    return this.orgacodigos === orgacodigos;
  }

  async clone(newCode, newName) {
    const transaction = await require('../../config/database').transaction();
    
    try {
      // Clonar proceso
      const newProceso = await Proceso.create({
        proccodigos: newCode,
        procnombres: newName,
        procdescripc: `${this.procdescripc} (Copia)`,
        proctiempon: this.proctiempon,
        procestinis: this.procestinis,
        procpriorids: this.procpriorids,
        orgacodigos: this.orgacodigos,
        procactivos: false // Inactivo por defecto
      }, { transaction });

      // Clonar actividades
      const actividades = await this.getActividades();
      const Actividad = require('./Actividad');
      const NumeradorService = require('../Services/NumeradorService');
      
      for (const actividad of actividades) {
        const newActicodigos = await NumeradorService.getNext('actividad');
        
        await Actividad.create({
          acticodigos: newActicodigos,
          proccodigos: newCode,
          actinombres: actividad.actinombres,
          actidescripc: actividad.actidescripc,
          actitiempon: actividad.actitiempon,
          actitipotien: actividad.actitipotien,
          actiorden: actividad.actiorden,
          actiinicial: actividad.actiinicial,
          orgacodigos: actividad.orgacodigos,
          actiactivas: false // Inactivas por defecto
        }, { transaction });
      }

      await transaction.commit();
      return newProceso;

    } catch (error) {
      await transaction.rollback();
      throw error;
    }
  }

  // Métodos de estadísticas
  async getExecutionStats(fechaInicio = null, fechaFin = null) {
    const { Op } = require('sequelize');
    const Orden = require('./Orden');
    
    const where = { proccodigos: this.proccodigos };
    
    if (fechaInicio && fechaFin) {
      where.ordefecregd = {
        [Op.between]: [
          Math.floor(new Date(fechaInicio).getTime() / 1000),
          Math.floor(new Date(fechaFin).getTime() / 1000)
        ]
      };
    }

    const ordenes = await Orden.findAll({ where });
    
    const stats = {
      total: ordenes.length,
      finalizadas: ordenes.filter(o => o.ordefecfinad).length,
      vencidas: ordenes.filter(o => o.isOverdue()).length,
      enProceso: ordenes.filter(o => !o.ordefecfinad).length,
      tiempoPromedio: 0
    };

    // Calcular tiempo promedio de finalización
    const finalizadas = ordenes.filter(o => o.ordefecfinad);
    if (finalizadas.length > 0) {
      const tiempoTotal = finalizadas.reduce((sum, orden) => {
        return sum + (orden.ordefecfinad - orden.ordefecregd);
      }, 0);
      
      stats.tiempoPromedio = Math.round(tiempoTotal / finalizadas.length / 86400); // En días
    }

    return stats;
  }
}

module.exports = Proceso;