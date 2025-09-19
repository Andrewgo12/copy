const express = require('express');
const router = express.Router();

// Middleware de autenticación
const authMiddleware = require('../app/Middleware/AuthMiddleware');

// Controladores
const AuthController = require('../app/Controllers/AuthController');
const OrdenController = require('../app/Controllers/OrdenController');
const ClienteController = require('../app/Controllers/ClienteController');

/**
 * @swagger
 * components:
 *   securitySchemes:
 *     bearerAuth:
 *       type: http
 *       scheme: bearer
 *       bearerFormat: JWT
 */

// Rutas públicas
router.get('/', (req, res) => {
  res.json({
    message: 'Sistema CROSS API',
    version: '1.0.0',
    status: 'Activo',
    timestamp: new Date().toISOString()
  });
});

// Rutas de autenticación
router.post('/auth/login', AuthController.login);
router.post('/auth/register', authMiddleware, AuthController.register);
router.get('/auth/profile', authMiddleware, AuthController.profile);
router.post('/auth/logout', authMiddleware, AuthController.logout);
router.post('/auth/change-password', authMiddleware, AuthController.changePassword);

// Rutas de órdenes
router.get('/api/ordenes', authMiddleware, OrdenController.index);
router.post('/api/ordenes', authMiddleware, OrdenController.store);
router.get('/api/ordenes/dashboard', authMiddleware, OrdenController.dashboard);
router.get('/api/ordenes/:id', authMiddleware, OrdenController.show);
router.put('/api/ordenes/:id', authMiddleware, OrdenController.update);
router.delete('/api/ordenes/:id', authMiddleware, OrdenController.destroy);
router.post('/api/ordenes/:id/asignar', authMiddleware, OrdenController.asignar);

// Rutas de clientes
router.get('/api/clientes', authMiddleware, ClienteController.index);
router.post('/api/clientes', authMiddleware, ClienteController.store);
router.get('/api/clientes/buscar', authMiddleware, ClienteController.buscar);
router.get('/api/clientes/:id', authMiddleware, ClienteController.show);
router.put('/api/clientes/:id', authMiddleware, ClienteController.update);
router.delete('/api/clientes/:id', authMiddleware, ClienteController.destroy);
router.get('/api/clientes/:id/ordenes', authMiddleware, ClienteController.ordenes);

// Rutas de utilidades y sistema
router.get('/api/sistema/estado', authMiddleware, (req, res) => {
  const CronService = require('../app/Services/CronService');
  
  res.json({
    sistema: {
      version: require('../package.json').version,
      uptime: process.uptime(),
      memoria: process.memoryUsage(),
      timestamp: new Date().toISOString()
    },
    tareas_programadas: CronService.obtenerEstadoTareas()
  });
});

router.post('/api/sistema/test-email', authMiddleware, async (req, res) => {
  try {
    const EmailService = require('../app/Services/EmailService');
    
    if (!req.body.email) {
      return res.status(400).json({ error: 'Email requerido' });
    }
    
    const resultado = await EmailService.enviarEmailPrueba(req.body.email);
    
    res.json({
      message: 'Test de email ejecutado',
      resultado
    });
    
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.get('/api/sistema/conexion-smtp', authMiddleware, async (req, res) => {
  try {
    const EmailService = require('../app/Services/EmailService');
    const resultado = await EmailService.probarConexion();
    
    res.json(resultado);
    
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Ruta para crear alertas personalizadas
router.post('/api/sistema/alerta', authMiddleware, async (req, res) => {
  try {
    const AlertService = require('../app/Services/AlertService');
    const { tipo, mensaje, usuarios, prioridad } = req.body;
    
    if (!tipo || !mensaje) {
      return res.status(400).json({ error: 'Tipo y mensaje son requeridos' });
    }
    
    await AlertService.crearAlertaPersonalizada(tipo, mensaje, usuarios, prioridad);
    
    res.json({
      message: 'Alerta enviada exitosamente'
    });
    
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Manejo de errores 404 para rutas API
router.use('/api/*', (req, res) => {
  res.status(404).json({
    error: 'Endpoint no encontrado',
    path: req.originalUrl,
    method: req.method
  });
});

module.exports = router;