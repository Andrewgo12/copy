module.exports = {
  up: async (queryInterface, Sequelize) => {
    
    // === DATOS INICIALES USUARIOS ===
    await queryInterface.bulkInsert('usuarios', [
      {
        usuacodigos: 'admin',
        usuanombres: 'Administrador Sistema',
        usuaemail: 'admin@cross.com',
        usuapassword: '$2b$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        usuaactivos: true,
        usuaalertas: true,
        createdAt: new Date(),
        updatedAt: new Date()
      },
      {
        usuacodigos: 'operador',
        usuanombres: 'Operador Sistema',
        usuaemail: 'operador@cross.com',
        usuapassword: '$2b$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        usuaactivos: true,
        usuaalertas: false,
        createdAt: new Date(),
        updatedAt: new Date()
      }
    ]);

    // === PERFILES ===
    await queryInterface.bulkInsert('perfiles', [
      {
        perfcodigos: 'ADMIN',
        perfnombres: 'Administrador',
        perfdescripc: 'Acceso completo al sistema',
        perfactivos: true
      },
      {
        perfcodigos: 'OPERADOR',
        perfnombres: 'Operador',
        perfdescripc: 'Operación básica del sistema',
        perfactivos: true
      },
      {
        perfcodigos: 'CONSULTA',
        perfnombres: 'Consulta',
        perfdescripc: 'Solo consulta de información',
        perfactivos: true
      }
    ]);

    // === PERMISOS ===
    await queryInterface.bulkInsert('permisos', [
      { permcodigos: 'ORDEN_CREATE', permnombres: 'Crear Órdenes', permdescripc: 'Permite crear nuevas órdenes', permactivos: true },
      { permcodigos: 'ORDEN_READ', permnombres: 'Consultar Órdenes', permdescripc: 'Permite consultar órdenes', permactivos: true },
      { permcodigos: 'ORDEN_UPDATE', permnombres: 'Modificar Órdenes', permdescripc: 'Permite modificar órdenes', permactivos: true },
      { permcodigos: 'ORDEN_DELETE', permnombres: 'Eliminar Órdenes', permdescripc: 'Permite eliminar órdenes', permactivos: true },
      { permcodigos: 'CLIENT_MANAGE', permnombres: 'Gestionar Clientes', permdescripc: 'Gestión completa de clientes', permactivos: true },
      { permcodigos: 'WORKFLOW_ADMIN', permnombres: 'Administrar Workflow', permdescripc: 'Configurar procesos y reglas', permactivos: true },
      { permcodigos: 'REPORTS_VIEW', permnombres: 'Ver Reportes', permdescripc: 'Acceso a reportes del sistema', permactivos: true },
      { permcodigos: 'SYSTEM_ADMIN', permnombres: 'Administrar Sistema', permdescripc: 'Administración completa', permactivos: true }
    ]);

    // === ORGANIZACIONES ===
    await queryInterface.bulkInsert('organizacion', [
      {
        orgacodigos: 'GERENCIA',
        organombres: 'Gerencia General',
        orgadescripc: 'Dirección general de la organización',
        orgapadres: null,
        organiveles: 1,
        orgaactivas: true
      },
      {
        orgacodigos: 'ATENCION',
        organombres: 'Atención al Cliente',
        orgadescripc: 'Departamento de atención al cliente',
        orgapadres: 'GERENCIA',
        organiveles: 2,
        orgaactivas: true
      },
      {
        orgacodigos: 'TECNICO',
        organombres: 'Soporte Técnico',
        orgadescripc: 'Departamento técnico',
        orgapadres: 'GERENCIA',
        organiveles: 2,
        orgaactivas: true
      },
      {
        orgacodigos: 'CALIDAD',
        organombres: 'Control de Calidad',
        orgadescripc: 'Departamento de calidad',
        orgapadres: 'GERENCIA',
        organiveles: 2,
        orgaactivas: true
      }
    ]);

    // === PROCESOS WORKFLOW ===
    await queryInterface.bulkInsert('proceso', [
      {
        proccodigos: 'PQRS_GENERAL',
        procnombres: 'PQRS General',
        procdescripc: 'Proceso general para PQRS',
        proctiempon: 15, // 15 días
        procestinis: 'RECIBIDO',
        procpriorids: 1,
        orgacodigos: 'ATENCION',
        procactivos: true
      },
      {
        proccodigos: 'QUEJA_TECNICA',
        procnombres: 'Queja Técnica',
        procdescripc: 'Proceso para quejas técnicas',
        proctiempon: 10, // 10 días
        procestinis: 'ASIGNADO',
        procpriorids: 2,
        orgacodigos: 'TECNICO',
        procactivos: true
      },
      {
        proccodigos: 'RECLAMO_FACTURA',
        procnombres: 'Reclamo de Facturación',
        procdescripc: 'Proceso para reclamos de facturación',
        proctiempon: 5, // 5 días
        procestinis: 'EN_REVISION',
        procpriorids: 3,
        orgacodigos: 'ATENCION',
        procactivos: true
      }
    ]);

    // === ACTIVIDADES ===
    await queryInterface.bulkInsert('actividad', [
      {
        acticodigos: 'RECEPCION',
        proccodigos: 'PQRS_GENERAL',
        actinombres: 'Recepción de PQRS',
        actidescripc: 'Recibir y registrar la PQRS',
        actitiempon: 1,
        actitipotien: 'DIAS',
        actiorden: 1,
        actiinicial: true,
        orgacodigos: 'ATENCION',
        actiactivas: true
      },
      {
        acticodigos: 'ANALISIS',
        proccodigos: 'PQRS_GENERAL',
        actinombres: 'Análisis de PQRS',
        actidescripc: 'Analizar y clasificar la PQRS',
        actitiempon: 3,
        actitipotien: 'DIAS',
        actiorden: 2,
        actiinicial: false,
        orgacodigos: 'ATENCION',
        actiactivas: true
      },
      {
        acticodigos: 'RESOLUCION',
        proccodigos: 'PQRS_GENERAL',
        actinombres: 'Resolución de PQRS',
        actidescripc: 'Resolver la PQRS',
        actitiempon: 10,
        actitipotien: 'DIAS',
        actiorden: 3,
        actiinicial: false,
        orgacodigos: 'TECNICO',
        actiactivas: true
      },
      {
        acticodigos: 'CIERRE',
        proccodigos: 'PQRS_GENERAL',
        actinombres: 'Cierre de PQRS',
        actidescripc: 'Cerrar y notificar resolución',
        actitiempon: 1,
        actitipotien: 'DIAS',
        actiorden: 4,
        actiinicial: false,
        orgacodigos: 'CALIDAD',
        actiactivas: true
      }
    ]);

    // === CLIENTES DE PRUEBA ===
    await queryInterface.bulkInsert('cliente', [
      {
        cliecodigos: 'CLI001',
        clieidentifs: '12345678',
        ticlcodigos: 'NATURAL',
        clienombres: 'Juan Pérez García',
        clierepprnos: 'Juan',
        clierepsenos: 'Carlos',
        cliereppraps: 'Pérez',
        clierepseaps: 'García',
        clielocalizs: 'Calle 123 #45-67',
        clietelefons: '3001234567',
        locacodigos: 'CALI',
        cliepagwebs: null,
        cliemails: 'juan.perez@email.com',
        esclcodigos: 'ACTIVO',
        tiidcodigos: 'CC',
        grclcodigos: 'REGULAR',
        clienumfaxs: null,
        clieaparaers: null,
        clieactivas: true
      },
      {
        cliecodigos: 'CLI002',
        clieidentifs: '87654321',
        ticlcodigos: 'JURIDICA',
        clienombres: 'Empresa ABC S.A.S.',
        clierepprnos: 'María',
        clierepsenos: 'Elena',
        cliereppraps: 'González',
        clierepseaps: 'López',
        clielocalizs: 'Carrera 50 #30-20',
        clietelefons: '3007654321',
        locacodigos: 'BOGOTA',
        cliepagwebs: 'www.empresaabc.com',
        cliemails: 'contacto@empresaabc.com',
        esclcodigos: 'ACTIVO',
        tiidcodigos: 'NIT',
        grclcodigos: 'PREMIUM',
        clienumfaxs: '6012345678',
        clieaparaers: '12345',
        clieactivas: true
      }
    ]);

    // === SOLICITANTES ===
    await queryInterface.bulkInsert('solicitante', [
      {
        contidentis: '12345678',
        cliecodigos: 'CLI001',
        contnombres: 'Juan Carlos',
        contapellids: 'Pérez García',
        contemails: 'juan.perez@email.com',
        conttelefons: '3001234567',
        contactivas: true
      },
      {
        contidentis: '87654321',
        cliecodigos: 'CLI002',
        contnombres: 'María Elena',
        contapellids: 'González López',
        contemails: 'maria.gonzalez@empresaabc.com',
        conttelefons: '3007654321',
        contactivas: true
      }
    ]);

    // === NUMERADORES ===
    await queryInterface.bulkInsert('numerador', [
      {
        numetipos: 'orden',
        numevalors: 1,
        numeprefijos: '',
        numesufijos: '',
        numelongituds: 10
      },
      {
        numetipos: 'cliente',
        numevalors: 3,
        numeprefijos: 'CLI',
        numesufijos: '',
        numelongituds: 3
      },
      {
        numetipos: 'tarea',
        numevalors: 1,
        numeprefijos: 'T',
        numesufijos: '',
        numelongituds: 6
      },
      {
        numetipos: 'archivos',
        numevalors: 1,
        numeprefijos: 'ARCH',
        numesufijos: '',
        numelongituds: 6
      }
    ]);

    // === REGLAS DE NEGOCIO ===
    await queryInterface.bulkInsert('regla', [
      {
        reglcodigos: 'EMAIL_CREACION',
        reglnombres: 'Email de Creación',
        regldescripc: 'Enviar email cuando se crea una orden',
        reglcondics: '{tiorcodigos} == "QUEJA"',
        reglaccions: 'EMAIL:order-created',
        reglpriorid: 1,
        acticodigos: 'RECEPCION',
        reglactivas: true
      },
      {
        reglcodigos: 'ESCALAMIENTO',
        reglnombres: 'Escalamiento Automático',
        regldescripc: 'Escalar caso si supera tiempo límite',
        reglcondics: '{diasVencido} > 5',
        reglaccions: 'EXECUTE:WorkflowService::escalarCaso',
        reglpriorid: 2,
        acticodigos: 'ANALISIS',
        reglactivas: true
      }
    ]);

    // === FORMULARIOS DE PRUEBA ===
    await queryInterface.bulkInsert('formulario', [
      {
        formcodigos: 'SATISFACCION',
        formnombres: 'Encuesta de Satisfacción',
        formdescripc: 'Encuesta para medir satisfacción del cliente',
        formactivos: true,
        formfeccread: Math.floor(Date.now() / 1000)
      }
    ]);

    // === PREGUNTAS ===
    await queryInterface.bulkInsert('pregunta', [
      {
        pregcodigos: 'P001',
        formcodigos: 'SATISFACCION',
        pregtextos: '¿Cómo califica nuestro servicio?',
        pregtipos: 'ESCALA',
        pregorden: 1,
        pregobligats: true
      },
      {
        pregcodigos: 'P002',
        formcodigos: 'SATISFACCION',
        pregtextos: '¿Recomendaría nuestros servicios?',
        pregtipos: 'SINO',
        pregorden: 2,
        pregobligats: true
      }
    ]);

    // === PRODUCTOS ===
    await queryInterface.bulkInsert('producto', [
      {
        prodcodigos: 'SERV001',
        prodnombres: 'Servicio Básico',
        proddescripc: 'Servicio básico de atención',
        prodprecios: 50000.00,
        prodactivos: true
      },
      {
        prodcodigos: 'SERV002',
        prodnombres: 'Servicio Premium',
        proddescripc: 'Servicio premium con soporte 24/7',
        prodprecios: 150000.00,
        prodactivos: true
      }
    ]);

    // === ALMACENES ===
    await queryInterface.bulkInsert('almacen', [
      {
        almacodigos: 'ALM001',
        almanombres: 'Almacén Principal',
        almadescripc: 'Almacén principal de la empresa',
        almaactivos: true
      }
    ]);

    // === RECURSOS ===
    await queryInterface.bulkInsert('recurso', [
      {
        recucodigos: 'REC001',
        recunombres: 'Computador',
        recudescripc: 'Computador de escritorio',
        recuactivos: true
      }
    ]);

    console.log('✅ Datos iniciales insertados correctamente');
  },

  down: async (queryInterface, Sequelize) => {
    // Limpiar todas las tablas
    const tables = [
      'recurso', 'almacen', 'producto', 'pregunta', 'formulario',
      'regla', 'numerador', 'solicitante', 'cliente', 'actividad',
      'proceso', 'organizacion', 'permisos', 'perfiles', 'usuarios'
    ];

    for (const table of tables) {
      await queryInterface.bulkDelete(table, null, {});
    }
  }
};