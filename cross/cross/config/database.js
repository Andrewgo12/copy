const { Sequelize } = require('sequelize');
const logger = require('../app/Services/LoggerService');

// Configuración de la base de datos
const sequelize = new Sequelize(
  process.env.DB_NAME || 'cross_db',
  process.env.DB_USER || 'cross_user',
  process.env.DB_PASS || 'cross_password',
  {
    host: process.env.DB_HOST || 'localhost',
    port: process.env.DB_PORT || 5432,
    dialect: 'postgres',
    logging: process.env.NODE_ENV === 'development' ? 
      (msg) => logger.debug(msg) : false,
    pool: {
      max: 10,
      min: 0,
      acquire: 30000,
      idle: 10000
    },
    define: {
      timestamps: true,
      underscored: true,
      freezeTableName: true
    },
    timezone: '-05:00' // Zona horaria Colombia
  }
);

// Test de conexión
sequelize.authenticate()
  .then(() => {
    logger.info('✅ Conexión a PostgreSQL exitosa');
  })
  .catch(err => {
    logger.error('❌ Error conectando a PostgreSQL:', err);
  });

module.exports = sequelize;