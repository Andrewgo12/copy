const Joi = require('joi');
const { Op } = require('sequelize');
const Orden = require('../Models/Orden');
const Cliente = require('../Models/Cliente');
const Usuario = require('../Models/Usuario');
const WorkflowService = require('../Services/WorkflowService');
const AlertService = require('../Services/AlertService');
const logger = require('../Services/LoggerService');

class OrdenController {
  /**
   * @swagger
   * /api/ordenes:
   *   get:
   *     summary: Listar órdenes
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   *     parameters:
   *       - in: query
   *         name: page
   *         schema:
   *           type: integer
   *         description: Página
   *       - in: query
   *         name: limit
   *         schema:
   *           type: integer
   *         description: Límite por página
   *       - in: query
   *         name: estado
   *         schema:
   *           type: string
   *         description: Filtrar por estado
   *     responses:
   *       200:
   *         description: Lista de órdenes
   */
  async index(req, res) {
    try {
      const page = parseInt(req.query.page) || 1;
      const limit = parseInt(req.query.limit) || 20;
      const offset = (page - 1) * limit;

      const where = { active: true };
      
      // Filtros
      if (req.query.estado) {
        where.estado = req.query.estado;
      }
      
      if (req.query.cliente_id) {
        where.cliente_id = req.query.cliente_id;
      }
      
      if (req.query.asignado_a) {
        where.asignado_a = req.query.asignado_a;
      }

      if (req.query.buscar) {
        where[Op.or] = [
          { numero_orden: { [Op.iLike]: `%${req.query.buscar}%` } },
          { titulo: { [Op.iLike]: `%${req.query.buscar}%` } },
          { descripcion: { [Op.iLike]: `%${req.query.buscar}%` } }
        ];
      }

      const { count, rows } = await Orden.findAndCountAll({
        where,
        include: [
          {
            model: Cliente,
            as: 'Cliente',
            attributes: ['id', 'razon_social', 'numero_documento']
          },
          {
            model: Usuario,
            as: 'AsignadoA',
            attributes: ['id', 'nombre', 'apellido', 'username']
          }
        ],
        order: [['created_at', 'DESC']],
        limit,
        offset
      });

      res.json({
        ordenes: rows,
        pagination: {
          page,
          limit,
          total: count,
          pages: Math.ceil(count / limit)
        }
      });

    } catch (error) {
      logger.error('Error listando órdenes:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes:
   *   post:
   *     summary: Crear nueva orden
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async store(req, res) {
    try {
      const schema = Joi.object({
        cliente_id: Joi.number().integer().required(),
        tipo_orden: Joi.string().valid('servicio', 'producto', 'consulta', 'reclamo').required(),
        prioridad: Joi.string().valid('baja', 'normal', 'alta', 'critica').default('normal'),
        titulo: Joi.string().max(200).required(),
        descripcion: Joi.string().optional(),
        categoria: Joi.string().max(100).optional(),
        subcategoria: Joi.string().max(100).optional(),
        fecha_vencimiento: Joi.date().optional(),
        tiempo_estimado: Joi.number().integer().optional(),
        valor_estimado: Joi.number().optional(),
        observaciones: Joi.string().optional(),
        datos_adicionales: Joi.object().optional()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      // Verificar que el cliente existe
      const cliente = await Cliente.findByPk(value.cliente_id);
      if (!cliente) {
        return res.status(404).json({ error: 'Cliente no encontrado' });
      }

      // Generar número de orden
      const numeroOrden = await Orden.generarNumeroOrden();

      // Crear orden
      const orden = await Orden.create({
        ...value,
        numero_orden: numeroOrden,
        created_by: req.user.id
      });

      // Iniciar workflow si está configurado
      await WorkflowService.iniciarProceso(orden, req.user.id);

      // Cargar relaciones para respuesta
      await orden.reload({
        include: [
          { model: Cliente, as: 'Cliente' },
          { model: Usuario, as: 'AsignadoA' }
        ]
      });

      logger.info(`Nueva orden creada: ${orden.numero_orden} por ${req.user.username}`);

      res.status(201).json({
        message: 'Orden creada exitosamente',
        orden
      });

    } catch (error) {
      logger.error('Error creando orden:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes/{id}:
   *   get:
   *     summary: Obtener orden por ID
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async show(req, res) {
    try {
      const orden = await Orden.findOne({
        where: { id: req.params.id, active: true },
        include: [
          { model: Cliente, as: 'Cliente' },
          { model: Usuario, as: 'AsignadoA' },
          { model: Usuario, as: 'CreadoPor' }
        ]
      });

      if (!orden) {
        return res.status(404).json({ error: 'Orden no encontrada' });
      }

      res.json({ orden });

    } catch (error) {
      logger.error('Error obteniendo orden:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes/{id}:
   *   put:
   *     summary: Actualizar orden
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async update(req, res) {
    try {
      const orden = await Orden.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!orden) {
        return res.status(404).json({ error: 'Orden no encontrada' });
      }

      const schema = Joi.object({
        tipo_orden: Joi.string().valid('servicio', 'producto', 'consulta', 'reclamo').optional(),
        prioridad: Joi.string().valid('baja', 'normal', 'alta', 'critica').optional(),
        estado: Joi.string().valid('nueva', 'asignada', 'en_proceso', 'pendiente', 'completada', 'cancelada').optional(),
        titulo: Joi.string().max(200).optional(),
        descripcion: Joi.string().optional(),
        asignado_a: Joi.number().integer().optional(),
        fecha_vencimiento: Joi.date().optional(),
        tiempo_estimado: Joi.number().integer().optional(),
        valor_estimado: Joi.number().optional(),
        observaciones: Joi.string().optional(),
        datos_adicionales: Joi.object().optional()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      // Verificar cambio de estado para completar
      if (value.estado === 'completada' && orden.estado !== 'completada') {
        value.fecha_completada = new Date();
      }

      await orden.update({
        ...value,
        updated_by: req.user.id
      });

      // Procesar workflow si hay cambio de estado
      if (value.estado && value.estado !== orden.estado) {
        await WorkflowService.procesarCambioEstado(orden, value.estado, req.user.id);
      }

      await orden.reload({
        include: [
          { model: Cliente, as: 'Cliente' },
          { model: Usuario, as: 'AsignadoA' }
        ]
      });

      logger.info(`Orden ${orden.numero_orden} actualizada por ${req.user.username}`);

      res.json({
        message: 'Orden actualizada exitosamente',
        orden
      });

    } catch (error) {
      logger.error('Error actualizando orden:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes/{id}/asignar:
   *   post:
   *     summary: Asignar orden a usuario
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async asignar(req, res) {
    try {
      const orden = await Orden.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!orden) {
        return res.status(404).json({ error: 'Orden no encontrada' });
      }

      const schema = Joi.object({
        usuario_id: Joi.number().integer().required(),
        observaciones: Joi.string().optional()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      // Verificar que el usuario existe
      const usuario = await Usuario.findByPk(value.usuario_id);
      if (!usuario) {
        return res.status(404).json({ error: 'Usuario no encontrado' });
      }

      await orden.update({
        asignado_a: value.usuario_id,
        estado: 'asignada',
        observaciones: value.observaciones || orden.observaciones,
        updated_by: req.user.id
      });

      // Notificar asignación
      await AlertService.notificarAsignacion(orden, usuario, req.user);

      logger.info(`Orden ${orden.numero_orden} asignada a ${usuario.username}`);

      res.json({
        message: 'Orden asignada exitosamente',
        orden
      });

    } catch (error) {
      logger.error('Error asignando orden:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes/dashboard:
   *   get:
   *     summary: Dashboard de órdenes
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async dashboard(req, res) {
    try {
      const [
        totalOrdenes,
        ordenesNuevas,
        ordenesEnProceso,
        ordenesVencidas,
        ordenesPorVencer
      ] = await Promise.all([
        Orden.count({ where: { active: true } }),
        Orden.count({ where: { estado: 'nueva', active: true } }),
        Orden.count({ where: { estado: 'en_proceso', active: true } }),
        Orden.count({
          where: {
            fecha_vencimiento: { [Op.lt]: new Date() },
            estado: { [Op.notIn]: ['completada', 'cancelada'] },
            active: true
          }
        }),
        Orden.count({
          where: {
            fecha_vencimiento: {
              [Op.between]: [new Date(), new Date(Date.now() + 3 * 24 * 60 * 60 * 1000)]
            },
            estado: { [Op.notIn]: ['completada', 'cancelada'] },
            active: true
          }
        })
      ]);

      res.json({
        dashboard: {
          total_ordenes: totalOrdenes,
          ordenes_nuevas: ordenesNuevas,
          ordenes_en_proceso: ordenesEnProceso,
          ordenes_vencidas: ordenesVencidas,
          ordenes_por_vencer: ordenesPorVencer
        }
      });

    } catch (error) {
      logger.error('Error obteniendo dashboard:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }

  /**
   * @swagger
   * /api/ordenes/{id}:
   *   delete:
   *     summary: Eliminar orden (soft delete)
   *     tags: [Órdenes]
   *     security:
   *       - bearerAuth: []
   */
  async destroy(req, res) {
    try {
      const orden = await Orden.findOne({
        where: { id: req.params.id, active: true }
      });

      if (!orden) {
        return res.status(404).json({ error: 'Orden no encontrada' });
      }

      await orden.update({
        active: false,
        updated_by: req.user.id
      });

      logger.info(`Orden ${orden.numero_orden} eliminada por ${req.user.username}`);

      res.json({
        message: 'Orden eliminada exitosamente'
      });

    } catch (error) {
      logger.error('Error eliminando orden:', error);
      res.status(500).json({ error: 'Error interno del servidor' });
    }
  }
}

module.exports = new OrdenController();