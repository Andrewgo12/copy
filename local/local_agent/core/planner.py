"""
Task Planner - Descompone solicitudes en planes ejecutables
"""
import json
from typing import List, Dict, Any, Optional
from dataclasses import dataclass, asdict
from enum import Enum
from loguru import logger

from langchain.llms.base import BaseLLM
from langchain.prompts import PromptTemplate
from langchain.schema import HumanMessage, SystemMessage

from .memory import MemoryManager
from .context import ContextEngine


class ActionType(Enum):
    """Tipos de acciones que puede ejecutar el agente"""
    FILE_READ = "file_read"
    FILE_WRITE = "file_write"
    CODE_ANALYSIS = "code_analysis"
    WEB_SEARCH = "web_search"
    SYSTEM_COMMAND = "system_command"
    MEMORY_QUERY = "memory_query"
    HUMAN_INPUT = "human_input"


@dataclass
class Action:
    """Representa una acción individual en el plan"""
    id: str
    type: ActionType
    tool_name: str
    parameters: Dict[str, Any]
    description: str
    depends_on: List[str] = None  # IDs de acciones prerequisito
    requires_confirmation: bool = False
    estimated_duration: int = 30  # segundos
    
    def to_dict(self) -> Dict:
        return asdict(self)


@dataclass
class ExecutionPlan:
    """Plan completo de ejecución"""
    id: str
    user_request: str
    actions: List[Action]
    estimated_total_time: int
    risk_level: str  # low, medium, high
    requires_human_approval: bool = False
    
    def to_dict(self) -> Dict:
        return {
            "id": self.id,
            "user_request": self.user_request,
            "actions": [action.to_dict() for action in self.actions],
            "estimated_total_time": self.estimated_total_time,
            "risk_level": self.risk_level,
            "requires_human_approval": self.requires_human_approval
        }


class TaskPlanner:
    """
    Planificador de tareas que convierte solicitudes de usuario
    en planes ejecutables paso a paso
    """
    
    def __init__(self, config, memory: MemoryManager, context: ContextEngine):
        self.config = config
        self.memory = memory
        self.context = context
        self.llm = self._initialize_llm()
        
        # Template para planificación
        self.planning_template = PromptTemplate(
            input_variables=["user_request", "context", "available_tools", "conversation_history"],
            template="""
Eres un planificador experto de tareas para un agente de IA local.

SOLICITUD DEL USUARIO:
{user_request}

CONTEXTO RELEVANTE:
{context}

HERRAMIENTAS DISPONIBLES:
{available_tools}

HISTORIAL DE CONVERSACIÓN:
{conversation_history}

Tu tarea es crear un plan detallado de acciones para cumplir la solicitud del usuario.

REGLAS IMPORTANTES:
1. Descompón la tarea en acciones atómicas y específicas
2. Cada acción debe usar una herramienta disponible
3. Especifica dependencias entre acciones si las hay
4. Marca acciones peligrosas que requieren confirmación humana
5. Estima el tiempo de cada acción
6. Evalúa el nivel de riesgo general (low/medium/high)

FORMATO DE RESPUESTA (JSON):
{{
    "reasoning": "Explicación de tu razonamiento",
    "actions": [
        {{
            "id": "action_1",
            "type": "file_read",
            "tool_name": "read_file",
            "parameters": {{"path": "example.py"}},
            "description": "Leer archivo de ejemplo",
            "depends_on": [],
            "requires_confirmation": false,
            "estimated_duration": 10
        }}
    ],
    "risk_level": "low",
    "requires_human_approval": false,
    "estimated_total_time": 60
}}

Responde SOLO con el JSON válido:
"""
        )
    
    def _initialize_llm(self) -> BaseLLM:
        """Inicializa el modelo LLM según la configuración"""
        if self.config.llm_provider == "openai":
            from langchain.llms import OpenAI
            return OpenAI(model_name=self.config.llm_model)
        elif self.config.llm_provider == "anthropic":
            from langchain.llms import Anthropic
            return Anthropic(model=self.config.llm_model)
        else:
            raise ValueError(f"Proveedor LLM no soportado: {self.config.llm_provider}")
    
    async def create_plan(
        self, 
        user_request: str, 
        context: Dict, 
        conversation_history: List[Dict]
    ) -> ExecutionPlan:
        """
        Crea un plan de ejecución para la solicitud del usuario
        
        Args:
            user_request: Solicitud original del usuario
            context: Contexto relevante recuperado
            conversation_history: Historial de la conversación
            
        Returns:
            Plan de ejecución completo
        """
        try:
            # Obtener herramientas disponibles
            available_tools = await self._get_available_tools_description()
            
            # Formatear historial para el prompt
            history_text = self._format_conversation_history(conversation_history)
            
            # Generar prompt
            prompt = self.planning_template.format(
                user_request=user_request,
                context=json.dumps(context, indent=2),
                available_tools=available_tools,
                conversation_history=history_text
            )
            
            # Llamar al LLM
            response = await self.llm.agenerate([prompt])
            plan_json = json.loads(response.generations[0][0].text)
            
            # Convertir a objetos Action
            actions = []
            for action_data in plan_json["actions"]:
                action = Action(
                    id=action_data["id"],
                    type=ActionType(action_data["type"]),
                    tool_name=action_data["tool_name"],
                    parameters=action_data["parameters"],
                    description=action_data["description"],
                    depends_on=action_data.get("depends_on", []),
                    requires_confirmation=action_data.get("requires_confirmation", False),
                    estimated_duration=action_data.get("estimated_duration", 30)
                )
                actions.append(action)
            
            # Crear plan de ejecución
            plan = ExecutionPlan(
                id=str(uuid.uuid4()),
                user_request=user_request,
                actions=actions,
                estimated_total_time=plan_json.get("estimated_total_time", 0),
                risk_level=plan_json.get("risk_level", "medium"),
                requires_human_approval=plan_json.get("requires_human_approval", False)
            )
            
            logger.info(f"Plan creado: {len(actions)} acciones, riesgo: {plan.risk_level}")
            return plan
            
        except Exception as e:
            logger.error(f"Error creando plan: {e}")
            # Plan de fallback simple
            return self._create_fallback_plan(user_request)
    
    async def _get_available_tools_description(self) -> str:
        """Obtiene descripción de herramientas disponibles"""
        # Esto se conectaría con el ToolRegistry
        tools = [
            "read_file: Lee contenido de archivos",
            "write_file: Escribe o modifica archivos", 
            "execute_command: Ejecuta comandos del sistema",
            "web_search: Busca información en internet",
            "code_analysis: Analiza código fuente",
            "memory_query: Consulta memoria del agente"
        ]
        return "\n".join(tools)
    
    def _format_conversation_history(self, history: List[Dict]) -> str:
        """Formatea el historial para incluir en el prompt"""
        if not history:
            return "Sin historial previo"
        
        formatted = []
        for item in history[-5:]:  # Solo últimas 5 interacciones
            role = item["role"]
            content = item["content"][:200]  # Truncar contenido largo
            formatted.append(f"{role}: {content}")
        
        return "\n".join(formatted)
    
    def _create_fallback_plan(self, user_request: str) -> ExecutionPlan:
        """Crea un plan básico cuando falla la planificación principal"""
        action = Action(
            id="fallback_1",
            type=ActionType.HUMAN_INPUT,
            tool_name="human_input",
            parameters={"message": f"No pude planificar automáticamente. ¿Puedes ser más específico sobre: {user_request}?"},
            description="Solicitar clarificación al usuario",
            requires_confirmation=False,
            estimated_duration=0
        )
        
        return ExecutionPlan(
            id=str(uuid.uuid4()),
            user_request=user_request,
            actions=[action],
            estimated_total_time=0,
            risk_level="low",
            requires_human_approval=False
        )
    
    async def generate_response(
        self, 
        user_request: str, 
        plan: ExecutionPlan, 
        results: List[Dict]
    ) -> str:
        """
        Genera la respuesta final basada en los resultados de ejecución
        """
        # Template para generar respuesta
        response_template = PromptTemplate(
            input_variables=["user_request", "plan_summary", "results"],
            template="""
Basándote en la solicitud del usuario y los resultados de ejecución, 
genera una respuesta clara y útil.

SOLICITUD: {user_request}
PLAN EJECUTADO: {plan_summary}
RESULTADOS: {results}

Genera una respuesta natural y útil que:
1. Responda directamente a la solicitud
2. Resuma lo que se hizo
3. Incluya información relevante de los resultados
4. Sugiera próximos pasos si es apropiado

Respuesta:
"""
        )
        
        plan_summary = f"{len(plan.actions)} acciones ejecutadas"
        results_summary = json.dumps(results, indent=2)
        
        prompt = response_template.format(
            user_request=user_request,
            plan_summary=plan_summary,
            results=results_summary
        )
        
        response = await self.llm.agenerate([prompt])
        return response.generations[0][0].text.strip()
