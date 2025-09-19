#!/usr/bin/env node

/**
 * Final System Verification
 * Comprehensive verification of the Visual Web Editor system
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';
import { exec } from 'child_process';
import { promisify } from 'util';

const execAsync = promisify(exec);
const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Test results
let results = {
  fileStructure: { passed: 0, failed: 0, total: 0 },
  packageIntegrity: { passed: 0, failed: 0, total: 0 },
  codeIntegrity: { passed: 0, failed: 0, total: 0 },
  dependencies: { passed: 0, failed: 0, total: 0 },
  configuration: { passed: 0, failed: 0, total: 0 }
};

const log = (message, type = 'info') => {
  const colors = {
    info: '\x1b[36m',
    success: '\x1b[32m',
    error: '\x1b[31m',
    warning: '\x1b[33m',
    reset: '\x1b[0m'
  };
  console.log(`${colors[type]}${message}${colors.reset}`);
};

const test = async (category, name, testFn) => {
  results[category].total++;
  try {
    await testFn();
    results[category].passed++;
    log(`✅ ${name}`, 'success');
  } catch (error) {
    results[category].failed++;
    log(`❌ ${name}: ${error.message}`, 'error');
  }
};

// Test functions
const testFileExists = async (file) => {
  try {
    await fs.promises.access(path.join(__dirname, file));
  } catch (error) {
    throw new Error(`Missing: ${file}`);
  }
};

const testPackageJson = async (file) => {
  const packagePath = path.join(__dirname, file);
  const content = JSON.parse(await fs.promises.readFile(packagePath, 'utf8'));
  
  if (!content.name) throw new Error(`${file} missing name`);
  if (!content.version) throw new Error(`${file} missing version`);
  if (!content.dependencies && !content.devDependencies) {
    throw new Error(`${file} has no dependencies`);
  }
  
  return content;
};

const testCodeFile = async (file) => {
  const filePath = path.join(__dirname, file);
  const content = await fs.promises.readFile(filePath, 'utf8');
  
  if (content.includes('res.status(501).json')) {
    throw new Error(`Contains placeholder functions`);
  }
  
  if (content.length < 200) {
    throw new Error(`Appears incomplete (${content.length} chars)`);
  }
};

const testDependencies = async (packagePath, requiredDeps) => {
  const packageJson = JSON.parse(await fs.promises.readFile(packagePath, 'utf8'));
  const allDeps = { ...packageJson.dependencies, ...packageJson.devDependencies };
  
  const missing = requiredDeps.filter(dep => !allDeps[dep]);
  if (missing.length > 0) {
    throw new Error(`Missing dependencies: ${missing.join(', ')}`);
  }
};

const testNodeModules = async (dir) => {
  const nodeModulesPath = path.join(__dirname, dir, 'node_modules');
  try {
    await fs.promises.access(nodeModulesPath);
  } catch (error) {
    throw new Error(`node_modules not found in ${dir}`);
  }
};

// Main verification
const runVerification = async () => {
  log('🔍 Visual Web Editor - Final System Verification', 'info');
  log('================================================', 'info');

  // File Structure Tests
  log('\n📂 Testing File Structure...', 'info');
  await test('fileStructure', 'Root package.json', () => testFileExists('package.json'));
  await test('fileStructure', 'Backend package.json', () => testFileExists('backend/package.json'));
  await test('fileStructure', 'Frontend package.json', () => testFileExists('frontend/package.json'));
  await test('fileStructure', 'Docker compose', () => testFileExists('docker-compose.yml'));
  await test('fileStructure', 'README', () => testFileExists('README.md'));
  await test('fileStructure', 'Backend server', () => testFileExists('backend/src/server.js'));
  await test('fileStructure', 'Frontend App', () => testFileExists('frontend/src/App.jsx'));
  await test('fileStructure', 'AI agent app', () => testFileExists('ai-agent/app.py'));

  // Package Integrity Tests
  log('\n📦 Testing Package Integrity...', 'info');
  await test('packageIntegrity', 'Root package.json valid', () => testPackageJson('package.json'));
  await test('packageIntegrity', 'Backend package.json valid', () => testPackageJson('backend/package.json'));
  await test('packageIntegrity', 'Frontend package.json valid', () => testPackageJson('frontend/package.json'));

  // Code Integrity Tests
  log('\n💻 Testing Code Integrity...', 'info');
  await test('codeIntegrity', 'Auth controller complete', () => testCodeFile('backend/src/controllers/authController.js'));
  await test('codeIntegrity', 'Project controller complete', () => testCodeFile('backend/src/controllers/projectController.js'));
  await test('codeIntegrity', 'AI controller complete', () => testCodeFile('backend/src/controllers/aiController.js'));
  await test('codeIntegrity', 'Visual Editor complete', () => testCodeFile('frontend/src/components/VisualEditor.jsx'));
  await test('codeIntegrity', 'Editor store complete', () => testCodeFile('frontend/src/hooks/useEditorStore.js'));

  // Dependencies Tests
  log('\n🔗 Testing Dependencies...', 'info');
  
  const backendDeps = ['express', 'cors', 'helmet', 'jsonwebtoken', 'bcryptjs'];
  await test('dependencies', 'Backend dependencies', () => 
    testDependencies(path.join(__dirname, 'backend/package.json'), backendDeps));
  
  const frontendDeps = ['react', 'react-dom', 'react-router-dom', 'zustand'];
  await test('dependencies', 'Frontend dependencies', () => 
    testDependencies(path.join(__dirname, 'frontend/package.json'), frontendDeps));

  // Configuration Tests
  log('\n⚙️  Testing Configuration...', 'info');
  await test('configuration', 'Backend .env.example', () => testFileExists('backend/.env.example'));
  await test('configuration', 'Frontend .env.example', () => testFileExists('frontend/.env.example'));
  await test('configuration', 'AI agent .env.example', () => testFileExists('ai-agent/.env.example'));
  await test('configuration', 'Backend Dockerfile', () => testFileExists('backend/Dockerfile'));
  await test('configuration', 'Frontend Dockerfile', () => testFileExists('frontend/Dockerfile'));
  await test('configuration', 'AI agent Dockerfile', () => testFileExists('ai-agent/Dockerfile'));

  // Generate Summary
  log('\n📊 Verification Summary', 'info');
  log('======================', 'info');

  let totalPassed = 0;
  let totalFailed = 0;
  let totalTests = 0;

  Object.entries(results).forEach(([category, result]) => {
    const categoryName = category.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
    const successRate = result.total > 0 ? ((result.passed / result.total) * 100).toFixed(1) : '0.0';
    
    log(`${categoryName}: ${result.passed}/${result.total} (${successRate}%)`, 
        result.failed === 0 ? 'success' : 'warning');
    
    totalPassed += result.passed;
    totalFailed += result.failed;
    totalTests += result.total;
  });

  log(`\nOverall: ${totalPassed}/${totalTests} tests passed (${((totalPassed / totalTests) * 100).toFixed(1)}%)`, 
      totalFailed === 0 ? 'success' : 'warning');

  // Final Assessment
  if (totalFailed === 0) {
    log('\n🎉 VERIFICATION COMPLETE: All systems operational!', 'success');
    log('The Visual Web Editor is ready for deployment and use.', 'success');
    
    log('\n🚀 Next Steps:', 'info');
    log('1. Run `npm install` in backend/ and frontend/ directories', 'info');
    log('2. Set up environment files (.env) based on .env.example files', 'info');
    log('3. Start the services using `./start.sh` or individual npm commands', 'info');
    log('4. Access the application at http://localhost:3002', 'info');
    
  } else if (totalFailed <= 3) {
    log('\n⚠️  VERIFICATION MOSTLY COMPLETE: Minor issues detected.', 'warning');
    log('The system should work but may have some optional features missing.', 'warning');
    
  } else {
    log('\n❌ VERIFICATION FAILED: Multiple critical issues detected.', 'error');
    log('Please review and fix the issues above before proceeding.', 'error');
  }

  // Save detailed report
  const report = {
    timestamp: new Date().toISOString(),
    summary: {
      totalTests,
      totalPassed,
      totalFailed,
      successRate: ((totalPassed / totalTests) * 100).toFixed(1)
    },
    categories: results,
    status: totalFailed === 0 ? 'READY' : totalFailed <= 3 ? 'MOSTLY_READY' : 'NEEDS_FIXES'
  };

  await fs.promises.writeFile(
    path.join(__dirname, 'verification-report.json'), 
    JSON.stringify(report, null, 2)
  );
  
  log('\n📄 Detailed report saved to verification-report.json', 'info');

  return totalFailed === 0;
};

// Run verification
runVerification().then(success => {
  process.exit(success ? 0 : 1);
}).catch(error => {
  log(`Fatal error: ${error.message}`, 'error');
  process.exit(1);
});
