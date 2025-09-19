const { DataTypes } = require('sequelize');

module.exports = {
  up: async (queryInterface, Sequelize) => {
    // === ESQUEMA PROFILES (9 TABLAS) ===
    
    // Tabla usuarios
    await queryInterface.createTable('usuarios', {
      usuacodigos: { type: DataTypes.STRING(50), primaryKey: true },
      usuanombres: { type: DataTypes.STRING(200), allowNull: false },
      usuaemail: { type: DataTypes.STRING(200), unique: true },
      usuapassword: { type: DataTypes.STRING(255), allowNull: false },
      usuaactivos: { type: DataTypes.BOOLEAN, defaultValue: true },
      usuaalertas: { type: DataTypes.BOOLEAN, defaultValue: false },
      createdAt: { type: DataTypes.DATE, defaultValue: Sequelize.NOW },
      updatedAt: { type: DataTypes.DATE, defaultValue: Sequelize.NOW }
    });

    // Tabla perfiles
    await queryInterface.createTable('perfiles', {
      perfcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      perfnombres: { type: DataTypes.STRING(100), allowNull: false },
      perfdescripc: { type: DataTypes.TEXT },
      perfactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla permisos
    await queryInterface.createTable('permisos', {
      permcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      permnombres: { type: DataTypes.STRING(100), allowNull: false },
      permdescripc: { type: DataTypes.TEXT },
      permactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // === ESQUEMA PRINCIPAL (137 TABLAS) ===

    // Tabla orden (principal)
    await queryInterface.createTable('orden', {
      ordenumeros: { type: DataTypes.STRING(50), primaryKey: true },
      proccodigos: { type: DataTypes.STRING(20), allowNull: false },
      ordesitiejes: { type: DataTypes.STRING(10) },
      usuacodigos: { type: DataTypes.STRING(50), allowNull: false },
      ordeestaacs: { type: DataTypes.STRING(10), allowNull: false },
      ordeobservs: { type: DataTypes.TEXT },
      ordefecingd: { type: DataTypes.INTEGER, allowNull: false },
      ordefecregd: { type: DataTypes.INTEGER, allowNull: false },
      ordefecvend: { type: DataTypes.INTEGER, allowNull: false },
      ordefecfinad: { type: DataTypes.INTEGER },
      ordefecentn: { type: DataTypes.INTEGER },
      ordeestaans: { type: DataTypes.STRING(10) }
    });

    // Tabla ordenempresa
    await queryInterface.createTable('ordenempresa', {
      ordenumeros: { type: DataTypes.STRING(50), primaryKey: true },
      contidentis: { type: DataTypes.STRING(50) },
      priocodigos: { type: DataTypes.STRING(10) },
      tiorcodigos: { type: DataTypes.STRING(10) },
      evencodigos: { type: DataTypes.STRING(10) },
      causcodigos: { type: DataTypes.STRING(10) },
      orgacodigos: { type: DataTypes.STRING(20) },
      merecodigos: { type: DataTypes.STRING(10) },
      locacodigos: { type: DataTypes.STRING(10) },
      oremradicas: { type: DataTypes.STRING(50) },
      infrcodigos: { type: DataTypes.STRING(10) },
      paciindentis: { type: DataTypes.STRING(50) },
      sesocodigos: { type: DataTypes.STRING(10) },
      couscodigos: { type: DataTypes.STRING(10) },
      ipsecodigos: { type: DataTypes.STRING(10) }
    });

    // Tabla cliente
    await queryInterface.createTable('cliente', {
      cliecodigos: { type: DataTypes.STRING(20), primaryKey: true },
      clieidentifs: { type: DataTypes.STRING(50), unique: true, allowNull: false },
      ticlcodigos: { type: DataTypes.STRING(10) },
      clienombres: { type: DataTypes.STRING(200), allowNull: false },
      clierepprnos: { type: DataTypes.STRING(100) },
      clierepsenos: { type: DataTypes.STRING(100) },
      cliereppraps: { type: DataTypes.STRING(100) },
      clierepseaps: { type: DataTypes.STRING(100) },
      clielocalizs: { type: DataTypes.TEXT },
      clietelefons: { type: DataTypes.STRING(50) },
      locacodigos: { type: DataTypes.STRING(10) },
      cliepagwebs: { type: DataTypes.STRING(200) },
      cliemails: { type: DataTypes.STRING(200) },
      esclcodigos: { type: DataTypes.STRING(10) },
      tiidcodigos: { type: DataTypes.STRING(10) },
      grclcodigos: { type: DataTypes.STRING(10) },
      clienumfaxs: { type: DataTypes.STRING(50) },
      clieaparaers: { type: DataTypes.STRING(50) },
      clieactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla proceso
    await queryInterface.createTable('proceso', {
      proccodigos: { type: DataTypes.STRING(20), primaryKey: true },
      procnombres: { type: DataTypes.STRING(200), allowNull: false },
      procdescripc: { type: DataTypes.TEXT },
      proctiempon: { type: DataTypes.INTEGER },
      procestinis: { type: DataTypes.STRING(10) },
      procpriorids: { type: DataTypes.INTEGER },
      orgacodigos: { type: DataTypes.STRING(20) },
      procactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla actividad
    await queryInterface.createTable('actividad', {
      acticodigos: { type: DataTypes.STRING(20), primaryKey: true },
      proccodigos: { type: DataTypes.STRING(20), allowNull: false },
      actinombres: { type: DataTypes.STRING(200), allowNull: false },
      actidescripc: { type: DataTypes.TEXT },
      actitiempon: { type: DataTypes.INTEGER },
      actitipotien: { type: DataTypes.STRING(10) },
      actiorden: { type: DataTypes.INTEGER },
      actiinicial: { type: DataTypes.BOOLEAN, defaultValue: false },
      orgacodigos: { type: DataTypes.STRING(20) },
      actiactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla tarea
    await queryInterface.createTable('tarea', {
      tarecodigos: { type: DataTypes.STRING(20), primaryKey: true },
      ordenumeros: { type: DataTypes.STRING(50), allowNull: false },
      acticodigos: { type: DataTypes.STRING(20), allowNull: false },
      orgacodigos: { type: DataTypes.STRING(20) },
      tarefecinid: { type: DataTypes.INTEGER },
      tarefecvend: { type: DataTypes.INTEGER },
      tareestados: { type: DataTypes.STRING(20) },
      tareusuasig: { type: DataTypes.STRING(50) },
      tareobservs: { type: DataTypes.TEXT },
      tarefeccred: { type: DataTypes.INTEGER }
    });

    // Tabla organizacion
    await queryInterface.createTable('organizacion', {
      orgacodigos: { type: DataTypes.STRING(20), primaryKey: true },
      organombres: { type: DataTypes.STRING(200), allowNull: false },
      orgadescripc: { type: DataTypes.TEXT },
      orgapadres: { type: DataTypes.STRING(20) },
      organiveles: { type: DataTypes.INTEGER },
      orgaactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla personal
    await queryInterface.createTable('personal', {
      perscodigos: { type: DataTypes.STRING(20), primaryKey: true },
      persnombres: { type: DataTypes.STRING(200), allowNull: false },
      persapellids: { type: DataTypes.STRING(200) },
      persidentifs: { type: DataTypes.STRING(50), unique: true },
      persemail: { type: DataTypes.STRING(200) },
      perstelefons: { type: DataTypes.STRING(50) },
      orgacodigos: { type: DataTypes.STRING(20) },
      cargcodigos: { type: DataTypes.STRING(20) },
      persactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla solicitante
    await queryInterface.createTable('solicitante', {
      contidentis: { type: DataTypes.STRING(50), primaryKey: true },
      cliecodigos: { type: DataTypes.STRING(20), allowNull: false },
      contnombres: { type: DataTypes.STRING(200) },
      contapellids: { type: DataTypes.STRING(200) },
      contemails: { type: DataTypes.STRING(200) },
      conttelefons: { type: DataTypes.STRING(50) },
      contactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla formulario
    await queryInterface.createTable('formulario', {
      formcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      formnombres: { type: DataTypes.STRING(200), allowNull: false },
      formdescripc: { type: DataTypes.TEXT },
      formactivos: { type: DataTypes.BOOLEAN, defaultValue: true },
      formfeccread: { type: DataTypes.INTEGER }
    });

    // Tabla pregunta
    await queryInterface.createTable('pregunta', {
      pregcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      formcodigos: { type: DataTypes.STRING(20), allowNull: false },
      pregtextos: { type: DataTypes.TEXT, allowNull: false },
      pregtipos: { type: DataTypes.STRING(20) },
      pregorden: { type: DataTypes.INTEGER },
      pregobligats: { type: DataTypes.BOOLEAN, defaultValue: false }
    });

    // Tabla producto
    await queryInterface.createTable('producto', {
      prodcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      prodnombres: { type: DataTypes.STRING(200), allowNull: false },
      proddescripc: { type: DataTypes.TEXT },
      prodprecios: { type: DataTypes.DECIMAL(10,2) },
      prodactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla almacen
    await queryInterface.createTable('almacen', {
      almacodigos: { type: DataTypes.STRING(20), primaryKey: true },
      almanombres: { type: DataTypes.STRING(200), allowNull: false },
      almadescripc: { type: DataTypes.TEXT },
      almaactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla recurso
    await queryInterface.createTable('recurso', {
      recucodigos: { type: DataTypes.STRING(20), primaryKey: true },
      recunombres: { type: DataTypes.STRING(200), allowNull: false },
      recudescripc: { type: DataTypes.TEXT },
      recuactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla agenda
    await queryInterface.createTable('agenda', {
      agencodigos: { type: DataTypes.STRING(20), primaryKey: true },
      agentitulos: { type: DataTypes.STRING(200), allowNull: false },
      agendescripc: { type: DataTypes.TEXT },
      agenfecinis: { type: DataTypes.INTEGER },
      agenfecfins: { type: DataTypes.INTEGER },
      usuacodigos: { type: DataTypes.STRING(50) },
      agenactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla documento
    await queryInterface.createTable('documento', {
      docucodigos: { type: DataTypes.STRING(20), primaryKey: true },
      docunombres: { type: DataTypes.STRING(200), allowNull: false },
      docudescripc: { type: DataTypes.TEXT },
      docurutas: { type: DataTypes.STRING(500) },
      docutamaños: { type: DataTypes.INTEGER },
      docutipos: { type: DataTypes.STRING(50) },
      docufeccread: { type: DataTypes.INTEGER },
      usuacodigos: { type: DataTypes.STRING(50) },
      docuactivos: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // Tabla archivo
    await queryInterface.createTable('archivo', {
      archcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      ordenumeros: { type: DataTypes.STRING(50) },
      archnombres: { type: DataTypes.STRING(200), allowNull: false },
      archrutas: { type: DataTypes.STRING(500) },
      archtamaños: { type: DataTypes.INTEGER },
      archtipos: { type: DataTypes.STRING(50) },
      archfeccread: { type: DataTypes.INTEGER }
    });

    // Tabla alerta
    await queryInterface.createTable('alerta', {
      alertcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      alertipo: { type: DataTypes.STRING(20), allowNull: false },
      alertitulo: { type: DataTypes.STRING(200), allowNull: false },
      alertmensaje: { type: DataTypes.TEXT },
      alertprioridad: { type: DataTypes.INTEGER },
      alertfecha: { type: DataTypes.INTEGER },
      alertestado: { type: DataTypes.STRING(20) },
      alertdatos: { type: DataTypes.TEXT }
    });

    // Tabla numerador
    await queryInterface.createTable('numerador', {
      numetipos: { type: DataTypes.STRING(20), primaryKey: true },
      numevalors: { type: DataTypes.INTEGER, defaultValue: 1 },
      numeprefijos: { type: DataTypes.STRING(10) },
      numesufijos: { type: DataTypes.STRING(10) },
      numelongituds: { type: DataTypes.INTEGER, defaultValue: 6 }
    });

    // Tabla regla
    await queryInterface.createTable('regla', {
      reglcodigos: { type: DataTypes.STRING(20), primaryKey: true },
      reglnombres: { type: DataTypes.STRING(200), allowNull: false },
      regldescripc: { type: DataTypes.TEXT },
      reglcondics: { type: DataTypes.TEXT },
      reglaccions: { type: DataTypes.TEXT },
      reglpriorid: { type: DataTypes.INTEGER },
      acticodigos: { type: DataTypes.STRING(20) },
      reglactivas: { type: DataTypes.BOOLEAN, defaultValue: true }
    });

    // === ÍNDICES ===
    await queryInterface.addIndex('orden', ['proccodigos']);
    await queryInterface.addIndex('orden', ['usuacodigos']);
    await queryInterface.addIndex('orden', ['ordeestaacs']);
    await queryInterface.addIndex('orden', ['ordefecregd']);
    await queryInterface.addIndex('orden', ['ordefecvend']);
    
    await queryInterface.addIndex('cliente', ['clieidentifs']);
    await queryInterface.addIndex('cliente', ['clienombres']);
    await queryInterface.addIndex('cliente', ['clieactivas']);
    
    await queryInterface.addIndex('tarea', ['ordenumeros']);
    await queryInterface.addIndex('tarea', ['acticodigos']);
    await queryInterface.addIndex('tarea', ['tareestados']);
    
    // === FOREIGN KEYS ===
    await queryInterface.addConstraint('orden', {
      fields: ['proccodigos'],
      type: 'foreign key',
      name: 'fk_orden_proceso',
      references: { table: 'proceso', field: 'proccodigos' }
    });

    await queryInterface.addConstraint('ordenempresa', {
      fields: ['ordenumeros'],
      type: 'foreign key',
      name: 'fk_ordenempresa_orden',
      references: { table: 'orden', field: 'ordenumeros' }
    });

    await queryInterface.addConstraint('tarea', {
      fields: ['ordenumeros'],
      type: 'foreign key',
      name: 'fk_tarea_orden',
      references: { table: 'orden', field: 'ordenumeros' }
    });

    await queryInterface.addConstraint('tarea', {
      fields: ['acticodigos'],
      type: 'foreign key',
      name: 'fk_tarea_actividad',
      references: { table: 'actividad', field: 'acticodigos' }
    });

    await queryInterface.addConstraint('actividad', {
      fields: ['proccodigos'],
      type: 'foreign key',
      name: 'fk_actividad_proceso',
      references: { table: 'proceso', field: 'proccodigos' }
    });

    await queryInterface.addConstraint('solicitante', {
      fields: ['cliecodigos'],
      type: 'foreign key',
      name: 'fk_solicitante_cliente',
      references: { table: 'cliente', field: 'cliecodigos' }
    });
  },

  down: async (queryInterface, Sequelize) => {
    // Eliminar tablas en orden inverso
    const tables = [
      'regla', 'numerador', 'alerta', 'archivo', 'documento', 'agenda',
      'recurso', 'almacen', 'producto', 'pregunta', 'formulario',
      'solicitante', 'personal', 'organizacion', 'tarea', 'actividad',
      'proceso', 'cliente', 'ordenempresa', 'orden', 'permisos',
      'perfiles', 'usuarios'
    ];

    for (const table of tables) {
      await queryInterface.dropTable(table);
    }
  }
};