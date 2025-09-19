"""
Punto de entrada principal del agente local
"""
import asyncio
import os
import sys
from pathlib import Path
from loguru import logger
from dotenv import load_dotenv

# Añadir el directorio raíz al path
sys.path.insert(0, str(Path(__file__).parent))

from core.agent import LocalAgent, AgentConfig
from interfaces.cli import CLIInterface


def setup_logging():
    """Configura el sistema de logging"""
    log_level = os.getenv("LOG_LEVEL", "INFO")
    log_file = os.getenv("LOG_FILE", "./data/logs/agent.log")
    
    # Crear directorio de logs
    Path(log_file).parent.mkdir(parents=True, exist_ok=True)
    
    # Configurar loguru
    logger.remove()  # Remover handler por defecto
    
    # Handler para consola
    logger.add(
        sys.stderr,
        level=log_level,
        format="<green>{time:YYYY-MM-DD HH:mm:ss}</green> | <level>{level: <8}</level> | <cyan>{name}</cyan>:<cyan>{function}</cyan>:<cyan>{line}</cyan> - <level>{message}</level>"
    )
    
    # Handler para archivo
    logger.add(
        log_file,
        level="DEBUG",
        format="{time:YYYY-MM-DD HH:mm:ss} | {level: <8} | {name}:{function}:{line} - {message}",
        rotation="10 MB",
        retention="7 days"
    )


def load_configuration() -> AgentConfig:
    """Carga la configuración del agente"""
    load_dotenv()
    
    return AgentConfig(
        llm_provider=os.getenv("LLM_PROVIDER", "openai"),
        llm_model=os.getenv("LLM_MODEL", "gpt-4"),
        max_iterations=int(os.getenv("MAX_ITERATIONS", "10")),
        enable_human_loop=os.getenv("ENABLE_HUMAN_LOOP", "true").lower() == "true",
        sandbox_mode=os.getenv("ENABLE_SANDBOX", "true").lower() == "true",
        memory_enabled=os.getenv("ENABLE_MEMORY", "true").lower() == "true",
        log_level=os.getenv("LOG_LEVEL", "INFO")
    )


async def main():
    """Función principal"""
    try:
        # Configurar logging
        setup_logging()
        logger.info("🚀 Iniciando Agente Local")
        
        # Cargar configuración
        config = load_configuration()
        logger.info(f"Configuración cargada: {config.llm_provider}:{config.llm_model}")
        
        # Verificar claves API
        if config.llm_provider == "openai" and not os.getenv("OPENAI_API_KEY"):
            logger.error("OPENAI_API_KEY no configurada")
            print("❌ Error: Configura OPENAI_API_KEY en el archivo .env")
            return
        
        if config.llm_provider == "anthropic" and not os.getenv("ANTHROPIC_API_KEY"):
            logger.error("ANTHROPIC_API_KEY no configurada")
            print("❌ Error: Configura ANTHROPIC_API_KEY en el archivo .env")
            return
        
        # Crear agente
        agent = LocalAgent(config)
        logger.info("✅ Agente creado exitosamente")
        
        # Iniciar interfaz CLI
        cli_interface = CLIInterface(agent)
        await cli_interface.start_interactive_session()
        
    except KeyboardInterrupt:
        logger.info("Programa interrumpido por el usuario")
    except Exception as e:
        logger.error(f"Error fatal: {e}")
        print(f"❌ Error fatal: {e}")
    finally:
        logger.info("🛑 Agente Local finalizado")


if __name__ == "__main__":
    # Verificar Python version
    if sys.version_info < (3, 8):
        print("❌ Error: Se requiere Python 3.8 o superior")
        sys.exit(1)
    
    # Ejecutar programa principal
    asyncio.run(main())
