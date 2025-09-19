const fs = require('fs');
const path = require('path');

function normalizeExtensions() {
  const basePath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSS7';
  
  console.log('🔄 Normalizing file extensions...');
  
  // Convert .inc.php to .php
  findAndReplaceExtension(basePath, '.inc.php', '.php');
  
  // Convert .htm to .html
  findAndReplaceExtension(basePath, '.htm', '.html');
  
  // Convert .inc to .php for include files
  findAndReplaceExtension(basePath, '.inc', '.php');
  
  console.log('✅ Extension normalization completed!');
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
        console.log(`🔧 Extension: ${item} → ${newName}`);
      } catch (error) {
        console.error(`❌ Failed to rename ${item}:`, error.message);
      }
    }
  });
}

if (require.main === module) {
  normalizeExtensions();
}

module.exports = { normalizeExtensions };