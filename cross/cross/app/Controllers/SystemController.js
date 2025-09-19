const BaseController = require('./BaseController');

class SystemController extends BaseController {

  /**
   * Página principal del sistema
   */
  async index(req, res) {
    try {
      const systemInfo = {
        name: 'Sistema CROSS',
        version: process.env.npm_package_version || '1.0.0',
        environment: process.env.NODE_ENV || 'development',
        timestamp: new Date().toISOString(),
        uptime: process.uptime(),
        memory: process.memoryUsage(),
        features: {
          database: '✅ PostgreSQL',
          authentication: '✅ JWT',
          email: process.env.SMTP_HOST ? '✅ SMTP' : '❌ No configurado',
          redis: process.env.REDIS_URL ? '✅ Redis' : '❌ No configurado',
          websockets: '✅ Socket.IO',
          cron: process.env.ENABLE_CRON !== 'false' ? '✅ Habilitado' : '❌ Deshabilitado',
          alerts: process.env.ENABLE_ALERTS !== 'false' ? '✅ Habilitado' : '❌ Deshabilitado'
        },
        endpoints: {
          api: '/api',
          docs: '/api-docs',
          health: '/health'
        }
      };

      return this.successResponse(res, systemInfo);

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo información del sistema');
    }
  }

  /**
   * Obtener todas las tablas del sistema
   */
  async getTables(req, res) {
    try {
      const [results] = await this.db.query(`
        SELECT 
          schemaname,
          tablename,
          n_live_tup as row_count,
          pg_size_pretty(pg_total_relation_size(schemaname||'.'||tablename)) as size
        FROM pg_stat_user_tables 
        ORDER BY schemaname, tablename
      `);

      const tablesBySchema = results.reduce((acc, table) => {
        if (!acc[table.schemaname]) {
          acc[table.schemaname] = [];
        }
        acc[table.schemaname].push({
          name: table.tablename,
          rowCount: parseInt(table.row_count) || 0,
          size: table.size
        });
        return acc;
      }, {});

      return this.successResponse(res, {
        schemas: Object.keys(tablesBySchema).length,
        totalTables: results.length,
        tablesBySchema
      });

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo tablas');
    }
  }

  /**
   * Obtener datos de una tabla específica
   */
  async getTableData(req, res) {
    try {
      const { schema, table } = req.params;
      const { page = 1, limit = 10 } = req.query;
      
      const offset = (parseInt(page) - 1) * parseInt(limit);
      
      // Validar que la tabla existe
      const [tableExists] = await this.db.query(`
        SELECT EXISTS (
          SELECT FROM information_schema.tables 
          WHERE table_schema = :schema 
          AND table_name = :table
        )
      `, {
        replacements: { schema, table }
      });

      if (!tableExists[0].exists) {
        return this.errorResponse(res, 'Tabla no encontrada', 404);
      }

      // Obtener estructura de la tabla
      const [columns] = await this.db.query(`
        SELECT 
          column_name,
          data_type,
          is_nullable,
          column_default
        FROM information_schema.columns 
        WHERE table_schema = :schema 
        AND table_name = :table
        ORDER BY ordinal_position
      `, {
        replacements: { schema, table }
      });

      // Obtener datos con paginación
      const [data] = await this.db.query(`
        SELECT * FROM ${schema}.${table} 
        ORDER BY 1 
        LIMIT :limit OFFSET :offset
      `, {
        replacements: { limit: parseInt(limit), offset }
      });

      // Obtener total de registros
      const [countResult] = await this.db.query(`
        SELECT COUNT(*) as total FROM ${schema}.${table}
      `);

      const total = parseInt(countResult[0].total);

      return this.successResponse(res, {
        table: {
          schema,
          name: table,
          columns: columns.map(col => ({
            name: col.column_name,
            type: col.data_type,
            nullable: col.is_nullable === 'YES',
            default: col.column_default
          }))
        },
        data,
        pagination: {
          total,
          page: parseInt(page),
          limit: parseInt(limit),
          pages: Math.ceil(total / parseInt(limit))
        }
      });

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo datos de la tabla');
    }
  }

  /**
   * Health check del sistema
   */
  async health(req, res) {
    try {
      const health = {
        status: 'OK',
        timestamp: new Date().toISOString(),
        uptime: process.uptime(),
        version: process.env.npm_package_version || '1.0.0',
        environment: process.env.NODE_ENV || 'development',
        checks: {
          database: false,
          redis: false,
          email: false,
          storage: false
        }
      };

      // Verificar base de datos
      try {
        await this.db.authenticate();
        health.checks.database = true;
      } catch (error) {
        health.checks.database = false;
        health.status = 'DEGRADED';
      }

      // Verificar Redis (si está configurado)
      if (process.env.REDIS_URL) {
        try {
          const redis = require('redis');
          const client = redis.createClient({ url: process.env.REDIS_URL });
          await client.connect();
          await client.ping();
          await client.quit();
          health.checks.redis = true;
        } catch (error) {
          health.checks.redis = false;
          health.status = 'DEGRADED';
        }
      } else {
        health.checks.redis = true; // No configurado, consideramos OK
      }

      // Verificar email
      if (process.env.SMTP_HOST) {
        try {
          const EmailService = require('../Services/EmailService');
          const result = await EmailService.testConnection();
          health.checks.email = result.success;
          if (!result.success) {
            health.status = 'DEGRADED';
          }
        } catch (error) {
          health.checks.email = false;
          health.status = 'DEGRADED';
        }
      } else {
        health.checks.email = true; // No configurado, consideramos OK
      }

      // Verificar storage
      try {
        const fs = require('fs').promises;
        const path = require('path');
        
        const storageDir = path.join(process.cwd(), 'storage');
        await fs.access(storageDir);
        health.checks.storage = true;
      } catch (error) {
        health.checks.storage = false;
        health.status = 'DEGRADED';
      }

      const statusCode = health.status === 'OK' ? 200 : 503;
      return res.status(statusCode).json(health);

    } catch (error) {
      return res.status(503).json({
        status: 'ERROR',
        timestamp: new Date().toISOString(),
        error: error.message
      });
    }
  }

  /**
   * Estadísticas del sistema
   */
  async getStats(req, res) {
    try {
      const stats = {
        system: {
          uptime: process.uptime(),
          memory: process.memoryUsage(),
          cpu: process.cpuUsage(),
          version: process.version,
          platform: process.platform
        },
        database: await this.getDatabaseStats(),
        application: await this.getApplicationStats()
      };

      return this.successResponse(res, stats);

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo estadísticas');
    }
  }

  /**
   * Configuración del sistema
   */
  async getConfig(req, res) {
    try {
      // Solo mostrar configuración no sensible
      const config = {
        environment: process.env.NODE_ENV,
        database: {
          host: process.env.DB_HOST,
          port: process.env.DB_PORT,
          name: process.env.DB_NAME
        },
        features: {
          cron: process.env.ENABLE_CRON !== 'false',
          alerts: process.env.ENABLE_ALERTS !== 'false',
          websockets: process.env.ENABLE_WEBSOCKETS !== 'false'
        },
        limits: {
          uploadMaxSize: process.env.UPLOAD_MAX_SIZE,
          rateLimitMax: process.env.RATE_LIMIT_MAX,
          rateLimitWindow: process.env.RATE_LIMIT_WINDOW
        }
      };

      return this.successResponse(res, config);

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo configuración');
    }
  }

  /**
   * Logs del sistema
   */
  async getLogs(req, res) {
    try {
      const { level = 'info', limit = 100, page = 1 } = req.query;
      const fs = require('fs').promises;
      const path = require('path');
      
      const logFile = path.join(process.cwd(), 'storage', 'logs', 'cross-' + new Date().toISOString().split('T')[0] + '.log');
      
      try {
        const logContent = await fs.readFile(logFile, 'utf8');
        const lines = logContent.split('\n').filter(line => line.trim());
        
        // Filtrar por nivel si se especifica
        const filteredLines = level !== 'all' 
          ? lines.filter(line => line.toLowerCase().includes(`[${level.toLowerCase()}]`))
          : lines;

        // Paginación
        const startIndex = (parseInt(page) - 1) * parseInt(limit);
        const endIndex = startIndex + parseInt(limit);
        const paginatedLines = filteredLines.slice(startIndex, endIndex);

        return this.successResponse(res, {
          logs: paginatedLines.reverse(), // Más recientes primero
          pagination: {
            total: filteredLines.length,
            page: parseInt(page),
            limit: parseInt(limit),
            pages: Math.ceil(filteredLines.length / parseInt(limit))
          }
        });

      } catch (fileError) {
        return this.successResponse(res, {
          logs: [],
          message: 'No hay logs disponibles para hoy'
        });
      }

    } catch (error) {
      return this.handleError(res, error, 'Error obteniendo logs');
    }
  }

  // Métodos auxiliares privados
  async getDatabaseStats() {
    try {
      const [dbStats] = await this.db.query(`
        SELECT 
          COUNT(*) as total_tables,
          SUM(n_live_tup) as total_rows,
          pg_size_pretty(SUM(pg_total_relation_size(schemaname||'.'||tablename))) as total_size
        FROM pg_stat_user_tables
      `);

      return dbStats[0];
    } catch (error) {
      return { error: 'No disponible' };
    }
  }

  async getApplicationStats() {
    try {
      // Obtener estadísticas de la aplicación
      const Orden = require('../Models/Orden');
      const Cliente = require('../Models/Cliente');
      const { Op } = require('sequelize');
      
      const today = Math.floor(Date.now() / 1000);
      const weekAgo = today - (7 * 24 * 60 * 60);

      const [totalOrdenes, ordenesHoy, totalClientes, clientesActivos] = await Promise.all([
        Orden.count(),
        Orden.count({
          where: {
            ordefecregd: { [Op.gte]: today - (24 * 60 * 60) }
          }
        }),
        Cliente.count(),
        Cliente.count({ where: { clieactivas: true } })
      ]);

      return {
        ordenes: {
          total: totalOrdenes,
          hoy: ordenesHoy
        },
        clientes: {
          total: totalClientes,
          activos: clientesActivos
        }
      };
    } catch (error) {
      return { error: 'No disponible' };
    }
  }
}

module.exports = SystemController;