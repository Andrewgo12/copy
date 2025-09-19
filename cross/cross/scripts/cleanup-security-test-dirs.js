const fs = require('fs');
const path = require('path');

function cleanupSecurityTestDirs() {
  const problematicPaths = [
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSSHUV\\src\\apps\\formularios\\templates_c',
    'C:\\Users\\Soporte\\Desktop\\cross\\cross\\resources\\legacy\\CROSSHUV\\src\\apps\\main-system\\templates_c'
  ];
  
  console.log('🧹 Cleaning up security test directories...');
  
  problematicPaths.forEach(basePath => {
    if (fs.existsSync(basePath)) {
      console.log(`\n🔍 Checking: ${basePath}`);
      
      const items = fs.readdirSync(basePath);
      items.forEach(item => {
        const fullPath = path.join(basePath, item);
        
        // Check if it's a suspicious directory name
        if (fs.statSync(fullPath).isDirectory()) {
          const isSuspicious = 
            item.includes('XSS') ||
            item.includes('SQL') ||
            item.includes('UNION') ||
            item.includes('SELECT') ||
            item.includes('bestbuy') ||
            item.includes('www.') ||
            item.includes('http') ||
            item.includes('alert') ||
            item.includes('script') ||
            item.includes('onerror') ||
            item.includes('passwd') ||
            item.includes('etc') ||
            item.includes('..%2F') ||
            item.includes('999999') ||
            item.includes('nvOpzp') ||
            item.includes('GROUP BY') ||
            item.includes('CONCAT') ||
            item.includes('VERSION()') ||
            item.includes('0x7e') ||
            item.includes('RAND(') ||
            item.includes('HAVING') ||
            item.includes('MIN(0)') ||
            item.includes("'") ||
            item.includes('"') ||
            item.includes('&') ||
            item.includes('=') ||
            item.includes(';') ||
            item.includes('(') ||
            item.includes(')') ||
            item.includes('%') ||
            item.includes('<') ||
            item.includes('>') ||
            item.length > 50;
          
          if (isSuspicious) {
            try {
              // Remove the suspicious directory
              fs.rmSync(fullPath, { recursive: true, force: true });
              console.log(`🗑️  Removed suspicious directory: ${item}`);
            } catch (error) {
              console.error(`❌ Failed to remove ${item}:`, error.message);
            }
          }
        }
      });
    }
  });
  
  console.log('\n✅ Security test directories cleanup completed!');
}

if (require.main === module) {
  cleanupSecurityTestDirs();
}

module.exports = { cleanupSecurityTestDirs };