const { DataTypes } = require('sequelize');
const BaseModel = require('./BaseModel');

const Orden = BaseModel.init('Orden', {
  numero_orden: {
    type: DataTypes.STRING(20),
    allowNull: false,
    unique: true
  },
  cliente_id: {
    type: DataTypes.INTEGER,
    allowNull: false,
    references: {
      model: 'clientes',
      key: 'id'
    }
  },
  tipo_orden: {
    type: DataTypes.ENUM('servicio', 'producto', 'consulta', 'reclamo'),
    allowNull: false
  },
  prioridad: {
    type: DataTypes.ENUM('baja', 'normal', 'alta', 'critica'),
    defaultValue: 'normal'
  },
  estado: {
    type: DataTypes.ENUM('nueva', 'asignada', 'en_proceso', 'pendiente', 'completada', 'cancelada'),
    defaultValue: 'nueva'
  },
  titulo: {
    type: DataTypes.STRING(200),
    allowNull: false
  },
  descripcion: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  asignado_a: {
    type: DataTypes.INTEGER,
    allowNull: true,
    references: {
      model: 'usuarios',
      key: 'id'
    }
  },
  fecha_vencimiento: {
    type: DataTypes.DATE,
    allowNull: true
  },
  fecha_completada: {
    type: DataTypes.DATE,
    allowNull: true
  },
  tiempo_estimado: {
    type: DataTypes.INTEGER, // minutos
    allowNull: true
  },
  tiempo_real: {
    type: DataTypes.INTEGER, // minutos
    allowNull: true
  },
  categoria: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  subcategoria: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  valor_estimado: {
    type: DataTypes.DECIMAL(15, 2),
    allowNull: true
  },
  valor_real: {
    type: DataTypes.DECIMAL(15, 2),
    allowNull: true
  },
  observaciones: {
    type: DataTypes.TEXT,
    allowNull: true
  },
  datos_adicionales: {
    type: DataTypes.JSONB,
    defaultValue: {}
  },
  workflow_estado: {
    type: DataTypes.STRING(50),
    allowNull: true
  },
  workflow_proceso_id: {
    type: DataTypes.INTEGER,
    allowNull: true,
    references: {
      model: 'workflow_procesos',
      key: 'id'
    }
  }
}, {
  tableName: 'ordenes',
  indexes: [
    { fields: ['numero_orden'] },
    { fields: ['cliente_id'] },
    { fields: ['estado'] },
    { fields: ['asignado_a'] },
    { fields: ['fecha_vencimiento'] },
    { fields: ['tipo_orden', 'estado'] }
  ]
});

// Métodos de instancia
Orden.prototype.estaVencida = function() {
  if (!this.fecha_vencimiento) return false;
  return new Date() > this.fecha_vencimiento && this.estado !== 'completada';
};

Orden.prototype.diasVencimiento = function() {
  if (!this.fecha_vencimiento) return null;
  const diff = this.fecha_vencimiento - new Date();
  return Math.ceil(diff / (1000 * 60 * 60 * 24));
};

// Métodos estáticos
Orden.generarNumeroOrden = async function() {
  const fecha = new Date();
  const año = fecha.getFullYear();
  const mes = String(fecha.getMonth() + 1).padStart(2, '0');
  
  const prefijo = `ORD${año}${mes}`;
  
  const ultimaOrden = await this.findOne({
    where: {
      numero_orden: {
        $like: `${prefijo}%`
      }
    },
    order: [['numero_orden', 'DESC']]
  });
  
  let siguiente = 1;
  if (ultimaOrden) {
    const ultimoNumero = parseInt(ultimaOrden.numero_orden.slice(-4));
    siguiente = ultimoNumero + 1;
  }
  
  return `${prefijo}${String(siguiente).padStart(4, '0')}`;
};

Orden.findVencidas = async function() {
  return this.findAll({
    where: {
      fecha_vencimiento: {
        $lt: new Date()
      },
      estado: {
        $notIn: ['completada', 'cancelada']
      },
      active: true
    },
    include: ['Cliente', 'AsignadoA']
  });
};

Orden.findPorVencer = async function(dias = 3) {
  const fechaLimite = new Date();
  fechaLimite.setDate(fechaLimite.getDate() + dias);
  
  return this.findAll({
    where: {
      fecha_vencimiento: {
        $between: [new Date(), fechaLimite]
      },
      estado: {
        $notIn: ['completada', 'cancelada']
      },
      active: true
    },
    include: ['Cliente', 'AsignadoA']
  });
};

module.exports = Orden;