const pool = require('../config/database');

async function testConnection() {
  try {
    console.log('🔄 Probando conexión a PostgreSQL...');
    
    const client = await pool.connect();
    const result = await client.query('SELECT NOW()');
    
    console.log('✅ Conexión exitosa');
    console.log('🕐 Hora del servidor:', result.rows[0].now);
    
    // Probar esquemas
    const schemas = await client.query(`
      SELECT schema_name 
      FROM information_schema.schemata 
      WHERE schema_name IN ('profiles', 'schema2')
    `);
    
    console.log('📋 Esquemas encontrados:', schemas.rows.map(r => r.schema_name));
    
    // Contar tablas
    const tables = await client.query(`
      SELECT schemaname, count(*) as total
      FROM pg_tables 
      WHERE schemaname IN ('profiles', 'schema2')
      GROUP BY schemaname
    `);
    
    console.log('📊 Tablas por esquema:');
    tables.rows.forEach(row => {
      console.log(`   ${row.schemaname}: ${row.total} tablas`);
    });
    
    client.release();
    
  } catch (error) {
    console.error('❌ Error de conexión:', error.message);
  } finally {
    await pool.end();
  }
}

testConnection();