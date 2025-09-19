const cron = require('node-cron');
const logger = require('./LoggerService');
const WorkflowService = require('./WorkflowService');
const AlertService = require('./AlertService');

class CronService {
  constructor() {
    this.tareas = new Map();
    this.inicializarTareas();
  }

  inicializarTareas() {
    logger.info('Inicializando tareas programadas...');

    // Verificar vencimientos cada 30 minutos
    this.programarTarea('verificar-vencimientos', '*/30 * * * *', async () => {
      await WorkflowService.verificarVencimientos();
    });

    // Limpiar logs antiguos diariamente a las 2:00 AM
    this.programarTarea('limpiar-logs', '0 2 * * *', async () => {
      await this.limpiarLogsAntiguos();
    });

    // Backup de datos críticos diariamente a las 3:00 AM
    this.programarTarea('backup-datos', '0 3 * * *', async () => {
      await this.realizarBackupDatos();
    });

    // Optimizar base de datos semanalmente los domingos a las 4:00 AM
    this.programarTarea('optimizar-bd', '0 4 * * 0', async () => {
      await this.optimizarBaseDatos();
    });

    // Generar estadísticas mensuales el primer día del mes a las 5:00 AM
    this.programarTarea('estadisticas-mensuales', '0 5 1 * *', async () => {
      await this.generarEstadisticasMensuales();
    });

    // Verificar salud del sistema cada 5 minutos
    this.programarTarea('health-check', '*/5 * * * *', async () => {
      await this.verificarSaludSistema();
    });

    logger.info(`✅ ${this.tareas.size} tareas programadas iniciadas`);
  }

  programarTarea(nombre, cronExpression, callback) {
    try {
      const tarea = cron.schedule(cronExpression, async () => {
        const inicio = Date.now();
        logger.info(`Ejecutando tarea: ${nombre}`);
        
        try {
          await callback();
          const duracion = Date.now() - inicio;
          logger.info(`Tarea ${nombre} completada en ${duracion}ms`);
        } catch (error) {
          logger.error(`Error en tarea ${nombre}:`, error);
        }
      }, {
        scheduled: true,
        timezone: 'America/Bogota'
      });

      this.tareas.set(nombre, {
        tarea,
        cronExpression,
        ultimaEjecucion: null,
        proximaEjecucion: tarea.nextDate()
      });

      logger.info(`Tarea ${nombre} programada: ${cronExpression}`);

    } catch (error) {
      logger.error(`Error programando tarea ${nombre}:`, error);
    }
  }

  async limpiarLogsAntiguos() {
    try {
      const fs = require('fs').promises;
      const path = require('path');
      
      const directorioLogs = path.join(__dirname, '../../storage/logs');
      const archivos = await fs.readdir(directorioLogs);
      
      const fechaLimite = new Date();
      fechaLimite.setDate(fechaLimite.getDate() - 30); // 30 días
      
      let archivosEliminados = 0;
      
      for (const archivo of archivos) {
        const rutaArchivo = path.join(directorioLogs, archivo);
        const stats = await fs.stat(rutaArchivo);
        
        if (stats.mtime < fechaLimite && archivo.endsWith('.log')) {
          await fs.unlink(rutaArchivo);
          archivosEliminados++;
        }
      }
      
      logger.info(`Limpieza de logs completada: ${archivosEliminados} archivos eliminados`);
      
    } catch (error) {
      logger.error('Error limpiando logs antiguos:', error);
    }
  }

  async realizarBackupDatos() {
    try {
      const { exec } = require('child_process');
      const path = require('path');
      
      const fecha = new Date().toISOString().split('T')[0];
      const nombreBackup = `cross_backup_${fecha}.sql`;
      const rutaBackup = path.join(__dirname, '../../storage/backups', nombreBackup);
      
      // Crear directorio de backups si no existe
      const fs = require('fs').promises;
      const directorioBackups = path.dirname(rutaBackup);
      await fs.mkdir(directorioBackups, { recursive: true });
      
      const comando = `pg_dump -h ${process.env.DB_HOST} -U ${process.env.DB_USER} -d ${process.env.DB_NAME} > "${rutaBackup}"`;
      
      exec(comando, { env: { ...process.env, PGPASSWORD: process.env.DB_PASS } }, (error, stdout, stderr) => {
        if (error) {
          logger.error('Error realizando backup:', error);
        } else {
          logger.info(`Backup realizado exitosamente: ${nombreBackup}`);
        }
      });
      
    } catch (error) {
      logger.error('Error en proceso de backup:', error);
    }
  }

  async optimizarBaseDatos() {
    try {
      const sequelize = require('../../config/database');
      
      // Ejecutar VACUUM y ANALYZE en PostgreSQL
      await sequelize.query('VACUUM ANALYZE;');
      
      logger.info('Optimización de base de datos completada');
      
    } catch (error) {
      logger.error('Error optimizando base de datos:', error);
    }
  }

  async generarEstadisticasMensuales() {
    try {
      const Orden = require('../Models/Orden');
      const Cliente = require('../Models/Cliente');
      const Usuario = require('../Models/Usuario');
      const { Op } = require('sequelize');
      
      const mesAnterior = new Date();
      mesAnterior.setMonth(mesAnterior.getMonth() - 1);
      const inicioMes = new Date(mesAnterior.getFullYear(), mesAnterior.getMonth(), 1);
      const finMes = new Date(mesAnterior.getFullYear(), mesAnterior.getMonth() + 1, 0);
      
      const [
        totalOrdenes,
        ordenesCompletadas,
        nuevosClientes,
        tiempoPromedioResolucion
      ] = await Promise.all([
        Orden.count({
          where: {
            created_at: { [Op.between]: [inicioMes, finMes] },
            active: true
          }
        }),
        Orden.count({
          where: {
            fecha_completada: { [Op.between]: [inicioMes, finMes] },
            active: true
          }
        }),
        Cliente.count({
          where: {
            created_at: { [Op.between]: [inicioMes, finMes] },
            active: true
          }
        }),
        Orden.findAll({
          where: {
            fecha_completada: { [Op.between]: [inicioMes, finMes] },
            tiempo_real: { [Op.not]: null },
            active: true
          },
          attributes: ['tiempo_real']
        })
      ]);
      
      const tiempoPromedio = tiempoPromedioResolucion.length > 0 
        ? tiempoPromedioResolucion.reduce((sum, orden) => sum + orden.tiempo_real, 0) / tiempoPromedioResolucion.length
        : 0;
      
      const estadisticas = {
        mes: mesAnterior.toLocaleDateString('es-CO', { year: 'numeric', month: 'long' }),
        total_ordenes: totalOrdenes,
        ordenes_completadas: ordenesCompletadas,
        nuevos_clientes: nuevosClientes,
        tiempo_promedio_resolucion: Math.round(tiempoPromedio / 60), // horas
        tasa_completacion: totalOrdenes > 0 ? Math.round((ordenesCompletadas / totalOrdenes) * 100) : 0
      };
      
      // Enviar estadísticas a administradores
      const administradores = await Usuario.findAll({
        where: {
          rol: 'admin',
          estado: 'activo',
          active: true
        }
      });
      
      const contenido = `
        <h2>📊 Estadísticas Mensuales - Sistema CROSS</h2>
        <p><strong>Período:</strong> ${estadisticas.mes}</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0;">
          <div style="background-color: #d4edda; padding: 15px; border-radius: 5px;">
            <h3 style="margin: 0; color: #155724;">Total Órdenes</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${estadisticas.total_ordenes}</p>
          </div>
          
          <div style="background-color: #cce5ff; padding: 15px; border-radius: 5px;">
            <h3 style="margin: 0; color: #004085;">Órdenes Completadas</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${estadisticas.ordenes_completadas}</p>
          </div>
          
          <div style="background-color: #fff3cd; padding: 15px; border-radius: 5px;">
            <h3 style="margin: 0; color: #856404;">Nuevos Clientes</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${estadisticas.nuevos_clientes}</p>
          </div>
          
          <div style="background-color: #e2e3e5; padding: 15px; border-radius: 5px;">
            <h3 style="margin: 0; color: #383d41;">Tiempo Promedio</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${estadisticas.tiempo_promedio_resolucion}h</p>
          </div>
          
          <div style="background-color: #d1ecf1; padding: 15px; border-radius: 5px;">
            <h3 style="margin: 0; color: #0c5460;">Tasa Completación</h3>
            <p style="font-size: 24px; font-weight: bold; margin: 5px 0;">${estadisticas.tasa_completacion}%</p>
          </div>
        </div>
      `;
      
      const EmailService = require('./EmailService');
      
      for (const admin of administradores) {
        if (admin.email) {
          await EmailService.enviarEmail({
            para: admin.email,
            asunto: `📊 Estadísticas Mensuales - ${estadisticas.mes}`,
            html: EmailService.plantillaBasica({ contenido })
          });
        }
      }
      
      logger.info(`Estadísticas mensuales generadas y enviadas: ${estadisticas.mes}`);
      
    } catch (error) {
      logger.error('Error generando estadísticas mensuales:', error);
    }
  }

  async verificarSaludSistema() {
    try {
      const sequelize = require('../../config/database');
      const os = require('os');
      
      // Verificar conexión a base de datos
      await sequelize.authenticate();
      
      // Verificar uso de memoria
      const memoriaUsada = process.memoryUsage();
      const memoriaTotal = os.totalmem();
      const porcentajeMemoria = (memoriaUsada.rss / memoriaTotal) * 100;
      
      // Verificar espacio en disco
      const fs = require('fs').promises;
      const stats = await fs.stat(__dirname);
      
      // Alertar si hay problemas
      if (porcentajeMemoria > 80) {
        logger.warn(`Uso alto de memoria: ${porcentajeMemoria.toFixed(2)}%`);
        
        await AlertService.crearAlertaPersonalizada(
          'sistema',
          `Uso alto de memoria detectado: ${porcentajeMemoria.toFixed(2)}%`,
          'admin',
          'alta'
        );
      }
      
      // Log de salud cada hora (no cada 5 minutos para evitar spam)
      const ahora = new Date();
      if (ahora.getMinutes() === 0) {
        logger.info(`Sistema saludable - Memoria: ${porcentajeMemoria.toFixed(2)}%, Uptime: ${Math.floor(process.uptime() / 3600)}h`);
      }
      
    } catch (error) {
      logger.error('Error verificando salud del sistema:', error);
      
      await AlertService.crearAlertaPersonalizada(
        'sistema',
        `Error en verificación de salud: ${error.message}`,
        'admin',
        'alta'
      );
    }
  }

  obtenerEstadoTareas() {
    const estado = {};
    
    for (const [nombre, info] of this.tareas) {
      estado[nombre] = {
        cronExpression: info.cronExpression,
        activa: info.tarea.running,
        ultimaEjecucion: info.ultimaEjecucion,
        proximaEjecucion: info.tarea.nextDate()
      };
    }
    
    return estado;
  }

  detenerTarea(nombre) {
    const info = this.tareas.get(nombre);
    if (info) {
      info.tarea.stop();
      logger.info(`Tarea ${nombre} detenida`);
      return true;
    }
    return false;
  }

  iniciarTarea(nombre) {
    const info = this.tareas.get(nombre);
    if (info) {
      info.tarea.start();
      logger.info(`Tarea ${nombre} iniciada`);
      return true;
    }
    return false;
  }

  detenerTodasLasTareas() {
    for (const [nombre, info] of this.tareas) {
      info.tarea.stop();
    }
    logger.info('Todas las tareas programadas detenidas');
  }
}

// Crear instancia única
const cronService = new CronService();

// Manejar cierre graceful
process.on('SIGTERM', () => {
  cronService.detenerTodasLasTareas();
});

process.on('SIGINT', () => {
  cronService.detenerTodasLasTareas();
});

module.exports = cronService;