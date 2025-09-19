const mysql = require('mysql2/promise');
require('dotenv').config();

async function createDatabase() {
  let connection;
  try {
    console.log('🔄 Creando base de datos crosshuvdb...');
    
    // Conectar sin especificar base de datos
    connection = await mysql.createConnection({
      host: process.env.DB_HOST,
      port: process.env.DB_PORT,
      user: process.env.DB_USER,
      password: process.env.DB_PASSWORD,
    });
    
    // Crear la base de datos
    await connection.execute('CREATE DATABASE IF NOT EXISTS crosshuvdb');
    console.log('✅ Base de datos crosshuvdb creada exitosamente');
    
  } catch (error) {
    console.error('❌ Error creando base de datos:', error.message);
  } finally {
    if (connection) {
      await connection.end();
    }
  }
}

createDatabase();