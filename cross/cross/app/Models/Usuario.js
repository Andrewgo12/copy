const { DataTypes } = require('sequelize');
const bcrypt = require('bcryptjs');
const BaseModel = require('./BaseModel');

const Usuario = BaseModel.init('Usuario', {
  username: {
    type: DataTypes.STRING(50),
    allowNull: false,
    unique: true
  },
  email: {
    type: DataTypes.STRING(100),
    allowNull: false,
    unique: true,
    validate: {
      isEmail: true
    }
  },
  password: {
    type: DataTypes.STRING(255),
    allowNull: false
  },
  nombre: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  apellido: {
    type: DataTypes.STRING(100),
    allowNull: false
  },
  telefono: {
    type: DataTypes.STRING(20),
    allowNull: true
  },
  cargo: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  departamento: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  rol: {
    type: DataTypes.ENUM('admin', 'supervisor', 'operador', 'consulta'),
    defaultValue: 'operador'
  },
  estado: {
    type: DataTypes.ENUM('activo', 'inactivo', 'bloqueado'),
    defaultValue: 'activo'
  },
  ultimo_acceso: {
    type: DataTypes.DATE,
    allowNull: true
  },
  intentos_fallidos: {
    type: DataTypes.INTEGER,
    defaultValue: 0
  },
  configuracion: {
    type: DataTypes.JSONB,
    defaultValue: {}
  }
}, {
  tableName: 'usuarios',
  hooks: {
    beforeCreate: async (usuario) => {
      if (usuario.password) {
        usuario.password = await bcrypt.hash(usuario.password, 12);
      }
    },
    beforeUpdate: async (usuario) => {
      if (usuario.changed('password')) {
        usuario.password = await bcrypt.hash(usuario.password, 12);
      }
    }
  }
});

// Métodos de instancia
Usuario.prototype.validarPassword = async function(password) {
  return bcrypt.compare(password, this.password);
};

Usuario.prototype.toJSON = function() {
  const values = { ...this.get() };
  delete values.password;
  return values;
};

// Métodos estáticos
Usuario.findByCredentials = async function(username, password) {
  const usuario = await this.findOne({
    where: {
      $or: [
        { username },
        { email: username }
      ],
      estado: 'activo',
      active: true
    }
  });

  if (!usuario || !(await usuario.validarPassword(password))) {
    return null;
  }

  // Actualizar último acceso
  await usuario.update({
    ultimo_acceso: new Date(),
    intentos_fallidos: 0
  });

  return usuario;
};

Usuario.incrementarIntentosFallidos = async function(username) {
  const usuario = await this.findOne({
    where: {
      $or: [
        { username },
        { email: username }
      ]
    }
  });

  if (usuario) {
    const intentos = usuario.intentos_fallidos + 1;
    await usuario.update({
      intentos_fallidos: intentos,
      estado: intentos >= 5 ? 'bloqueado' : usuario.estado
    });
  }
};

module.exports = Usuario;