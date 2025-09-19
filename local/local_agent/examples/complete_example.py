"""
Ejemplo completo de uso del agente local
Demuestra todas las capacidades principales del sistema
"""
import asyncio
import json
from pathlib import Path
import sys

# Añadir el directorio padre al path
sys.path.insert(0, str(Path(__file__).parent.parent))

from core.agent import LocalAgent, AgentConfig
from tools.base import ToolDefinition, ToolParameter, ToolCategory, RiskLevel
from tools.file_tools import ReadFileTool, WriteFileTool
from tools.system_tools import SystemCommandTool
from loguru import logger


class ExampleCustomTool:
    """Ejemplo de herramienta personalizada"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="example_calculator",
            description="Calculadora simple para operaciones matemáticas",
            category=ToolCategory.DATA_PROCESSING,
            risk_level=RiskLevel.SAFE,
            parameters=[
                ToolParameter(
                    name="operation",
                    type="string",
                    description="Operación matemática",
                    required=True,
                    allowed_values=["add", "subtract", "multiply", "divide"]
                ),
                ToolParameter(
                    name="a",
                    type="int",
                    description="Primer número",
                    required=True
                ),
                ToolParameter(
                    name="b", 
                    type="int",
                    description="Segundo número",
                    required=True
                )
            ],
            examples=[
                {"operation": "add", "a": 5, "b": 3},
                {"operation": "multiply", "a": 4, "b": 7}
            ]
        )
    
    async def execute(self, parameters):
        """Ejecuta la operación matemática"""
        try:
            operation = parameters["operation"]
            a = parameters["a"]
            b = parameters["b"]
            
            operations = {
                "add": lambda x, y: x + y,
                "subtract": lambda x, y: x - y,
                "multiply": lambda x, y: x * y,
                "divide": lambda x, y: x / y if y != 0 else None
            }
            
            if operation not in operations:
                return {
                    "success": False,
                    "result": None,
                    "error": f"Operación no válida: {operation}",
                    "metadata": {}
                }
            
            result = operations[operation](a, b)
            
            if result is None:
                return {
                    "success": False,
                    "result": None,
                    "error": "División por cero",
                    "metadata": {"operation": operation, "a": a, "b": b}
                }
            
            return {
                "success": True,
                "result": {
                    "operation": operation,
                    "operands": [a, b],
                    "result": result
                },
                "error": None,
                "metadata": {
                    "operation": operation,
                    "execution_time": 0.001
                }
            }
            
        except Exception as e:
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"operation": parameters.get("operation")}
            }


async def demo_basic_usage():
    """Demostración de uso básico del agente"""
    
    print("🚀 Demo: Uso Básico del Agente Local")
    print("=" * 50)
    
    # Crear configuración
    config = AgentConfig(
        llm_provider="openai",  # Cambiar según tu configuración
        llm_model="gpt-4",
        enable_human_loop=False,  # Deshabilitado para demo automática
        sandbox_mode=True,
        memory_enabled=True
    )
    
    # Crear agente
    agent = LocalAgent(config)
    
    # Ejemplos de solicitudes
    test_requests = [
        "Lee el archivo README.md si existe",
        "Lista los archivos en el directorio actual",
        "Crea un archivo de ejemplo con código Python",
        "Ejecuta el comando 'python --version'",
        "Busca información sobre FastAPI en internet"
    ]
    
    for i, request in enumerate(test_requests, 1):
        print(f"\n📝 Solicitud {i}: {request}")
        print("-" * 40)
        
        try:
            # Procesar solicitud
            response = await agent.process_request(request)
            
            # Mostrar respuesta
            print(f"✅ Respuesta: {response['response'][:200]}...")
            
            # Mostrar metadatos
            if "metadata" in response:
                metadata = response["metadata"]
                print(f"📊 Acciones ejecutadas: {metadata.get('actions_executed', 0)}")
                print(f"🧠 Contexto usado: {metadata.get('context_used', 0)} elementos")
            
        except Exception as e:
            print(f"❌ Error: {e}")
        
        # Pausa entre solicitudes
        await asyncio.sleep(1)
    
    # Mostrar resumen de memoria
    print(f"\n🧠 Resumen de Memoria:")
    memory_summary = await agent.get_memory_summary()
    print(json.dumps(memory_summary, indent=2))
    
    # Cerrar agente
    await agent.shutdown()
    print("\n✅ Demo completada")


async def demo_custom_tools():
    """Demostración de herramientas personalizadas"""
    
    print("\n🛠️ Demo: Herramientas Personalizadas")
    print("=" * 50)
    
    config = AgentConfig(enable_human_loop=False)
    agent = LocalAgent(config)
    
    # Registrar herramienta personalizada
    custom_tool = ExampleCustomTool()
    await agent.add_custom_tool(custom_tool.get_definition().to_dict())
    
    # Usar la herramienta personalizada
    request = "Calcula 15 multiplicado por 8 usando la calculadora"
    
    print(f"📝 Solicitud: {request}")
    response = await agent.process_request(request)
    
    print(f"✅ Respuesta: {response['response']}")
    
    await agent.shutdown()


async def demo_memory_and_context():
    """Demostración del sistema de memoria y contexto"""
    
    print("\n🧠 Demo: Memoria y Contexto")
    print("=" * 50)
    
    config = AgentConfig(
        memory_enabled=True,
        enable_human_loop=False
    )
    agent = LocalAgent(config)
    
    # Secuencia de solicitudes que construyen contexto
    context_requests = [
        "Mi nombre es Juan y soy desarrollador Python",
        "Prefiero usar FastAPI para APIs REST",
        "Estoy trabajando en un proyecto de machine learning",
        "¿Qué framework me recomendarías para mi proyecto basado en mis preferencias?"
    ]
    
    for i, request in enumerate(context_requests, 1):
        print(f"\n📝 Solicitud {i}: {request}")
        
        response = await agent.process_request(request)
        print(f"✅ Respuesta: {response['response'][:150]}...")
        
        # Mostrar cómo evoluciona la memoria
        if i == len(context_requests):
            memory_summary = await agent.get_memory_summary()
            print(f"\n🧠 Estado final de memoria:")
            print(f"  - Preferencias: {memory_summary.get('user_preferences', {})}")
            print(f"  - Entradas a corto plazo: {memory_summary.get('short_term_memory', {}).get('total_entries', 0)}")
    
    await agent.shutdown()


async def demo_safety_and_guardrails():
    """Demostración del sistema de seguridad"""
    
    print("\n🔒 Demo: Seguridad y Guardrails")
    print("=" * 50)
    
    config = AgentConfig(
        sandbox_mode=True,
        enable_human_loop=False  # Para demo automática
    )
    agent = LocalAgent(config)
    
    # Solicitudes que activan diferentes guardrails
    safety_tests = [
        "Ejecuta el comando 'ls -la'",  # Seguro
        "Ejecuta el comando 'rm -rf /'",  # Peligroso - debería bloquearse
        "Instala el paquete requests con pip",  # Requiere confirmación
        "Lee el archivo /etc/passwd",  # Archivo del sistema - debería bloquearse
        "Crea un archivo en el directorio actual"  # Seguro
    ]
    
    for i, request in enumerate(safety_tests, 1):
        print(f"\n🧪 Test {i}: {request}")
        
        try:
            response = await agent.process_request(request)
            
            if response.get("error"):
                print(f"🛡️ Bloqueado por seguridad: {response['response']}")
            else:
                print(f"✅ Permitido: {response['response'][:100]}...")
                
        except Exception as e:
            print(f"❌ Error: {e}")
    
    # Mostrar estadísticas de seguridad
    safety_stats = agent.safety.get_stats()
    print(f"\n📊 Estadísticas de Seguridad:")
    print(f"  - Reglas activas: {safety_stats['total_rules']}")
    print(f"  - Violaciones detectadas: {safety_stats['violation_count']}")
    
    await agent.shutdown()


async def demo_parallel_execution():
    """Demostración de ejecución paralela de tareas"""
    
    print("\n⚡ Demo: Ejecución Paralela")
    print("=" * 50)
    
    config = AgentConfig(enable_human_loop=False)
    agent = LocalAgent(config)
    
    # Solicitud que puede ejecutarse en paralelo
    request = """
    Realiza las siguientes tareas en paralelo:
    1. Lista los archivos en el directorio actual
    2. Verifica la versión de Python
    3. Crea un archivo temporal con contenido de ejemplo
    """
    
    print(f"📝 Solicitud compleja: {request}")
    
    start_time = asyncio.get_event_loop().time()
    response = await agent.process_request(request)
    execution_time = asyncio.get_event_loop().time() - start_time
    
    print(f"✅ Completado en {execution_time:.2f} segundos")
    print(f"📄 Respuesta: {response['response'][:200]}...")
    
    # Mostrar plan ejecutado
    if "plan" in response:
        plan = response["plan"]
        print(f"\n📋 Plan ejecutado:")
        for action in plan.get("actions", []):
            print(f"  - {action.get('description', 'Sin descripción')}")
    
    await agent.shutdown()


async def main():
    """Función principal que ejecuta todas las demostraciones"""
    
    print("🤖 AGENTE LOCAL - DEMOSTRACIONES COMPLETAS")
    print("=" * 60)
    
    # Configurar logging para las demos
    logger.remove()
    logger.add(
        sys.stderr,
        level="INFO",
        format="<green>{time:HH:mm:ss}</green> | <level>{level}</level> | {message}"
    )
    
    try:
        # Ejecutar todas las demostraciones
        await demo_basic_usage()
        await demo_custom_tools()
        await demo_memory_and_context()
        await demo_safety_and_guardrails()
        await demo_parallel_execution()
        
        print("\n🎉 Todas las demostraciones completadas exitosamente!")
        
    except KeyboardInterrupt:
        print("\n⚠️ Demostraciones interrumpidas por el usuario")
    except Exception as e:
        print(f"\n❌ Error en demostraciones: {e}")
        logger.error(f"Error en demo: {e}")


if __name__ == "__main__":
    # Verificar que las dependencias estén instaladas
    try:
        import langchain
        import chromadb
        import rich
    except ImportError as e:
        print(f"❌ Dependencia faltante: {e}")
        print("Ejecuta: pip install -r requirements.txt")
        sys.exit(1)
    
    # Ejecutar demostraciones
    asyncio.run(main())
