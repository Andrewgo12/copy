"""
Clase principal del agente local - Orquesta todos los componentes
"""
import asyncio
import uuid
from typing import Dict, List, Any, Optional
from dataclasses import dataclass
from loguru import logger

from .planner import TaskPlanner
from .executor import ActionExecutor
from .memory import MemoryManager
from .context import ContextEngine
from ..tools.registry import ToolRegistry
from ..safety.guardrails import SafetyGuardrails
from ..storage.vector_db import VectorDatabase


@dataclass
class AgentConfig:
    """Configuración del agente"""
    llm_provider: str = "openai"  # openai, anthropic, local
    llm_model: str = "gpt-4"
    max_iterations: int = 10
    enable_human_loop: bool = True
    sandbox_mode: bool = True
    memory_enabled: bool = True
    log_level: str = "INFO"


class LocalAgent:
    """
    Agente de IA local completo con capacidades de planificación,
    ejecución de herramientas, memoria y seguridad.
    """
    
    def __init__(self, config: AgentConfig):
        self.config = config
        self.session_id = str(uuid.uuid4())
        
        # Inicializar componentes principales
        self.vector_db = VectorDatabase()
        self.memory = MemoryManager(self.vector_db)
        self.context = ContextEngine(self.vector_db)
        self.tool_registry = ToolRegistry()
        self.safety = SafetyGuardrails(config)
        self.planner = TaskPlanner(config, self.memory, self.context)
        self.executor = ActionExecutor(
            self.tool_registry, 
            self.safety, 
            config
        )
        
        # Estado de la conversación
        self.conversation_history: List[Dict] = []
        self.current_task: Optional[str] = None
        
        logger.info(f"Agente inicializado - Sesión: {self.session_id}")
    
    async def process_request(self, user_input: str) -> Dict[str, Any]:
        """
        Procesa una solicitud del usuario de principio a fin
        
        Args:
            user_input: Entrada del usuario
            
        Returns:
            Respuesta completa con resultados y metadatos
        """
        try:
            # 1. Registrar entrada del usuario
            await self._log_interaction("user", user_input)
            
            # 2. Recuperar contexto relevante
            context = await self.context.get_relevant_context(
                user_input, 
                self.session_id
            )
            
            # 3. Planificar acciones
            plan = await self.planner.create_plan(
                user_input, 
                context, 
                self.conversation_history
            )
            
            logger.info(f"Plan creado: {len(plan.actions)} acciones")
            
            # 4. Ejecutar plan
            results = await self.executor.execute_plan(plan)
            
            # 5. Generar respuesta final
            response = await self.planner.generate_response(
                user_input, 
                plan, 
                results
            )
            
            # 6. Actualizar memoria
            await self.memory.store_interaction(
                user_input, 
                response, 
                plan, 
                results,
                self.session_id
            )
            
            # 7. Registrar respuesta
            await self._log_interaction("assistant", response)
            
            return {
                "response": response,
                "plan": plan.to_dict(),
                "results": results,
                "session_id": self.session_id,
                "metadata": {
                    "actions_executed": len(results),
                    "context_used": len(context),
                    "safety_checks": self.safety.get_stats()
                }
            }
            
        except Exception as e:
            logger.error(f"Error procesando solicitud: {e}")
            return {
                "response": f"Error interno: {str(e)}",
                "error": True,
                "session_id": self.session_id
            }
    
    async def _log_interaction(self, role: str, content: str):
        """Registra una interacción en el historial"""
        interaction = {
            "role": role,
            "content": content,
            "timestamp": asyncio.get_event_loop().time(),
            "session_id": self.session_id
        }
        self.conversation_history.append(interaction)
        
        # Mantener solo las últimas 50 interacciones en memoria
        if len(self.conversation_history) > 50:
            self.conversation_history = self.conversation_history[-50:]
    
    async def get_available_tools(self) -> List[Dict]:
        """Retorna lista de herramientas disponibles"""
        return await self.tool_registry.list_tools()
    
    async def add_custom_tool(self, tool_definition: Dict):
        """Añade una herramienta personalizada"""
        await self.tool_registry.register_tool(tool_definition)
    
    async def get_memory_summary(self) -> Dict:
        """Retorna resumen de la memoria del agente"""
        return await self.memory.get_summary(self.session_id)
    
    async def clear_session(self):
        """Limpia la sesión actual"""
        self.conversation_history.clear()
        self.session_id = str(uuid.uuid4())
        logger.info(f"Nueva sesión iniciada: {self.session_id}")
    
    async def shutdown(self):
        """Cierra el agente de forma limpia"""
        logger.info("Cerrando agente...")
        await self.vector_db.close()
        await self.memory.close()
        logger.info("Agente cerrado correctamente")


# Función de conveniencia para crear agente con configuración por defecto
def create_agent(
    llm_provider: str = "openai",
    llm_model: str = "gpt-4",
    enable_sandbox: bool = True
) -> LocalAgent:
    """Crea un agente con configuración estándar"""
    config = AgentConfig(
        llm_provider=llm_provider,
        llm_model=llm_model,
        sandbox_mode=enable_sandbox,
        enable_human_loop=True,
        memory_enabled=True
    )
    return LocalAgent(config)
