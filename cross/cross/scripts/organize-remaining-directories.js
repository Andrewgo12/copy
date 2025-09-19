const fs = require('fs');
const path = require('path');

const renameMappings = {
  // Portal files
  'script-prueba-bd.php': 'database-test-script.php',
  'Portal_id_V1.sql': 'portal-id-v1.sql',
  
  // Form files - normalize Spanish names
  'form_aplicaciones': 'form-applications',
  'form_clientes': 'form-clients',
  'form_clientes_bck': 'form-clients-backup',
  'form_clientes_externo': 'form-external-clients',
  'form_estadosclientes': 'form-client-states',
  'form_metodosauths': 'form-auth-methods',
  'form_paises': 'form-countries',
  'form_publicaciones': 'form-publications',
  'form_tiposclientes': 'form-client-types',
  'form_tiposidentifis': 'form-id-types',
  
  // Grid files
  'grid_aplicaciones': 'grid-applications',
  'grid_clientes': 'grid-clients',
  'grid_clientes_back': 'grid-clients-backup',
  'grid_estadosclientes': 'grid-client-states',
  'grid_metodosauths': 'grid-auth-methods',
  'grid_onegatelogs': 'grid-onegate-logs',
  'grid_paises': 'grid-countries',
  'grid_publicaciones': 'grid-publications',
  'grid_tiposclientes': 'grid-client-types',
  'grid_tiposidentifis': 'grid-id-types',
  
  // Menu
  'menu_portal-id': 'menu-portal-id',
  
  // Blank
  'blank_pagos': 'blank-payments'
};

const directoryMappings = {
  'portal-id': 'portal-id',
  'portalid': 'portal-id-legacy'
};

function organizePortals() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\portals';
  
  console.log('🔄 Organizing portals...');
  
  Object.entries(directoryMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, true);
  });
  
  Object.entries(renameMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, false);
  });
  
  console.log('✅ Portals organized!');
}

function organizeSources() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\sources';
  
  console.log('🔄 Organizing sources...');
  
  if (fs.existsSync(basePath)) {
    const items = fs.readdirSync(basePath);
    items.forEach(item => {
      const fullPath = path.join(basePath, item);
      if (fs.statSync(fullPath).isDirectory()) {
        if (item.includes('-')) return;
        const newName = item.toLowerCase().replace(/[^a-z0-9]/g, '-');
        if (newName !== item) {
          try {
            fs.renameSync(fullPath, path.join(basePath, newName));
            console.log(`📁 ${item} → ${newName}`);
          } catch (error) {
            console.error(`❌ Failed to rename ${item}:`, error.message);
          }
        }
      }
    });
  }
  
  console.log('✅ Sources organized!');
}

function organizeViews() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\views';
  
  console.log('🔄 Organizing views...');
  
  if (fs.existsSync(basePath)) {
    const items = fs.readdirSync(basePath);
    items.forEach(item => {
      if (item.endsWith('.blade.php')) return;
      if (item.endsWith('.php') || item.endsWith('.html')) {
        const newName = item.replace(/[^a-z0-9.-]/gi, '-').toLowerCase();
        if (newName !== item) {
          try {
            const fullPath = path.join(basePath, item);
            const newPath = path.join(basePath, newName);
            fs.renameSync(fullPath, newPath);
            console.log(`📄 ${item} → ${newName}`);
          } catch (error) {
            console.error(`❌ Failed to rename ${item}:`, error.message);
          }
        }
      }
    });
  }
  
  console.log('✅ Views organized!');
}

function organizeRoutes() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\routes';
  
  console.log('🔄 Organizing routes...');
  
  if (fs.existsSync(basePath)) {
    const items = fs.readdirSync(basePath);
    items.forEach(item => {
      if (item === 'web.js' || item === 'api.js') return;
      if (item.endsWith('.js')) {
        const newName = item.replace(/[^a-z0-9.-]/gi, '-').toLowerCase();
        if (newName !== item) {
          try {
            const fullPath = path.join(basePath, item);
            const newPath = path.join(basePath, newName);
            fs.renameSync(fullPath, newPath);
            console.log(`📄 ${item} → ${newName}`);
          } catch (error) {
            console.error(`❌ Failed to rename ${item}:`, error.message);
          }
        }
      }
    });
  }
  
  console.log('✅ Routes organized!');
}

function organizeStorage() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\storage';
  
  console.log('🔄 Organizing storage...');
  
  const storageMappings = {
    'backup': 'backups',
    'export': 'exports',
    'Exportar': 'exports-legacy',
    'repositorios': 'repositories'
  };
  
  Object.entries(storageMappings).forEach(([oldName, newName]) => {
    renameInDirectory(basePath, oldName, newName, true);
  });
  
  console.log('✅ Storage organized!');
}

function organizeTests() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\tests';
  
  console.log('🔄 Organizing tests...');
  
  if (fs.existsSync(basePath)) {
    const items = fs.readdirSync(basePath);
    items.forEach(item => {
      if (item.endsWith('.test.js') || item.endsWith('.spec.js')) return;
      if (item.endsWith('.js') || item.endsWith('.php')) {
        const newName = item.replace(/[^a-z0-9.-]/gi, '-').toLowerCase();
        if (newName !== item) {
          try {
            const fullPath = path.join(basePath, item);
            const newPath = path.join(basePath, newName);
            fs.renameSync(fullPath, newPath);
            console.log(`📄 ${item} → ${newName}`);
          } catch (error) {
            console.error(`❌ Failed to rename ${item}:`, error.message);
          }
        }
      }
    });
  }
  
  console.log('✅ Tests organized!');
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

if (require.main === module) {
  organizePortals();
  organizeSources();
  organizeViews();
  organizeRoutes();
  organizeStorage();
  organizeTests();
}

module.exports = { organizePortals, organizeSources, organizeViews, organizeRoutes, organizeStorage, organizeTests };