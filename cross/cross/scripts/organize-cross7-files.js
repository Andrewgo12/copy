const fs = require('fs');
const path = require('path');

// File renaming mappings for CROSS7 legacy files
const renameMappings = {
  // Config files
  'inicio-sistema.php': 'system-init.php',
  'registro-temporal.php': 'temp-registry.php',
  
  // Documentation
  'documentacion.txt': 'documentation.txt',
  'version-sistema.txt': 'system-version.txt',
  
  // Scripts
  'configurar-sistema.sh': 'configure-system.sh',
  
  // Core controllers - data
  'serializador-datos.php': 'data-serializer.php',
  
  // Core controllers - web interface
  'comando-web.php': 'web-command.php',
  'controlador-frontal.php': 'front-controller.php',
  'peticion-web.php': 'web-request.php',
  'registro-web-php5.php': 'web-registry-php5.php',
  'registro-web.php': 'web-registry.php',
  'sesion-web.php': 'web-session.php',
  'vista-plantilla.php': 'template-view.php',
  'vista-xsl.php': 'xsl-view.php',
  
  // Core controllers - services
  'admin-esquemas.php': 'schema-admin.php',
  'barra-progreso.php': 'progress-bar.php',
  'controlador-fechas.php': 'date-controller.php',
  'dimensiones.php': 'dimensions.php',
  'ejecutor-acciones.php': 'action-executor.php',
  'estadisticas.php': 'statistics.php',
  'generador-html.php': 'html-generator.php',
  'paginador.php': 'paginator.php',
  'servicio-agenda.php': 'agenda-service.php',
  'servicio-clientes.php': 'clients-service.php',
  'servicio-cross300.php': 'cross300-service.php',
  'servicio-documentos.php': 'documents-service.php',
  'servicio-flujo.php': 'workflow-service.php',
  'servicio-formularios.php': 'forms-service.php',
  'servicio-general.php': 'general-service.php',
  'servicio-perfiles.php': 'profiles-service.php',
  'servicio-productos.php': 'products-service.php',
  'servicio-rrhh.php': 'hr-service.php',
  'servidor-jsrs.php': 'jsrs-server.php',
  'tipo-datos.php': 'data-types.php',
  'validador-datos.php': 'data-validator.php',
  'verificador-paginas.php': 'page-verifier.php',
  
  // Core controllers - web services
  'servicio-web-cross.php': 'cross-web-service.php',
  'servicio-web-perfiles.php': 'profiles-web-service.php',
  
  // Core controllers - main
  'aplicacion-principal.php': 'main-application.php',
  'sistema-asap.php': 'asap-system.php',
  
  // Core extensions
  'funcion-nombre-aplicacion.php': 'app-name-function.php',
  'funcion-nombre-app.php': 'app-name-func.php'
};

// Directory renaming mappings
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
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7';
  
  console.log('🔄 Starting CROSS7 file organization...');
  
  // First rename directories
  Object.entries(directoryMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, true);
  });
  
  // Then rename files
  Object.entries(renameMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, false);
  });
  
  console.log('✅ CROSS7 file organization completed!');
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
          console.log(`📁 Renamed directory: ${oldName} → ${newName}`);
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
          console.log(`📄 Renamed file: ${oldName} → ${newName}`);
        } catch (error) {
          console.error(`❌ Failed to rename file ${oldName}:`, error.message);
        }
      }
    }
  });
}

if (require.main === module) {
  organizeFiles();
}

module.exports = { organizeFiles };