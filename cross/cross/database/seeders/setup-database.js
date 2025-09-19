const fs = require('fs');
const path = require('path');
const pool = require('../config/database');

async function setupDatabase() {
  try {
    console.log('🔄 Configurando base de datos PostgreSQL...');
    
    // Leer el archivo SQL completo
    const sqlFile = path.join(__dirname, '../todas_las_tablas_completas.sql');
    const sql = fs.readFileSync(sqlFile, 'utf8');
    
    // Ejecutar el SQL completo
    await pool.query(sql);
    
    console.log('✅ Base de datos PostgreSQL configurada exitosamente');
    console.log('📊 146 tablas creadas (9 en profiles + 137 en schema2)');
    
  } catch (error) {
    console.error('❌ Error configurando base de datos:', error.message);
  } finally {
    await pool.end();
  }
}

setupDatabase();