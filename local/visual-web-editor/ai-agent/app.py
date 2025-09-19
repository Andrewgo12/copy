"""
Visual Web Editor AI Agent
Main application entry point for the local AI agent
"""

import os
import logging
from flask import Flask, request, jsonify
from flask_cors import CORS
from flask_limiter import Limiter
from flask_limiter.util import get_remote_address
from dotenv import load_dotenv
import structlog

# Load environment variables
load_dotenv()

# Configure structured logging
structlog.configure(
    processors=[
        structlog.stdlib.filter_by_level,
        structlog.stdlib.add_logger_name,
        structlog.stdlib.add_log_level,
        structlog.stdlib.PositionalArgumentsFormatter(),
        structlog.processors.TimeStamper(fmt="iso"),
        structlog.processors.StackInfoRenderer(),
        structlog.processors.format_exc_info,
        structlog.processors.UnicodeDecoder(),
        structlog.processors.JSONRenderer()
    ],
    context_class=dict,
    logger_factory=structlog.stdlib.LoggerFactory(),
    wrapper_class=structlog.stdlib.BoundLogger,
    cache_logger_on_first_use=True,
)

logger = structlog.get_logger()

# Import AI processors
from src.api.health import health_bp
from src.api.design import design_bp
from src.api.generation import generation_bp
from src.api.analysis import analysis_bp
from src.api.templates import templates_bp
from src.middleware.error_handler import register_error_handlers
from src.middleware.logging import setup_request_logging

def create_app():
    """Create and configure the Flask application"""
    app = Flask(__name__)
    
    # Configuration
    app.config['SECRET_KEY'] = os.getenv('SECRET_KEY', 'dev-secret-key-change-in-production')
    app.config['DEBUG'] = os.getenv('DEBUG', 'False').lower() == 'true'
    app.config['HOST'] = os.getenv('HOST', 'localhost')
    app.config['PORT'] = int(os.getenv('PORT', 8000))
    
    # CORS configuration
    cors_origins = os.getenv('CORS_ORIGINS', 'http://localhost:3001,http://localhost:3002').split(',')
    CORS(app, origins=cors_origins, supports_credentials=True)
    
    # Rate limiting
    limiter = Limiter(
        app,
        key_func=get_remote_address,
        default_limits=["200 per day", "50 per hour"],
        storage_uri=os.getenv('REDIS_URL', 'memory://')
    )
    
    # Request logging
    setup_request_logging(app)
    
    # Error handling
    register_error_handlers(app)
    
    # Register blueprints
    app.register_blueprint(health_bp, url_prefix='/health')
    app.register_blueprint(design_bp, url_prefix='/')
    app.register_blueprint(generation_bp, url_prefix='/')
    app.register_blueprint(analysis_bp, url_prefix='/')
    app.register_blueprint(templates_bp, url_prefix='/')
    
    # Root endpoint
    @app.route('/')
    def root():
        return jsonify({
            'name': 'Visual Web Editor AI Agent',
            'version': '2.0.0',
            'status': 'running',
            'capabilities': [
                'contextual-reasoning',
                'iterative-design',
                'visual-replication',
                'code-generation',
                'design-analysis',
                'template-generation'
            ],
            'endpoints': {
                'health': '/health',
                'contextual_reasoning': '/contextual-reasoning',
                'iterative_design': '/iterative-design',
                'replicate_design': '/replicate-visual-design',
                'generate_interface': '/generate-advanced-interface',
                'analyze_design': '/analyze-design',
                'optimize_design': '/optimize-design',
                'generate_templates': '/generate-templates',
                'refactor_code': '/refactor-code'
            }
        })
    
    return app

def initialize_models():
    """Initialize AI models on startup"""
    try:
        logger.info("Initializing AI models...")
        
        # Import and initialize model managers
        from src.models.nlp_model import NLPModel
        from src.models.vision_model import VisionModel
        from src.models.code_model import CodeModel
        
        # Initialize models
        nlp_model = NLPModel()
        vision_model = VisionModel()
        code_model = CodeModel()
        
        # Store in app context for reuse
        app.nlp_model = nlp_model
        app.vision_model = vision_model
        app.code_model = code_model
        
        logger.info("AI models initialized successfully")
        
    except Exception as e:
        logger.error("Failed to initialize AI models", error=str(e))
        raise

# Create the Flask app
app = create_app()

if __name__ == '__main__':
    try:
        # Initialize models
        initialize_models()
        
        # Start the server
        host = app.config['HOST']
        port = app.config['PORT']
        debug = app.config['DEBUG']
        
        logger.info(f"Starting AI Agent server on {host}:{port}")
        logger.info(f"Debug mode: {debug}")
        logger.info(f"CORS origins: {os.getenv('CORS_ORIGINS', 'localhost')}")
        
        app.run(
            host=host,
            port=port,
            debug=debug,
            threaded=True
        )
        
    except KeyboardInterrupt:
        logger.info("Server stopped by user")
    except Exception as e:
        logger.error("Failed to start server", error=str(e))
        raise
