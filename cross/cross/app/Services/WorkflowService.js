const logger = require('./LoggerService');
const EmailService = require('./EmailService');

class WorkflowService {
  constructor() {
    this.reglas = new Map();
    this.procesos = new Map();
    this.inicializarReglas();
  }

  inicializarReglas() {
    // Reglas básicas del workflow migradas del sistema legacy
    this.reglas.set('orden_nueva', {
      condiciones: ['tipo_orden', 'prioridad'],
      acciones: ['asignar_automatico', 'calcular_vencimiento', 'notificar']
    });

    this.reglas.set('orden_vencida', {
      condiciones: ['fecha_vencimiento'],
      acciones: ['escalar', 'notificar_supervisor', 'cambiar_prioridad']
    });

    this.reglas.set('orden_completada', {
      condiciones: ['estado'],
      acciones: ['calcular_tiempo_real', 'notificar_cliente', 'cerrar_tareas']
    });
  }

  async iniciarProceso(orden, usuarioId) {
    try {
      logger.info(`Iniciando workflow para orden ${orden.numero_orden}`);

      // Determinar proceso según tipo de orden
      const procesoId = this.determinarProceso(orden);
      
      if (procesoId) {
        await orden.update({
          workflow_proceso_id: procesoId,
          workflow_estado: 'iniciado'
        });

        // Ejecutar reglas iniciales
        await this.ejecutarReglas('orden_nueva', orden, usuarioId);
      }

      return true;
    } catch (error) {
      logger.error('Error iniciando proceso workflow:', error);
      return false;
    }
  }

  determinarProceso(orden) {
    // Lógica para determinar el proceso según el tipo de orden
    const procesos = {
      'servicio': 1,
      'producto': 2,
      'consulta': 3,
      'reclamo': 4
    };

    return procesos[orden.tipo_orden] || 1;
  }

  async ejecutarReglas(tipoRegla, orden, usuarioId) {
    try {
      const regla = this.reglas.get(tipoRegla);
      if (!regla) return;

      logger.info(`Ejecutando reglas ${tipoRegla} para orden ${orden.numero_orden}`);

      // Evaluar condiciones
      const condicionesCumplidas = await this.evaluarCondiciones(regla.condiciones, orden);
      
      if (condicionesCumplidas) {
        // Ejecutar acciones
        for (const accion of regla.acciones) {
          await this.ejecutarAccion(accion, orden, usuarioId);
        }
      }

    } catch (error) {
      logger.error('Error ejecutando reglas workflow:', error);
    }
  }

  async evaluarCondiciones(condiciones, orden) {
    try {
      for (const condicion of condiciones) {
        switch (condicion) {
          case 'tipo_orden':
            if (!orden.tipo_orden) return false;
            break;
          case 'prioridad':
            if (!orden.prioridad) return false;
            break;
          case 'fecha_vencimiento':
            if (orden.fecha_vencimiento && new Date() > orden.fecha_vencimiento) {
              return true;
            }
            break;
          case 'estado':
            if (!orden.estado) return false;
            break;
        }
      }
      return true;
    } catch (error) {
      logger.error('Error evaluando condiciones:', error);
      return false;
    }
  }

  async ejecutarAccion(accion, orden, usuarioId) {
    try {
      switch (accion) {
        case 'asignar_automatico':
          await this.asignarAutomatico(orden);
          break;
        case 'calcular_vencimiento':
          await this.calcularVencimiento(orden);
          break;
        case 'notificar':
          await this.notificarCreacion(orden);
          break;
        case 'escalar':
          await this.escalarOrden(orden);
          break;
        case 'notificar_supervisor':
          await this.notificarSupervisor(orden);
          break;
        case 'cambiar_prioridad':
          await this.cambiarPrioridad(orden);
          break;
        case 'calcular_tiempo_real':
          await this.calcularTiempoReal(orden);
          break;
        case 'notificar_cliente':
          await this.notificarCliente(orden);
          break;
        case 'cerrar_tareas':
          await this.cerrarTareas(orden);
          break;
      }
    } catch (error) {
      logger.error(`Error ejecutando acción ${accion}:`, error);
    }
  }

  async asignarAutomatico(orden) {
    try {
      const Usuario = require('../Models/Usuario');
      
      // Lógica de asignación automática basada en carga de trabajo
      const usuarios = await Usuario.findAll({
        where: {
          rol: ['operador', 'supervisor'],
          estado: 'activo',
          active: true
        }
      });

      if (usuarios.length === 0) return;

      // Asignar al usuario con menos órdenes activas
      const Orden = require('../Models/Orden');
      let usuarioMenorCarga = null;
      let menorCarga = Infinity;

      for (const usuario of usuarios) {
        const carga = await Orden.count({
          where: {
            asignado_a: usuario.id,
            estado: ['nueva', 'asignada', 'en_proceso'],
            active: true
          }
        });

        if (carga < menorCarga) {
          menorCarga = carga;
          usuarioMenorCarga = usuario;
        }
      }

      if (usuarioMenorCarga) {
        await orden.update({
          asignado_a: usuarioMenorCarga.id,
          estado: 'asignada'
        });

        logger.info(`Orden ${orden.numero_orden} asignada automáticamente a ${usuarioMenorCarga.username}`);
      }

    } catch (error) {
      logger.error('Error en asignación automática:', error);
    }
  }

  async calcularVencimiento(orden) {
    try {
      if (orden.fecha_vencimiento) return;

      // Calcular vencimiento según tipo y prioridad
      const diasVencimiento = {
        'critica': 1,
        'alta': 3,
        'normal': 7,
        'baja': 15
      };

      const dias = diasVencimiento[orden.prioridad] || 7;
      const fechaVencimiento = new Date();
      fechaVencimiento.setDate(fechaVencimiento.getDate() + dias);

      await orden.update({
        fecha_vencimiento: fechaVencimiento
      });

      logger.info(`Vencimiento calculado para orden ${orden.numero_orden}: ${fechaVencimiento}`);

    } catch (error) {
      logger.error('Error calculando vencimiento:', error);
    }
  }

  async notificarCreacion(orden) {
    try {
      const Cliente = require('../Models/Cliente');
      const cliente = await Cliente.findByPk(orden.cliente_id);

      if (cliente && cliente.email_principal) {
        await EmailService.enviarNotificacionOrdenCreada(cliente, orden);
      }

    } catch (error) {
      logger.error('Error notificando creación:', error);
    }
  }

  async escalarOrden(orden) {
    try {
      const Usuario = require('../Models/Usuario');
      
      // Buscar supervisor para escalar
      const supervisor = await Usuario.findOne({
        where: {
          rol: 'supervisor',
          estado: 'activo',
          active: true
        }
      });

      if (supervisor) {
        await orden.update({
          asignado_a: supervisor.id,
          prioridad: 'alta',
          observaciones: `${orden.observaciones || ''}\n[ESCALADO] Orden escalada por vencimiento`
        });

        logger.info(`Orden ${orden.numero_orden} escalada a supervisor ${supervisor.username}`);
      }

    } catch (error) {
      logger.error('Error escalando orden:', error);
    }
  }

  async notificarSupervisor(orden) {
    try {
      const Usuario = require('../Models/Usuario');
      
      const supervisores = await Usuario.findAll({
        where: {
          rol: 'supervisor',
          estado: 'activo',
          active: true
        }
      });

      for (const supervisor of supervisores) {
        await EmailService.enviarAlertaVencimiento(supervisor, orden);
      }

    } catch (error) {
      logger.error('Error notificando supervisor:', error);
    }
  }

  async cambiarPrioridad(orden) {
    try {
      if (orden.prioridad !== 'critica') {
        const nuevaPrioridad = orden.prioridad === 'alta' ? 'critica' : 'alta';
        
        await orden.update({
          prioridad: nuevaPrioridad,
          observaciones: `${orden.observaciones || ''}\n[WORKFLOW] Prioridad cambiada a ${nuevaPrioridad} por vencimiento`
        });

        logger.info(`Prioridad de orden ${orden.numero_orden} cambiada a ${nuevaPrioridad}`);
      }

    } catch (error) {
      logger.error('Error cambiando prioridad:', error);
    }
  }

  async calcularTiempoReal(orden) {
    try {
      if (orden.created_at && orden.fecha_completada) {
        const tiempoReal = Math.floor((orden.fecha_completada - orden.created_at) / (1000 * 60)); // minutos
        
        await orden.update({
          tiempo_real: tiempoReal
        });

        logger.info(`Tiempo real calculado para orden ${orden.numero_orden}: ${tiempoReal} minutos`);
      }

    } catch (error) {
      logger.error('Error calculando tiempo real:', error);
    }
  }

  async notificarCliente(orden) {
    try {
      const Cliente = require('../Models/Cliente');
      const cliente = await Cliente.findByPk(orden.cliente_id);

      if (cliente && cliente.email_principal) {
        await EmailService.enviarNotificacionOrdenCompletada(cliente, orden);
      }

    } catch (error) {
      logger.error('Error notificando cliente:', error);
    }
  }

  async cerrarTareas(orden) {
    try {
      // Cerrar tareas relacionadas (si existen)
      logger.info(`Cerrando tareas relacionadas con orden ${orden.numero_orden}`);
      
      // Aquí se implementaría la lógica para cerrar tareas relacionadas
      // Por ahora solo registramos el evento

    } catch (error) {
      logger.error('Error cerrando tareas:', error);
    }
  }

  async procesarCambioEstado(orden, nuevoEstado, usuarioId) {
    try {
      logger.info(`Procesando cambio de estado para orden ${orden.numero_orden}: ${orden.estado} -> ${nuevoEstado}`);

      // Ejecutar reglas según el nuevo estado
      switch (nuevoEstado) {
        case 'completada':
          await this.ejecutarReglas('orden_completada', orden, usuarioId);
          break;
        case 'cancelada':
          await this.ejecutarReglas('orden_cancelada', orden, usuarioId);
          break;
      }

      // Actualizar estado del workflow
      await orden.update({
        workflow_estado: nuevoEstado
      });

    } catch (error) {
      logger.error('Error procesando cambio de estado:', error);
    }
  }

  async verificarVencimientos() {
    try {
      const Orden = require('../Models/Orden');
      
      const ordenesVencidas = await Orden.findVencidas();
      
      for (const orden of ordenesVencidas) {
        await this.ejecutarReglas('orden_vencida', orden, null);
      }

      logger.info(`Procesadas ${ordenesVencidas.length} órdenes vencidas`);

    } catch (error) {
      logger.error('Error verificando vencimientos:', error);
    }
  }
}

module.exports = new WorkflowService();