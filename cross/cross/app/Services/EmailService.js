const nodemailer = require('nodemailer');
const logger = require('./LoggerService');
const fs = require('fs').promises;
const path = require('path');

class EmailService {
  constructor() {
    this.transporter = null;
    this.inicializarTransporter();
  }

  async inicializarTransporter() {
    try {
      // Configuración SMTP migrada de CROSSHUV
      this.transporter = nodemailer.createTransporter({
        host: process.env.SMTP_HOST || 'smtp.gmail.com',
        port: process.env.SMTP_PORT || 587,
        secure: process.env.SMTP_SECURE === 'true',
        auth: {
          user: process.env.SMTP_USER,
          pass: process.env.SMTP_PASS
        },
        tls: {
          rejectUnauthorized: false
        }
      });

      // Verificar conexión
      if (process.env.SMTP_USER && process.env.SMTP_PASS) {
        await this.transporter.verify();
        logger.info('✅ Conexión SMTP establecida');
      }

    } catch (error) {
      logger.error('❌ Error configurando SMTP:', error);
    }
  }

  async enviarEmail(opciones) {
    try {
      if (!this.transporter) {
        throw new Error('Transporter SMTP no configurado');
      }

      const mailOptions = {
        from: `"Sistema CROSS" <${process.env.SMTP_USER}>`,
        to: opciones.para,
        subject: opciones.asunto,
        html: opciones.html || opciones.texto,
        text: opciones.texto,
        attachments: opciones.adjuntos || []
      };

      if (opciones.copia) {
        mailOptions.cc = opciones.copia;
      }

      if (opciones.copiaOculta) {
        mailOptions.bcc = opciones.copiaOculta;
      }

      const resultado = await this.transporter.sendMail(mailOptions);
      
      logger.info(`Email enviado exitosamente a ${opciones.para}: ${opciones.asunto}`);
      
      return {
        exito: true,
        messageId: resultado.messageId,
        response: resultado.response
      };

    } catch (error) {
      logger.error('Error enviando email:', error);
      return {
        exito: false,
        error: error.message
      };
    }
  }

  async cargarPlantilla(nombrePlantilla, variables = {}) {
    try {
      const rutaPlantilla = path.join(__dirname, '../../resources/views/emails', `${nombrePlantilla}.html`);
      let contenido = await fs.readFile(rutaPlantilla, 'utf8');

      // Reemplazar variables en la plantilla
      for (const [clave, valor] of Object.entries(variables)) {
        const regex = new RegExp(`{{${clave}}}`, 'g');
        contenido = contenido.replace(regex, valor || '');
      }

      return contenido;

    } catch (error) {
      logger.error(`Error cargando plantilla ${nombrePlantilla}:`, error);
      return this.plantillaBasica(variables);
    }
  }

  plantillaBasica(variables) {
    return `
      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8">
        <title>Sistema CROSS</title>
        <style>
          body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }
          .container { max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 8px; }
          .header { background-color: #007bff; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
          .content { padding: 20px; }
          .footer { background-color: #f8f9fa; padding: 15px; text-align: center; border-radius: 0 0 8px 8px; }
        </style>
      </head>
      <body>
        <div class="container">
          <div class="header">
            <h1>Sistema CROSS</h1>
          </div>
          <div class="content">
            ${variables.contenido || 'Contenido del mensaje'}
          </div>
          <div class="footer">
            <p>Este es un mensaje automático del Sistema CROSS</p>
          </div>
        </div>
      </body>
      </html>
    `;
  }

  async enviarNotificacionOrdenCreada(cliente, orden) {
    try {
      const contenido = await this.cargarPlantilla('orden-creada', {
        cliente_nombre: cliente.razon_social,
        numero_orden: orden.numero_orden,
        titulo: orden.titulo,
        descripcion: orden.descripcion,
        fecha_creacion: orden.created_at.toLocaleDateString('es-CO'),
        estado: orden.estado.toUpperCase()
      });

      return await this.enviarEmail({
        para: cliente.email_principal,
        asunto: `Nueva Orden Creada - ${orden.numero_orden}`,
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando notificación de orden creada:', error);
      return { exito: false, error: error.message };
    }
  }

  async enviarNotificacionOrdenCompletada(cliente, orden) {
    try {
      const contenido = await this.cargarPlantilla('orden-completada', {
        cliente_nombre: cliente.razon_social,
        numero_orden: orden.numero_orden,
        titulo: orden.titulo,
        fecha_completada: orden.fecha_completada.toLocaleDateString('es-CO'),
        tiempo_total: orden.tiempo_real ? `${Math.floor(orden.tiempo_real / 60)} horas` : 'N/A'
      });

      return await this.enviarEmail({
        para: cliente.email_principal,
        asunto: `Orden Completada - ${orden.numero_orden}`,
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando notificación de orden completada:', error);
      return { exito: false, error: error.message };
    }
  }

  async enviarAlertaVencimiento(usuario, orden) {
    try {
      const Cliente = require('../Models/Cliente');
      const cliente = await Cliente.findByPk(orden.cliente_id);

      const contenido = await this.cargarPlantilla('alerta-vencimiento', {
        usuario_nombre: `${usuario.nombre} ${usuario.apellido}`,
        numero_orden: orden.numero_orden,
        cliente_nombre: cliente ? cliente.razon_social : 'N/A',
        titulo: orden.titulo,
        fecha_vencimiento: orden.fecha_vencimiento.toLocaleDateString('es-CO'),
        dias_vencido: Math.ceil((new Date() - orden.fecha_vencimiento) / (1000 * 60 * 60 * 24))
      });

      return await this.enviarEmail({
        para: usuario.email,
        asunto: `🚨 ALERTA: Orden Vencida - ${orden.numero_orden}`,
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando alerta de vencimiento:', error);
      return { exito: false, error: error.message };
    }
  }

  async enviarNotificacionAsignacion(orden, usuarioAsignado, usuarioAsignador) {
    try {
      const Cliente = require('../Models/Cliente');
      const cliente = await Cliente.findByPk(orden.cliente_id);

      const contenido = await this.cargarPlantilla('orden-asignada', {
        usuario_nombre: `${usuarioAsignado.nombre} ${usuarioAsignado.apellido}`,
        numero_orden: orden.numero_orden,
        cliente_nombre: cliente ? cliente.razon_social : 'N/A',
        titulo: orden.titulo,
        asignado_por: `${usuarioAsignador.nombre} ${usuarioAsignador.apellido}`,
        fecha_asignacion: new Date().toLocaleDateString('es-CO'),
        prioridad: orden.prioridad.toUpperCase()
      });

      return await this.enviarEmail({
        para: usuarioAsignado.email,
        asunto: `Nueva Orden Asignada - ${orden.numero_orden}`,
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando notificación de asignación:', error);
      return { exito: false, error: error.message };
    }
  }

  async enviarReporteVencimientos(usuario, ordenesVencidas) {
    try {
      let listaOrdenes = '';
      for (const orden of ordenesVencidas) {
        const diasVencido = Math.ceil((new Date() - orden.fecha_vencimiento) / (1000 * 60 * 60 * 24));
        listaOrdenes += `
          <tr>
            <td>${orden.numero_orden}</td>
            <td>${orden.Cliente ? orden.Cliente.razon_social : 'N/A'}</td>
            <td>${orden.titulo}</td>
            <td>${orden.fecha_vencimiento.toLocaleDateString('es-CO')}</td>
            <td style="color: red; font-weight: bold;">${diasVencido} días</td>
          </tr>
        `;
      }

      const contenido = await this.cargarPlantilla('reporte-vencimientos', {
        usuario_nombre: `${usuario.nombre} ${usuario.apellido}`,
        total_ordenes: ordenesVencidas.length,
        fecha_reporte: new Date().toLocaleDateString('es-CO'),
        lista_ordenes: listaOrdenes
      });

      return await this.enviarEmail({
        para: usuario.email,
        asunto: `📊 Reporte de Órdenes Vencidas - ${ordenesVencidas.length} órdenes`,
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando reporte de vencimientos:', error);
      return { exito: false, error: error.message };
    }
  }

  async probarConexion() {
    try {
      if (!this.transporter) {
        throw new Error('Transporter no configurado');
      }

      await this.transporter.verify();
      
      return {
        exito: true,
        mensaje: 'Conexión SMTP exitosa'
      };

    } catch (error) {
      logger.error('Error probando conexión SMTP:', error);
      return {
        exito: false,
        error: error.message
      };
    }
  }

  async enviarEmailPrueba(email) {
    try {
      const contenido = this.plantillaBasica({
        contenido: `
          <h2>Prueba de Conexión SMTP</h2>
          <p>Este es un email de prueba del Sistema CROSS.</p>
          <p><strong>Fecha:</strong> ${new Date().toLocaleString('es-CO')}</p>
          <p><strong>Estado:</strong> ✅ Configuración SMTP funcionando correctamente</p>
        `
      });

      return await this.enviarEmail({
        para: email,
        asunto: '✅ Prueba SMTP - Sistema CROSS',
        html: contenido
      });

    } catch (error) {
      logger.error('Error enviando email de prueba:', error);
      return { exito: false, error: error.message };
    }
  }
}

module.exports = new EmailService();