"""
Health Check API
Provides health status and system information
"""

import os
import psutil
import time
from flask import Blueprint, jsonify
from datetime import datetime
import structlog

logger = structlog.get_logger()

health_bp = Blueprint('health', __name__)

# Store startup time
startup_time = time.time()

@health_bp.route('/', methods=['GET'])
def health_check():
    """
    Comprehensive health check endpoint
    Returns system status, performance metrics, and capabilities
    """
    try:
        current_time = time.time()
        uptime = current_time - startup_time
        
        # System metrics
        memory = psutil.virtual_memory()
        cpu_percent = psutil.cpu_percent(interval=1)
        disk = psutil.disk_usage('/')
        
        # Model status (would check actual models in production)
        model_status = {
            'nlp_model': 'loaded',
            'vision_model': 'loaded',
            'code_model': 'loaded',
            'design_model': 'loaded'
        }
        
        # Capabilities
        capabilities = [
            'contextual-reasoning',
            'iterative-design', 
            'visual-replication',
            'code-generation',
            'design-analysis',
            'template-generation',
            'code-refactoring',
            'design-optimization'
        ]
        
        health_data = {
            'status': 'healthy',
            'timestamp': datetime.utcnow().isoformat(),
            'version': '2.0.0',
            'uptime_seconds': round(uptime, 2),
            'capabilities': capabilities,
            'models': model_status,
            'system': {
                'cpu_percent': cpu_percent,
                'memory': {
                    'total': memory.total,
                    'available': memory.available,
                    'percent': memory.percent,
                    'used': memory.used
                },
                'disk': {
                    'total': disk.total,
                    'free': disk.free,
                    'used': disk.used,
                    'percent': (disk.used / disk.total) * 100
                }
            },
            'environment': {
                'python_version': os.sys.version,
                'platform': os.name,
                'debug_mode': os.getenv('DEBUG', 'False').lower() == 'true'
            },
            'endpoints': {
                'contextual_reasoning': '/contextual-reasoning',
                'iterative_design': '/iterative-design',
                'replicate_design': '/replicate-visual-design',
                'generate_interface': '/generate-advanced-interface',
                'analyze_design': '/analyze-design',
                'optimize_design': '/optimize-design',
                'generate_templates': '/generate-templates',
                'customize_template': '/customize-template',
                'refactor_code': '/refactor-code',
                'explain_design': '/explain-design'
            }
        }
        
        return jsonify(health_data), 200
        
    except Exception as e:
        logger.error("Health check failed", error=str(e))
        return jsonify({
            'status': 'unhealthy',
            'timestamp': datetime.utcnow().isoformat(),
            'error': str(e)
        }), 500

@health_bp.route('/ready', methods=['GET'])
def readiness_check():
    """
    Readiness check for Kubernetes/Docker
    Returns 200 if service is ready to accept requests
    """
    try:
        # Check if models are loaded (simplified check)
        models_ready = True  # Would check actual model loading status
        
        if models_ready:
            return jsonify({
                'status': 'ready',
                'timestamp': datetime.utcnow().isoformat()
            }), 200
        else:
            return jsonify({
                'status': 'not_ready',
                'timestamp': datetime.utcnow().isoformat(),
                'reason': 'Models not loaded'
            }), 503
            
    except Exception as e:
        logger.error("Readiness check failed", error=str(e))
        return jsonify({
            'status': 'not_ready',
            'timestamp': datetime.utcnow().isoformat(),
            'error': str(e)
        }), 503

@health_bp.route('/live', methods=['GET'])
def liveness_check():
    """
    Liveness check for Kubernetes/Docker
    Returns 200 if service is alive
    """
    return jsonify({
        'status': 'alive',
        'timestamp': datetime.utcnow().isoformat()
    }), 200

@health_bp.route('/metrics', methods=['GET'])
def metrics():
    """
    Prometheus-style metrics endpoint
    """
    try:
        current_time = time.time()
        uptime = current_time - startup_time
        
        memory = psutil.virtual_memory()
        cpu_percent = psutil.cpu_percent()
        
        metrics_data = {
            'ai_agent_uptime_seconds': uptime,
            'ai_agent_cpu_percent': cpu_percent,
            'ai_agent_memory_usage_bytes': memory.used,
            'ai_agent_memory_percent': memory.percent,
            'ai_agent_models_loaded': 4,  # Would count actual loaded models
            'ai_agent_requests_total': 0,  # Would track actual requests
            'ai_agent_errors_total': 0,    # Would track actual errors
            'ai_agent_response_time_seconds': 0.5  # Would track actual response times
        }
        
        return jsonify(metrics_data), 200
        
    except Exception as e:
        logger.error("Metrics collection failed", error=str(e))
        return jsonify({'error': str(e)}), 500
