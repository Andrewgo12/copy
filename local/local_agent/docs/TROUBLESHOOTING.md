# Guía de Solución de Problemas

## Problemas de Instalación

### Error: "Python version not supported"
**Síntoma**: Error durante instalación sobre versión de Python
**Causa**: Python < 3.8
**Solución**:
```bash
# Verificar versión actual
python --version

# Instalar Python 3.11 (recomendado)
# Ubuntu/Debian:
sudo apt update
sudo apt install python3.11 python3.11-venv

# macOS con Homebrew:
brew install python@3.11

# Windows: Descargar desde python.org
```

### Error: "pip install failed"
**Síntoma**: Falla instalación de dependencias
**Causa**: Problemas de red, permisos o dependencias del sistema
**Solución**:
```bash
# Actualizar pip
python -m pip install --upgrade pip

# Instalar con verbose para ver detalles
pip install -r requirements.txt -v

# Si falla una dependencia específica:
pip install --no-deps nombre-paquete

# En sistemas Linux, instalar dependencias del sistema:
sudo apt install build-essential python3-dev
```

### Error: "ChromaDB initialization failed"
**Síntoma**: Error al inicializar base de datos vectorial
**Causa**: Permisos de directorio o dependencias faltantes
**Solución**:
```bash
# Limpiar directorio de base de datos
rm -rf data/vector_db/*

# Verificar permisos
chmod -R 755 data/

# Reinstalar ChromaDB
pip uninstall chromadb
pip install chromadb

# En Windows, ejecutar como administrador si es necesario
```

## Problemas de Configuración

### Error: "API key not found"
**Síntoma**: Error sobre clave API faltante
**Causa**: Archivo .env mal configurado
**Solución**:
```bash
# Verificar que .env existe
ls -la .env

# Verificar contenido
cat .env | grep API_KEY

# Formato correcto:
OPENAI_API_KEY=sk-tu-clave-real-aqui
# NO usar comillas, espacios extra, etc.

# Verificar que se carga correctamente:
python -c "
import os
from dotenv import load_dotenv
load_dotenv()
print('OpenAI:', 'CONFIGURADA' if os.getenv('OPENAI_API_KEY') else 'FALTANTE')
"
```

### Error: "Permission denied" en operaciones de archivos
**Síntoma**: No puede leer/escribir archivos
**Causa**: Permisos insuficientes
**Solución**:
```bash
# Verificar permisos del directorio actual
ls -la

# Cambiar permisos si es necesario
chmod -R 755 .

# En Windows, verificar que no está en directorio protegido
# Mover proyecto a Documents/ o Desktop/

# Verificar que no hay antivirus bloqueando
```

## Problemas de Ejecución

### Error: "Tool execution timeout"
**Síntoma**: Herramientas fallan por timeout
**Causa**: Operaciones muy lentas o configuración incorrecta
**Solución**:
```bash
# Aumentar timeout en .env
MAX_EXECUTION_TIME=600

# Verificar recursos del sistema
python -c "
import psutil
print(f'CPU: {psutil.cpu_percent()}%')
print(f'RAM: {psutil.virtual_memory().percent}%')
print(f'Disco: {psutil.disk_usage(\".\").percent}%')
"

# Si recursos están altos, cerrar aplicaciones innecesarias
```

### Error: "LLM connection failed"
**Síntoma**: No puede conectar con el modelo LLM
**Causa**: Problemas de red, API key inválida, o límites de rate
**Solución**:
```bash
# Verificar conectividad
curl -I https://api.openai.com/v1/models

# Verificar API key
curl -H "Authorization: Bearer $OPENAI_API_KEY" \
     https://api.openai.com/v1/models

# Verificar límites de rate en dashboard de OpenAI
# Esperar si has excedido límites

# Cambiar a modelo más barato temporalmente:
LLM_MODEL=gpt-3.5-turbo
```

### Error: "Memory storage failed"
**Síntoma**: Error guardando en memoria
**Causa**: Base de datos corrupta o espacio insuficiente
**Solución**:
```bash
# Verificar espacio en disco
df -h .

# Limpiar memoria corrupta
rm -rf data/vector_db/*
rm -rf data/cache/*

# Reinicializar base de datos
python -c "
from storage.vector_db import VectorDatabase
db = VectorDatabase()
print('✅ Base de datos reinicializada')
"
```

## Problemas de Rendimiento

### Agente muy lento
**Síntomas**: Respuestas tardan mucho tiempo
**Diagnóstico**:
```bash
# Verificar logs para identificar cuellos de botella
tail -f data/logs/agent.log

# Verificar uso de recursos
top  # Linux/macOS
# o
taskmgr  # Windows
```

**Soluciones**:
```bash
# 1. Reducir contexto máximo
echo "MAX_CONTEXT_ITEMS=10" >> .env

# 2. Deshabilitar memoria si no es necesaria
echo "ENABLE_MEMORY=false" >> .env

# 3. Usar modelo más rápido
echo "LLM_MODEL=gpt-3.5-turbo" >> .env

# 4. Aumentar workers
echo "MAX_WORKERS=2" >> .env

# 5. Limpiar caché
rm -rf data/cache/*
```

### Memoria RAM alta
**Síntomas**: Agente consume mucha memoria
**Soluciones**:
```bash
# Reducir memoria a corto plazo
echo "MAX_SHORT_TERM_MEMORY=50" >> .env

# Limpiar memoria vectorial antigua
python -c "
from storage.vector_db import VectorDatabase
db = VectorDatabase()
# Implementar limpieza de documentos antiguos
"

# Reiniciar agente periódicamente
```

## Problemas de Seguridad

### Guardrails muy restrictivos
**Síntoma**: Muchas acciones bloqueadas
**Solución**:
```bash
# Revisar reglas activas
python -c "
from safety.guardrails import SafetyGuardrails
from core.agent import AgentConfig
config = AgentConfig()
safety = SafetyGuardrails(config)
rules = safety.list_rules()
for rule in rules:
    print(f'{rule[\"name\"]}: {rule[\"severity\"]}')
"

# Deshabilitar regla específica (temporal)
# En el código, añadir:
# safety.disable_rule("nombre_regla")

# O modificar configuración
echo "STRICT_GUARDRAILS=false" >> .env
```

### Sandbox no funciona
**Síntoma**: Comandos del sistema fallan
**Causa**: Docker no disponible o mal configurado
**Solución**:
```bash
# Verificar Docker
docker --version
docker ps

# Si Docker no está disponible, deshabilitar sandbox
echo "ENABLE_SANDBOX=false" >> .env

# ⚠️ ADVERTENCIA: Solo para desarrollo/testing
# En producción, usar siempre sandbox
```

## Problemas Específicos por SO

### Windows

#### Error: "venv\Scripts\activate no reconocido"
```powershell
# Cambiar política de ejecución
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser

# O usar activación alternativa
venv\Scripts\Activate.ps1
```

#### Error: "Microsoft Visual C++ required"
```bash
# Instalar Build Tools para Visual Studio
# Descargar desde: https://visualstudio.microsoft.com/visual-cpp-build-tools/

# O instalar paquetes precompilados
pip install --only-binary=all -r requirements.txt
```

### macOS

#### Error: "Command Line Tools not found"
```bash
# Instalar Xcode Command Line Tools
xcode-select --install

# Verificar instalación
xcode-select -p
```

#### Error: "Permission denied" en /usr/local
```bash
# Usar Homebrew para gestión de paquetes
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Instalar Python con Homebrew
brew install python@3.11
```

### Linux

#### Error: "python3-venv not found"
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install python3-venv python3-pip

# CentOS/RHEL
sudo yum install python3-venv python3-pip

# Arch Linux
sudo pacman -S python-virtualenv python-pip
```

#### Error: "gcc not found"
```bash
# Ubuntu/Debian
sudo apt install build-essential

# CentOS/RHEL
sudo yum groupinstall "Development Tools"

# Arch Linux
sudo pacman -S base-devel
```

## Herramientas de Diagnóstico

### Script de Diagnóstico Automático
```python
# diagnostics.py
import sys
import subprocess
import platform
from pathlib import Path

def run_diagnostics():
    """Ejecuta diagnósticos completos del sistema"""
    
    print("🔍 DIAGNÓSTICO DEL SISTEMA")
    print("=" * 40)
    
    # Sistema operativo
    print(f"OS: {platform.system()} {platform.release()}")
    print(f"Python: {sys.version}")
    
    # Verificar archivos críticos
    critical_files = [
        "requirements.txt", "main.py", ".env", 
        "core/agent.py", "tools/base.py"
    ]
    
    print("\n📁 Archivos críticos:")
    for file in critical_files:
        exists = "✅" if Path(file).exists() else "❌"
        print(f"  {exists} {file}")
    
    # Verificar dependencias
    print("\n📦 Dependencias:")
    dependencies = [
        "langchain", "chromadb", "fastapi", 
        "openai", "anthropic", "rich"
    ]
    
    for dep in dependencies:
        try:
            __import__(dep)
            print(f"  ✅ {dep}")
        except ImportError:
            print(f"  ❌ {dep}")
    
    # Verificar configuración
    print("\n⚙️ Configuración:")
    try:
        from dotenv import load_dotenv
        import os
        load_dotenv()
        
        configs = [
            ("OPENAI_API_KEY", bool(os.getenv("OPENAI_API_KEY"))),
            ("VECTOR_DB_PATH", Path(os.getenv("VECTOR_DB_PATH", "")).exists()),
            ("LOG_LEVEL", bool(os.getenv("LOG_LEVEL")))
        ]
        
        for config, status in configs:
            status_icon = "✅" if status else "❌"
            print(f"  {status_icon} {config}")
            
    except Exception as e:
        print(f"  ❌ Error cargando configuración: {e}")

if __name__ == "__main__":
    run_diagnostics()
```

### Verificación de Conectividad
```python
# test_connectivity.py
import asyncio
import aiohttp
import os
from dotenv import load_dotenv

async def test_api_connectivity():
    """Prueba conectividad con APIs externas"""
    load_dotenv()
    
    tests = []
    
    # Test OpenAI
    openai_key = os.getenv("OPENAI_API_KEY")
    if openai_key:
        try:
            async with aiohttp.ClientSession() as session:
                headers = {"Authorization": f"Bearer {openai_key}"}
                async with session.get(
                    "https://api.openai.com/v1/models",
                    headers=headers,
                    timeout=10
                ) as response:
                    if response.status == 200:
                        tests.append("✅ OpenAI API - Conectado")
                    else:
                        tests.append(f"❌ OpenAI API - Error {response.status}")
        except Exception as e:
            tests.append(f"❌ OpenAI API - Error: {e}")
    else:
        tests.append("⚠️ OpenAI API - No configurada")
    
    # Test conectividad general
    try:
        async with aiohttp.ClientSession() as session:
            async with session.get("https://httpbin.org/ip", timeout=5) as response:
                if response.status == 200:
                    tests.append("✅ Conectividad Internet - OK")
                else:
                    tests.append("❌ Conectividad Internet - Problemas")
    except Exception as e:
        tests.append(f"❌ Conectividad Internet - Error: {e}")
    
    return tests

# Ejecutar tests
if __name__ == "__main__":
    results = asyncio.run(test_api_connectivity())
    for result in results:
        print(result)
```

## Logs y Debugging

### Habilitar Logging Detallado
```bash
# En .env
LOG_LEVEL=DEBUG
ENABLE_TOOL_LOGGING=true

# Ver logs en tiempo real
tail -f data/logs/agent.log

# En Windows
Get-Content data\logs\agent.log -Wait
```

### Interpretar Logs Comunes
```
# Log normal de ejecución
2024-01-15 10:30:15 | INFO | core.agent:process_request:45 - Procesando solicitud del usuario
2024-01-15 10:30:15 | DEBUG | core.planner:create_plan:78 - Plan creado: 3 acciones
2024-01-15 10:30:16 | INFO | core.executor:execute_plan:123 - Ejecutando plan: uuid-here

# Error de herramienta
2024-01-15 10:30:17 | ERROR | tools.file_tools:execute:89 - Error leyendo archivo: Permission denied

# Violación de guardrails
2024-01-15 10:30:18 | WARNING | safety.guardrails:evaluate_action:156 - Violación: comando peligroso detectado
```

### Debug Interactivo
```python
# Añadir breakpoints en el código
import pdb; pdb.set_trace()

# O usar debugger moderno
import ipdb; ipdb.set_trace()

# Ejecutar con debugger
python -m pdb main.py
```

## Problemas de Rendimiento

### Optimización de Memoria
```python
# memory_optimizer.py
import gc
import psutil
from storage.vector_db import VectorDatabase

async def optimize_memory():
    """Optimiza uso de memoria del agente"""
    
    # 1. Limpiar caché de archivos
    from core.context import ContextEngine
    context_engine = ContextEngine(None)
    context_engine.file_cache.clear()
    
    # 2. Compactar base de datos vectorial
    db = VectorDatabase()
    # Implementar compactación
    
    # 3. Forzar garbage collection
    gc.collect()
    
    # 4. Mostrar uso actual
    memory = psutil.virtual_memory()
    print(f"Memoria usada: {memory.percent}%")
    print(f"Memoria disponible: {memory.available / 1024**3:.1f}GB")

if __name__ == "__main__":
    import asyncio
    asyncio.run(optimize_memory())
```

### Optimización de Velocidad
```bash
# Configuraciones para mejor rendimiento
echo "MAX_CONTEXT_ITEMS=5" >> .env
echo "MEMORY_IMPORTANCE_THRESHOLD=0.5" >> .env
echo "MAX_SHORT_TERM_MEMORY=25" >> .env
echo "ENABLE_COMPRESSION=true" >> .env
```

## Problemas de Seguridad

### Sandbox no funciona en Windows
```bash
# Alternativa: usar subprocess con restricciones
echo "ENABLE_SANDBOX=false" >> .env
echo "SANDBOX_PROVIDER=subprocess" >> .env

# ⚠️ Menos seguro, solo para desarrollo
```

### Comandos bloqueados incorrectamente
```python
# Modificar guardrails temporalmente
from safety.guardrails import SafetyGuardrails

# En core/agent.py, después de crear safety:
# safety.disable_rule("nombre_regla_especifica")

# O crear regla personalizada menos restrictiva
custom_rule = GuardrailRule(
    name="allow_my_command",
    pattern="mi_comando_especifico",
    action=ActionDecision.ALLOW,
    applies_to=["system_command"],
    severity="low",
    message="Comando personalizado permitido"
)
safety.add_custom_rule(custom_rule)
```

## Recuperación de Datos

### Backup de Memoria
```python
# backup_memory.py
import asyncio
from storage.vector_db import VectorDatabase

async def backup_all_memory():
    """Crea backup completo de la memoria"""
    db = VectorDatabase()
    
    collections = ["conversations", "code_context", "web_knowledge"]
    
    for collection in collections:
        backup_file = f"backup_{collection}_{int(time.time())}.json"
        success = await db.backup_collection(collection, backup_file)
        print(f"Backup {collection}: {'✅' if success else '❌'}")

asyncio.run(backup_all_memory())
```

### Restaurar desde Backup
```python
# restore_memory.py
import asyncio
import json
from storage.vector_db import VectorDatabase

async def restore_from_backup(backup_file):
    """Restaura memoria desde backup"""
    db = VectorDatabase()
    
    with open(backup_file, 'r') as f:
        backup_data = json.load(f)
    
    collection_name = backup_data["collection_name"]
    
    # Limpiar colección actual
    await db.clear_collection(collection_name)
    
    # Restaurar documentos
    collection = db.collections[collection_name]
    collection.add(
        documents=backup_data["documents"],
        metadatas=backup_data["metadatas"],
        ids=backup_data["ids"]
    )
    
    print(f"✅ Memoria restaurada: {collection_name}")

# Uso: asyncio.run(restore_from_backup("backup_conversations_123456.json"))
```

## Contacto y Soporte

### Información de Debug para Reportes
```bash
# Generar reporte de debug completo
python -c "
import sys, platform, subprocess
print('=== REPORTE DE DEBUG ===')
print(f'Python: {sys.version}')
print(f'OS: {platform.platform()}')
print(f'Directorio: {os.getcwd()}')

# Versiones de dependencias clave
deps = ['langchain', 'chromadb', 'fastapi', 'openai']
for dep in deps:
    try:
        mod = __import__(dep)
        version = getattr(mod, '__version__', 'unknown')
        print(f'{dep}: {version}')
    except ImportError:
        print(f'{dep}: NOT INSTALLED')

print('========================')
"
```

### Logs para Soporte
```bash
# Crear paquete de logs para soporte
tar -czf debug_logs.tar.gz data/logs/ .env config/

# En Windows
powershell Compress-Archive -Path data\logs\,config\ -DestinationPath debug_logs.zip
```

**Al reportar problemas, incluye:**
1. Reporte de debug completo
2. Logs relevantes (últimas 100 líneas)
3. Pasos exactos para reproducir
4. Configuración (sin API keys)
5. Mensaje de error completo
