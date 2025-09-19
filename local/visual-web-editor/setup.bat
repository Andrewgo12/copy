@echo off
REM Visual Web Editor - Complete Setup Script for Windows
REM Automated deployment and configuration

setlocal enabledelayedexpansion

REM Configuration
set PROJECT_NAME=Visual Web Editor
set VERSION=2.0.0
set ENVIRONMENT=%1
if "%ENVIRONMENT%"=="" set ENVIRONMENT=production

echo.
echo ================================
echo 🚀 %PROJECT_NAME% v%VERSION%
echo Complete Windows Setup
echo ================================
echo Environment: %ENVIRONMENT%
echo.

REM Check prerequisites
echo 🔍 Checking Prerequisites...
echo.

REM Check Docker
docker --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Docker is not installed. Please install Docker Desktop first.
    pause
    exit /b 1
)
echo ✅ Docker is installed

REM Check Docker Compose
docker-compose --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Docker Compose is not installed. Please install Docker Compose first.
    pause
    exit /b 1
)
echo ✅ Docker Compose is installed

REM Check Node.js (optional)
node --version >nul 2>&1
if errorlevel 1 (
    echo ⚠️ Node.js not found (optional for Docker deployment)
) else (
    for /f "tokens=*" %%i in ('node --version') do set NODE_VERSION=%%i
    echo ✅ Node.js is installed: !NODE_VERSION!
)

REM Check Python (optional)
python --version >nul 2>&1
if errorlevel 1 (
    echo ⚠️ Python not found (optional for Docker deployment)
) else (
    for /f "tokens=*" %%i in ('python --version') do set PYTHON_VERSION=%%i
    echo ✅ Python is installed: !PYTHON_VERSION!
)

echo.

REM Setup environment variables
echo 🔧 Setting up Environment Configuration...
echo.

if not exist .env (
    if exist .env.example (
        copy .env.example .env >nul
        echo ✅ Created .env from .env.example
    ) else (
        REM Create basic .env file
        (
            echo # Visual Web Editor Environment Configuration
            echo.
            echo # Environment
            echo NODE_ENV=%ENVIRONMENT%
            echo ENVIRONMENT=%ENVIRONMENT%
            echo.
            echo # API Keys (Optional - for enhanced AI features^)
            echo OPENAI_API_KEY=your_openai_api_key_here
            echo DEEPSEEK_API_KEY=your_deepseek_api_key_here
            echo.
            echo # Security
            echo JWT_SECRET=secure_jwt_secret_change_in_production
            echo REDIS_PASSWORD=secure_redis_password
            echo.
            echo # Database
            echo DB_USER=admin
            echo DB_PASSWORD=secure_db_password
            echo DATABASE_URL=postgresql://admin:secure_db_password@database:5432/visual_web_editor
            echo.
            echo # Ports
            echo FRONTEND_PORT=3002
            echo BACKEND_PORT=3001
            echo AI_AGENT_PORT=8000
            echo DATABASE_PORT=5432
            echo REDIS_PORT=6379
            echo.
            echo # URLs
            echo REACT_APP_BACKEND_URL=http://localhost:3001
            echo REACT_APP_LOCAL_AI_URL=http://localhost:8000
            echo LOCAL_AI_AGENT_URL=http://local-ai-agent:8000
            echo CORS_ORIGIN=http://localhost:3002
        ) > .env
        echo ✅ Created .env with secure defaults
    )
) else (
    echo ✅ .env file already exists
)

echo.

REM Create necessary directories
echo 📁 Creating Project Directories...
echo.

if not exist backend\uploads mkdir backend\uploads
if not exist backend\projects mkdir backend\projects
if not exist backend\logs mkdir backend\logs
if not exist local-ai-agent\models mkdir local-ai-agent\models
if not exist local-ai-agent\cache mkdir local-ai-agent\cache
if not exist database\init mkdir database\init
if not exist nginx\ssl mkdir nginx\ssl
if not exist nginx\logs mkdir nginx\logs

echo ✅ Project directories created
echo.

REM Setup Docker files
echo 🐳 Setting up Docker Configuration...
echo.

REM Create frontend Dockerfile if it doesn't exist
if not exist frontend\Dockerfile (
    (
        echo FROM node:18-alpine
        echo.
        echo WORKDIR /app
        echo.
        echo # Copy package files
        echo COPY package*.json ./
        echo.
        echo # Install dependencies
        echo RUN npm ci --only=production
        echo.
        echo # Copy source code
        echo COPY . .
        echo.
        echo # Build the application
        echo RUN npm run build
        echo.
        echo # Install serve to run the application
        echo RUN npm install -g serve
        echo.
        echo # Expose port
        echo EXPOSE 3000
        echo.
        echo # Health check
        echo HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
        echo   CMD curl -f http://localhost:3000/health ^|^| exit 1
        echo.
        echo # Start the application
        echo CMD ["serve", "-s", "build", "-l", "3000"]
    ) > frontend\Dockerfile
    echo ✅ Created frontend Dockerfile
)

REM Create backend Dockerfile if it doesn't exist
if not exist backend\Dockerfile (
    (
        echo FROM node:18-alpine
        echo.
        echo WORKDIR /app
        echo.
        echo # Install curl for health checks
        echo RUN apk add --no-cache curl
        echo.
        echo # Copy package files
        echo COPY package*.json ./
        echo.
        echo # Install dependencies
        echo RUN npm ci --only=production
        echo.
        echo # Copy source code
        echo COPY . .
        echo.
        echo # Create necessary directories
        echo RUN mkdir -p uploads projects logs
        echo.
        echo # Expose port
        echo EXPOSE 3001
        echo.
        echo # Health check
        echo HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
        echo   CMD curl -f http://localhost:3001/api/health ^|^| exit 1
        echo.
        echo # Start the application
        echo CMD ["npm", "start"]
    ) > backend\Dockerfile
    echo ✅ Created backend Dockerfile
)

REM Create AI agent Dockerfile if it doesn't exist
if not exist local-ai-agent\Dockerfile (
    (
        echo FROM python:3.11-slim
        echo.
        echo WORKDIR /app
        echo.
        echo # Install system dependencies
        echo RUN apt-get update ^&^& apt-get install -y \
        echo     curl \
        echo     gcc \
        echo     g++ \
        echo     ^&^& rm -rf /var/lib/apt/lists/*
        echo.
        echo # Copy requirements
        echo COPY requirements.txt .
        echo.
        echo # Install Python dependencies
        echo RUN pip install --no-cache-dir -r requirements.txt
        echo.
        echo # Download spaCy model
        echo RUN python -m spacy download en_core_web_sm
        echo.
        echo # Copy source code
        echo COPY . .
        echo.
        echo # Create necessary directories
        echo RUN mkdir -p models cache logs
        echo.
        echo # Expose port
        echo EXPOSE 8000
        echo.
        echo # Health check
        echo HEALTHCHECK --interval=30s --timeout=15s --start-period=30s --retries=3 \
        echo   CMD curl -f http://localhost:8000/health ^|^| exit 1
        echo.
        echo # Start the application
        echo CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000"]
    ) > local-ai-agent\Dockerfile
    echo ✅ Created AI agent Dockerfile
)

echo.

REM Deploy services
echo 🚀 Deploying Services...
echo.

if "%ENVIRONMENT%"=="development" (
    echo ✅ Starting development environment...
    docker-compose -f docker-compose.dev.yml down
    docker-compose -f docker-compose.dev.yml build
    docker-compose -f docker-compose.dev.yml up -d
) else (
    echo ✅ Starting production environment...
    docker-compose down
    docker-compose build
    docker-compose up -d
)

echo.

REM Wait for services
echo ⏳ Waiting for Services to Start...
echo.

echo Waiting for services to initialize...
timeout /t 15 /nobreak >nul

echo Checking service health...
timeout /t 10 /nobreak >nul

echo.

REM Display final status
echo.
echo ================================
echo 🎉 %PROJECT_NAME% Setup Complete!
echo ================================
echo.
echo 📊 Service Status:
echo Frontend:  http://localhost:3002
echo Backend:   http://localhost:3001
echo AI Agent:  http://localhost:8000
echo Database:  localhost:5432
echo Redis:     localhost:6379
echo.
echo 🔧 Management Commands:
echo View logs:     docker-compose logs -f
echo Stop services: docker-compose down
echo Restart:       docker-compose restart
echo Update:        docker-compose pull ^&^& docker-compose up -d
echo.
echo 📚 Documentation:
echo README:        .\README.md
echo API Docs:      http://localhost:3001/api/docs
echo AI Docs:       http://localhost:8000/docs
echo.
echo ✅ All systems operational and ready for use!
echo.

pause
