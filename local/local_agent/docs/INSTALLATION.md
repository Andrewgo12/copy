# Guía de Instalación Completa

## Requisitos del Sistema

### Requisitos Mínimos
- **Python**: 3.8 o superior (recomendado 3.11)
- **RAM**: 4GB mínimo, 8GB recomendado
- **Almacenamiento**: 2GB libres para datos y modelos
- **CPU**: 2 cores mínimo, 4+ cores recomendado
- **SO**: Windows 10+, macOS 10.15+, Ubuntu 18.04+

### Requisitos Opcionales
- **Docker**: Para sandboxing avanzado
- **Git**: Para operaciones de control de versiones
- **Node.js**: Para herramientas de JavaScript
- **CUDA**: Para aceleración GPU (modelos locales)

## Instalación Paso a Paso

### 1. Preparación del Entorno

```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/local-agent.git
cd local-agent

# Crear entorno virtual
python -m venv venv

# Activar entorno virtual
# En Windows:
venv\Scripts\activate
# En macOS/Linux:
source venv/bin/activate

# Verificar versión de Python
python --version  # Debe ser 3.8+
```

### 2. Instalación de Dependencias

```bash
# Actualizar pip
pip install --upgrade pip

# Instalar dependencias principales
pip install -r requirements.txt

# Verificar instalación
python -c "import langchain, chromadb, fastapi; print('✅ Dependencias instaladas')"
```

### 3. Configuración Inicial

```bash
# Copiar archivo de configuración
cp .env.example .env

# Editar configuración (ver sección de configuración)
nano .env  # o tu editor preferido
```

### 4. Configuración de APIs

#### OpenAI (Recomendado)
1. Crear cuenta en [OpenAI](https://platform.openai.com/)
2. Generar API key en la sección API keys
3. Añadir a `.env`:
```bash
OPENAI_API_KEY=sk-tu-clave-aqui
LLM_PROVIDER=openai
LLM_MODEL=gpt-4
```

#### Anthropic (Alternativa)
1. Crear cuenta en [Anthropic](https://console.anthropic.com/)
2. Generar API key
3. Añadir a `.env`:
```bash
ANTHROPIC_API_KEY=tu-clave-anthropic
LLM_PROVIDER=anthropic
LLM_MODEL=claude-3-sonnet-20240229
```

#### Modelos Locales (Avanzado)
```bash
# Instalar dependencias adicionales
pip install transformers torch accelerate

# Configurar en .env
LLM_PROVIDER=local
LLM_MODEL=microsoft/DialoGPT-medium
```

### 5. Inicialización de la Base de Datos

```bash
# Ejecutar setup inicial
python -m local_agent.interfaces.cli setup

# Verificar que se crearon los directorios
ls -la data/
# Debería mostrar: vector_db/, cache/, logs/, backups/
```

### 6. Verificación de la Instalación

```bash
# Test básico
python main.py --test

# Test interactivo
python -m local_agent.interfaces.cli interactive

# Test de herramientas
python -c "
from local_agent.core.agent import create_agent
import asyncio

async def test():
    agent = create_agent()
    tools = await agent.get_available_tools()
    print(f'✅ {len(tools)} herramientas disponibles')
    await agent.shutdown()

asyncio.run(test())
"
```

## Instalación con Docker

### Opción 1: Docker Compose (Recomendado)

```bash
# Clonar repositorio
git clone https://github.com/tu-usuario/local-agent.git
cd local-agent

# Configurar variables de entorno
cp .env.example .env
# Editar .env con tus claves API

# Iniciar todos los servicios
docker-compose up -d

# Verificar que los servicios están corriendo
docker-compose ps

# Ver logs
docker-compose logs -f local-agent
```

### Opción 2: Docker Manual

```bash
# Construir imagen
docker build -t local-agent .

# Ejecutar contenedor
docker run -d \
  --name local-agent \
  -p 8000:8000 \
  -p 8501:8501 \
  -v $(pwd)/data:/app/data \
  -e OPENAI_API_KEY=tu-clave \
  local-agent
```

## Configuración Detallada

### Archivo .env Principal

```bash
# =============================================================================
# CONFIGURACIÓN ESENCIAL
# =============================================================================

# API Keys (REQUERIDO)
OPENAI_API_KEY=sk-tu-clave-openai-aqui
ANTHROPIC_API_KEY=tu-clave-anthropic-aqui

# Configuración del modelo
LLM_PROVIDER=openai          # openai, anthropic, local
LLM_MODEL=gpt-4             # gpt-4, gpt-3.5-turbo, claude-3-sonnet
MAX_ITERATIONS=10

# Configuración de seguridad
ENABLE_SANDBOX=true
REQUIRE_CONFIRMATION=true
MAX_EXECUTION_TIME=300

# Configuración de memoria
ENABLE_MEMORY=true
MEMORY_IMPORTANCE_THRESHOLD=0.3

# Configuración de logging
LOG_LEVEL=INFO
LOG_FILE=./data/logs/agent.log
```

### Configuración Avanzada de Herramientas

```yaml
# config/tools.yml
tools:
  file_operations:
    enabled: true
    max_file_size: "10MB"
    allowed_extensions: [".txt", ".py", ".js", ".md", ".json", ".yml"]
    blocked_paths: ["/etc", "/sys", "/proc", "C:\\Windows"]
    
  system_commands:
    enabled: true
    sandbox_required: true
    timeout: 60
    blocked_commands:
      - "rm -rf"
      - "del /s"
      - "format"
      - "shutdown"
      - "reboot"
    allowed_commands:
      - "ls"
      - "dir" 
      - "python"
      - "node"
      - "git"
    
  web_tools:
    enabled: true
    max_requests_per_minute: 10
    timeout: 30
    blocked_domains:
      - "malware.com"
      - "phishing.net"
    user_agent: "LocalAgent/1.0"
    
  code_analysis:
    enabled: true
    supported_languages: ["python", "javascript", "typescript", "java", "cpp"]
    max_file_size: "5MB"
    enable_syntax_checking: true
    enable_security_scanning: true
```

### Configuración de Seguridad Avanzada

```yaml
# config/security.yml
security:
  guardrails:
    enabled: true
    strict_mode: false
    custom_rules:
      - name: "protect_config_files"
        pattern: "\\.(env|config|ini|conf)$"
        action: "require_confirmation"
        severity: "high"
        
      - name: "block_network_tools"
        pattern: "(nc|netcat|nmap|masscan)"
        action: "deny"
        severity: "critical"
  
  sandbox:
    provider: "docker"  # docker, firejail, subprocess
    image: "python:3.11-slim"
    memory_limit: "512m"
    cpu_limit: "1.0"
    network_access: false
    mount_points:
      - "./workspace:/workspace:rw"
      - "/tmp:/tmp:rw"
  
  human_loop:
    enabled: true
    auto_approve_safe: true
    confirmation_timeout: 60
    require_approval_for:
      - "system_commands"
      - "file_write"
      - "package_install"
```

## Solución de Problemas Comunes

### Error: "No module named 'langchain'"
```bash
# Verificar que el entorno virtual está activado
which python  # Debe apuntar a venv/bin/python

# Reinstalar dependencias
pip install --force-reinstall -r requirements.txt
```

### Error: "ChromaDB initialization failed"
```bash
# Limpiar base de datos corrupta
rm -rf data/vector_db/*

# Reinstalar ChromaDB
pip uninstall chromadb
pip install chromadb
```

### Error: "OpenAI API key not found"
```bash
# Verificar que .env existe y tiene la clave
cat .env | grep OPENAI_API_KEY

# Verificar que se está cargando
python -c "
import os
from dotenv import load_dotenv
load_dotenv()
print('API Key:', os.getenv('OPENAI_API_KEY', 'NO ENCONTRADA'))
"
```

### Error: "Permission denied" en comandos del sistema
```bash
# Verificar permisos del directorio
ls -la data/

# Cambiar permisos si es necesario
chmod -R 755 data/

# En Windows, ejecutar como administrador si es necesario
```

### Problemas de Rendimiento
```bash
# Verificar uso de recursos
python -c "
import psutil
print(f'CPU: {psutil.cpu_percent()}%')
print(f'RAM: {psutil.virtual_memory().percent}%')
print(f'Disco: {psutil.disk_usage(\"/\").percent}%')
"

# Limpiar caché si es necesario
rm -rf data/cache/*
```

## Configuración para Desarrollo

### Setup de Desarrollo
```bash
# Instalar dependencias de desarrollo
pip install -r requirements-dev.txt

# Configurar pre-commit hooks
pre-commit install

# Ejecutar tests
pytest tests/ -v

# Verificar calidad de código
black local_agent/
flake8 local_agent/
mypy local_agent/
```

### Variables de Entorno para Desarrollo
```bash
# .env.development
DEBUG_MODE=true
AUTO_RELOAD=true
LOG_LEVEL=DEBUG
ENABLE_PROMETHEUS=true
ENABLE_WEB_UI=true

# Configuración de testing
TEST_DIRECTORY=./tests
ENABLE_TEST_SANDBOX=true
TEST_TIMEOUT=30
```

## Configuración para Producción

### Optimizaciones de Producción
```bash
# .env.production
DEBUG_MODE=false
LOG_LEVEL=WARNING
ENABLE_COMPRESSION=true
MAX_WORKERS=8
CONNECTION_POOL_SIZE=20

# Configuración de seguridad estricta
STRICT_GUARDRAILS=true
REQUIRE_CONFIRMATION=true
ENABLE_AUDIT_LOGGING=true

# Configuración de backup
ENABLE_AUTO_BACKUP=true
BACKUP_INTERVAL=6
MAX_BACKUPS=30
```

### Deployment con Docker
```bash
# Construir imagen optimizada
docker build -f Dockerfile.prod -t local-agent:prod .

# Ejecutar en producción
docker run -d \
  --name local-agent-prod \
  --restart unless-stopped \
  -p 8000:8000 \
  -v /opt/agent/data:/app/data \
  -v /opt/agent/logs:/app/logs \
  --memory=2g \
  --cpus=2 \
  local-agent:prod
```

## Verificación Final

### Checklist de Instalación
- [ ] Python 3.8+ instalado
- [ ] Dependencias instaladas sin errores
- [ ] Archivo .env configurado con API keys
- [ ] Directorios de datos creados
- [ ] Base de datos vectorial inicializada
- [ ] Herramientas básicas funcionando
- [ ] Interfaz CLI accesible
- [ ] Logs generándose correctamente

### Test de Funcionalidad Completa
```bash
# Ejecutar suite de tests completa
python examples/complete_example.py

# Debería mostrar:
# ✅ Demo: Uso Básico del Agente Local
# ✅ Demo: Herramientas Personalizadas  
# ✅ Demo: Memoria y Contexto
# ✅ Demo: Seguridad y Guardrails
# ✅ Demo: Ejecución Paralela
# 🎉 Todas las demostraciones completadas exitosamente!
```
