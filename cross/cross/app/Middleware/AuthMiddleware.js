const jwt = require('jsonwebtoken');
const Usuario = require('../Models/Usuario');
const logger = require('../Services/LoggerService');

const authMiddleware = async (req, res, next) => {
  try {
    // Obtener token del header Authorization
    const authHeader = req.header('Authorization');
    
    if (!authHeader || !authHeader.startsWith('Bearer ')) {
      return res.status(401).json({
        error: 'Token de acceso requerido'
      });
    }

    const token = authHeader.substring(7); // Remover 'Bearer '

    // Verificar token
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    
    // Buscar usuario en base de datos
    const usuario = await Usuario.findOne({
      where: {
        id: decoded.id,
        estado: 'activo',
        active: true
      }
    });

    if (!usuario) {
      return res.status(401).json({
        error: 'Usuario no válido o inactivo'
      });
    }

    // Agregar usuario a la request
    req.user = {
      id: usuario.id,
      username: usuario.username,
      email: usuario.email,
      nombre: usuario.nombre,
      apellido: usuario.apellido,
      rol: usuario.rol
    };

    next();

  } catch (error) {
    if (error.name === 'JsonWebTokenError') {
      return res.status(401).json({
        error: 'Token inválido'
      });
    }
    
    if (error.name === 'TokenExpiredError') {
      return res.status(401).json({
        error: 'Token expirado'
      });
    }

    logger.error('Error en middleware de autenticación:', error);
    res.status(500).json({
      error: 'Error interno del servidor'
    });
  }
};

module.exports = authMiddleware;