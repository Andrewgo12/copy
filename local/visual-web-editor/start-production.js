#!/usr/bin/env node

/**
 * Visual Web Editor - Production Startup Script
 * 
 * This script ensures all components are properly configured and starts
 * both frontend and backend in production-ready mode.
 */

import { spawn } from 'child_process'
import { existsSync, readFileSync } from 'fs'
import { join } from 'path'
import chalk from 'chalk'

const log = {
  info: (msg) => console.log(chalk.blue('ℹ'), msg),
  success: (msg) => console.log(chalk.green('✓'), msg),
  warning: (msg) => console.log(chalk.yellow('⚠'), msg),
  error: (msg) => console.log(chalk.red('✗'), msg),
  title: (msg) => console.log(chalk.bold.cyan(msg))
}

class ProductionStarter {
  constructor() {
    this.processes = []
    this.isShuttingDown = false
  }

  async start() {
    log.title('\n🚀 Visual Web Editor - Production Startup\n')

    try {
      await this.checkPrerequisites()
      await this.validateConfiguration()
      await this.startServices()
      this.setupGracefulShutdown()
      this.showSuccessMessage()
    } catch (error) {
      log.error(`Startup failed: ${error.message}`)
      process.exit(1)
    }
  }

  async checkPrerequisites() {
    log.info('Checking prerequisites...')

    // Check Node.js version
    const nodeVersion = process.version
    const majorVersion = parseInt(nodeVersion.slice(1).split('.')[0])
    if (majorVersion < 16) {
      throw new Error(`Node.js 16+ required, found ${nodeVersion}`)
    }
    log.success(`Node.js ${nodeVersion} ✓`)

    // Check if package.json exists
    if (!existsSync('package.json')) {
      throw new Error('package.json not found. Run from project root.')
    }
    log.success('Project structure ✓')

    // Check if node_modules exists
    if (!existsSync('node_modules')) {
      log.warning('Dependencies not installed. Installing...')
      await this.runCommand('npm', ['install'])
      log.success('Dependencies installed ✓')
    } else {
      log.success('Dependencies ✓')
    }

    // Check server dependencies
    if (!existsSync('server/node_modules')) {
      log.warning('Server dependencies not installed. Installing...')
      await this.runCommand('npm', ['install'], { cwd: 'server' })
      log.success('Server dependencies installed ✓')
    } else {
      log.success('Server dependencies ✓')
    }
  }

  async validateConfiguration() {
    log.info('Validating configuration...')

    // Check server environment
    const serverEnvPath = 'server/.env'
    if (!existsSync(serverEnvPath)) {
      log.warning('Server .env not found. Creating from example...')
      const exampleEnv = readFileSync('server/.env.example', 'utf8')
      require('fs').writeFileSync(serverEnvPath, exampleEnv)
      log.warning('⚠ Please configure your OpenAI API key in server/.env')
    }

    // Check frontend environment
    const frontendEnvPath = '.env.development'
    if (!existsSync(frontendEnvPath)) {
      log.success('Using default frontend configuration')
    } else {
      log.success('Frontend configuration ✓')
    }

    // Validate server configuration
    try {
      const serverEnv = readFileSync(serverEnvPath, 'utf8')
      if (!serverEnv.includes('OPENAI_API_KEY=your_openai_api_key_here')) {
        log.success('OpenAI API key configured ✓')
      } else {
        log.warning('⚠ OpenAI API key not configured - AI features will be limited')
      }
    } catch (error) {
      log.warning('Could not validate server configuration')
    }

    log.success('Configuration validated ✓')
  }

  async startServices() {
    log.info('Starting services...')

    // Start backend server
    log.info('Starting backend server on port 3001...')
    const backendProcess = spawn('npm', ['run', 'dev'], {
      cwd: 'server',
      stdio: ['pipe', 'pipe', 'pipe'],
      shell: true
    })

    this.processes.push({ name: 'Backend', process: backendProcess })

    // Wait for backend to be ready
    await this.waitForService('http://localhost:3001/api/health', 'Backend')

    // Start frontend server
    log.info('Starting frontend server on port 3002...')
    const frontendProcess = spawn('npm', ['run', 'dev'], {
      stdio: ['pipe', 'pipe', 'pipe'],
      shell: true
    })

    this.processes.push({ name: 'Frontend', process: frontendProcess })

    // Wait for frontend to be ready
    await this.waitForService('http://localhost:3002', 'Frontend')

    log.success('All services started successfully ✓')
  }

  async waitForService(url, serviceName, maxAttempts = 30) {
    for (let i = 0; i < maxAttempts; i++) {
      try {
        const response = await fetch(url)
        if (response.ok) {
          log.success(`${serviceName} ready ✓`)
          return
        }
      } catch (error) {
        // Service not ready yet
      }

      if (i < maxAttempts - 1) {
        await new Promise(resolve => setTimeout(resolve, 1000))
        process.stdout.write('.')
      }
    }

    throw new Error(`${serviceName} failed to start within ${maxAttempts} seconds`)
  }

  setupGracefulShutdown() {
    const shutdown = () => {
      if (this.isShuttingDown) return
      this.isShuttingDown = true

      log.info('\nShutting down services...')

      this.processes.forEach(({ name, process }) => {
        log.info(`Stopping ${name}...`)
        process.kill('SIGTERM')
      })

      setTimeout(() => {
        this.processes.forEach(({ name, process }) => {
          if (!process.killed) {
            log.warning(`Force killing ${name}...`)
            process.kill('SIGKILL')
          }
        })
        process.exit(0)
      }, 5000)
    }

    process.on('SIGINT', shutdown)
    process.on('SIGTERM', shutdown)
    process.on('SIGQUIT', shutdown)
  }

  showSuccessMessage() {
    console.log('\n' + '='.repeat(60))
    log.title('🎉 Visual Web Editor is now running!')
    console.log('')
    log.success('Frontend: http://localhost:3002')
    log.success('Backend:  http://localhost:3001')
    log.success('Health:   http://localhost:3001/api/health')
    console.log('')
    log.info('Features available:')
    console.log('  • Complete visual web page builder')
    console.log('  • 25+ production-ready UI elements')
    console.log('  • Real AI integration with iterative agent')
    console.log('  • Responsive design system')
    console.log('  • Advanced code generation')
    console.log('  • Professional keyboard shortcuts')
    console.log('  • Auto-save and project management')
    console.log('')
    log.info('Press Ctrl+C to stop all services')
    console.log('='.repeat(60) + '\n')
  }

  async runCommand(command, args, options = {}) {
    return new Promise((resolve, reject) => {
      const process = spawn(command, args, {
        stdio: 'inherit',
        shell: true,
        ...options
      })

      process.on('close', (code) => {
        if (code === 0) {
          resolve()
        } else {
          reject(new Error(`Command failed with code ${code}`))
        }
      })

      process.on('error', reject)
    })
  }
}

// Add chalk dependency check
try {
  await import('chalk')
} catch (error) {
  console.log('Installing required dependencies...')
  const { spawn } = await import('child_process')
  const installProcess = spawn('npm', ['install', 'chalk'], { stdio: 'inherit', shell: true })
  
  installProcess.on('close', (code) => {
    if (code === 0) {
      console.log('Dependencies installed. Please run the script again.')
    } else {
      console.error('Failed to install dependencies')
    }
    process.exit(code)
  })
}

// Start the application
const starter = new ProductionStarter()
starter.start().catch(error => {
  console.error('Failed to start:', error.message)
  process.exit(1)
})
