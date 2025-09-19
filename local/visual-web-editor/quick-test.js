#!/usr/bin/env node

/**
 * Quick System Test
 * Simple verification of the Visual Web Editor system
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Test results
let passed = 0;
let failed = 0;
let total = 0;

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

const test = async (name, testFn) => {
  total++;
  try {
    await testFn();
    passed++;
    log(`✅ ${name}`, 'success');
  } catch (error) {
    failed++;
    log(`❌ ${name}: ${error.message}`, 'error');
  }
};

// Test functions
const testFileExists = async (file) => {
  try {
    await fs.promises.access(path.join(__dirname, file));
  } catch (error) {
    throw new Error(`File missing: ${file}`);
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
};

const testCodeFile = async (file) => {
  const filePath = path.join(__dirname, file);
  const content = await fs.promises.readFile(filePath, 'utf8');
  
  if (content.includes('res.status(501).json')) {
    throw new Error(`${file} contains placeholder functions`);
  }
  
  if (content.length < 200) {
    throw new Error(`${file} appears incomplete`);
  }
};

// Main test runner
const runTests = async () => {
  log('🚀 Visual Web Editor - Quick System Test', 'info');
  log('========================================', 'info');

  // Test core files
  await test('Root package.json exists', () => testFileExists('package.json'));
  await test('Backend package.json exists', () => testFileExists('backend/package.json'));
  await test('Frontend package.json exists', () => testFileExists('frontend/package.json'));
  await test('Docker compose exists', () => testFileExists('docker-compose.yml'));
  await test('README exists', () => testFileExists('README.md'));

  // Test package.json integrity
  await test('Root package.json valid', () => testPackageJson('package.json'));
  await test('Backend package.json valid', () => testPackageJson('backend/package.json'));
  await test('Frontend package.json valid', () => testPackageJson('frontend/package.json'));

  // Test backend files
  await test('Backend server exists', () => testFileExists('backend/src/server.js'));
  await test('Auth controller exists', () => testFileExists('backend/src/controllers/authController.js'));
  await test('Project controller exists', () => testFileExists('backend/src/controllers/projectController.js'));
  await test('AI controller exists', () => testFileExists('backend/src/controllers/aiController.js'));

  // Test frontend files
  await test('Frontend App exists', () => testFileExists('frontend/src/App.jsx'));
  await test('Visual Editor exists', () => testFileExists('frontend/src/components/VisualEditor.jsx'));
  await test('Editor store exists', () => testFileExists('frontend/src/hooks/useEditorStore.js'));

  // Test AI agent files
  await test('AI agent app exists', () => testFileExists('ai-agent/app.py'));
  await test('AI requirements exists', () => testFileExists('ai-agent/requirements.txt'));

  // Test environment files
  await test('Backend .env.example exists', () => testFileExists('backend/.env.example'));
  await test('Frontend .env.example exists', () => testFileExists('frontend/.env.example'));
  await test('AI agent .env.example exists', () => testFileExists('ai-agent/.env.example'));

  // Test Docker files
  await test('Backend Dockerfile exists', () => testFileExists('backend/Dockerfile'));
  await test('Frontend Dockerfile exists', () => testFileExists('frontend/Dockerfile'));
  await test('AI agent Dockerfile exists', () => testFileExists('ai-agent/Dockerfile'));

  // Test code integrity (sample files)
  await test('Auth controller complete', () => testCodeFile('backend/src/controllers/authController.js'));
  await test('Project controller complete', () => testCodeFile('backend/src/controllers/projectController.js'));
  await test('AI controller complete', () => testCodeFile('backend/src/controllers/aiController.js'));

  // Results
  log('\n📊 Test Results', 'info');
  log('===============', 'info');
  log(`Total Tests: ${total}`, 'info');
  log(`Passed: ${passed}`, passed === total ? 'success' : 'info');
  log(`Failed: ${failed}`, failed > 0 ? 'error' : 'info');
  log(`Success Rate: ${((passed / total) * 100).toFixed(1)}%`, 
      failed === 0 ? 'success' : 'warning');

  if (failed === 0) {
    log('\n🎉 All tests passed! System is ready.', 'success');
    return true;
  } else {
    log('\n⚠️  Some tests failed. Please review the issues above.', 'warning');
    return false;
  }
};

// Run tests
runTests().then(success => {
  process.exit(success ? 0 : 1);
}).catch(error => {
  log(`Fatal error: ${error.message}`, 'error');
  process.exit(1);
});
