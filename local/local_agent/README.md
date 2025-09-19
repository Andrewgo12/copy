# Local AI Agent - Espejo de Augment Agent

Un agente de IA local completo con capacidades de planificación, ejecución de herramientas, memoria persistente y sandboxing de seguridad.

## Arquitectura

```
local_agent/
├── core/                    # Motor principal del agente
│   ├── __init__.py
│   ├── planner.py          # Planificador de tareas
│   ├── executor.py         # Ejecutor de acciones
│   ├── memory.py           # Gestor de memoria
│   ├── context.py          # Motor de contexto
│   └── agent.py            # Clase principal del agente
├── tools/                   # Sistema de herramientas
│   ├── __init__.py
│   ├── base.py             # Clase base para herramientas
│   ├── registry.py         # Registro de herramientas
│   ├── file_tools.py       # Operaciones de archivos
│   ├── code_tools.py       # Análisis de código
│   ├── web_tools.py        # Búsqueda web
│   ├── system_tools.py     # Comandos del sistema
│   └── custom_tools.py     # Herramientas personalizadas
├── safety/                  # Sistema de seguridad
│   ├── __init__.py
│   ├── guardrails.py       # Reglas de seguridad
│   ├── sandbox.py          # Entorno aislado
│   ├── validator.py        # Validador de acciones
│   └── human_loop.py       # Intervención humana
├── storage/                 # Capa de almacenamiento
│   ├── __init__.py
│   ├── vector_db.py        # Base de datos vectorial
│   ├── sql_db.py           # Base de datos SQL
│   └── cache.py            # Sistema de caché
├── interfaces/              # Interfaces de usuario
│   ├── __init__.py
│   ├── cli.py              # Interfaz de línea de comandos
│   ├── web_ui.py           # Interfaz web
│   └── api.py              # API REST
├── config/                  # Configuración
│   ├── __init__.py
│   ├── settings.py         # Configuraciones generales
│   └── prompts.py          # Plantillas de prompts
├── tests/                   # Pruebas unitarias
│   ├── __init__.py
│   ├── test_core/
│   ├── test_tools/
│   └── test_safety/
├── requirements.txt         # Dependencias Python
├── docker-compose.yml       # Configuración Docker
├── .env.example            # Variables de entorno
└── main.py                 # Punto de entrada principal
```

## Instalación Rápida

```bash
# Clonar y configurar
git clone <repo>
cd local_agent
python -m venv venv
source venv/bin/activate  # Windows: venv\Scripts\activate
pip install -r requirements.txt

# Configurar variables de entorno
cp .env.example .env
# Editar .env con tus claves API

# Ejecutar
python main.py
```

## Características Principales

- 🧠 **Planificación Inteligente**: Descomposición automática de tareas complejas
- 🛠️ **Sistema de Herramientas Extensible**: Fácil adición de nuevas capacidades
- 💾 **Memoria Persistente**: Contexto a largo plazo con embeddings vectoriales
- 🔒 **Sandboxing Seguro**: Ejecución aislada de comandos peligrosos
- 🎯 **Human-in-the-Loop**: Confirmación para acciones críticas
- 📊 **Logging Completo**: Trazabilidad de todas las acciones
- 🌐 **Múltiples Interfaces**: CLI, Web UI, API REST

## Configuración Avanzada

Ver documentación en `/docs/` para:
- Configuración de modelos LLM locales
- Personalización de herramientas
- Configuración de seguridad
- Integración con VS Code
