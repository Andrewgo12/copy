#!/usr/bin/env node

/**
 * System Verification Script
 * Verifies that all components are working correctly
 */

const fs = require('fs-extra');
const path = require('path');
const axios = require('axios');

// Test configuration
const SERVICES = {
  backend: {
    name: 'Backend API',
    url: 'http://localhost:3001',
    healthEndpoint: '/api/health',
    testEndpoints: [
      '/api/health',
      '/api/auth/register',
      '/api/projects'
    ]
  },
  frontend: {
    name: 'Frontend',
    url: 'http://localhost:3002',
    testPaths: [
      '/',
      '/editor'
    ]
  },
  aiAgent: {
    name: 'AI Agent',
    url: 'http://localhost:8000',
    healthEndpoint: '/health',
    testEndpoints: [
      '/health',
      '/contextual-reasoning'
    ]
  }
};

// Utility functions
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

const sleep = (ms) => new Promise(resolve => setTimeout(resolve, ms));

// Test functions
const testServiceHealth = async (service) => {
  try {
    const response = await axios.get(service.url + service.healthEndpoint, {
      timeout: 5000
    });
    
    if (response.status === 200) {
      log(`✅ ${service.name} is healthy`, 'success');
      return true;
    } else {
      log(`❌ ${service.name} returned status ${response.status}`, 'error');
      return false;
    }
  } catch (error) {
    log(`❌ ${service.name} is not responding: ${error.message}`, 'error');
    return false;
  }
};

const testBackendEndpoints = async () => {
  log('\n🔍 Testing Backend API Endpoints...', 'info');
  
  const backend = SERVICES.backend;
  let passedTests = 0;
  let totalTests = 0;
  
  for (const endpoint of backend.testEndpoints) {
    totalTests++;
    try {
      const response = await axios.get(backend.url + endpoint, {
        timeout: 5000,
        validateStatus: (status) => status < 500 // Accept 4xx as valid responses
      });
      
      log(`✅ ${endpoint} - Status: ${response.status}`, 'success');
      passedTests++;
    } catch (error) {
      log(`❌ ${endpoint} - Error: ${error.message}`, 'error');
    }
  }
  
  log(`Backend API Tests: ${passedTests}/${totalTests} passed`, 
      passedTests === totalTests ? 'success' : 'warning');
  
  return passedTests === totalTests;
};

const testAuthenticationFlow = async () => {
  log('\n🔐 Testing Authentication Flow...', 'info');
  
  try {
    const backend = SERVICES.backend;
    
    // Test user registration
    const registerData = {
      email: `test-${Date.now()}@example.com`,
      password: 'TestPassword123!',
      name: 'Test User',
      confirmPassword: 'TestPassword123!'
    };
    
    const registerResponse = await axios.post(
      backend.url + '/api/auth/register',
      registerData,
      { timeout: 5000 }
    );
    
    if (registerResponse.status === 201) {
      log('✅ User registration successful', 'success');
      
      // Test login
      const loginData = {
        email: registerData.email,
        password: registerData.password
      };
      
      const loginResponse = await axios.post(
        backend.url + '/api/auth/login',
        loginData,
        { timeout: 5000 }
      );
      
      if (loginResponse.status === 200 && loginResponse.data.tokens) {
        log('✅ User login successful', 'success');
        
        // Test protected endpoint
        const token = loginResponse.data.tokens.accessToken;
        const profileResponse = await axios.get(
          backend.url + '/api/auth/me',
          {
            headers: { Authorization: `Bearer ${token}` },
            timeout: 5000
          }
        );
        
        if (profileResponse.status === 200) {
          log('✅ Protected endpoint access successful', 'success');
          return true;
        }
      }
    }
    
    return false;
  } catch (error) {
    log(`❌ Authentication test failed: ${error.message}`, 'error');
    return false;
  }
};

const testProjectOperations = async () => {
  log('\n📁 Testing Project Operations...', 'info');
  
  try {
    const backend = SERVICES.backend;
    
    // Test project creation
    const projectData = {
      name: `Test Project ${Date.now()}`,
      description: 'A test project for verification',
      elements: [
        {
          id: 'test-element-1',
          type: 'heading',
          content: 'Test Heading',
          styles: { fontSize: '2rem' }
        }
      ]
    };
    
    const createResponse = await axios.post(
      backend.url + '/api/projects',
      projectData,
      { timeout: 5000 }
    );
    
    if (createResponse.status === 201) {
      log('✅ Project creation successful', 'success');
      
      const projectId = createResponse.data.id;
      
      // Test project retrieval
      const getResponse = await axios.get(
        backend.url + `/api/projects/${projectId}`,
        { timeout: 5000 }
      );
      
      if (getResponse.status === 200) {
        log('✅ Project retrieval successful', 'success');
        
        // Test project update
        const updateData = {
          name: projectData.name + ' (Updated)',
          description: 'Updated description'
        };
        
        const updateResponse = await axios.put(
          backend.url + `/api/projects/${projectId}`,
          updateData,
          { timeout: 5000 }
        );
        
        if (updateResponse.status === 200) {
          log('✅ Project update successful', 'success');
          return true;
        }
      }
    }
    
    return false;
  } catch (error) {
    log(`❌ Project operations test failed: ${error.message}`, 'error');
    return false;
  }
};

const testAIAgentEndpoints = async () => {
  log('\n🤖 Testing AI Agent Endpoints...', 'info');
  
  const aiAgent = SERVICES.aiAgent;
  
  try {
    // Test contextual reasoning
    const reasoningData = {
      query: 'How can I improve this button design?',
      context: {},
      elements: []
    };
    
    const reasoningResponse = await axios.post(
      aiAgent.url + '/contextual-reasoning',
      reasoningData,
      { timeout: 10000 }
    );
    
    if (reasoningResponse.status === 200) {
      log('✅ AI contextual reasoning successful', 'success');
      return true;
    }
    
    return false;
  } catch (error) {
    if (error.code === 'ECONNREFUSED') {
      log('⚠️  AI Agent not running (optional service)', 'warning');
      return true; // AI Agent is optional
    }
    log(`❌ AI Agent test failed: ${error.message}`, 'error');
    return false;
  }
};

const testFileStructure = async () => {
  log('\n📂 Testing File Structure...', 'info');
  
  const requiredFiles = [
    'package.json',
    'backend/package.json',
    'frontend/package.json',
    'backend/src/server.js',
    'frontend/src/App.jsx',
    'README.md',
    'docker-compose.yml'
  ];
  
  let missingFiles = [];
  
  for (const file of requiredFiles) {
    const filePath = path.join(__dirname, file);
    if (!await fs.pathExists(filePath)) {
      missingFiles.push(file);
    }
  }
  
  if (missingFiles.length === 0) {
    log('✅ All required files present', 'success');
    return true;
  } else {
    log(`❌ Missing files: ${missingFiles.join(', ')}`, 'error');
    return false;
  }
};

const testEnvironmentConfiguration = async () => {
  log('\n⚙️  Testing Environment Configuration...', 'info');
  
  const envFiles = [
    'backend/.env',
    'frontend/.env'
  ];
  
  let issues = [];
  
  for (const envFile of envFiles) {
    const envPath = path.join(__dirname, envFile);
    if (!await fs.pathExists(envPath)) {
      issues.push(`Missing: ${envFile}`);
    } else {
      const content = await fs.readFile(envPath, 'utf8');
      if (content.length < 50) {
        issues.push(`Incomplete: ${envFile}`);
      }
    }
  }
  
  if (issues.length === 0) {
    log('✅ Environment configuration looks good', 'success');
    return true;
  } else {
    log(`⚠️  Environment issues: ${issues.join(', ')}`, 'warning');
    return false;
  }
};

// Main verification function
const runVerification = async () => {
  log('🔍 Visual Web Editor - System Verification', 'info');
  log('==========================================', 'info');
  
  const results = {
    fileStructure: await testFileStructure(),
    environmentConfig: await testEnvironmentConfiguration(),
    backendHealth: await testServiceHealth(SERVICES.backend),
    frontendHealth: false, // Will test if backend is healthy
    aiAgentHealth: false,  // Will test if available
    backendEndpoints: false,
    authFlow: false,
    projectOps: false,
    aiEndpoints: false
  };
  
  // Test frontend if backend is healthy
  if (results.backendHealth) {
    results.frontendHealth = await testServiceHealth(SERVICES.frontend);
    results.backendEndpoints = await testBackendEndpoints();
    results.authFlow = await testAuthenticationFlow();
    results.projectOps = await testProjectOperations();
  }
  
  // Test AI agent if available
  results.aiAgentHealth = await testServiceHealth(SERVICES.aiAgent);
  if (results.aiAgentHealth) {
    results.aiEndpoints = await testAIAgentEndpoints();
  }
  
  // Generate summary
  log('\n📊 Verification Summary', 'info');
  log('======================', 'info');
  
  const testResults = Object.entries(results);
  const passedTests = testResults.filter(([_, passed]) => passed).length;
  const totalTests = testResults.length;
  
  testResults.forEach(([test, passed]) => {
    const status = passed ? '✅' : '❌';
    const testName = test.replace(/([A-Z])/g, ' $1').replace(/^./, str => str.toUpperCase());
    log(`${status} ${testName}`, passed ? 'success' : 'error');
  });
  
  log(`\nOverall: ${passedTests}/${totalTests} tests passed`, 
      passedTests === totalTests ? 'success' : 'warning');
  
  if (passedTests === totalTests) {
    log('\n🎉 All systems operational! The Visual Web Editor is ready to use.', 'success');
  } else if (passedTests >= totalTests * 0.8) {
    log('\n⚠️  Most systems operational. Some optional features may not be available.', 'warning');
  } else {
    log('\n❌ Multiple system issues detected. Please check the setup and try again.', 'error');
  }
  
  // Save verification report
  const report = {
    timestamp: new Date().toISOString(),
    results,
    summary: {
      passed: passedTests,
      total: totalTests,
      successRate: ((passedTests / totalTests) * 100).toFixed(1)
    }
  };
  
  await fs.writeJson(path.join(__dirname, 'verification-report.json'), report, { spaces: 2 });
  log('\n📄 Verification report saved to verification-report.json', 'info');
  
  return passedTests === totalTests;
};

// Run verification
if (require.main === module) {
  runVerification().then(success => {
    process.exit(success ? 0 : 1);
  }).catch(error => {
    log(`Fatal error: ${error.message}`, 'error');
    process.exit(1);
  });
}

module.exports = { runVerification };
