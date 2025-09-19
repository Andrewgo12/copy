const BaseModel = require('./BaseModel');

class Personal extends BaseModel {
  constructor() {
    super('personal', 'schema2');
    this.primaryKey = 'perscodigos';
  }

  // Buscar personal por código
  async findByCode(codigo) {
    return await this.findById(codigo, this.primaryKey);
  }

  // Buscar personal activo
  async findActive() {
    const query = `SELECT * FROM ${this.fullTableName} WHERE persactivas = 'A'`;
    const result = await pool.query(query);
    return result.rows;
  }

  // Buscar por email
  async findByEmail(email) {
    const query = `SELECT * FROM ${this.fullTableName} WHERE persemail = $1`;
    const result = await pool.query(query, [email]);
    return result.rows[0];
  }

  // Obtener personal con organización
  async findWithOrganization() {
    const query = `
      SELECT p.*, o.organombres 
      FROM ${this.fullTableName} p
      LEFT JOIN schema2.organizacion o ON p.orgacodigos = o.orgacodigos
      WHERE p.persactivas = 'A'
    `;
    const result = await pool.query(query);
    return result.rows;
  }
}

module.exports = new Personal();