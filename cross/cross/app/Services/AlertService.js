const cron = require('node-cron');
const logger = require('./LoggerService');
const EmailService = require('./EmailService');

class AlertService {
  constructor() {
    this.alertasActivas = new Map();
    this.configurarAlertas();
  }

  configurarAlertas() {
    // Configuración de alertas migrada de CROSSHUV
    if (process.env.ENABLE_ALERTS === 'true') {
      this.iniciarMonitoreoVencimientos();
      this.iniciarReportesDiarios();
      logger.info('✅ Sistema de alertas iniciado');
    }
  }

  iniciarMonitoreoVencimientos() {
    // Verificar vencimientos cada hora
    cron.schedule('0 * * * *', async () => {
      await this.verificarVencimientos();
    });

    // Verificar órdenes por vencer cada 4 horas
    cron.schedule('0 */4 * * *', async () => {
      await this.verificarProximosVencimientos();
    });

    logger.info('Monitoreo de vencimientos configurado');
  }

  iniciarReportesDiarios() {
    // Reporte diario a las 8:00 AM
    cron.schedule('0 8 * * *', async () => {
      await this.enviarReporteDiario();
    });

    // Reporte semanal los lunes a las 9:00 AM
    cron.schedule('0 9 * * 1', async () => {
      await this.enviarReporteSemanal();
    });

    logger.info('Reportes automáticos configurados');
  }

  async verificarVencimientos() {
    try {
      const Orden = require('../Models/Orden');
      const Usuario = require('../Models/Usuario');
      
      const ordenesVencidas = await Orden.findVencidas();
      
      if (ordenesVencidas.length === 0) {
        logger.info('No hay órdenes vencidas');
        return;
      }

      logger.warn(`Encontradas ${ordenesVencidas.length} órdenes vencidas`);

      // Agrupar por usuario asignado
      const ordenesPorUsuario = new Map();
      
      for (const orden of ordenesVencidas) {
        if (orden.asignado_a) {
          if (!ordenesPorUsuario.has(orden.asignado_a)) {
            ordenesPorUsuario.set(orden.asignado_a, []);
          }
          ordenesPorUsuario.get(orden.asignado_a).push(orden);
        }
      }

      // Enviar alertas individuales
      for (const [usuarioId, ordenes] of ordenesPorUsuario) {
        const usuario = await Usuario.findByPk(usuarioId);
        if (usuario && usuario.email) {
          await this.enviarAlertaVencimientos(usuario, ordenes);
        }
      }

      // Notificar supervisores
      await this.notificarSupervisores(ordenesVencidas);

      // Registrar alerta en el sistema
      await this.registrarAlerta('vencimientos', {
        total_ordenes: ordenesVencidas.length,
        usuarios_notificados: ordenesPorUsuario.size,
        timestamp: new Date()
      });

    } catch (error) {
      logger.error('Error verificando vencimientos:', error);
    }
  }

  async verificarProximosVencimientos() {
    try {
      const Orden = require('../Models/Orden');
      const Usuario = require('../Models/Usuario');
      
      const ordenesPorVencer = await Orden.findPorVencer(2); // 2 días
      
      if (ordenesPorVencer.length === 0) {
        return;
      }

      logger.info(`Encontradas ${ordenesPorVencer.length} órdenes por vencer en 2 días`);

      // Notificar usuarios asignados
      for (const orden of ordenesPorVencer) {
        if (orden.asignado_a) {
          const usuario = await Usuario.findByPk(orden.asignado_a);
          if (usuario && usuario.email) {
            await this.enviarAlertaProximoVencimiento(usuario, orden);
          }
        }
      }

    } catch (error) {
      logger.error('Error verificando próximos vencimientos:', error);
    }
  }

  async enviarAlertaVencimientos(usuario, ordenes) {
    try {
      // Evitar spam - máximo una alerta por usuario por hora
      const claveAlerta = `vencimiento_${usuario.id}`;
      const ultimaAlerta = this.alertasActivas.get(claveAlerta);
      
      if (ultimaAlerta && (Date.now() - ultimaAlerta) < 3600000) { // 1 hora
        return;
      }

      const resultado = await EmailService.enviarReporteVencimientos(usuario, ordenes);
      
      if (resultado.exito) {
        this.alertasActivas.set(claveAlerta, Date.now());
        logger.info(`Alerta de vencimientos enviada a ${usuario.email}`);
      }

    } catch (error) {
      logger.error('Error enviando alerta de vencimientos:', error);
    }
  }

  async enviarAlertaProximoVencimiento(usuario, orden) {
    try {
      const diasRestantes = Math.ceil((orden.fecha_vencimiento - new Date()) / (1000 * 60 * 60 * 24));
      
      const contenido = `
        <h2>⚠️ Orden Próxima a Vencer</h2>
        <p>Estimado/a ${usuario.nombre} ${usuario.apellido},</p>
        <p>La siguiente orden está próxima a vencer:</p>
        <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px; margin: 15px 0;">
          <strong>Orden:</strong> ${orden.numero_orden}<br>
          <strong>Cliente:</strong> ${orden.Cliente ? orden.Cliente.razon_social : 'N/A'}<br>
          <strong>Título:</strong> ${orden.titulo}<br>
          <strong>Vence en:</strong> <span style="color: #856404; font-weight: bold;">${diasRestantes} día(s)</span><br>
          <strong>Fecha límite:</strong> ${orden.fecha_vencimiento.toLocaleDateString('es-CO')}
        </div>
        <p>Por favor, tome las acciones necesarias para completar esta orden a tiempo.</p>
      `;

      await EmailService.enviarEmail({
        para: usuario.email,
        asunto: `⚠️ Orden por vencer - ${orden.numero_orden}`,
        html: EmailService.plantillaBasica({ contenido })
      });

    } catch (error) {
      logger.error('Error enviando alerta de próximo vencimiento:', error);
    }
  }

  async notificarSupervisores(ordenesVencidas) {
    try {
      const Usuario = require('../Models/Usuario');
      
      const supervisores = await Usuario.findAll({
        where: {
          rol: ['supervisor', 'admin'],
          estado: 'activo',
          active: true
        }
      });

      const contenido = `
        <h2>🚨 Reporte de Órdenes Vencidas</h2>
        <p>Se han detectado <strong>${ordenesVencidas.length}</strong> órdenes vencidas que requieren atención inmediata.</p>
        <div style="background-color: #f8d7da; padding: 15px; border-radius: 5px; margin: 15px 0;">
          <h3>Resumen:</h3>
          <ul>
            ${ordenesVencidas.slice(0, 10).map(orden => `
              <li>
                <strong>${orden.numero_orden}</strong> - ${orden.titulo}
                <br><small>Cliente: ${orden.Cliente ? orden.Cliente.razon_social : 'N/A'} | 
                Vencida hace: ${Math.ceil((new Date() - orden.fecha_vencimiento) / (1000 * 60 * 60 * 24))} días</small>
              </li>
            `).join('')}
            ${ordenesVencidas.length > 10 ? `<li><em>... y ${ordenesVencidas.length - 10} órdenes más</em></li>` : ''}
          </ul>
        </div>
        <p>Se recomienda revisar y tomar acciones correctivas inmediatas.</p>
      `;

      for (const supervisor of supervisores) {
        if (supervisor.email) {
          await EmailService.enviarEmail({
            para: supervisor.email,
            asunto: `🚨 URGENTE: ${ordenesVencidas.length} órdenes vencidas`,
            html: EmailService.plantillaBasica({ contenido })
          });
        }
      }

    } catch (error) {
      logger.error('Error notificando supervisores:', error);
    }
  }

  async enviarReporteDiario() {
    try {
      const Usuario = require('../Models/Usuario');
      const Orden = require('../Models/Orden');
      const { Op } = require('sequelize');

      // Obtener estadísticas del día
      const hoy = new Date();
      hoy.setHours(0, 0, 0, 0);
      const mañana = new Date(hoy);
      mañana.setDate(mañana.getDate() + 1);

      const [
        ordenesCreadas,
        ordenesCompletadas,
        ordenesVencidas,
        ordenesPendientes
      ] = await Promise.all([
        Orden.count({
          where: {
            created_at: { [Op.between]: [hoy, mañana] },
            active: true
          }
        }),
        Orden.count({
          where: {
            fecha_completada: { [Op.between]: [hoy, mañana] },
            active: true
          }
        }),
        Orden.count({
          where: {
            fecha_vencimiento: { [Op.lt]: new Date() },
            estado: { [Op.notIn]: ['completada', 'cancelada'] },
            active: true
          }
        }),
        Orden.count({
          where: {
            estado: { [Op.in]: ['nueva', 'asignada', 'en_proceso'] },
            active: true
          }
        })
      ]);

      const contenido = `
        <h2>📊 Reporte Diario - Sistema CROSS</h2>
        <p><strong>Fecha:</strong> ${new Date().toLocaleDateString('es-CO')}</p>
        
        <div style="display: flex; flex-wrap: wrap; gap: 15px; margin: 20px 0;">
          <div style="background-color: #d4edda; padding: 15px; border-radius: 5px; flex: 1; min-width: 200px;">
            <h3 style="margin: 0; color: #155724;">Órdenes Creadas Hoy</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${ordenesCreadas}</p>
          </div>
          
          <div style="background-color: #cce5ff; padding: 15px; border-radius: 5px; flex: 1; min-width: 200px;">
            <h3 style="margin: 0; color: #004085;">Órdenes Completadas Hoy</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${ordenesCompletadas}</p>
          </div>
          
          <div style="background-color: #f8d7da; padding: 15px; border-radius: 5px; flex: 1; min-width: 200px;">
            <h3 style="margin: 0; color: #721c24;">Órdenes Vencidas</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${ordenesVencidas}</p>
          </div>
          
          <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px; flex: 1; min-width: 200px;">
            <h3 style="margin: 0; color: #856404;">Órdenes Pendientes</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${ordenesPendientes}</p>
          </div>
        </div>
        
        <p>Este reporte se genera automáticamente todos los días a las 8:00 AM.</p>
      `;

      // Enviar a supervisores y administradores
      const destinatarios = await Usuario.findAll({
        where: {
          rol: ['supervisor', 'admin'],
          estado: 'activo',
          active: true
        }
      });

      for (const usuario of destinatarios) {
        if (usuario.email) {
          await EmailService.enviarEmail({
            para: usuario.email,
            asunto: `📊 Reporte Diario CROSS - ${new Date().toLocaleDateString('es-CO')}`,
            html: EmailService.plantillaBasica({ contenido })
          });
        }
      }

      logger.info('Reporte diario enviado exitosamente');

    } catch (error) {
      logger.error('Error enviando reporte diario:', error);
    }
  }

  async enviarReporteSemanal() {
    try {
      // Implementar reporte semanal más detallado
      logger.info('Enviando reporte semanal...');
      
      // Por ahora, usar la misma lógica del reporte diario
      // pero con datos de la semana
      await this.enviarReporteDiario();

    } catch (error) {
      logger.error('Error enviando reporte semanal:', error);
    }
  }

  async registrarAlerta(tipo, datos) {
    try {
      // Registrar alerta en logs para análisis posterior
      logger.info(`Alerta registrada - Tipo: ${tipo}`, datos);
      
      // Aquí se podría guardar en base de datos para histórico
      // Por ahora solo registramos en logs

    } catch (error) {
      logger.error('Error registrando alerta:', error);
    }
  }

  async notificarAsignacion(orden, usuarioAsignado, usuarioAsignador) {
    try {
      await EmailService.enviarNotificacionAsignacion(orden, usuarioAsignado, usuarioAsignador);
      
      // Notificar por WebSocket si está disponible
      const io = require('../../server').io;
      if (io) {
        io.emit('orden_asignada', {
          orden_id: orden.id,
          numero_orden: orden.numero_orden,
          usuario_asignado: usuarioAsignado.id,
          mensaje: `Orden ${orden.numero_orden} asignada a ${usuarioAsignado.nombre} ${usuarioAsignado.apellido}`
        });
      }

    } catch (error) {
      logger.error('Error notificando asignación:', error);
    }
  }

  async crearAlertaPersonalizada(tipo, mensaje, usuarios, prioridad = 'normal') {
    try {
      const Usuario = require('../Models/Usuario');
      
      let destinatarios = [];
      
      if (Array.isArray(usuarios)) {
        destinatarios = await Usuario.findAll({
          where: { id: usuarios, active: true }
        });
      } else if (typeof usuarios === 'string') {
        // Buscar por rol
        destinatarios = await Usuario.findAll({
          where: { rol: usuarios, estado: 'activo', active: true }
        });
      }

      const contenido = `
        <h2>🔔 Alerta del Sistema</h2>
        <div style="background-color: ${prioridad === 'alta' ? '#f8d7da' : '#d1ecf1'}; padding: 15px; border-radius: 5px; margin: 15px 0;">
          <h3>Tipo: ${tipo.toUpperCase()}</h3>
          <p>${mensaje}</p>
          <p><small>Fecha: ${new Date().toLocaleString('es-CO')}</small></p>
        </div>
      `;

      for (const usuario of destinatarios) {
        if (usuario.email) {
          await EmailService.enviarEmail({
            para: usuario.email,
            asunto: `🔔 Alerta: ${tipo}`,
            html: EmailService.plantillaBasica({ contenido })
          });
        }
      }

      logger.info(`Alerta personalizada enviada a ${destinatarios.length} usuarios`);

    } catch (error) {
      logger.error('Error creando alerta personalizada:', error);
    }
  }
}

module.exports = new AlertService();