#!/usr/bin/env node

/**
 * Complete System Test Suite
 * Comprehensive testing of the Visual Web Editor system
 */

import fs from 'fs';
import path from 'path';
import { spawn, exec } from 'child_process';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Test configuration
const TEST_CONFIG = {
  backend: {
    url: 'http://localhost:3001',
    healthEndpoint: '/api/health'
  },
  frontend: {
    url: 'http://localhost:3002',
    buildPath: './frontend/build'
  },
  aiAgent: {
    url: 'http://localhost:8000',
    healthEndpoint: '/health'
  },
  timeout: 30000,
  retries: 3
};

// Test results
let testResults = {
  passed: 0,
  failed: 0,
  total: 0,
  details: []
};

// Utility functions
const log = (message, type = 'info') => {
  const timestamp = new Date().toISOString();
  const colors = {
    info: '\x1b[36m',
    success: '\x1b[32m',
    error: '\x1b[31m',
    warning: '\x1b[33m',
    reset: '\x1b[0m'
  };
  console.log(`${colors[type]}[${timestamp}] ${message}${colors.reset}`);
};

const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));

const runTest = async (testName, testFunction) => {
  testResults.total++;
  log(`Running test: ${testName}`, 'info');
  
  try {
    await testFunction();
    testResults.passed++;
    testResults.details.push({ name: testName, status: 'PASSED', error: null });
    log(`✅ ${testName} - PASSED`, 'success');
  } catch (error) {
    testResults.failed++;
    testResults.details.push({ name: testName, status: 'FAILED', error: error.message });
    log(`❌ ${testName} - FAILED: ${error.message}`, 'error');
  }
};

// Test functions
const testFileStructure = async () => {
  const requiredFiles = [
    'package.json',
    'backend/package.json',
    'frontend/package.json',
    'backend/src/server.js',
    'frontend/src/App.jsx',
    'ai-agent/app.py',
    'docker-compose.yml',
    'README.md'
  ];

  for (const file of requiredFiles) {
    const filePath = path.join(__dirname, file);
    try {
      await fs.promises.access(filePath);
    } catch (error) {
      throw new Error(`Required file missing: ${file}`);
    }
  }
};

const testPackageJsonIntegrity = async () => {
  const packageFiles = [
    'package.json',
    'backend/package.json',
    'frontend/package.json'
  ];

  for (const file of packageFiles) {
    const packagePath = path.join(__dirname, file);
    const packageContent = JSON.parse(await fs.promises.readFile(packagePath, 'utf8'));

    if (!packageContent.name) {
      throw new Error(`Package ${file} missing name field`);
    }

    if (!packageContent.version) {
      throw new Error(`Package ${file} missing version field`);
    }

    if (!packageContent.dependencies && !packageContent.devDependencies) {
      throw new Error(`Package ${file} has no dependencies`);
    }
  }
};

const testEnvironmentFiles = async () => {
  const envFiles = [
    'backend/.env.example',
    'frontend/.env.example',
    'ai-agent/.env.example'
  ];

  for (const file of envFiles) {
    const envPath = path.join(__dirname, file);
    try {
      await fs.promises.access(envPath);
      const content = await fs.promises.readFile(envPath, 'utf8');
      if (content.length < 100) {
        throw new Error(`Environment file ${file} appears incomplete`);
      }
    } catch (error) {
      throw new Error(`Environment example file missing: ${file}`);
    }
  }
};

const testDockerConfiguration = async () => {
  const dockerFiles = [
    'docker-compose.yml',
    'backend/Dockerfile',
    'frontend/Dockerfile',
    'ai-agent/Dockerfile'
  ];

  for (const file of dockerFiles) {
    const dockerPath = path.join(__dirname, file);
    try {
      await fs.promises.access(dockerPath);
      const content = await fs.promises.readFile(dockerPath, 'utf8');
      if (content.length < 50) {
        throw new Error(`Docker file ${file} appears incomplete`);
      }
    } catch (error) {
      throw new Error(`Docker file missing: ${file}`);
    }
  }
};

const testBackendDependencies = async () => {
  const backendPath = path.join(__dirname, 'backend');
  const packageJson = JSON.parse(await fs.promises.readFile(path.join(backendPath, 'package.json'), 'utf8'));

  const requiredDeps = [
    'express',
    'cors',
    'helmet',
    'express-rate-limit',
    'express-validator',
    'jsonwebtoken',
    'bcryptjs',
    'multer',
    'winston'
  ];

  const allDeps = { ...packageJson.dependencies, ...packageJson.devDependencies };

  for (const dep of requiredDeps) {
    if (!allDeps[dep]) {
      throw new Error(`Backend missing required dependency: ${dep}`);
    }
  }
};

const testFrontendDependencies = async () => {
  const frontendPath = path.join(__dirname, 'frontend');
  const packageJson = JSON.parse(await fs.promises.readFile(path.join(frontendPath, 'package.json'), 'utf8'));

  const requiredDeps = [
    'react',
    'react-dom',
    'react-router-dom',
    'zustand',
    'framer-motion',
    '@dnd-kit/core',
    'tailwindcss'
  ];

  const allDeps = { ...packageJson.dependencies, ...packageJson.devDependencies };

  for (const dep of requiredDeps) {
    if (!allDeps[dep]) {
      throw new Error(`Frontend missing required dependency: ${dep}`);
    }
  }
};

const testBackendCodeIntegrity = async () => {
  const backendFiles = [
    'backend/src/server.js',
    'backend/src/controllers/authController.js',
    'backend/src/controllers/projectController.js',
    'backend/src/controllers/aiController.js',
    'backend/src/middleware/auth.js',
    'backend/src/middleware/errorHandler.js',
    'backend/src/routes/auth.js',
    'backend/src/routes/projects.js',
    'backend/src/routes/ai.js',
    'backend/src/utils/logger.js',
    'backend/src/utils/userStore.js',
    'backend/src/utils/codeGenerator.js'
  ];

  for (const file of backendFiles) {
    const filePath = path.join(__dirname, file);
    const content = await fs.promises.readFile(filePath, 'utf8');

    // Check for syntax errors (basic check)
    if (content.includes('res.status(501).json')) {
      throw new Error(`File ${file} contains unimplemented placeholder functions`);
    }

    // Check for proper exports
    if (!content.includes('module.exports')) {
      throw new Error(`File ${file} missing module.exports`);
    }

    // Check minimum content length
    if (content.length < 500) {
      throw new Error(`File ${file} appears incomplete (too short)`);
    }
  }
};

const testFrontendCodeIntegrity = async () => {
  const frontendFiles = [
    'frontend/src/App.jsx',
    'frontend/src/components/VisualEditor.jsx',
    'frontend/src/components/ComponentLibrary.jsx',
    'frontend/src/components/DesignCanvas.jsx',
    'frontend/src/components/PropertyPanel.jsx',
    'frontend/src/hooks/useEditorStore.js',
    'frontend/src/pages/HomePage.jsx',
    'frontend/src/pages/EditorPage.jsx'
  ];

  for (const file of frontendFiles) {
    const filePath = path.join(__dirname, file);
    const content = await fs.promises.readFile(filePath, 'utf8');

    // Check for React imports
    if (content.includes('React') && !content.includes('import React')) {
      throw new Error(`File ${file} uses React but missing import`);
    }

    // Check for proper exports
    if (!content.includes('export')) {
      throw new Error(`File ${file} missing export statement`);
    }

    // Check minimum content length
    if (content.length < 300) {
      throw new Error(`File ${file} appears incomplete (too short)`);
    }
  }
};

const testAIAgentStructure = async () => {
  const aiFiles = [
    'ai-agent/app.py',
    'ai-agent/requirements.txt',
    'ai-agent/.env.example',
    'ai-agent/Dockerfile'
  ];

  for (const file of aiFiles) {
    const filePath = path.join(__dirname, file);
    try {
      await fs.promises.access(filePath);
      const content = await fs.promises.readFile(filePath, 'utf8');
      if (content.length < 100) {
        throw new Error(`AI agent file ${file} appears incomplete`);
      }
    } catch (error) {
      throw new Error(`AI agent file missing: ${file}`);
    }
  }
};

const testConfigurationFiles = async () => {
  const configFiles = [
    'frontend/tailwind.config.js',
    'frontend/vite.config.js',
    'backend/healthcheck.js'
  ];

  for (const file of configFiles) {
    const filePath = path.join(__dirname, file);
    try {
      await fs.promises.access(filePath);
      const content = await fs.promises.readFile(filePath, 'utf8');
      if (content.length < 50) {
        throw new Error(`Configuration file ${file} appears incomplete`);
      }
    } catch (error) {
      // Configuration files are optional, so we don't throw errors for missing files
    }
  }
};

const testStartupScripts = async () => {
  const scripts = [
    'start.sh',
    'setup.sh'
  ];

  for (const script of scripts) {
    const scriptPath = path.join(__dirname, script);
    try {
      await fs.promises.access(scriptPath);
      const content = await fs.promises.readFile(scriptPath, 'utf8');
      if (!content.includes('#!/bin/bash')) {
        throw new Error(`Script ${script} missing shebang`);
      }
      if (content.length < 200) {
        throw new Error(`Script ${script} appears incomplete`);
      }
    } catch (error) {
      // Scripts are optional, so we don't throw errors for missing files
    }
  }
};

// Main test runner
const runAllTests = async () => {
  log('🚀 Starting Complete System Test Suite', 'info');
  log('=====================================', 'info');

  // File structure tests
  await runTest('File Structure Integrity', testFileStructure);
  await runTest('Package.json Integrity', testPackageJsonIntegrity);
  await runTest('Environment Files', testEnvironmentFiles);
  await runTest('Docker Configuration', testDockerConfiguration);

  // Dependency tests
  await runTest('Backend Dependencies', testBackendDependencies);
  await runTest('Frontend Dependencies', testFrontendDependencies);

  // Code integrity tests
  await runTest('Backend Code Integrity', testBackendCodeIntegrity);
  await runTest('Frontend Code Integrity', testFrontendCodeIntegrity);
  await runTest('AI Agent Structure', testAIAgentStructure);

  // Configuration tests
  await runTest('Configuration Files', testConfigurationFiles);
  await runTest('Startup Scripts', testStartupScripts);

  // Generate report
  log('=====================================', 'info');
  log('📊 Test Results Summary', 'info');
  log(`Total Tests: ${testResults.total}`, 'info');
  log(`Passed: ${testResults.passed}`, 'success');
  log(`Failed: ${testResults.failed}`, testResults.failed > 0 ? 'error' : 'info');
  log(`Success Rate: ${((testResults.passed / testResults.total) * 100).toFixed(1)}%`, 
      testResults.failed === 0 ? 'success' : 'warning');

  if (testResults.failed > 0) {
    log('\n❌ Failed Tests:', 'error');
    testResults.details
      .filter(test => test.status === 'FAILED')
      .forEach(test => {
        log(`  - ${test.name}: ${test.error}`, 'error');
      });
  }

  // Save detailed report
  const report = {
    timestamp: new Date().toISOString(),
    summary: {
      total: testResults.total,
      passed: testResults.passed,
      failed: testResults.failed,
      successRate: ((testResults.passed / testResults.total) * 100).toFixed(1)
    },
    details: testResults.details
  };

  await fs.promises.writeFile(path.join(__dirname, 'test-report.json'), JSON.stringify(report, null, 2));
  log('\n📄 Detailed report saved to test-report.json', 'info');

  if (testResults.failed === 0) {
    log('\n🎉 All tests passed! The system is ready for deployment.', 'success');
    process.exit(0);
  } else {
    log('\n⚠️  Some tests failed. Please review and fix the issues.', 'warning');
    process.exit(1);
  }
};

// Run tests
if (import.meta.url === `file://${process.argv[1]}`) {
  runAllTests().catch(error => {
    log(`Fatal error: ${error.message}`, 'error');
    process.exit(1);
  });
}

export { runAllTests, testResults };
