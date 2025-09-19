const BaseController = require('./BaseController');
const WorkflowService = require('../Services/WorkflowService');

class WorkflowController extends BaseController {

  async getProcesos(req, res) {
    try {
      const { activos = true } = req.query;
      const Proceso = require('../Models/Proceso');
      
      const where = {};
      if (activos !== undefined) {
        where.procactivos = activos === 'true';
      }

      const procesos = await Proceso.findAll({
        where,
        include: ['organizacion', 'actividades'],
        order: [['procpriorids', 'ASC'], ['procnombres', 'ASC']]
      });

      return this.successResponse(res, { procesos });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener procesos');
    }
  }

  async createProceso(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const procesoData = req.body;
      const Proceso = require('../Models/Proceso');
      
      // Generar código automático
      const NumeradorService = require('../Services/NumeradorService');
      const proccodigos = await NumeradorService.getNext('proceso');

      const proceso = await Proceso.create({
        proccodigos,
        ...procesoData,
        procactivos: true
      }, { transaction });

      await transaction.commit();

      return this.successResponse(res, {
        message: 'Proceso creado exitosamente',
        proceso
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error al crear proceso');
    }
  }

  async getActividades(req, res) {
    try {
      const { proccodigos } = req.query;
      const Actividad = require('../Models/Actividad');
      
      const where = {};
      if (proccodigos) {
        where.proccodigos = proccodigos;
      }

      const actividades = await Actividad.findAll({
        where,
        include: ['proceso', 'organizacion'],
        order: [['proccodigos', 'ASC'], ['actiorden', 'ASC']]
      });

      return this.successResponse(res, { actividades });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener actividades');
    }
  }

  async createActividad(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const actividadData = req.body;
      const Actividad = require('../Models/Actividad');
      
      // Generar código automático
      const NumeradorService = require('../Services/NumeradorService');
      const acticodigos = await NumeradorService.getNext('actividad');

      const actividad = await Actividad.create({
        acticodigos,
        ...actividadData,
        actiactivas: true
      }, { transaction });

      await transaction.commit();

      return this.successResponse(res, {
        message: 'Actividad creada exitosamente',
        actividad
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error al crear actividad');
    }
  }

  async getTareas(req, res) {
    try {
      const { 
        ordenumeros, 
        orgacodigos, 
        tareestados, 
        page = 1, 
        limit = 10 
      } = req.query;
      
      const Tarea = require('../Models/Tarea');
      const { Op } = require('sequelize');
      
      const where = {};
      if (ordenumeros) where.ordenumeros = ordenumeros;
      if (orgacodigos) where.orgacodigos = orgacodigos;
      if (tareestados) where.tareestados = tareestados;

      const tareas = await Tarea.findAndCountAll({
        where,
        include: ['orden', 'actividad', 'organizacion'],
        limit: parseInt(limit),
        offset: (parseInt(page) - 1) * parseInt(limit),
        order: [['tarefeccred', 'DESC']]
      });

      return this.paginatedResponse(res, tareas.rows, tareas.count, parseInt(page), parseInt(limit));

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener tareas');
    }
  }

  async ejecutarTarea(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const { id } = req.params;
      const { observaciones, resultado } = req.body;
      
      const Tarea = require('../Models/Tarea');
      
      const tarea = await Tarea.findByPk(id, {
        include: ['orden', 'actividad'],
        transaction
      });

      if (!tarea) {
        return this.errorResponse(res, 'Tarea no encontrada', 404);
      }

      // Validar que la tarea esté pendiente
      if (tarea.tareestados !== 'PENDIENTE') {
        return this.errorResponse(res, 'La tarea no está en estado pendiente', 400);
      }

      // Actualizar tarea
      await tarea.update({
        tareestados: 'COMPLETADA',
        tareobservs: observaciones,
        tarefecfind: Math.floor(Date.now() / 1000),
        tareusuasig: req.user.usuacodigos
      }, { transaction });

      // Ejecutar lógica de workflow
      const workflowResult = await WorkflowService.executeTaskCompletion(
        tarea, 
        resultado, 
        { transaction }
      );

      await transaction.commit();

      return this.successResponse(res, {
        message: 'Tarea ejecutada exitosamente',
        tarea,
        workflowResult
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error al ejecutar tarea');
    }
  }

  async getReglas(req, res) {
    try {
      const { acticodigos, activas = true } = req.query;
      const Regla = require('../Models/Regla');
      
      const where = {};
      if (acticodigos) where.acticodigos = acticodigos;
      if (activas !== undefined) where.reglactivas = activas === 'true';

      const reglas = await Regla.findAll({
        where,
        include: ['actividad'],
        order: [['reglpriorid', 'ASC']]
      });

      return this.successResponse(res, { reglas });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener reglas');
    }
  }

  async createRegla(req, res) {
    const transaction = await this.db.transaction();
    
    try {
      const reglaData = req.body;
      const Regla = require('../Models/Regla');
      
      // Generar código automático
      const NumeradorService = require('../Services/NumeradorService');
      const reglcodigos = await NumeradorService.getNext('regla');

      const regla = await Regla.create({
        reglcodigos,
        ...reglaData,
        reglactivas: true
      }, { transaction });

      await transaction.commit();

      return this.successResponse(res, {
        message: 'Regla creada exitosamente',
        regla
      }, 3);

    } catch (error) {
      await transaction.rollback();
      return this.handleError(res, error, 'Error al crear regla');
    }
  }

  async testRegla(req, res) {
    try {
      const { reglcodigos } = req.params;
      const { testData } = req.body;
      
      const Regla = require('../Models/Regla');
      
      const regla = await Regla.findByPk(reglcodigos);
      if (!regla) {
        return this.errorResponse(res, 'Regla no encontrada', 404);
      }

      // Probar evaluación de la regla
      const resultado = await WorkflowService.evaluateRule(regla, testData, 'TEST');

      return this.successResponse(res, {
        regla: {
          codigo: regla.reglcodigos,
          nombre: regla.reglnombres,
          condicion: regla.reglcondics,
          accion: regla.reglaccions
        },
        testData,
        resultado
      });

    } catch (error) {
      return this.handleError(res, error, 'Error al probar regla');
    }
  }

  async getEstadisticas(req, res) {
    try {
      const { fechaInicio, fechaFin } = req.query;
      
      const stats = await WorkflowService.getWorkflowStats(fechaInicio, fechaFin);

      return this.successResponse(res, { estadisticas: stats });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener estadísticas');
    }
  }

  async getFlujoProceso(req, res) {
    try {
      const { proccodigos } = req.params;
      
      const flujo = await WorkflowService.getProcessFlow(proccodigos);

      return this.successResponse(res, { flujo });

    } catch (error) {
      return this.handleError(res, error, 'Error al obtener flujo del proceso');
    }
  }

  async simularProceso(req, res) {
    try {
      const { proccodigos } = req.params;
      const { ordenData } = req.body;
      
      const simulacion = await WorkflowService.simulateProcess(proccodigos, ordenData);

      return this.successResponse(res, { simulacion });

    } catch (error) {
      return this.handleError(res, error, 'Error al simular proceso');
    }
  }
}

module.exports = WorkflowController;