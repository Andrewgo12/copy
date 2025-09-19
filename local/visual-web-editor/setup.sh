#!/bin/bash

# Visual Web Editor - Complete Setup Script
# Automated deployment and configuration

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
PROJECT_NAME="Visual Web Editor"
VERSION="2.0.0"
ENVIRONMENT=${1:-production}

echo -e "${BLUE}🚀 ${PROJECT_NAME} v${VERSION} - Complete Setup${NC}"
echo -e "${BLUE}================================================${NC}"
echo -e "${YELLOW}Environment: ${ENVIRONMENT}${NC}"
echo ""

# Function to print status
print_status() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️ $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Check prerequisites
check_prerequisites() {
    echo -e "${BLUE}🔍 Checking Prerequisites...${NC}"
    
    # Check Docker
    if ! command -v docker &> /dev/null; then
        print_error "Docker is not installed. Please install Docker first."
        exit 1
    fi
    print_status "Docker is installed"
    
    # Check Docker Compose
    if ! command -v docker-compose &> /dev/null; then
        print_error "Docker Compose is not installed. Please install Docker Compose first."
        exit 1
    fi
    print_status "Docker Compose is installed"
    
    # Check Node.js (for local development)
    if command -v node &> /dev/null; then
        NODE_VERSION=$(node --version)
        print_status "Node.js is installed: $NODE_VERSION"
    else
        print_warning "Node.js not found (optional for Docker deployment)"
    fi
    
    # Check Python (for local development)
    if command -v python3 &> /dev/null; then
        PYTHON_VERSION=$(python3 --version)
        print_status "Python is installed: $PYTHON_VERSION"
    else
        print_warning "Python not found (optional for Docker deployment)"
    fi
    
    echo ""
}

# Setup environment variables
setup_environment() {
    echo -e "${BLUE}🔧 Setting up Environment Configuration...${NC}"
    
    if [ ! -f .env ]; then
        if [ -f .env.example ]; then
            cp .env.example .env
            print_status "Created .env from .env.example"
        else
            # Create basic .env file
            cat > .env << EOF
# Visual Web Editor Environment Configuration

# Environment
NODE_ENV=${ENVIRONMENT}
ENVIRONMENT=${ENVIRONMENT}

# API Keys (Optional - for enhanced AI features)
OPENAI_API_KEY=your_openai_api_key_here
DEEPSEEK_API_KEY=your_deepseek_api_key_here

# Security
JWT_SECRET=$(openssl rand -base64 32)
REDIS_PASSWORD=$(openssl rand -base64 16)

# Database
DB_USER=admin
DB_PASSWORD=$(openssl rand -base64 16)
DATABASE_URL=postgresql://admin:${DB_PASSWORD}@database:5432/visual_web_editor

# Ports
FRONTEND_PORT=3002
BACKEND_PORT=3001
AI_AGENT_PORT=8000
DATABASE_PORT=5432
REDIS_PORT=6379

# URLs
REACT_APP_BACKEND_URL=http://localhost:3001
REACT_APP_LOCAL_AI_URL=http://localhost:8000
LOCAL_AI_AGENT_URL=http://local-ai-agent:8000
CORS_ORIGIN=http://localhost:3002
EOF
            print_status "Created .env with secure defaults"
        fi
    else
        print_status ".env file already exists"
    fi
    
    echo ""
}

# Create necessary directories
create_directories() {
    echo -e "${BLUE}📁 Creating Project Directories...${NC}"
    
    # Create directories if they don't exist
    mkdir -p backend/uploads
    mkdir -p backend/projects
    mkdir -p backend/logs
    mkdir -p local-ai-agent/models
    mkdir -p local-ai-agent/cache
    mkdir -p database/init
    mkdir -p nginx/ssl
    mkdir -p nginx/logs
    
    print_status "Project directories created"
    echo ""
}

# Setup Docker files
setup_docker_files() {
    echo -e "${BLUE}🐳 Setting up Docker Configuration...${NC}"
    
    # Create frontend Dockerfile if it doesn't exist
    if [ ! -f frontend/Dockerfile ]; then
        cat > frontend/Dockerfile << 'EOF'
FROM node:18-alpine

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --only=production

# Copy source code
COPY . .

# Build the application
RUN npm run build

# Install serve to run the application
RUN npm install -g serve

# Expose port
EXPOSE 3000

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:3000/health || exit 1

# Start the application
CMD ["serve", "-s", "build", "-l", "3000"]
EOF
        print_status "Created frontend Dockerfile"
    fi
    
    # Create backend Dockerfile if it doesn't exist
    if [ ! -f backend/Dockerfile ]; then
        cat > backend/Dockerfile << 'EOF'
FROM node:18-alpine

WORKDIR /app

# Install curl for health checks
RUN apk add --no-cache curl

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci --only=production

# Copy source code
COPY . .

# Create necessary directories
RUN mkdir -p uploads projects logs

# Expose port
EXPOSE 3001

# Health check
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
  CMD curl -f http://localhost:3001/api/health || exit 1

# Start the application
CMD ["npm", "start"]
EOF
        print_status "Created backend Dockerfile"
    fi
    
    # Create AI agent Dockerfile if it doesn't exist
    if [ ! -f local-ai-agent/Dockerfile ]; then
        cat > local-ai-agent/Dockerfile << 'EOF'
FROM python:3.11-slim

WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    gcc \
    g++ \
    && rm -rf /var/lib/apt/lists/*

# Copy requirements
COPY requirements.txt .

# Install Python dependencies
RUN pip install --no-cache-dir -r requirements.txt

# Download spaCy model
RUN python -m spacy download en_core_web_sm

# Copy source code
COPY . .

# Create necessary directories
RUN mkdir -p models cache logs

# Expose port
EXPOSE 8000

# Health check
HEALTHCHECK --interval=30s --timeout=15s --start-period=30s --retries=3 \
  CMD curl -f http://localhost:8000/health || exit 1

# Start the application
CMD ["uvicorn", "main:app", "--host", "0.0.0.0", "--port", "8000"]
EOF
        print_status "Created AI agent Dockerfile"
    fi
    
    echo ""
}

# Setup Nginx configuration
setup_nginx() {
    echo -e "${BLUE}🌐 Setting up Nginx Configuration...${NC}"
    
    if [ ! -f nginx/nginx.conf ]; then
        mkdir -p nginx
        cat > nginx/nginx.conf << 'EOF'
events {
    worker_connections 1024;
}

http {
    upstream frontend {
        server frontend:3000;
    }
    
    upstream backend {
        server backend:3001;
    }
    
    upstream ai-agent {
        server local-ai-agent:8000;
    }
    
    server {
        listen 80;
        server_name localhost;
        
        # Frontend
        location / {
            proxy_pass http://frontend;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Forwarded-Proto $scheme;
        }
        
        # Backend API
        location /api/ {
            proxy_pass http://backend;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Forwarded-Proto $scheme;
        }
        
        # AI Agent API
        location /ai/ {
            proxy_pass http://ai-agent/;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Forwarded-Proto $scheme;
        }
        
        # Health check
        location /health {
            access_log off;
            return 200 "healthy\n";
            add_header Content-Type text/plain;
        }
    }
}
EOF
        print_status "Created Nginx configuration"
    fi
    
    echo ""
}

# Build and start services
deploy_services() {
    echo -e "${BLUE}🚀 Deploying Services...${NC}"
    
    if [ "$ENVIRONMENT" = "development" ]; then
        print_status "Starting development environment..."
        docker-compose -f docker-compose.dev.yml down
        docker-compose -f docker-compose.dev.yml build
        docker-compose -f docker-compose.dev.yml up -d
    else
        print_status "Starting production environment..."
        docker-compose down
        docker-compose build
        docker-compose up -d
    fi
    
    echo ""
}

# Wait for services to be ready
wait_for_services() {
    echo -e "${BLUE}⏳ Waiting for Services to Start...${NC}"
    
    # Wait for database
    echo "Waiting for database..."
    sleep 10
    
    # Wait for AI agent
    echo "Waiting for AI agent..."
    timeout=60
    while [ $timeout -gt 0 ]; do
        if curl -f http://localhost:8000/health &> /dev/null; then
            print_status "AI Agent is ready"
            break
        fi
        sleep 2
        timeout=$((timeout-2))
    done
    
    # Wait for backend
    echo "Waiting for backend..."
    timeout=60
    while [ $timeout -gt 0 ]; do
        if curl -f http://localhost:3001/api/health &> /dev/null; then
            print_status "Backend is ready"
            break
        fi
        sleep 2
        timeout=$((timeout-2))
    done
    
    # Wait for frontend
    echo "Waiting for frontend..."
    timeout=60
    while [ $timeout -gt 0 ]; do
        if curl -f http://localhost:3002 &> /dev/null; then
            print_status "Frontend is ready"
            break
        fi
        sleep 2
        timeout=$((timeout-2))
    done
    
    echo ""
}

# Run tests
run_tests() {
    echo -e "${BLUE}🧪 Running Integration Tests...${NC}"
    
    if [ -f "run-integration-tests.js" ]; then
        if command -v node &> /dev/null; then
            node run-integration-tests.js
        else
            print_warning "Node.js not available, skipping JavaScript tests"
        fi
    fi
    
    if [ -f "test-complete-integration.py" ]; then
        if command -v python3 &> /dev/null; then
            python3 test-complete-integration.py
        else
            print_warning "Python not available, skipping Python tests"
        fi
    fi
    
    echo ""
}

# Display final status
show_final_status() {
    echo -e "${GREEN}🎉 ${PROJECT_NAME} Setup Complete!${NC}"
    echo -e "${GREEN}================================${NC}"
    echo ""
    echo -e "${BLUE}📊 Service Status:${NC}"
    echo -e "Frontend:  ${GREEN}http://localhost:3002${NC}"
    echo -e "Backend:   ${GREEN}http://localhost:3001${NC}"
    echo -e "AI Agent:  ${GREEN}http://localhost:8000${NC}"
    echo -e "Database:  ${GREEN}localhost:5432${NC}"
    echo -e "Redis:     ${GREEN}localhost:6379${NC}"
    echo ""
    echo -e "${BLUE}🔧 Management Commands:${NC}"
    echo -e "View logs:     ${YELLOW}docker-compose logs -f${NC}"
    echo -e "Stop services: ${YELLOW}docker-compose down${NC}"
    echo -e "Restart:       ${YELLOW}docker-compose restart${NC}"
    echo -e "Update:        ${YELLOW}docker-compose pull && docker-compose up -d${NC}"
    echo ""
    echo -e "${BLUE}📚 Documentation:${NC}"
    echo -e "README:        ${YELLOW}./README.md${NC}"
    echo -e "API Docs:      ${YELLOW}http://localhost:3001/api/docs${NC}"
    echo -e "AI Docs:       ${YELLOW}http://localhost:8000/docs${NC}"
    echo ""
    echo -e "${GREEN}✅ All systems operational and ready for use!${NC}"
}

# Main execution
main() {
    check_prerequisites
    setup_environment
    create_directories
    setup_docker_files
    setup_nginx
    deploy_services
    wait_for_services
    run_tests
    show_final_status
}

# Run main function
main "$@"
