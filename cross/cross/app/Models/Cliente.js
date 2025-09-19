const { DataTypes } = require('sequelize');
const BaseModel = require('./BaseModel');

const Cliente = BaseModel.init('Cliente', {
  tipo_documento: {
    type: DataTypes.ENUM('CC', 'NIT', 'CE', 'PP', 'TI'),
    allowNull: false
  },
  numero_documento: {
    type: DataTypes.STRING(20),
    allowNull: false,
    unique: true
  },
  razon_social: {
    type: DataTypes.STRING(200),
    allowNull: false
  },
  nombre_comercial: {
    type: DataTypes.STRING(200),
    allowNull: true
  },
  tipo_cliente: {
    type: DataTypes.ENUM('persona_natural', 'persona_juridica'),
    allowNull: false
  },
  categoria: {
    type: DataTypes.ENUM('premium', 'corporativo', 'pyme', 'individual'),
    defaultValue: 'individual'
  },
  estado: {
    type: DataTypes.ENUM('activo', 'inactivo', 'suspendido', 'bloqueado'),
    defaultValue: 'activo'
  },
  email_principal: {
    type: DataTypes.STRING(100),
    allowNull: true,
    validate: {
      isEmail: true
    }
  },
  telefono_principal: {
    type: DataTypes.STRING(20),
    allowNull: true
  },
  celular_principal: {
    type: DataTypes.STRING(20),
    allowNull: true
  },
  direccion: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  ciudad: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  departamento: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  pais: {
    type: DataTypes.STRING(100),
    defaultValue: 'Colombia'
  },
  codigo_postal: {
    type: DataTypes.STRING(10),
    allowNull: true
  },
  sitio_web: {
    type: DataTypes.STRING(200),
    allowNull: true
  },
  sector_economico: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  tamaño_empresa: {
    type: DataTypes.ENUM('micro', 'pequeña', 'mediana', 'grande'),
    allowNull: true
  },
  fecha_registro: {
    type: DataTypes.DATE,
    defaultValue: DataTypes.NOW
  },
  fecha_ultima_compra: {
    type: DataTypes.DATE,
    allowNull: true
  },
  valor_total_compras: {
    type: DataTypes.DECIMAL(15, 2),
    defaultValue: 0
  },
  limite_credito: {
    type: DataTypes.DECIMAL(15, 2),
    allowNull: true
  },
  dias_credito: {
    type: DataTypes.INTEGER,
    defaultValue: 0
  },
  descuento_general: {
    type: DataTypes.DECIMAL(5, 2),
    defaultValue: 0
  },
  observaciones: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  datos_adicionales: {
    type: DataTypes.JSONB,
    defaultValue: {}
  },
  representante_legal: {
    type: DataTypes.STRING(200),
    allowNull: true
  },
  contacto_principal: {
    type: DataTypes.STRING(200),
    allowNull: true
  },
  cargo_contacto: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  vendedor_asignado: {
    type: DataTypes.INTEGER,
    allowNull: true,
    references: {
      model: 'usuarios',
      key: 'id'
    }
  }
}, {
  tableName: 'clientes',
  indexes: [
    { fields: ['numero_documento'] },
    { fields: ['razon_social'] },
    { fields: ['email_principal'] },
    { fields: ['estado'] },
    { fields: ['categoria'] },
    { fields: ['vendedor_asignado'] }
  ]
});

// Métodos de instancia
Cliente.prototype.getNombreCompleto = function() {
  return this.nombre_comercial || this.razon_social;
};

Cliente.prototype.getContactoPrincipal = function() {
  return {
    nombre: this.contacto_principal,
    cargo: this.cargo_contacto,
    email: this.email_principal,
    telefono: this.telefono_principal,
    celular: this.celular_principal
  };
};

Cliente.prototype.getDireccionCompleta = function() {
  const partes = [this.direccion, this.ciudad, this.departamento, this.pais].filter(Boolean);
  return partes.join(', ');
};

// Métodos estáticos
Cliente.findByDocumento = async function(tipoDocumento, numeroDocumento) {
  return this.findOne({
    where: {
      tipo_documento: tipoDocumento,
      numero_documento: numeroDocumento,
      active: true
    }
  });
};

Cliente.findActivos = async function(options = {}) {
  return this.findAll({
    where: {
      estado: 'activo',
      active: true
    },
    ...options
  });
};

Cliente.buscar = async function(termino, options = {}) {
  const { Op } = require('sequelize');
  
  return this.findAll({
    where: {
      [Op.or]: [
        { razon_social: { [Op.iLike]: `%${termino}%` } },
        { nombre_comercial: { [Op.iLike]: `%${termino}%` } },
        { numero_documento: { [Op.iLike]: `%${termino}%` } },
        { email_principal: { [Op.iLike]: `%${termino}%` } }
      ],
      active: true
    },
    ...options
  });
};

module.exports = Cliente;