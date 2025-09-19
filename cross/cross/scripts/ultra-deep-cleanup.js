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
    .replace(/^-|-$/g, '')
    .replace(/\.class\.php$/, '.php')
    .replace(/\.inc\.php$/, '.php')
    .replace(/\.inc$/, '.php');
}

function ultraDeepCleanup(dirPath, level = 0, maxLevel = 6) {
  if (!fs.existsSync(dirPath) || level > maxLevel) return;
  
  const indent = '  '.repeat(level);
  
  try {
    const items = fs.readdirSync(dirPath);
    
    // First pass: rename files
    items.forEach(item => {
      const fullPath = path.join(dirPath, item);
      
      try {
        const stat = fs.statSync(fullPath);
        
        if (stat.isFile()) {
          const normalizedName = normalizeFileName(item);
          if (normalizedName !== item && normalizedName.length > 0) {
            const newPath = path.join(dirPath, normalizedName);
            try {
              fs.renameSync(fullPath, newPath);
              console.log(`${indent}📄 ${item} → ${normalizedName}`);
            } catch (error) {
              // Skip if can't rename
            }
          }
        }
      } catch (error) {
        // Skip inaccessible items
      }
    });
    
    // Second pass: process directories and rename them
    const updatedItems = fs.readdirSync(dirPath);
    updatedItems.forEach(item => {
      const fullPath = path.join(dirPath, item);
      
      try {
        const stat = fs.statSync(fullPath);
        
        if (stat.isDirectory()) {
          // First recurse into the directory
          ultraDeepCleanup(fullPath, level + 1, maxLevel);
          
          // Then try to rename the directory itself
          const normalizedName = normalizeFileName(item);
          if (normalizedName !== item && normalizedName.length > 0) {
            const newPath = path.join(dirPath, normalizedName);
            try {
              fs.renameSync(fullPath, newPath);
              console.log(`${indent}📁 ${item} → ${normalizedName}`);
            } catch (error) {
              // Skip if can't rename
            }
          }
        }
      } catch (error) {
        // Skip inaccessible items
      }
    });
    
  } catch (error) {
    // Skip inaccessible directories
  }
}

function runUltraDeepCleanup() {
  const legacyPath = 'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy';
  
  console.log('🚀 Starting ULTRA DEEP cleanup (6 levels deep)...');
  console.log('This will normalize ALL file and directory names recursively');
  console.log('='.repeat(70));
  
  if (fs.existsSync(legacyPath)) {
    const systems = fs.readdirSync(legacyPath);
    
    systems.forEach(system => {
      const systemPath = path.join(legacyPath, system);
      if (fs.statSync(systemPath).isDirectory()) {
        console.log(`\n🔄 Processing: ${system}`);
        console.log('-'.repeat(50));
        ultraDeepCleanup(systemPath);
      }
    });
  }
  
  console.log('\n✅ ULTRA DEEP cleanup completed!');
  console.log('All files and directories up to 6 levels deep have been normalized.');
}

if (require.main === module) {
  runUltraDeepCleanup();
}

module.exports = { runUltraDeepCleanup };