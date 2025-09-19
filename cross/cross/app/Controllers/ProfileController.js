const BaseController = require('./BaseController');
const bcrypt = require('bcryptjs');
const jwt = require('jsonwebtoken');

class ProfileController extends BaseController {

  async login(req, res) {
    try {
      const { usuacodigos, password } = req.body;
      
      if (!usuacodigos || !password) {
        return this.errorResponse(res, 'Usuario y contraseña requeridos', 400);
      }

      const Usuario = require('../Models/Usuario');
      
      const usuario = await Usuario.findByPk(usuacodigos, {
        include: ['perfiles', 'organizaciones']
      });

      if (!usuario || !usuario.usuaactivos) {
        this.logger.logAuth('login_failed', usuacodigos, false, { 
          reason: 'user_not_found',
          ip: req.ip 
        });
        
        return this.errorResponse(res, 'Credenciales inválidas', 401);
      }

      const passwordValid = await bcrypt.compare(password, usuario.usuapassword);
      
      if (!passwordValid) {
        this.logger.logAuth('login_failed', usuacodigos, false, { 
          reason: 'invalid_password',
          ip: req.ip 
        });
        
        return this.errorResponse(res, 'Credenciales inválidas', 401);
      }

      // Obtener permisos del usuario
      const permisos = await this.getUserPermissions(usuario);
      
      // Generar token JWT
      const token = jwt.sign({
        usuacodigos: usuario.usuacodigos,
        usuanombres: usuario.usuanombres,
        usuaemail: usuario.usuaemail,
        perfiles: usuario.perfiles?.map(p => p.perfcodigos) || [],
        permisos,
        orgacodigos: usuario.organizaciones?.map(o => o.orgacodigos) || []
      }, process.env.JWT_SECRET, {
        expiresIn: process.env.JWT_EXPIRES_IN || '24h'
      });

      // Actualizar último login
      await usuario.update({
        usuaultlogin: Math.floor(Date.now() / 1000)
      });

      this.logger.logAuth('login_success', usuacodigos, true, { ip: req.ip });

      return this.successResponse(res, {
        message: 'Login exitoso',
        token,
        user: {
          usuacodigos: usuario.usuacodigos,
          usuanombres: usuario.usuanombres,
          usuaemail: usuario.usuaemail,
          perfiles: usuario.perfiles?.map(p => p.perfcodigos) || [],
          permisos,
          organizaciones: usuario.organizaciones?.map(o => ({
            codigo: o.orgacodigos,
            nombre: o.organombres
          })) || []
        }
      });

    } catch (error) {
      return this.handleError(res, error, 'Error en login');
    }
  }

  async logout(req, res) {
    try {
      const usuario = this.getCurrentUser(req);
      
      if (usuario) {
        this.logger.logAuth('logout', usuario.usuacodigos, true, { ip: req.ip });
      }

      return this.successResponse(res, {
        message: 'Logout exitoso'
      });

    } catch (error) {
      return this.handleError(res, error, 'Error en logout');
    }
  }

  async register(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const { usuacodigos, usuanombres, usuaemail, password, perfiles = [] } = req.body;
      
      // Validar campos requeridos
      const missing = this.validateRequired(req.body, ['usuacodigos', 'usuanombres', 'usuaemail', 'password']);
      if (missing.length > 0) {
        return this.errorResponse(res, `Campos requeridos: ${missing.join(', ')}`, 400);
      }

      // Validar email
      if (!this.isValidEmail(usuaemail)) {
        return this.errorResponse(res, 'Formato de email inválido', 400);
      }

      const Usuario = require('../Models/Usuario');
      
      // Verificar que no exista el usuario
      const existeUsuario = await Usuario.findByPk(usuacodigos, { transaction });
      if (existeUsuario) {
        return this.errorResponse(res, 'El usuario ya existe', 409);
      }

      // Verificar que no exista el email
      const existeEmail = await Usuario.findOne({
        where: { usuaemail },
        transaction
      });
      if (existeEmail) {
        return this.errorResponse(res, 'El email ya está registrado', 409);
      }

      // Encriptar contraseña
      const hashedPassword = await bcrypt.hash(password, parseInt(process.env.BCRYPT_ROUNDS) || 12);

      // Crear usuario
      const usuario = await Usuario.create({
        usuacodigos,
        usuanombres,
        usuaemail,
        usuapassword: hashedPassword,
        usuaactivos: true,
        usuaalertas: false,
        usuafeccread: Math.floor(Date.now() / 1000)
      }, { transaction });

      // Asignar perfiles si se especificaron
      if (perfiles.length > 0) {
        const Perfil = require('../Models/Perfil');
        const perfilesValidos = await Perfil.findAll({
          where: { perfcodigos: perfiles, perfactivos: true },
          transaction
        });

        await usuario.setPerfiles(perfilesValidos, { transaction });
      }

      await transaction.commit();

      this.logger.logAuth('register_success', usuacodigos, true, { 
        email: usuaemail,
        ip: req.ip 
      });

      return this.successResponse(res, {
        message: 'Usuario registrado exitosamente',
        usuario: {
          usuacodigos: usuario.usuacodigos,
          usuanombres: usuario.usuanombres,
          usuaemail: usuario.usuaemail
        }
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error registrando usuario');
    }
  }

  async index(req, res) {
    try {
      const { page = 1, limit = 10, activos } = req.query;
      const Usuario = require('../Models/Usuario');
      
      const where = {};
      if (activos !== undefined) {
        where.usuaactivos = activos === 'true';
      }

      const usuarios = await Usuario.findAndCountAll({
        where,
        include: ['perfiles', 'organizaciones'],
        attributes: { exclude: ['usuapassword'] },
        limit: parseInt(limit),
        offset: (parseInt(page) - 1) * parseInt(limit),
        order: [['usuanombres', 'ASC']]
      });

      return this.paginatedResponse(res, usuarios.rows, usuarios.count, parseInt(page), parseInt(limit));

    } catch (error) {
      return this.handleError(res, error, 'Error al listar usuarios');
    }
  }

  async show(req, res) {
    try {
      const { id } = req.params;
      const Usuario = require('../Models/Usuario');
      
      const usuario = await Usuario.findByPk(id, {
        include: ['perfiles', 'organizaciones'],
        attributes: { exclude: ['usuapassword'] }
      });

      if (!usuario) {
        return this.errorResponse(res, 'Usuario no encontrado', 404);
      }

      return this.successResponse(res, { usuario });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener usuario');
    }
  }

  async update(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const { id } = req.params;
      const updateData = req.body;
      
      const Usuario = require('../Models/Usuario');
      
      const usuario = await Usuario.findByPk(id, { transaction });
      if (!usuario) {
        return this.errorResponse(res, 'Usuario no encontrado', 404);
      }

      // Si se actualiza la contraseña, encriptarla
      if (updateData.password) {
        updateData.usuapassword = await bcrypt.hash(updateData.password, 12);
        delete updateData.password;
      }

      await usuario.update(updateData, { transaction });
      await transaction.commit();

      return this.successResponse(res, {
        message: 'Usuario actualizado exitosamente'
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error al actualizar usuario');
    }
  }

  async getPermisos(req, res) {
    try {
      const { id } = req.params;
      
      const permisos = await this.getUserPermissions({ usuacodigos: id });

      return this.successResponse(res, { permisos });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener permisos');
    }
  }

  async changePassword(req, res) {
    try {
      const { currentPassword, newPassword } = req.body;
      const usuario = this.getCurrentUser(req);
      
      if (!currentPassword || !newPassword) {
        return this.errorResponse(res, 'Contraseña actual y nueva requeridas', 400);
      }

      const Usuario = require('../Models/Usuario');
      const user = await Usuario.findByPk(usuario.usuacodigos);
      
      const passwordValid = await bcrypt.compare(currentPassword, user.usuapassword);
      if (!passwordValid) {
        return this.errorResponse(res, 'Contraseña actual incorrecta', 401);
      }

      const hashedPassword = await bcrypt.hash(newPassword, 12);
      await user.update({ usuapassword: hashedPassword });

      this.logger.logAuth('password_changed', usuario.usuacodigos, true, { ip: req.ip });

      return this.successResponse(res, {
        message: 'Contraseña actualizada exitosamente'
      });

    } catch (error) {
      return this.handleError(res, error, 'Error al cambiar contraseña');
    }
  }

  // Métodos auxiliares
  async getUserPermissions(usuario) {
    try {
      const ProfileService = require('../Services/ProfileService');
      return await ProfileService.getUserPermissions(usuario.usuacodigos);
    } catch (error) {
      this.logger.error('Error obteniendo permisos:', error);
      return [];
    }
  }
}

module.exports = ProfileController;