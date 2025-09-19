const BaseService = require('./BaseService');
const multer = require('multer');
const path = require('path');
const fs = require('fs').promises;

class FileService extends BaseService {
  
  constructor() {
    super();
    this.uploadPath = process.env.STORAGE_PATH || './storage/uploads';
    this.tempPath = process.env.TEMP_PATH || './storage/temp';
    this.maxFileSize = parseInt(process.env.UPLOAD_MAX_SIZE) || 10485760; // 10MB
    this.allowedTypes = (process.env.UPLOAD_ALLOWED_TYPES || 'jpg,jpeg,png,gif,pdf,doc,docx,xls,xlsx,txt').split(',');
    
    this.initializeDirectories();
  }

  /**
   * Inicializar directorios necesarios
   */
  async initializeDirectories() {
    try {
      await fs.mkdir(this.uploadPath, { recursive: true });
      await fs.mkdir(this.tempPath, { recursive: true });
      await fs.mkdir(path.join(this.uploadPath, 'ordenes'), { recursive: true });
      await fs.mkdir(path.join(this.uploadPath, 'documentos'), { recursive: true });
      await fs.mkdir(path.join(this.uploadPath, 'reportes'), { recursive: true });
    } catch (error) {
      this.logger.error('Error creando directorios:', error);
    }
  }

  /**
   * Configurar multer para subida de archivos
   */
  getMulterConfig(destination = 'general') {
    const storage = multer.diskStorage({
      destination: async (req, file, cb) => {
        const uploadDir = path.join(this.uploadPath, destination);
        await fs.mkdir(uploadDir, { recursive: true });
        cb(null, uploadDir);
      },
      filename: (req, file, cb) => {
        const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9);
        const ext = path.extname(file.originalname);
        cb(null, file.fieldname + '-' + uniqueSuffix + ext);
      }
    });

    const fileFilter = (req, file, cb) => {
      const ext = path.extname(file.originalname).toLowerCase().substring(1);
      
      if (this.allowedTypes.includes(ext)) {
        cb(null, true);
      } else {
        cb(new Error(`Tipo de archivo no permitido: ${ext}. Permitidos: ${this.allowedTypes.join(', ')}`), false);
      }
    };

    return multer({
      storage,
      fileFilter,
      limits: {
        fileSize: this.maxFileSize,
        files: 10 // Máximo 10 archivos por request
      }
    });
  }

  /**
   * Procesar archivos adjuntos para órdenes
   * Migrado de: FeCrOrdenManager::addFiles()
   */
  async processAttachments(ordenumeros, files, options = {}) {
    const { transaction } = options;
    
    try {
      if (!files || files.length === 0) {
        return [];
      }

      const Archivo = require('../Models/Archivo');
      const NumeradorService = require('./NumeradorService');
      
      const archivosCreados = [];
      
      for (const file of files) {
        // Generar código único para el archivo
        const archcodigos = await NumeradorService.getNext('archivos');
        
        // Mover archivo a directorio final
        const finalPath = await this.moveToFinalLocation(file, 'ordenes', ordenumeros);
        
        // Crear registro en base de datos
        const archivo = await Archivo.create({
          archcodigos,
          ordenumeros,
          archnombres: file.originalname,
          archrutas: finalPath,
          archtamaños: file.size,
          archtipos: file.mimetype,
          archfeccread: Math.floor(Date.now() / 1000)
        }, { transaction });

        archivosCreados.push(archivo);
        
        this.logger.logFileOperation('upload', file.originalname, true, null, {
          ordenumeros,
          size: file.size,
          type: file.mimetype
        });
      }

      return archivosCreados;

    } catch (error) {
      this.logger.logFileOperation('upload', 'multiple', false, error);
      throw error;
    }
  }

  /**
   * Actualizar archivos adjuntos
   * Migrado de: FeCrOrdenManager::updateFiles()
   */
  async updateAttachments(ordenumeros, files, options = {}) {
    const { transaction } = options;
    
    try {
      const Archivo = require('../Models/Archivo');
      
      // Obtener archivos existentes
      const archivosExistentes = await Archivo.findAll({
        where: { ordenumeros },
        transaction
      });

      // Eliminar archivos que ya no están en la lista
      const archivosAEliminar = archivosExistentes.filter(archivo => 
        !files.some(file => file.id === archivo.archcodigos)
      );

      for (const archivo of archivosAEliminar) {
        await this.deleteFile(archivo.archrutas);
        await archivo.destroy({ transaction });
      }

      // Procesar nuevos archivos
      const nuevosArchivos = files.filter(file => !file.id);
      const archivosCreados = await this.processAttachments(ordenumeros, nuevosArchivos, { transaction });

      return {
        eliminados: archivosAEliminar.length,
        creados: archivosCreados.length,
        archivos: archivosCreados
      };

    } catch (error) {
      this.logger.logFileOperation('update', 'attachments', false, error, { ordenumeros });
      throw error;
    }
  }

  /**
   * Mover archivo a ubicación final
   */
  async moveToFinalLocation(file, category, identifier) {
    try {
      const finalDir = path.join(this.uploadPath, category, identifier);
      await fs.mkdir(finalDir, { recursive: true });
      
      const finalPath = path.join(finalDir, file.filename);
      await fs.rename(file.path, finalPath);
      
      return finalPath;
    } catch (error) {
      this.logger.error('Error moviendo archivo:', error);
      throw error;
    }
  }

  /**
   * Eliminar archivo del sistema
   */
  async deleteFile(filePath) {
    try {
      await fs.unlink(filePath);
      this.logger.logFileOperation('delete', path.basename(filePath), true);
      return true;
    } catch (error) {
      if (error.code !== 'ENOENT') {
        this.logger.logFileOperation('delete', path.basename(filePath), false, error);
        throw error;
      }
      return false; // Archivo no existe, consideramos éxito
    }
  }

  /**
   * Obtener información de archivo
   */
  async getFileInfo(filePath) {
    try {
      const stats = await fs.stat(filePath);
      const ext = path.extname(filePath).toLowerCase();
      
      return {
        name: path.basename(filePath),
        size: stats.size,
        extension: ext,
        mimeType: this.getMimeType(ext),
        created: stats.birthtime,
        modified: stats.mtime,
        exists: true
      };
    } catch (error) {
      return {
        exists: false,
        error: error.message
      };
    }
  }

  /**
   * Validar archivo
   */
  validateFile(file) {
    const errors = [];
    
    // Validar tamaño
    if (file.size > this.maxFileSize) {
      errors.push(`Archivo demasiado grande. Máximo: ${this.formatFileSize(this.maxFileSize)}`);
    }
    
    // Validar tipo
    const ext = path.extname(file.originalname).toLowerCase().substring(1);
    if (!this.allowedTypes.includes(ext)) {
      errors.push(`Tipo de archivo no permitido: ${ext}`);
    }
    
    // Validar nombre
    if (!file.originalname || file.originalname.trim() === '') {
      errors.push('Nombre de archivo inválido');
    }
    
    return {
      valid: errors.length === 0,
      errors
    };
  }

  /**
   * Generar thumbnail para imágenes
   */
  async generateThumbnail(filePath, width = 200, height = 200) {
    try {
      const sharp = require('sharp');
      const ext = path.extname(filePath);
      const thumbnailPath = filePath.replace(ext, `_thumb${ext}`);
      
      await sharp(filePath)
        .resize(width, height, { fit: 'cover' })
        .jpeg({ quality: 80 })
        .toFile(thumbnailPath);
      
      return thumbnailPath;
    } catch (error) {
      this.logger.error('Error generando thumbnail:', error);
      return null;
    }
  }

  /**
   * Comprimir archivo
   */
  async compressFile(filePath) {
    try {
      const archiver = require('archiver');
      const compressedPath = filePath + '.zip';
      
      const output = require('fs').createWriteStream(compressedPath);
      const archive = archiver('zip', { zlib: { level: 9 } });
      
      return new Promise((resolve, reject) => {
        output.on('close', () => resolve(compressedPath));
        archive.on('error', reject);
        
        archive.pipe(output);
        archive.file(filePath, { name: path.basename(filePath) });
        archive.finalize();
      });
    } catch (error) {
      this.logger.error('Error comprimiendo archivo:', error);
      throw error;
    }
  }

  /**
   * Limpiar archivos temporales
   */
  async cleanupTempFiles(maxAge = 24 * 60 * 60 * 1000) { // 24 horas
    try {
      const files = await fs.readdir(this.tempPath);
      const cutoffTime = Date.now() - maxAge;
      let deletedCount = 0;

      for (const file of files) {
        const filePath = path.join(this.tempPath, file);
        const stats = await fs.stat(filePath);
        
        if (stats.mtime.getTime() < cutoffTime) {
          await fs.unlink(filePath);
          deletedCount++;
        }
      }

      this.logger.info(`Archivos temporales limpiados: ${deletedCount}`);
      return deletedCount;

    } catch (error) {
      this.logger.error('Error limpiando archivos temporales:', error);
      throw error;
    }
  }

  /**
   * Obtener estadísticas de almacenamiento
   */
  async getStorageStats() {
    try {
      const stats = {
        uploads: await this.getDirectoryStats(this.uploadPath),
        temp: await this.getDirectoryStats(this.tempPath),
        total: { size: 0, files: 0 }
      };

      stats.total.size = stats.uploads.size + stats.temp.size;
      stats.total.files = stats.uploads.files + stats.temp.files;

      return stats;
    } catch (error) {
      this.logger.error('Error obteniendo estadísticas de almacenamiento:', error);
      throw error;
    }
  }

  /**
   * Obtener estadísticas de directorio
   */
  async getDirectoryStats(dirPath) {
    try {
      let totalSize = 0;
      let totalFiles = 0;

      const files = await fs.readdir(dirPath, { withFileTypes: true });
      
      for (const file of files) {
        const filePath = path.join(dirPath, file.name);
        
        if (file.isDirectory()) {
          const subStats = await this.getDirectoryStats(filePath);
          totalSize += subStats.size;
          totalFiles += subStats.files;
        } else {
          const stats = await fs.stat(filePath);
          totalSize += stats.size;
          totalFiles++;
        }
      }

      return {
        size: totalSize,
        files: totalFiles,
        sizeFormatted: this.formatFileSize(totalSize)
      };
    } catch (error) {
      return { size: 0, files: 0, sizeFormatted: '0 B' };
    }
  }

  /**
   * Formatear tamaño de archivo
   */
  formatFileSize(bytes) {
    if (bytes === 0) return '0 B';
    
    const k = 1024;
    const sizes = ['B', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
  }

  /**
   * Obtener tipo MIME por extensión
   */
  getMimeType(extension) {
    const mimeTypes = {
      '.jpg': 'image/jpeg',
      '.jpeg': 'image/jpeg',
      '.png': 'image/png',
      '.gif': 'image/gif',
      '.pdf': 'application/pdf',
      '.doc': 'application/msword',
      '.docx': 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
      '.xls': 'application/vnd.ms-excel',
      '.xlsx': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
      '.txt': 'text/plain'
    };

    return mimeTypes[extension.toLowerCase()] || 'application/octet-stream';
  }

  /**
   * Crear backup de archivos
   */
  async createBackup(category = null) {
    try {
      const backupDir = path.join(process.cwd(), 'storage', 'backups');
      await fs.mkdir(backupDir, { recursive: true });
      
      const timestamp = new Date().toISOString().replace(/[:.]/g, '-');
      const backupName = `files-backup-${category || 'all'}-${timestamp}.zip`;
      const backupPath = path.join(backupDir, backupName);
      
      const archiver = require('archiver');
      const output = require('fs').createWriteStream(backupPath);
      const archive = archiver('zip', { zlib: { level: 9 } });
      
      return new Promise((resolve, reject) => {
        output.on('close', () => {
          this.logger.info(`Backup de archivos creado: ${backupPath} (${archive.pointer()} bytes)`);
          resolve(backupPath);
        });
        
        archive.on('error', reject);
        archive.pipe(output);
        
        const sourceDir = category ? 
          path.join(this.uploadPath, category) : 
          this.uploadPath;
          
        archive.directory(sourceDir, false);
        archive.finalize();
      });
    } catch (error) {
      this.logger.error('Error creando backup de archivos:', error);
      throw error;
    }
  }
}

module.exports = new FileService();