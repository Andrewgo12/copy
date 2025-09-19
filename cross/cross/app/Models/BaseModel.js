const { DataTypes } = require('sequelize');
const sequelize = require('../../config/database');

// Modelo base con campos comunes
class BaseModel {
  static init(modelName, attributes, options = {}) {
    // Agregar campos base a todos los modelos
    const baseAttributes = {
      id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
      },
      created_at: {
        type: DataTypes.DATE,
        allowNull: false,
        defaultValue: DataTypes.NOW
      },
      updated_at: {
        type: DataTypes.DATE,
        allowNull: false,
        defaultValue: DataTypes.NOW
      },
      created_by: {
        type: DataTypes.INTEGER,
        allowNull: true,
        references: {
          model: 'usuarios',
          key: 'id'
        }
      },
      updated_by: {
        type: DataTypes.INTEGER,
        allowNull: true,
        references: {
          model: 'usuarios',
          key: 'id'
        }
      },
      active: {
        type: DataTypes.BOOLEAN,
        defaultValue: true
      }
    };

    // Combinar atributos base con los específicos del modelo
    const finalAttributes = { ...baseAttributes, ...attributes };

    // Opciones por defecto
    const defaultOptions = {
      sequelize,
      modelName,
      tableName: modelName.toLowerCase(),
      timestamps: true,
      underscored: true,
      paranoid: false, // Soft delete deshabilitado por defecto
      hooks: {
        beforeUpdate: (instance) => {
          instance.updated_at = new Date();
        }
      }
    };

    // Combinar opciones
    const finalOptions = { ...defaultOptions, ...options };

    return sequelize.define(modelName, finalAttributes, finalOptions);
  }

  // Métodos de utilidad estáticos
  static async findActive(options = {}) {
    return this.findAll({
      where: { active: true },
      ...options
    });
  }

  static async findByIdActive(id, options = {}) {
    return this.findOne({
      where: { id, active: true },
      ...options
    });
  }

  static async softDelete(id, userId = null) {
    return this.update(
      { 
        active: false,
        updated_by: userId,
        updated_at: new Date()
      },
      { where: { id } }
    );
  }

  static async restore(id, userId = null) {
    return this.update(
      { 
        active: true,
        updated_by: userId,
        updated_at: new Date()
      },
      { where: { id } }
    );
  }
}

module.exports = BaseModel;