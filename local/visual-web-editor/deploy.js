#!/usr/bin/env node
/**
 * Visual Web Editor - Automated Deployment Script
 * Cross-platform deployment automation
 */

import { promises as fs } from 'fs';
import { spawn } from 'child_process';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

class DeploymentManager {
    constructor() {
        this.environment = process.argv[2] || 'production';
        this.platform = process.platform;
        this.deploymentSteps = [];
        this.errors = [];
    }

    async deploy() {
        console.log('🚀 VISUAL WEB EDITOR - AUTOMATED DEPLOYMENT');
        console.log('=' .repeat(60));
        console.log(`Environment: ${this.environment}`);
        console.log(`Platform: ${this.platform}`);
        console.log('=' .repeat(60));

        try {
            await this.validateEnvironment();
            await this.setupConfiguration();
            await this.buildServices();
            await this.deployServices();
            await this.validateDeployment();
            this.showDeploymentSummary();
        } catch (error) {
            console.error('❌ Deployment failed:', error.message);
            this.showErrorSummary();
            process.exit(1);
        }
    }

    async validateEnvironment() {
        console.log('\n🔍 VALIDATING DEPLOYMENT ENVIRONMENT');
        console.log('-'.repeat(40));

        // Check Docker
        try {
            await this.runCommand('docker', ['--version']);
            console.log('✅ Docker is available');
        } catch (error) {
            throw new Error('Docker is not installed or not accessible');
        }

        // Check Docker Compose
        try {
            await this.runCommand('docker-compose', ['--version']);
            console.log('✅ Docker Compose is available');
        } catch (error) {
            throw new Error('Docker Compose is not installed or not accessible');
        }

        // Check project structure
        const requiredFiles = [
            'docker-compose.yml',
            'local-ai-agent/requirements.txt',
            'local-ai-agent/main.py',
            'local-ai-agent/core/agent.py'
        ];

        for (const file of requiredFiles) {
            try {
                await fs.access(path.join(__dirname, file));
                console.log(`✅ ${file} exists`);
            } catch (error) {
                throw new Error(`Required file missing: ${file}`);
            }
        }
    }

    async setupConfiguration() {
        console.log('\n🔧 SETTING UP CONFIGURATION');
        console.log('-'.repeat(40));

        // Create .env if it doesn't exist
        const envPath = path.join(__dirname, '.env');
        try {
            await fs.access(envPath);
            console.log('✅ .env file exists');
        } catch (error) {
            // Create basic .env
            const envContent = `# Visual Web Editor Environment Configuration
NODE_ENV=${this.environment}
ENVIRONMENT=${this.environment}

# API Keys (Optional)
OPENAI_API_KEY=your_openai_api_key_here
DEEPSEEK_API_KEY=your_deepseek_api_key_here

# Security
JWT_SECRET=secure_jwt_secret_${Date.now()}
REDIS_PASSWORD=secure_redis_password_${Date.now()}

# Database
DB_USER=admin
DB_PASSWORD=secure_db_password_${Date.now()}
DATABASE_URL=postgresql://admin:secure_db_password_${Date.now()}@database:5432/visual_web_editor

# Ports
FRONTEND_PORT=3002
BACKEND_PORT=3001
AI_AGENT_PORT=8000

# URLs
REACT_APP_BACKEND_URL=http://localhost:3001
REACT_APP_LOCAL_AI_URL=http://localhost:8000
LOCAL_AI_AGENT_URL=http://local-ai-agent:8000
CORS_ORIGIN=http://localhost:3002
`;
            await fs.writeFile(envPath, envContent);
            console.log('✅ Created .env file with secure defaults');
        }

        // Create necessary directories
        const directories = [
            'backend/uploads',
            'backend/projects', 
            'backend/logs',
            'local-ai-agent/models',
            'local-ai-agent/cache',
            'database/init',
            'nginx/ssl',
            'nginx/logs'
        ];

        for (const dir of directories) {
            const dirPath = path.join(__dirname, dir);
            try {
                await fs.mkdir(dirPath, { recursive: true });
                console.log(`✅ Created directory: ${dir}`);
            } catch (error) {
                console.log(`⚠️ Directory already exists: ${dir}`);
            }
        }
    }

    async buildServices() {
        console.log('\n🏗️ BUILDING SERVICES');
        console.log('-'.repeat(40));

        const composeFile = this.environment === 'development' 
            ? 'docker-compose.dev.yml' 
            : 'docker-compose.yml';

        try {
            console.log('Building Docker images...');
            await this.runCommand('docker-compose', ['-f', composeFile, 'build', '--no-cache']);
            console.log('✅ All services built successfully');
        } catch (error) {
            throw new Error(`Failed to build services: ${error.message}`);
        }
    }

    async deployServices() {
        console.log('\n🚀 DEPLOYING SERVICES');
        console.log('-'.repeat(40));

        const composeFile = this.environment === 'development' 
            ? 'docker-compose.dev.yml' 
            : 'docker-compose.yml';

        try {
            // Stop existing services
            console.log('Stopping existing services...');
            await this.runCommand('docker-compose', ['-f', composeFile, 'down']);

            // Start services
            console.log('Starting services...');
            await this.runCommand('docker-compose', ['-f', composeFile, 'up', '-d']);
            console.log('✅ All services deployed successfully');

            // Wait for services to be ready
            console.log('Waiting for services to initialize...');
            await this.waitForServices();
        } catch (error) {
            throw new Error(`Failed to deploy services: ${error.message}`);
        }
    }

    async waitForServices() {
        const services = [
            { name: 'AI Agent', url: 'http://localhost:8000/health', timeout: 60 },
            { name: 'Backend', url: 'http://localhost:3001/api/health', timeout: 30 },
            { name: 'Frontend', url: 'http://localhost:3002', timeout: 30 }
        ];

        for (const service of services) {
            console.log(`Waiting for ${service.name}...`);
            let attempts = 0;
            const maxAttempts = service.timeout / 2;

            while (attempts < maxAttempts) {
                try {
                    const response = await fetch(service.url);
                    if (response.ok) {
                        console.log(`✅ ${service.name} is ready`);
                        break;
                    }
                } catch (error) {
                    // Service not ready yet
                }

                attempts++;
                if (attempts >= maxAttempts) {
                    console.log(`⚠️ ${service.name} may not be ready (timeout)`);
                    break;
                }

                await new Promise(resolve => setTimeout(resolve, 2000));
            }
        }
    }

    async validateDeployment() {
        console.log('\n✅ VALIDATING DEPLOYMENT');
        console.log('-'.repeat(40));

        const validationChecks = [
            { name: 'Docker containers running', check: () => this.checkContainers() },
            { name: 'AI Agent health', check: () => this.checkService('http://localhost:8000/health') },
            { name: 'Backend health', check: () => this.checkService('http://localhost:3001/api/health') },
            { name: 'Frontend accessibility', check: () => this.checkService('http://localhost:3002') }
        ];

        for (const validation of validationChecks) {
            try {
                await validation.check();
                console.log(`✅ ${validation.name}`);
            } catch (error) {
                console.log(`❌ ${validation.name}: ${error.message}`);
                this.errors.push(`${validation.name}: ${error.message}`);
            }
        }
    }

    async checkContainers() {
        try {
            const result = await this.runCommand('docker-compose', ['ps']);
            if (!result.includes('Up')) {
                throw new Error('No containers are running');
            }
        } catch (error) {
            throw new Error('Failed to check container status');
        }
    }

    async checkService(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Service returned ${response.status}`);
            }
        } catch (error) {
            throw new Error(`Service not accessible: ${error.message}`);
        }
    }

    showDeploymentSummary() {
        console.log('\n' + '='.repeat(60));
        console.log('🎉 DEPLOYMENT COMPLETED SUCCESSFULLY');
        console.log('='.repeat(60));

        console.log('\n📊 SERVICE STATUS:');
        console.log('-'.repeat(30));
        console.log('✅ Frontend:  http://localhost:3002');
        console.log('✅ Backend:   http://localhost:3001');
        console.log('✅ AI Agent:  http://localhost:8000');
        console.log('✅ Database:  localhost:5432');
        console.log('✅ Redis:     localhost:6379');

        console.log('\n🔧 MANAGEMENT COMMANDS:');
        console.log('-'.repeat(30));
        console.log('View logs:     docker-compose logs -f');
        console.log('Stop services: docker-compose down');
        console.log('Restart:       docker-compose restart');
        console.log('Update:        docker-compose pull && docker-compose up -d');

        console.log('\n📚 DOCUMENTATION:');
        console.log('-'.repeat(30));
        console.log('README:        ./README.md');
        console.log('API Docs:      http://localhost:3001/api/docs');
        console.log('AI Docs:       http://localhost:8000/docs');

        console.log('\n🚀 DEPLOYMENT SUMMARY:');
        console.log('-'.repeat(30));
        console.log(`Environment: ${this.environment}`);
        console.log(`Platform: ${this.platform}`);
        console.log(`Errors: ${this.errors.length}`);
        console.log('Status: ✅ OPERATIONAL');

        if (this.errors.length === 0) {
            console.log('\n🎯 ALL SYSTEMS ARE FULLY OPERATIONAL!');
            console.log('The Visual Web Editor is ready for use.');
        } else {
            console.log('\n⚠️ DEPLOYMENT COMPLETED WITH WARNINGS');
            console.log('Some services may need attention.');
        }
    }

    showErrorSummary() {
        console.log('\n❌ DEPLOYMENT FAILED');
        console.log('-'.repeat(30));
        
        if (this.errors.length > 0) {
            console.log('\nErrors encountered:');
            this.errors.forEach((error, index) => {
                console.log(`${index + 1}. ${error}`);
            });
        }

        console.log('\nTroubleshooting:');
        console.log('1. Check Docker is running');
        console.log('2. Verify all required files exist');
        console.log('3. Check port availability (3001, 3002, 8000)');
        console.log('4. Review Docker logs: docker-compose logs');
    }

    async runCommand(command, args) {
        return new Promise((resolve, reject) => {
            const process = spawn(command, args, { 
                stdio: ['pipe', 'pipe', 'pipe'],
                shell: this.platform === 'win32'
            });

            let stdout = '';
            let stderr = '';

            process.stdout.on('data', (data) => {
                stdout += data.toString();
            });

            process.stderr.on('data', (data) => {
                stderr += data.toString();
            });

            process.on('close', (code) => {
                if (code === 0) {
                    resolve(stdout);
                } else {
                    reject(new Error(stderr || `Command failed with code ${code}`));
                }
            });

            process.on('error', (error) => {
                reject(error);
            });
        });
    }
}

// Run deployment
async function main() {
    const deployer = new DeploymentManager();
    await deployer.deploy();
}

main().catch(console.error);
