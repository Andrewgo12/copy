"""
Clase base para todas las herramientas del agente
"""
from abc import ABC, abstractmethod
from typing import Dict, Any, List, Optional
from dataclasses import dataclass
from enum import Enum
import asyncio
from loguru import logger


class ToolCategory(Enum):
    """Categorías de herramientas"""
    FILE_SYSTEM = "file_system"
    CODE_ANALYSIS = "code_analysis"
    WEB_INTERACTION = "web_interaction"
    SYSTEM_COMMANDS = "system_commands"
    DATA_PROCESSING = "data_processing"
    COMMUNICATION = "communication"
    CUSTOM = "custom"


class RiskLevel(Enum):
    """Niveles de riesgo de las herramientas"""
    SAFE = "safe"           # Sin riesgos, solo lectura
    LOW = "low"             # Modificaciones menores
    MEDIUM = "medium"       # Cambios significativos
    HIGH = "high"           # Acciones potencialmente destructivas
    CRITICAL = "critical"   # Requiere confirmación obligatoria


@dataclass
class ToolParameter:
    """Definición de un parámetro de herramienta"""
    name: str
    type: str  # string, int, bool, list, dict
    description: str
    required: bool = True
    default: Any = None
    validation_regex: Optional[str] = None
    allowed_values: Optional[List[Any]] = None


@dataclass
class ToolDefinition:
    """Definición completa de una herramienta"""
    name: str
    description: str
    category: ToolCategory
    risk_level: RiskLevel
    parameters: List[ToolParameter]
    examples: List[Dict[str, Any]]
    requires_sandbox: bool = False
    requires_confirmation: bool = False
    max_execution_time: int = 300  # segundos
    
    def to_dict(self) -> Dict[str, Any]:
        """Convierte la definición a diccionario"""
        return {
            "name": self.name,
            "description": self.description,
            "category": self.category.value,
            "risk_level": self.risk_level.value,
            "parameters": [
                {
                    "name": p.name,
                    "type": p.type,
                    "description": p.description,
                    "required": p.required,
                    "default": p.default,
                    "validation_regex": p.validation_regex,
                    "allowed_values": p.allowed_values
                }
                for p in self.parameters
            ],
            "examples": self.examples,
            "requires_sandbox": self.requires_sandbox,
            "requires_confirmation": self.requires_confirmation,
            "max_execution_time": self.max_execution_time
        }


class BaseTool(ABC):
    """
    Clase base abstracta para todas las herramientas del agente.
    
    Cada herramienta debe implementar:
    - execute(): Lógica principal de ejecución
    - get_definition(): Definición de la herramienta
    - validate_parameters(): Validación de parámetros
    """
    
    def __init__(self):
        self.execution_count = 0
        self.last_execution_time = None
        self.is_enabled = True
    
    @abstractmethod
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """
        Ejecuta la herramienta con los parámetros dados
        
        Args:
            parameters: Parámetros de entrada validados
            
        Returns:
            Resultado de la ejecución con formato estándar:
            {
                "success": bool,
                "result": Any,
                "error": Optional[str],
                "metadata": Dict[str, Any]
            }
        """
        pass
    
    @abstractmethod
    def get_definition(self) -> ToolDefinition:
        """Retorna la definición completa de la herramienta"""
        pass
    
    def validate_parameters(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """
        Valida los parámetros de entrada
        
        Args:
            parameters: Parámetros a validar
            
        Returns:
            Parámetros validados y procesados
            
        Raises:
            ValueError: Si los parámetros no son válidos
        """
        definition = self.get_definition()
        validated = {}
        
        # Verificar parámetros requeridos
        for param in definition.parameters:
            if param.required and param.name not in parameters:
                raise ValueError(f"Parámetro requerido faltante: {param.name}")
            
            value = parameters.get(param.name, param.default)
            
            # Validar tipo
            if value is not None:
                validated[param.name] = self._validate_parameter_type(
                    param.name, value, param.type, param
                )
        
        return validated
    
    def _validate_parameter_type(
        self, 
        name: str, 
        value: Any, 
        expected_type: str, 
        param: ToolParameter
    ) -> Any:
        """Valida el tipo de un parámetro específico"""
        if expected_type == "string" and not isinstance(value, str):
            raise ValueError(f"Parámetro {name} debe ser string")
        elif expected_type == "int" and not isinstance(value, int):
            try:
                value = int(value)
            except ValueError:
                raise ValueError(f"Parámetro {name} debe ser entero")
        elif expected_type == "bool" and not isinstance(value, bool):
            if isinstance(value, str):
                value = value.lower() in ["true", "1", "yes", "on"]
            else:
                value = bool(value)
        elif expected_type == "list" and not isinstance(value, list):
            raise ValueError(f"Parámetro {name} debe ser lista")
        elif expected_type == "dict" and not isinstance(value, dict):
            raise ValueError(f"Parámetro {name} debe ser diccionario")
        
        # Validar valores permitidos
        if param.allowed_values and value not in param.allowed_values:
            raise ValueError(f"Parámetro {name} debe ser uno de: {param.allowed_values}")
        
        # Validar regex si está definido
        if param.validation_regex and isinstance(value, str):
            import re
            if not re.match(param.validation_regex, value):
                raise ValueError(f"Parámetro {name} no cumple el formato requerido")
        
        return value
    
    async def pre_execute_hook(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Hook ejecutado antes de la ejecución principal"""
        logger.debug(f"Ejecutando herramienta {self.__class__.__name__} con parámetros: {parameters}")
        return parameters
    
    async def post_execute_hook(self, result: Dict[str, Any]) -> Dict[str, Any]:
        """Hook ejecutado después de la ejecución principal"""
        self.execution_count += 1
        self.last_execution_time = asyncio.get_event_loop().time()
        logger.debug(f"Herramienta {self.__class__.__name__} completada. Ejecuciones: {self.execution_count}")
        return result
    
    def get_usage_stats(self) -> Dict[str, Any]:
        """Retorna estadísticas de uso de la herramienta"""
        return {
            "execution_count": self.execution_count,
            "last_execution_time": self.last_execution_time,
            "is_enabled": self.is_enabled,
            "tool_name": self.__class__.__name__
        }
    
    def enable(self):
        """Habilita la herramienta"""
        self.is_enabled = True
        logger.info(f"Herramienta {self.__class__.__name__} habilitada")
    
    def disable(self):
        """Deshabilita la herramienta"""
        self.is_enabled = False
        logger.warning(f"Herramienta {self.__class__.__name__} deshabilitada")


class ToolExecutionError(Exception):
    """Excepción específica para errores de ejecución de herramientas"""
    
    def __init__(self, tool_name: str, message: str, details: Optional[Dict] = None):
        self.tool_name = tool_name
        self.details = details or {}
        super().__init__(f"Error en herramienta {tool_name}: {message}")


class ToolValidationError(Exception):
    """Excepción para errores de validación de parámetros"""
    
    def __init__(self, tool_name: str, parameter: str, message: str):
        self.tool_name = tool_name
        self.parameter = parameter
        super().__init__(f"Error de validación en {tool_name}.{parameter}: {message}")


# Decorador para herramientas que requieren confirmación
def requires_confirmation(func):
    """Decorador que marca una herramienta como que requiere confirmación"""
    func._requires_confirmation = True
    return func


# Decorador para herramientas que requieren sandbox
def requires_sandbox(func):
    """Decorador que marca una herramienta como que requiere sandbox"""
    func._requires_sandbox = True
    return func
