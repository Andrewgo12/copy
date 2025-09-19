#!/bin/bash

# Local AI Agent Deployment Script
# Automates the complete setup and integration of the local AI agent

set -e  # Exit on any error

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Logging functions
log_info() {
    echo -e "${BLUE}ℹ️  $1${NC}"
}

log_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

log_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

log_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Check prerequisites
check_prerequisites() {
    log_info "Checking prerequisites..."
    
    # Check Python
    if ! command_exists python3; then
        log_error "Python 3 is required but not installed"
        exit 1
    fi
    
    # Check Python version
    python_version=$(python3 -c 'import sys; print(".".join(map(str, sys.version_info[:2])))')
    if [[ $(echo "$python_version < 3.8" | bc -l) -eq 1 ]]; then
        log_error "Python 3.8+ is required, found $python_version"
        exit 1
    fi
    
    log_success "Python $python_version found"
    
    # Check pip
    if ! command_exists pip3; then
        log_error "pip3 is required but not installed"
        exit 1
    fi
    
    # Check Node.js
    if ! command_exists node; then
        log_error "Node.js is required but not installed"
        exit 1
    fi
    
    # Check npm
    if ! command_exists npm; then
        log_error "npm is required but not installed"
        exit 1
    fi
    
    log_success "All prerequisites satisfied"
}

# Setup local AI agent
setup_local_ai_agent() {
    log_info "Setting up Local AI Agent..."
    
    cd local-ai-agent
    
    # Create virtual environment if it doesn't exist
    if [ ! -d "venv" ]; then
        log_info "Creating Python virtual environment..."
        python3 -m venv venv
    fi
    
    # Activate virtual environment
    source venv/bin/activate
    
    # Upgrade pip
    pip install --upgrade pip
    
    # Run setup script
    log_info "Running automated setup..."
    python setup.py
    
    if [ $? -eq 0 ]; then
        log_success "Local AI Agent setup completed"
    else
        log_error "Local AI Agent setup failed"
        exit 1
    fi
    
    cd ..
}

# Update backend configuration
update_backend_config() {
    log_info "Updating backend configuration..."
    
    cd server
    
    # Check if .env exists, create from example if not
    if [ ! -f ".env" ]; then
        log_info "Creating .env from .env.example..."
        cp .env.example .env
    fi
    
    # Update .env to enable local AI agent
    if grep -q "USE_LOCAL_AI_AGENT=" .env; then
        sed -i 's/USE_LOCAL_AI_AGENT=.*/USE_LOCAL_AI_AGENT=true/' .env
    else
        echo "USE_LOCAL_AI_AGENT=true" >> .env
    fi
    
    if grep -q "LOCAL_AI_AGENT_URL=" .env; then
        sed -i 's|LOCAL_AI_AGENT_URL=.*|LOCAL_AI_AGENT_URL=http://localhost:8000|' .env
    else
        echo "LOCAL_AI_AGENT_URL=http://localhost:8000" >> .env
    fi
    
    if grep -q "LOCAL_AI_TIMEOUT=" .env; then
        sed -i 's/LOCAL_AI_TIMEOUT=.*/LOCAL_AI_TIMEOUT=30000/' .env
    else
        echo "LOCAL_AI_TIMEOUT=30000" >> .env
    fi
    
    log_success "Backend configuration updated"
    
    cd ..
}

# Start local AI agent
start_local_ai_agent() {
    log_info "Starting Local AI Agent..."
    
    cd local-ai-agent
    source venv/bin/activate
    
    # Start in background
    nohup python main.py > ../logs/local-ai-agent.log 2>&1 &
    LOCAL_AI_PID=$!
    echo $LOCAL_AI_PID > ../local-ai-agent.pid
    
    log_info "Local AI Agent started with PID $LOCAL_AI_PID"
    
    # Wait for agent to be ready
    log_info "Waiting for Local AI Agent to be ready..."
    for i in {1..30}; do
        if curl -s http://localhost:8000/health >/dev/null 2>&1; then
            log_success "Local AI Agent is ready"
            break
        fi
        
        if [ $i -eq 30 ]; then
            log_error "Local AI Agent failed to start within 30 seconds"
            exit 1
        fi
        
        sleep 1
        echo -n "."
    done
    
    cd ..
}

# Start backend server
start_backend_server() {
    log_info "Starting backend server..."
    
    cd server
    
    # Install dependencies if needed
    if [ ! -d "node_modules" ]; then
        log_info "Installing backend dependencies..."
        npm install
    fi
    
    # Start in background
    nohup npm run dev > ../logs/backend.log 2>&1 &
    BACKEND_PID=$!
    echo $BACKEND_PID > ../backend.pid
    
    log_info "Backend server started with PID $BACKEND_PID"
    
    # Wait for backend to be ready
    log_info "Waiting for backend server to be ready..."
    for i in {1..30}; do
        if curl -s http://localhost:3001/api/health >/dev/null 2>&1; then
            log_success "Backend server is ready"
            break
        fi
        
        if [ $i -eq 30 ]; then
            log_error "Backend server failed to start within 30 seconds"
            exit 1
        fi
        
        sleep 1
        echo -n "."
    done
    
    cd ..
}

# Start frontend server
start_frontend_server() {
    log_info "Starting frontend server..."
    
    # Install dependencies if needed
    if [ ! -d "node_modules" ]; then
        log_info "Installing frontend dependencies..."
        npm install
    fi
    
    # Start in background
    nohup npm run dev > logs/frontend.log 2>&1 &
    FRONTEND_PID=$!
    echo $FRONTEND_PID > frontend.pid
    
    log_info "Frontend server started with PID $FRONTEND_PID"
    
    # Wait for frontend to be ready
    log_info "Waiting for frontend server to be ready..."
    for i in {1..30}; do
        if curl -s http://localhost:3002 >/dev/null 2>&1; then
            log_success "Frontend server is ready"
            break
        fi
        
        if [ $i -eq 30 ]; then
            log_error "Frontend server failed to start within 30 seconds"
            exit 1
        fi
        
        sleep 1
        echo -n "."
    done
}

# Test integration
test_integration() {
    log_info "Testing Local AI Agent integration..."
    
    # Test local AI agent health
    log_info "Testing Local AI Agent health..."
    if curl -s http://localhost:8000/health | grep -q '"agent_ready":true'; then
        log_success "Local AI Agent health check passed"
    else
        log_error "Local AI Agent health check failed"
        return 1
    fi
    
    # Test backend integration
    log_info "Testing backend integration..."
    if curl -s http://localhost:3001/api/local-ai-agent/health | grep -q '"local_ai_healthy":true'; then
        log_success "Backend integration test passed"
    else
        log_error "Backend integration test failed"
        return 1
    fi
    
    # Test simple design generation
    log_info "Testing design generation..."
    response=$(curl -s -X POST http://localhost:3001/api/local-ai-agent/iterative-design \
        -H "Content-Type: application/json" \
        -d '{"requirements": "Create a simple landing page with a header and button"}')
    
    if echo "$response" | grep -q '"success":true'; then
        log_success "Design generation test passed"
    else
        log_error "Design generation test failed"
        echo "Response: $response"
        return 1
    fi
    
    log_success "All integration tests passed"
}

# Show status
show_status() {
    echo ""
    echo "🎉 Local AI Agent deployment completed successfully!"
    echo ""
    echo "📊 Service Status:"
    echo "  • Local AI Agent: http://localhost:8000"
    echo "  • Backend Server: http://localhost:3001"
    echo "  • Frontend Server: http://localhost:3002"
    echo ""
    echo "🔧 Management Commands:"
    echo "  • Stop all services: ./stop-local-ai.sh"
    echo "  • View logs: tail -f logs/*.log"
    echo "  • Test integration: curl http://localhost:8000/health"
    echo ""
    echo "📝 Configuration:"
    echo "  • Local AI Agent is enabled in backend"
    echo "  • All services are running in background"
    echo "  • Logs are saved in logs/ directory"
    echo ""
    echo "🚀 Ready to use! Open http://localhost:3002 and try the AI Assistant."
}

# Create stop script
create_stop_script() {
    cat > stop-local-ai.sh << 'EOF'
#!/bin/bash

# Stop all Local AI services

echo "🛑 Stopping Local AI services..."

# Stop processes using PID files
if [ -f "local-ai-agent.pid" ]; then
    PID=$(cat local-ai-agent.pid)
    if kill -0 $PID 2>/dev/null; then
        kill $PID
        echo "✅ Stopped Local AI Agent (PID $PID)"
    fi
    rm -f local-ai-agent.pid
fi

if [ -f "backend.pid" ]; then
    PID=$(cat backend.pid)
    if kill -0 $PID 2>/dev/null; then
        kill $PID
        echo "✅ Stopped Backend Server (PID $PID)"
    fi
    rm -f backend.pid
fi

if [ -f "frontend.pid" ]; then
    PID=$(cat frontend.pid)
    if kill -0 $PID 2>/dev/null; then
        kill $PID
        echo "✅ Stopped Frontend Server (PID $PID)"
    fi
    rm -f frontend.pid
fi

# Fallback: kill by port
pkill -f "python main.py" 2>/dev/null || true
pkill -f "node.*server" 2>/dev/null || true
pkill -f "vite.*3002" 2>/dev/null || true

echo "🎉 All services stopped"
EOF

    chmod +x stop-local-ai.sh
}

# Main execution
main() {
    echo "🚀 Local AI Agent Deployment Script"
    echo "===================================="
    echo ""
    
    # Create logs directory
    mkdir -p logs
    
    # Check prerequisites
    check_prerequisites
    
    # Setup local AI agent
    setup_local_ai_agent
    
    # Update backend configuration
    update_backend_config
    
    # Start services
    start_local_ai_agent
    start_backend_server
    start_frontend_server
    
    # Test integration
    test_integration
    
    # Create stop script
    create_stop_script
    
    # Show status
    show_status
}

# Handle script interruption
trap 'log_error "Deployment interrupted"; exit 1' INT TERM

# Run main function
main "$@"
