const Joi = require('joi');
const { Op } = require('sequelize');
const Cliente = require('../Models/Cliente');
const Usuario = require('../Models/Usuario');
const logger = require('../Services/LoggerService');

class ClienteController {
  /**
   * @swagger
   * /api/clientes:
   *   get:
   *     summary: Listar clientes
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async index(req, res) {
    try {
      const page = parseInt(req.query.page) || 1;
      const limit = parseInt(req.query.limit) || 20;
      const offset = (page - 1) * limit;

      const where = { active: true };
      
      if (req.query.estado) {
        where.estado = req.query.estado;
      }
      
      if (req.query.categoria) {
        where.categoria = req.query.categoria;
      }

      if (req.query.buscar) {
        where[Op.or] = [
          { razon_social: { [Op.iLike]: `%${req.query.buscar}%` } },
          { nombre_comercial: { [Op.iLike]: `%${req.query.buscar}%` } },
          { numero_documento: { [Op.iLike]: `%${req.query.buscar}%` } },
          { email_principal: { [Op.iLike]: `%${req.query.buscar}%` } }
        ];
      }

      const { count, rows } = await Cliente.findAndCountAll({
        where,
        include: [
          {
            model: Usuario,
            as: 'VendedorAsignado',
            attributes: ['id', 'nombre', 'apellido', 'username']
          }
        ],
        order: [['razon_social', 'ASC']],
        limit,
        offset
      });

      res.json({
        clientes: rows,
        pagination: {
          page,
          limit,
          total: count,
          pages: Math.ceil(count / limit)
        }
      });

    } catch (error) {
      logger.error('Error listando clientes:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes:
   *   post:
   *     summary: Crear nuevo cliente
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async store(req, res) {
    try {
      const schema = Joi.object({
        tipo_documento: Joi.string().valid('CC', 'NIT', 'CE', 'PP', 'TI').required(),
        numero_documento: Joi.string().max(20).required(),
        razon_social: Joi.string().max(200).required(),
        nombre_comercial: Joi.string().max(200).optional(),
        tipo_cliente: Joi.string().valid('persona_natural', 'persona_juridica').required(),
        categoria: Joi.string().valid('premium', 'corporativo', 'pyme', 'individual').default('individual'),
        email_principal: Joi.string().email().optional(),
        telefono_principal: Joi.string().max(20).optional(),
        celular_principal: Joi.string().max(20).optional(),
        direccion: Joi.string().optional(),
        ciudad: Joi.string().max(100).optional(),
        departamento: Joi.string().max(100).optional(),
        pais: Joi.string().max(100).default('Colombia'),
        codigo_postal: Joi.string().max(10).optional(),
        sitio_web: Joi.string().uri().optional(),
        sector_economico: Joi.string().max(100).optional(),
        tamaño_empresa: Joi.string().valid('micro', 'pequeña', 'mediana', 'grande').optional(),
        limite_credito: Joi.number().optional(),
        dias_credito: Joi.number().integer().default(0),
        descuento_general: Joi.number().min(0).max(100).default(0),
        observaciones: Joi.string().optional(),
        datos_adicionales: Joi.object().optional(),
        representante_legal: Joi.string().max(200).optional(),
        contacto_principal: Joi.string().max(200).optional(),
        cargo_contacto: Joi.string().max(100).optional(),
        vendedor_asignado: Joi.number().integer().optional()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      // Verificar que no existe cliente con mismo documento
      const clienteExistente = await Cliente.findByDocumento(value.tipo_documento, value.numero_documento);
      if (clienteExistente) {
        return res.status(400).json({
          error: 'Ya existe un cliente con este documento'
        });
      }

      // Verificar vendedor si se asigna
      if (value.vendedor_asignado) {
        const vendedor = await Usuario.findByPk(value.vendedor_asignado);
        if (!vendedor) {
          return res.status(404).json({ error: 'Vendedor no encontrado' });
        }
      }

      const cliente = await Cliente.create({
        ...value,
        created_by: req.user.id
      });

      await cliente.reload({
        include: [
          { model: Usuario, as: 'VendedorAsignado' }
        ]
      });

      logger.info(`Nuevo cliente creado: ${cliente.razon_social} por ${req.user.username}`);

      res.status(201).json({
        message: 'Cliente creado exitosamente',
        cliente
      });

    } catch (error) {
      logger.error('Error creando cliente:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes/{id}:
   *   get:
   *     summary: Obtener cliente por ID
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async show(req, res) {
    try {
      const cliente = await Cliente.findOne({
        where: { id: req.params.id, active: true },
        include: [
          { model: Usuario, as: 'VendedorAsignado' },
          { model: Usuario, as: 'CreadoPor' }
        ]
      });

      if (!cliente) {
        return res.status(404).json({ error: 'Cliente no encontrado' });
      }

      res.json({ cliente });

    } catch (error) {
      logger.error('Error obteniendo cliente:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes/{id}:
   *   put:
   *     summary: Actualizar cliente
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async update(req, res) {
    try {
      const cliente = await Cliente.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!cliente) {
        return res.status(404).json({ error: 'Cliente no encontrado' });
      }

      const schema = Joi.object({
        razon_social: Joi.string().max(200).optional(),
        nombre_comercial: Joi.string().max(200).optional(),
        categoria: Joi.string().valid('premium', 'corporativo', 'pyme', 'individual').optional(),
        estado: Joi.string().valid('activo', 'inactivo', 'suspendido', 'bloqueado').optional(),
        email_principal: Joi.string().email().optional(),
        telefono_principal: Joi.string().max(20).optional(),
        celular_principal: Joi.string().max(20).optional(),
        direccion: Joi.string().optional(),
        ciudad: Joi.string().max(100).optional(),
        departamento: Joi.string().max(100).optional(),
        pais: Joi.string().max(100).optional(),
        codigo_postal: Joi.string().max(10).optional(),
        sitio_web: Joi.string().uri().optional(),
        sector_economico: Joi.string().max(100).optional(),
        tamaño_empresa: Joi.string().valid('micro', 'pequeña', 'mediana', 'grande').optional(),
        limite_credito: Joi.number().optional(),
        dias_credito: Joi.number().integer().optional(),
        descuento_general: Joi.number().min(0).max(100).optional(),
        observaciones: Joi.string().optional(),
        datos_adicionales: Joi.object().optional(),
        representante_legal: Joi.string().max(200).optional(),
        contacto_principal: Joi.string().max(200).optional(),
        cargo_contacto: Joi.string().max(100).optional(),
        vendedor_asignado: Joi.number().integer().optional()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      await cliente.update({
        ...value,
        updated_by: req.user.id
      });

      await cliente.reload({
        include: [
          { model: Usuario, as: 'VendedorAsignado' }
        ]
      });

      logger.info(`Cliente ${cliente.razon_social} actualizado por ${req.user.username}`);

      res.json({
        message: 'Cliente actualizado exitosamente',
        cliente
      });

    } catch (error) {
      logger.error('Error actualizando cliente:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes/buscar:
   *   get:
   *     summary: Buscar clientes
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async buscar(req, res) {
    try {
      const { q } = req.query;
      
      if (!q || q.length < 2) {
        return res.status(400).json({
          error: 'El término de búsqueda debe tener al menos 2 caracteres'
        });
      }

      const clientes = await Cliente.buscar(q, {
        limit: 10,
        attributes: ['id', 'razon_social', 'nombre_comercial', 'numero_documento', 'email_principal']
      });

      res.json({ clientes });

    } catch (error) {
      logger.error('Error buscando clientes:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes/{id}/ordenes:
   *   get:
   *     summary: Obtener órdenes del cliente
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async ordenes(req, res) {
    try {
      const cliente = await Cliente.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!cliente) {
        return res.status(404).json({ error: 'Cliente no encontrado' });
      }

      const Orden = require('../Models/Orden');
      
      const ordenes = await Orden.findAll({
        where: { 
          cliente_id: cliente.id,
          active: true 
        },
        include: [
          {
            model: Usuario,
            as: 'AsignadoA',
            attributes: ['id', 'nombre', 'apellido']
          }
        ],
        order: [['created_at', 'DESC']],
        limit: 50
      });

      res.json({ ordenes });

    } catch (error) {
      logger.error('Error obteniendo órdenes del cliente:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/clientes/{id}:
   *   delete:
   *     summary: Eliminar cliente (soft delete)
   *     tags: [Clientes]
   *     security:
   *       - bearerAuth: []
   */
  async destroy(req, res) {
    try {
      const cliente = await Cliente.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!cliente) {
        return res.status(404).json({ error: 'Cliente no encontrado' });
      }

      await cliente.update({
        active: false,
        updated_by: req.user.id
      });

      logger.info(`Cliente ${cliente.razon_social} eliminado por ${req.user.username}`);

      res.json({
        message: 'Cliente eliminado exitosamente'
      });

    } catch (error) {
      logger.error('Error eliminando cliente:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }
}

module.exports = new ClienteController();