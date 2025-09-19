const jwt = require('jsonwebtoken');
const Joi = require('joi');
const Usuario = require('../Models/Usuario');
const logger = require('../Services/LoggerService');

class AuthController {
  /**
   * @swagger
   * /auth/login:
   *   post:
   *     summary: Iniciar sesión
   *     tags: [Autenticación]
   *     requestBody:
   *       required: true
   *       content:
   *         application/json:
   *           schema:
   *             type: object
   *             properties:
   *               username:
   *                 type: string
   *               password:
   *                 type: string
   *     responses:
   *       200:
   *         description: Login exitoso
   *       401:
   *         description: Credenciales inválidas
   */
  async login(req, res) {
    try {
      // Validar entrada
      const schema = Joi.object({
        username: Joi.string().required(),
        password: Joi.string().required()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      const { username, password } = value;

      // Buscar usuario y validar credenciales
      const usuario = await Usuario.findByCredentials(username, password);
      
      if (!usuario) {
        // Incrementar intentos fallidos
        await Usuario.incrementarIntentosFallidos(username);
        
        return res.status(401).json({
          error: 'Credenciales inválidas'
        });
      }

      // Generar token JWT
      const token = jwt.sign(
        { 
          id: usuario.id,
          username: usuario.username,
          rol: usuario.rol
        },
        process.env.JWT_SECRET,
        { expiresIn: process.env.JWT_EXPIRES_IN || '24h' }
      );

      logger.info(`Usuario ${usuario.username} inició sesión`);

      res.json({
        message: 'Login exitoso',
        token,
        usuario: usuario.toJSON()
      });

    } catch (error) {
      logger.error('Error en login:', error);
      res.status(500).json({
        error: 'Error interno del servidor'
      });
    }
  }

  /**
   * @swagger
   * /auth/register:
   *   post:
   *     summary: Registrar nuevo usuario
   *     tags: [Autenticación]
   *     security:
   *       - bearerAuth: []
   *     requestBody:
   *       required: true
   *       content:
   *         application/json:
   *           schema:
   *             type: object
   *             properties:
   *               username:
   *                 type: string
   *               email:
   *                 type: string
   *               password:
   *                 type: string
   *               nombre:
   *                 type: string
   *               apellido:
   *                 type: string
   *               rol:
   *                 type: string
   *                 enum: [admin, supervisor, operador, consulta]
   *     responses:
   *       201:
   *         description: Usuario creado exitosamente
   *       400:
   *         description: Datos inválidos
   */
  async register(req, res) {
    try {
      // Validar entrada
      const schema = Joi.object({
        username: Joi.string().alphanum().min(3).max(50).required(),
        email: Joi.string().email().required(),
        password: Joi.string().min(6).required(),
        nombre: Joi.string().min(2).max(100).required(),
        apellido: Joi.string().min(2).max(100).required(),
        telefono: Joi.string().optional(),
        cargo: Joi.string().optional(),
        departamento: Joi.string().optional(),
        rol: Joi.string().valid('admin', 'supervisor', 'operador', 'consulta').default('operador')
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      // Verificar si el usuario ya existe
      const usuarioExistente = await Usuario.findOne({
        where: {
          $or: [
            { username: value.username },
            { email: value.email }
          ]
        }
      });

      if (usuarioExistente) {
        return res.status(400).json({
          error: 'El usuario o email ya existe'
        });
      }

      // Crear usuario
      const nuevoUsuario = await Usuario.create({
        ...value,
        created_by: req.user?.id
      });

      logger.info(`Nuevo usuario registrado: ${nuevoUsuario.username}`);

      res.status(201).json({
        message: 'Usuario creado exitosamente',
        usuario: nuevoUsuario.toJSON()
      });

    } catch (error) {
      logger.error('Error en registro:', error);
      res.status(500).json({
        error: 'Error interno del servidor'
      });
    }
  }

  /**
   * @swagger
   * /auth/profile:
   *   get:
   *     summary: Obtener perfil del usuario actual
   *     tags: [Autenticación]
   *     security:
   *       - bearerAuth: []
   *     responses:
   *       200:
   *         description: Perfil del usuario
   *       401:
   *         description: No autorizado
   */
  async profile(req, res) {
    try {
      const usuario = await Usuario.findByPk(req.user.id);
      
      if (!usuario) {
        return res.status(404).json({
          error: 'Usuario no encontrado'
        });
      }

      res.json({
        usuario: usuario.toJSON()
      });

    } catch (error) {
      logger.error('Error obteniendo perfil:', error);
      res.status(500).json({
        error: 'Error interno del servidor'
      });
    }
  }

  /**
   * @swagger
   * /auth/logout:
   *   post:
   *     summary: Cerrar sesión
   *     tags: [Autenticación]
   *     security:
   *       - bearerAuth: []
   *     responses:
   *       200:
   *         description: Logout exitoso
   */
  async logout(req, res) {
    try {
      logger.info(`Usuario ${req.user.username} cerró sesión`);
      
      res.json({
        message: 'Logout exitoso'
      });

    } catch (error) {
      logger.error('Error en logout:', error);
      res.status(500).json({
        error: 'Error interno del servidor'
      });
    }
  }

  /**
   * @swagger
   * /auth/change-password:
   *   post:
   *     summary: Cambiar contraseña
   *     tags: [Autenticación]
   *     security:
   *       - bearerAuth: []
   *     requestBody:
   *       required: true
   *       content:
   *         application/json:
   *           schema:
   *             type: object
   *             properties:
   *               currentPassword:
   *                 type: string
   *               newPassword:
   *                 type: string
   *     responses:
   *       200:
   *         description: Contraseña cambiada exitosamente
   *       400:
   *         description: Contraseña actual incorrecta
   */
  async changePassword(req, res) {
    try {
      const schema = Joi.object({
        currentPassword: Joi.string().required(),
        newPassword: Joi.string().min(6).required()
      });

      const { error, value } = schema.validate(req.body);
      if (error) {
        return res.status(400).json({
          error: 'Datos inválidos',
          details: error.details[0].message
        });
      }

      const { currentPassword, newPassword } = value;

      const usuario = await Usuario.findByPk(req.user.id);
      
      if (!usuario || !(await usuario.validarPassword(currentPassword))) {
        return res.status(400).json({
          error: 'Contraseña actual incorrecta'
        });
      }

      await usuario.update({
        password: newPassword,
        updated_by: req.user.id
      });

      logger.info(`Usuario ${usuario.username} cambió su contraseña`);

      res.json({
        message: 'Contraseña cambiada exitosamente'
      });

    } catch (error) {
      logger.error('Error cambiando contraseña:', error);
      res.status(500).json({
        error: 'Error interno del servidor'
      });
    }
  }
}

module.exports = new AuthController();