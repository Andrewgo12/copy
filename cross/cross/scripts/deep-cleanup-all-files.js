const fs = require('fs');
const path = require('path');

function normalizeFileName(name) {
  return name
    .toLowerCase()
    .replace(/[áàäâ]/g, 'a')
    .replace(/[éèëê]/g, 'e')
    .replace(/[íìïî]/g, 'i')
    .replace(/[óòöô]/g, 'o')
    .replace(/[úùüû]/g, 'u')
    .replace(/[ñ]/g, 'n')
    .replace(/[ç]/g, 'c')
    .replace(/[^a-z0-9.-]/g, '-')
    .replace(/-+/g, '-')
    .replace(/^-|-$/g, '');
}

function cleanupDirectory(dirPath, level = 0) {
  if (!fs.existsSync(dirPath)) return;
  
  const items = fs.readdirSync(dirPath);
  
  items.forEach(item => {
    const fullPath = path.join(dirPath, item);
    const stat = fs.statSync(fullPath);
    
    if (stat.isDirectory()) {
      // Primero limpiar contenido recursivamente
      cleanupDirectory(fullPath, level + 1);
      
      // Luego renombrar el directorio si es necesario
      const normalizedName = normalizeFileName(item);
      if (normalizedName !== item && normalizedName.length > 0) {
        const newPath = path.join(dirPath, normalizedName);
        try {
          fs.renameSync(fullPath, newPath);
          console.log(`${'  '.repeat(level)}📁 ${item} → ${normalizedName}`);
        } catch (error) {
          console.error(`❌ Failed to rename directory ${item}:`, error.message);
        }
      }
    } else {
      // Renombrar archivo si es necesario
      const normalizedName = normalizeFileName(item);
      if (normalizedName !== item && normalizedName.length > 0) {
        const newPath = path.join(dirPath, normalizedName);
        try {
          fs.renameSync(fullPath, newPath);
          console.log(`${'  '.repeat(level)}📄 ${item} → ${normalizedName}`);
        } catch (error) {
          console.error(`❌ Failed to rename file ${item}:`, error.message);
        }
      }
    }
  });
}

function deepCleanupAll() {
  const basePaths = [
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSSHUV',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7Fuentes',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7WORK',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7WORK-Copia',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\portals',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\sources',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\views',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\storage',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\tests'
  ];
  
  console.log('🧹 Starting DEEP cleanup of ALL files and directories...');
  
  basePaths.forEach(basePath => {
    if (fs.existsSync(basePath)) {
      console.log(`\n🔄 Cleaning: ${path.basename(basePath)}`);
      cleanupDirectory(basePath);
    }
  });
  
  console.log('\n✅ DEEP cleanup completed!');
}

if (require.main === module) {
  deepCleanupAll();
}

module.exports = { deepCleanupAll, normalizeFileName };