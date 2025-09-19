#!/usr/bin/env node

/**
 * Status Check Script
 * Verifies if services are running and accessible
 */

import http from 'http';
import { fileURLToPath } from 'url';
import path from 'path';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

// Service configurations
const services = [
  {
    name: 'Backend API',
    url: 'http://localhost:3001',
    endpoint: '/api/health',
    port: 3001
  },
  {
    name: 'Frontend App',
    url: 'http://localhost:3002',
    endpoint: '/',
    port: 3002
  }
];

// Colors for console output
const colors = {
  green: '\x1b[32m',
  red: '\x1b[31m',
  yellow: '\x1b[33m',
  blue: '\x1b[36m',
  reset: '\x1b[0m'
};

const log = (message, color = 'reset') => {
  console.log(`${colors[color]}${message}${colors.reset}`);
};

// Check if a port is in use
const checkPort = (port) => {
  return new Promise((resolve) => {
    const server = http.createServer();
    
    server.listen(port, () => {
      server.close(() => {
        resolve(false); // Port is available
      });
    });
    
    server.on('error', () => {
      resolve(true); // Port is in use
    });
  });
};

// Make HTTP request to check service
const checkService = (service) => {
  return new Promise((resolve) => {
    const url = `${service.url}${service.endpoint}`;
    
    http.get(url, (res) => {
      let data = '';
      res.on('data', chunk => data += chunk);
      res.on('end', () => {
        resolve({
          success: true,
          status: res.statusCode,
          data: data
        });
      });
    }).on('error', (error) => {
      resolve({
        success: false,
        error: error.message
      });
    });
  });
};

// Main status check function
const checkStatus = async () => {
  log('🔍 Visual Web Editor - Status Check', 'blue');
  log('=====================================', 'blue');
  
  let allGood = true;
  
  for (const service of services) {
    log(`\n📡 Checking ${service.name}...`, 'yellow');
    
    // Check if port is in use
    const portInUse = await checkPort(service.port);
    
    if (!portInUse) {
      log(`❌ Port ${service.port} is not in use - service not running`, 'red');
      allGood = false;
      continue;
    }
    
    log(`✅ Port ${service.port} is in use`, 'green');
    
    // Check if service responds
    const result = await checkService(service);
    
    if (result.success) {
      log(`✅ ${service.name} is responding (Status: ${result.status})`, 'green');
      
      // Try to parse JSON response for backend
      if (service.name === 'Backend API') {
        try {
          const healthData = JSON.parse(result.data);
          if (healthData.status === 'healthy') {
            log(`✅ Backend health check passed`, 'green');
          } else {
            log(`⚠️  Backend health check returned: ${healthData.status}`, 'yellow');
          }
        } catch (e) {
          log(`⚠️  Backend response is not valid JSON`, 'yellow');
        }
      }
    } else {
      log(`❌ ${service.name} is not responding: ${result.error}`, 'red');
      allGood = false;
    }
  }
  
  // Summary
  log('\n📊 Summary', 'blue');
  log('==========', 'blue');
  
  if (allGood) {
    log('🎉 All services are running correctly!', 'green');
    log('\n🌐 Access URLs:', 'blue');
    log('• Frontend: http://localhost:3002', 'green');
    log('• Backend API: http://localhost:3001', 'green');
    log('• Health Check: http://localhost:3001/api/health', 'green');
  } else {
    log('⚠️  Some services are not running properly.', 'yellow');
    log('\n🚀 To start services:', 'blue');
    log('• Backend: cd backend && npm start', 'yellow');
    log('• Frontend: cd frontend && npm start', 'yellow');
  }
  
  log('\n📋 Manual Testing Guide: MANUAL_TESTING_GUIDE.md', 'blue');
  
  return allGood;
};

// Run the status check
if (import.meta.url === `file://${process.argv[1]}`) {
  checkStatus().then(success => {
    process.exit(success ? 0 : 1);
  }).catch(error => {
    log(`Fatal error: ${error.message}`, 'red');
    process.exit(1);
  });
}

export { checkStatus };
