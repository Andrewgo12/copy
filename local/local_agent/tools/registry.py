"""
Registro de herramientas - Gestiona todas las herramientas disponibles
"""
import asyncio
import importlib
from typing import Dict, Any, List, Optional, Type
from pathlib import Path
from loguru import logger

from .base import BaseTool, ToolDefinition
from .file_tools import ReadFileTool, WriteFileTool, ListDirectoryTool
from .system_tools import SystemCommandTool, InstallPackageTool, GitOperationTool


class ToolRegistry:
    """
    Registro centralizado de todas las herramientas disponibles.
    Maneja carga dinámica, validación y acceso a herramientas.
    """
    
    def __init__(self):
        self.tools: Dict[str, BaseTool] = {}
        self.tool_definitions: Dict[str, ToolDefinition] = {}
        self.tool_stats: Dict[str, Dict[str, Any]] = {}
        
        # Configuración
        self.lazy_loading = True
        self.auto_discovery = True
        
        # Inicializar herramientas por defecto
        asyncio.create_task(self._initialize_default_tools())
        
        logger.info("Tool Registry inicializado")
    
    async def _initialize_default_tools(self):
        """Inicializa las herramientas por defecto del sistema"""
        default_tools = [
            ReadFileTool(),
            WriteFileTool(),
            ListDirectoryTool(),
            SystemCommandTool(),
            InstallPackageTool(),
            GitOperationTool()
        ]
        
        for tool in default_tools:
            await self.register_tool_instance(tool)
        
        logger.info(f"Herramientas por defecto registradas: {len(default_tools)}")
    
    async def register_tool_instance(self, tool: BaseTool) -> bool:
        """
        Registra una instancia de herramienta
        
        Args:
            tool: Instancia de la herramienta
            
        Returns:
            True si se registró exitosamente
        """
        try:
            definition = tool.get_definition()
            tool_name = definition.name
            
            # Validar definición
            if not await self._validate_tool_definition(definition):
                logger.error(f"Definición de herramienta inválida: {tool_name}")
                return False
            
            # Registrar herramienta
            self.tools[tool_name] = tool
            self.tool_definitions[tool_name] = definition
            self.tool_stats[tool_name] = {
                "registered_at": asyncio.get_event_loop().time(),
                "execution_count": 0,
                "last_used": None,
                "error_count": 0
            }
            
            logger.info(f"Herramienta registrada: {tool_name}")
            return True
            
        except Exception as e:
            logger.error(f"Error registrando herramienta: {e}")
            return False
    
    async def register_tool(self, tool_definition: Dict[str, Any]) -> bool:
        """
        Registra una herramienta desde su definición
        
        Args:
            tool_definition: Definición de la herramienta en formato dict
            
        Returns:
            True si se registró exitosamente
        """
        try:
            # Crear herramienta dinámica desde definición
            tool_class = await self._create_dynamic_tool(tool_definition)
            tool_instance = tool_class()
            
            return await self.register_tool_instance(tool_instance)
            
        except Exception as e:
            logger.error(f"Error registrando herramienta desde definición: {e}")
            return False
    
    async def get_tool(self, tool_name: str) -> Optional[BaseTool]:
        """
        Obtiene una herramienta por nombre
        
        Args:
            tool_name: Nombre de la herramienta
            
        Returns:
            Instancia de la herramienta o None si no existe
        """
        if tool_name not in self.tools:
            # Intentar carga dinámica si está habilitada
            if self.lazy_loading:
                await self._try_load_tool(tool_name)
        
        tool = self.tools.get(tool_name)
        
        if tool and tool.is_enabled:
            # Actualizar estadísticas de uso
            self.tool_stats[tool_name]["last_used"] = asyncio.get_event_loop().time()
            return tool
        
        return None
    
    async def list_tools(self) -> List[Dict[str, Any]]:
        """
        Lista todas las herramientas disponibles
        
        Returns:
            Lista de definiciones de herramientas
        """
        tools_list = []
        
        for tool_name, definition in self.tool_definitions.items():
            tool = self.tools.get(tool_name)
            stats = self.tool_stats.get(tool_name, {})
            
            tool_info = definition.to_dict()
            tool_info.update({
                "is_enabled": tool.is_enabled if tool else False,
                "execution_count": stats.get("execution_count", 0),
                "last_used": stats.get("last_used"),
                "error_count": stats.get("error_count", 0)
            })
            
            tools_list.append(tool_info)
        
        return tools_list
    
    async def get_tools_by_category(self, category: str) -> List[Dict[str, Any]]:
        """Obtiene herramientas filtradas por categoría"""
        all_tools = await self.list_tools()
        return [tool for tool in all_tools if tool["category"] == category]
    
    async def get_tools_by_risk_level(self, risk_level: str) -> List[Dict[str, Any]]:
        """Obtiene herramientas filtradas por nivel de riesgo"""
        all_tools = await self.list_tools()
        return [tool for tool in all_tools if tool["risk_level"] == risk_level]
    
    async def enable_tool(self, tool_name: str) -> bool:
        """Habilita una herramienta"""
        tool = self.tools.get(tool_name)
        if tool:
            tool.enable()
            logger.info(f"Herramienta habilitada: {tool_name}")
            return True
        return False
    
    async def disable_tool(self, tool_name: str) -> bool:
        """Deshabilita una herramienta"""
        tool = self.tools.get(tool_name)
        if tool:
            tool.disable()
            logger.warning(f"Herramienta deshabilitada: {tool_name}")
            return True
        return False
    
    async def unregister_tool(self, tool_name: str) -> bool:
        """Desregistra una herramienta completamente"""
        if tool_name in self.tools:
            del self.tools[tool_name]
            del self.tool_definitions[tool_name]
            del self.tool_stats[tool_name]
            logger.info(f"Herramienta desregistrada: {tool_name}")
            return True
        return False
    
    async def _validate_tool_definition(self, definition: ToolDefinition) -> bool:
        """Valida que una definición de herramienta sea correcta"""
        try:
            # Verificar campos requeridos
            if not definition.name or not definition.description:
                return False
            
            # Verificar que el nombre no esté duplicado
            if definition.name in self.tool_definitions:
                logger.warning(f"Herramienta duplicada: {definition.name}")
                return False
            
            # Validar parámetros
            for param in definition.parameters:
                if not param.name or not param.type:
                    return False
                
                # Verificar tipos válidos
                valid_types = ["string", "int", "bool", "list", "dict"]
                if param.type not in valid_types:
                    return False
            
            # Validar ejemplos
            for example in definition.examples:
                if not isinstance(example, dict):
                    return False
            
            return True
            
        except Exception as e:
            logger.error(f"Error validando definición: {e}")
            return False
    
    async def _create_dynamic_tool(self, tool_definition: Dict[str, Any]) -> Type[BaseTool]:
        """Crea una clase de herramienta dinámicamente desde su definición"""
        
        class DynamicTool(BaseTool):
            def __init__(self):
                super().__init__()
                self._definition = tool_definition
            
            def get_definition(self) -> ToolDefinition:
                # Convertir dict a ToolDefinition
                from .base import ToolCategory, RiskLevel, ToolParameter
                
                parameters = [
                    ToolParameter(**param) for param in tool_definition["parameters"]
                ]
                
                return ToolDefinition(
                    name=tool_definition["name"],
                    description=tool_definition["description"],
                    category=ToolCategory(tool_definition["category"]),
                    risk_level=RiskLevel(tool_definition["risk_level"]),
                    parameters=parameters,
                    examples=tool_definition["examples"]
                )
            
            async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
                # Implementación básica - en una versión real esto sería más sofisticado
                return {
                    "success": True,
                    "result": f"Herramienta dinámica {self._definition['name']} ejecutada",
                    "error": None,
                    "metadata": {"dynamic_tool": True}
                }
        
        return DynamicTool
    
    async def _try_load_tool(self, tool_name: str) -> bool:
        """Intenta cargar una herramienta dinámicamente"""
        try:
            # Buscar en directorio de herramientas personalizadas
            custom_tools_dir = Path("tools/custom")
            if custom_tools_dir.exists():
                for tool_file in custom_tools_dir.glob(f"*{tool_name}*.py"):
                    # Cargar módulo dinámicamente
                    spec = importlib.util.spec_from_file_location(
                        f"custom_{tool_name}", 
                        tool_file
                    )
                    module = importlib.util.module_from_spec(spec)
                    spec.loader.exec_module(module)
                    
                    # Buscar clases que hereden de BaseTool
                    for attr_name in dir(module):
                        attr = getattr(module, attr_name)
                        if (isinstance(attr, type) and 
                            issubclass(attr, BaseTool) and 
                            attr != BaseTool):
                            
                            tool_instance = attr()
                            await self.register_tool_instance(tool_instance)
                            return True
            
            return False
            
        except Exception as e:
            logger.error(f"Error cargando herramienta {tool_name}: {e}")
            return False
    
    async def reload_tools(self):
        """Recarga todas las herramientas"""
        logger.info("Recargando herramientas...")
        
        # Guardar estadísticas actuales
        old_stats = self.tool_stats.copy()
        
        # Limpiar registro
        self.tools.clear()
        self.tool_definitions.clear()
        self.tool_stats.clear()
        
        # Reinicializar herramientas por defecto
        await self._initialize_default_tools()
        
        # Restaurar estadísticas donde sea posible
        for tool_name, stats in old_stats.items():
            if tool_name in self.tool_stats:
                self.tool_stats[tool_name].update(stats)
        
        logger.info("Herramientas recargadas")
    
    async def get_registry_stats(self) -> Dict[str, Any]:
        """Obtiene estadísticas del registro de herramientas"""
        total_tools = len(self.tools)
        enabled_tools = len([t for t in self.tools.values() if t.is_enabled])
        
        categories = {}
        risk_levels = {}
        
        for definition in self.tool_definitions.values():
            # Contar por categoría
            cat = definition.category.value
            categories[cat] = categories.get(cat, 0) + 1
            
            # Contar por nivel de riesgo
            risk = definition.risk_level.value
            risk_levels[risk] = risk_levels.get(risk, 0) + 1
        
        return {
            "total_tools": total_tools,
            "enabled_tools": enabled_tools,
            "disabled_tools": total_tools - enabled_tools,
            "categories": categories,
            "risk_levels": risk_levels,
            "most_used": self._get_most_used_tools(5),
            "recent_errors": self._get_recent_errors()
        }
    
    def _get_most_used_tools(self, limit: int) -> List[Dict[str, Any]]:
        """Obtiene las herramientas más utilizadas"""
        tools_by_usage = [
            {
                "name": name,
                "execution_count": stats.get("execution_count", 0),
                "last_used": stats.get("last_used")
            }
            for name, stats in self.tool_stats.items()
        ]
        
        tools_by_usage.sort(key=lambda x: x["execution_count"], reverse=True)
        return tools_by_usage[:limit]
    
    def _get_recent_errors(self) -> List[Dict[str, Any]]:
        """Obtiene errores recientes de herramientas"""
        errors = []
        
        for tool_name, stats in self.tool_stats.items():
            if stats.get("error_count", 0) > 0:
                errors.append({
                    "tool_name": tool_name,
                    "error_count": stats["error_count"],
                    "last_error": stats.get("last_error")
                })
        
        return sorted(errors, key=lambda x: x["error_count"], reverse=True)
    
    async def update_tool_stats(self, tool_name: str, execution_result: Dict[str, Any]):
        """Actualiza estadísticas de uso de una herramienta"""
        if tool_name not in self.tool_stats:
            return
        
        stats = self.tool_stats[tool_name]
        stats["execution_count"] = stats.get("execution_count", 0) + 1
        stats["last_used"] = asyncio.get_event_loop().time()
        
        if not execution_result.get("success", False):
            stats["error_count"] = stats.get("error_count", 0) + 1
            stats["last_error"] = execution_result.get("error", "Unknown error")
    
    async def discover_tools(self, directory: str = "tools/custom") -> int:
        """
        Descubre automáticamente herramientas en un directorio
        
        Args:
            directory: Directorio donde buscar herramientas
            
        Returns:
            Número de herramientas descubiertas
        """
        discovered = 0
        tools_dir = Path(directory)
        
        if not tools_dir.exists():
            logger.warning(f"Directorio de herramientas no existe: {directory}")
            return 0
        
        try:
            for tool_file in tools_dir.glob("*.py"):
                if tool_file.name.startswith("__"):
                    continue
                
                # Cargar módulo
                spec = importlib.util.spec_from_file_location(
                    tool_file.stem,
                    tool_file
                )
                module = importlib.util.module_from_spec(spec)
                spec.loader.exec_module(module)
                
                # Buscar clases que hereden de BaseTool
                for attr_name in dir(module):
                    attr = getattr(module, attr_name)
                    if (isinstance(attr, type) and 
                        issubclass(attr, BaseTool) and 
                        attr != BaseTool):
                        
                        try:
                            tool_instance = attr()
                            if await self.register_tool_instance(tool_instance):
                                discovered += 1
                        except Exception as e:
                            logger.error(f"Error instanciando herramienta {attr_name}: {e}")
            
            logger.info(f"Herramientas descubiertas: {discovered}")
            return discovered
            
        except Exception as e:
            logger.error(f"Error en descubrimiento de herramientas: {e}")
            return 0
    
    async def _validate_tool_definition(self, definition: ToolDefinition) -> bool:
        """Valida que una definición de herramienta sea correcta"""
        try:
            # Verificar campos requeridos
            required_fields = ["name", "description", "category", "risk_level", "parameters"]
            
            for field in required_fields:
                if not hasattr(definition, field) or getattr(definition, field) is None:
                    logger.error(f"Campo requerido faltante en herramienta: {field}")
                    return False
            
            # Verificar que el nombre sea único
            if definition.name in self.tool_definitions:
                logger.error(f"Nombre de herramienta duplicado: {definition.name}")
                return False
            
            # Validar parámetros
            for param in definition.parameters:
                if not param.name or not param.type:
                    logger.error(f"Parámetro inválido en herramienta {definition.name}")
                    return False
            
            # Validar ejemplos
            for i, example in enumerate(definition.examples):
                if not isinstance(example, dict):
                    logger.error(f"Ejemplo {i} inválido en herramienta {definition.name}")
                    return False
                
                # Verificar que los ejemplos tengan los parámetros requeridos
                required_params = [p.name for p in definition.parameters if p.required]
                for param in required_params:
                    if param not in example:
                        logger.warning(f"Ejemplo {i} falta parámetro requerido: {param}")
            
            return True
            
        except Exception as e:
            logger.error(f"Error validando definición de herramienta: {e}")
            return False
    
    async def export_tools_catalog(self, output_file: str = "tools_catalog.json"):
        """Exporta un catálogo de todas las herramientas"""
        try:
            catalog = {
                "metadata": {
                    "generated_at": asyncio.get_event_loop().time(),
                    "total_tools": len(self.tools),
                    "registry_version": "1.0.0"
                },
                "tools": await self.list_tools(),
                "statistics": await self.get_registry_stats()
            }
            
            with open(output_file, 'w', encoding='utf-8') as f:
                json.dump(catalog, f, indent=2, ensure_ascii=False, default=str)
            
            logger.info(f"Catálogo de herramientas exportado: {output_file}")
            return True
            
        except Exception as e:
            logger.error(f"Error exportando catálogo: {e}")
            return False
    
    async def import_tools_from_catalog(self, catalog_file: str) -> int:
        """Importa herramientas desde un catálogo"""
        try:
            with open(catalog_file, 'r', encoding='utf-8') as f:
                catalog = json.load(f)
            
            imported = 0
            for tool_def in catalog.get("tools", []):
                if await self.register_tool(tool_def):
                    imported += 1
            
            logger.info(f"Herramientas importadas desde catálogo: {imported}")
            return imported
            
        except Exception as e:
            logger.error(f"Error importando catálogo {catalog_file}: {e}")
            return 0
