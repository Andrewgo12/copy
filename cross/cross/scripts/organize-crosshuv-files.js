const fs = require('fs');
const path = require('path');

const renameMappings = {
  // Config files
  'inicio-sistema.php': 'system-init.php',
  'registro-temporal.php': 'temp-registry.php',
  
  // Documentation
  'documentacion.txt': 'documentation.txt',
  'rutas-sistema.txt': 'system-routes.txt',
  'version-sistema.txt': 'system-version.txt',
  
  // Scripts
  'configurar-sistema.sh': 'configure-system.sh',
  'tareas-programadas.txt': 'scheduled-tasks.txt',
  
  // Logs
  'registro-debug-alertas.txt': 'debug-alerts-log.txt',
  'registro-pruebas.log': 'tests-log.log',
  
  // Core files
  'Application.class.php': 'Application.php',
  'ASAP.class.php': 'ASAP.php',
  'function.app_name.php': 'app-name-function.php',
  'function.appname.php': 'appname-function.php',
  
  // Core controllers
  'Serializer.class.php': 'Serializer.php',
  'FrontController.class.php': 'FrontController.php',
  'TemplateView.class.php': 'TemplateView.php',
  'WebRegistry.class.php': 'WebRegistry.php',
  'WebRegistry.class.php5': 'WebRegistry-php5.php',
  'WebRequest.class.php': 'WebRequest.php',
  'WebSession.class.php': 'WebSession.php',
  'XslTransformView.class.php': 'XslTransformView.php',
  
  // Services
  'Cross300.class.php': 'Cross300.php',
  'Customers.class.php': 'Customers.php',
  'Data_type.class.php': 'DataType.php',
  'DateController.class.php': 'DateController.php',
  'Dimentions.class.php': 'Dimensions.php',
  'Docunet.class.php': 'Document.php',
  'Encuestas.class.php': 'Surveys.php',
  'ExecuteAction.class.php': 'ExecuteAction.php',
  'General.class.php': 'General.php',
  'Html.class.php': 'Html.php',
  'Human_resources.class.php': 'HumanResources.php',
  'JsrsServer.class.php': 'JsrsServer.php',
  'Pager.class.php': 'Pager.php',
  'PagerCheck.class.php': 'PagerCheck.php',
  'Products.class.php': 'Products.php',
  'Profiles.class.php': 'Profiles.php',
  'ProgressBar.class.php': 'ProgressBar.php',
  'Schedule.class.php': 'Schedule.php',
  'SchemaAdministrator.class.php': 'SchemaAdministrator.php',
  'Statistic.class.php': 'Statistics.php',
  'ValidationData.class.php': 'ValidationData.php',
  'Workflow.class.php': 'Workflow.php',
  
  // Test files
  'test-conexion-socket.php': 'test-socket-connection.php',
  'test-envio-email.php': 'test-email-sending.php',
  'test-socket-alternativo.php': 'test-alternative-socket.php',
  'clase-smtp-email.php': 'smtp-email-class.php'
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
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSSHUV';
  
  console.log('🔄 Starting CROSSHUV organization (PRIORITY SYSTEM)...');
  
  Object.entries(directoryMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, true);
  });
  
  Object.entries(renameMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, false);
  });
  
  console.log('✅ CROSSHUV organization completed!');
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
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSSHUV';
  
  console.log('🔄 Normalizing extensions in CROSSHUV...');
  
  findAndReplaceExtension(basePath, '.inc.php', '.php');
  findAndReplaceExtension(basePath, '.inc', '.php');
  findAndReplaceExtension(basePath, '.htm', '.html');
  
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