const fs = require('fs');
const path = require('path');

const renameMappings = {
  'inicio-sistema.php': 'system-init.php',
  'registro-temporal.php': 'temp-registry.php',
  'documentacion.txt': 'documentation.txt',
  'version-sistema.txt': 'system-version.txt',
  'configurar-sistema.sh': 'configure-system.sh',
  'base-datos-desarrollo.sql': 'development-database.sql',
  'Application.class.php': 'Application.php',
  'ASAP.class.php': 'ASAP.php',
  'function.app_name.php': 'app-name-function.php',
  'function.appname.php': 'appname-function.php'
};

const directoryMappings = {
  'flujo-trabajo': 'workflow',
  'recursos-humanos': 'human-resources',
  'sistema-principal': 'main-system',
  'utilidades': 'utilities',
  'configuracion': 'configuration',
  'controladores': 'controllers',
  'interfaz-web': 'web-interface',
  'servicios': 'services',
  'servicios-web': 'web-services',
  'extensiones': 'extensions',
  'base-datos': 'database',
  'conectores-bd': 'db-connectors',
  'convertir-pdf': 'pdf-converter',
  'convertir-word': 'word-converter',
  'descargas': 'downloads',
  'envio-email': 'email-sender',
  'exportar-excel': 'excel-exporter',
  'framework-js': 'js-framework',
  'generar-pdf': 'pdf-generator',
  'graficos': 'graphics',
  'navegacion': 'navigation',
  'plantillas': 'templates',
  'utilidades-php': 'php-utilities'
};

function organizeFiles() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7WORK-Copia';
  
  console.log('🔄 Starting CROSS7WORK-Copia organization...');
  
  Object.entries(directoryMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, true);
  });
  
  Object.entries(renameMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, false);
  });
  
  console.log('✅ CROSS7WORK-Copia organization completed!');
}

function renameInDirectory(basePath, oldName, newName, isDirectory) {
  try {
    findAndRename(basePath, oldName, newName, isDirectory);
  } catch (error) {
    console.error(`❌ Error renaming ${oldName}:`, error.message);
  }
}

function findAndRename(dir, oldName, newName, isDirectory) {
  if (!fs.existsSync(dir)) return;
  
  const items = fs.readdirSync(dir);
  
  items.forEach(item => {
    const fullPath = path.join(dir, item);
    const stat = fs.statSync(fullPath);
    
    if (stat.isDirectory()) {
      if (isDirectory && item === oldName) {
        const newPath = path.join(dir, newName);
        try {
          fs.renameSync(fullPath, newPath);
          console.log(`📁 ${oldName} → ${newName}`);
        } catch (error) {
          console.error(`❌ Failed to rename directory ${oldName}:`, error.message);
        }
      } else {
        findAndRename(fullPath, oldName, newName, isDirectory);
      }
    } else {
      if (!isDirectory && item === oldName) {
        const newPath = path.join(dir, newName);
        try {
          fs.renameSync(fullPath, newPath);
          console.log(`📄 ${oldName} → ${newName}`);
        } catch (error) {
          console.error(`❌ Failed to rename file ${oldName}:`, error.message);
        }
      }
    }
  });
}

function normalizeExtensions() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7WORK-Copia';
  
  console.log('🔄 Normalizing extensions...');
  
  findAndReplaceExtension(basePath, '.inc.php', '.php');
  findAndReplaceExtension(basePath, '.inc', '.php');
  
  console.log('✅ Extensions normalized!');
}

function findAndReplaceExtension(dir, oldExt, newExt) {
  if (!fs.existsSync(dir)) return;
  
  const items = fs.readdirSync(dir);
  
  items.forEach(item => {
    const fullPath = path.join(dir, item);
    const stat = fs.statSync(fullPath);
    
    if (stat.isDirectory()) {
      findAndReplaceExtension(fullPath, oldExt, newExt);
    } else if (item.endsWith(oldExt)) {
      const newName = item.replace(oldExt, newExt);
      const newPath = path.join(dir, newName);
      try {
        fs.renameSync(fullPath, newPath);
        console.log(`🔧 ${item} → ${newName}`);
      } catch (error) {
        console.error(`❌ Failed to rename ${item}:`, error.message);
      }
    }
  });
}

if (require.main === module) {
  organizeFiles();
  normalizeExtensions();
}

module.exports = { organizeFiles, normalizeExtensions };