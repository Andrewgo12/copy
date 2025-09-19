"""
Action Executor - Ejecuta planes de acción de forma segura y controlada
"""
import asyncio
import uuid
from typing import Dict, Any, List, Optional
from dataclasses import dataclass
from enum import Enum
from loguru import logger

from .planner import ExecutionPlan, Action
from ..tools.registry import ToolRegistry
from ..safety.guardrails import SafetyGuardrails, ActionDecision
from ..safety.human_loop import HumanLoopManager


class ExecutionStatus(Enum):
    """Estados de ejecución de acciones"""
    PENDING = "pending"
    RUNNING = "running"
    COMPLETED = "completed"
    FAILED = "failed"
    CANCELLED = "cancelled"
    WAITING_CONFIRMATION = "waiting_confirmation"


@dataclass
class ExecutionResult:
    """Resultado de ejecución de una acción"""
    action_id: str
    status: ExecutionStatus
    result: Any
    error: Optional[str]
    execution_time: float
    metadata: Dict[str, Any]
    
    def to_dict(self) -> Dict[str, Any]:
        return {
            "action_id": self.action_id,
            "status": self.status.value,
            "result": self.result,
            "error": self.error,
            "execution_time": self.execution_time,
            "metadata": self.metadata
        }


class ActionExecutor:
    """
    Ejecutor de acciones que maneja la ejecución segura y controlada
    de planes generados por el planificador
    """
    
    def __init__(self, tool_registry: ToolRegistry, safety: SafetyGuardrails, config):
        self.tool_registry = tool_registry
        self.safety = safety
        self.config = config
        self.human_loop = HumanLoopManager(config) if config.enable_human_loop else None
        
        # Estado de ejecución
        self.current_execution: Optional[str] = None
        self.execution_results: Dict[str, List[ExecutionResult]] = {}
        self.cancelled_executions: set = set()
        
        logger.info("Action Executor inicializado")
    
    async def execute_plan(self, plan: ExecutionPlan) -> List[Dict[str, Any]]:
        """
        Ejecuta un plan completo de acciones
        
        Args:
            plan: Plan de ejecución a ejecutar
            
        Returns:
            Lista de resultados de ejecución
        """
        try:
            self.current_execution = plan.id
            execution_results = []
            
            logger.info(f"Iniciando ejecución del plan: {plan.id}")
            
            # Verificar si el plan requiere aprobación humana
            if plan.requires_human_approval and self.human_loop:
                approved = await self.human_loop.request_approval(
                    f"Plan requiere aprobación: {plan.user_request}",
                    plan.to_dict()
                )
                
                if not approved:
                    logger.info("Plan rechazado por el usuario")
                    return [self._create_cancelled_result("plan_rejected")]
            
            # Ejecutar acciones en orden, respetando dependencias
            for action in plan.actions:
                if plan.id in self.cancelled_executions:
                    logger.info(f"Ejecución cancelada: {plan.id}")
                    break
                
                # Verificar dependencias
                if not await self._check_dependencies(action, execution_results):
                    result = self._create_failed_result(
                        action.id, 
                        "Dependencias no satisfechas"
                    )
                    execution_results.append(result.to_dict())
                    continue
                
                # Ejecutar acción individual
                result = await self._execute_single_action(action)
                execution_results.append(result.to_dict())
                
                # Si falla una acción crítica, detener ejecución
                if result.status == ExecutionStatus.FAILED and action.requires_confirmation:
                    logger.warning(f"Acción crítica falló: {action.id}")
                    break
            
            # Almacenar resultados
            self.execution_results[plan.id] = [
                ExecutionResult(**r) for r in execution_results
            ]
            
            logger.info(f"Ejecución completada: {plan.id} - {len(execution_results)} acciones")
            return execution_results
            
        except Exception as e:
            logger.error(f"Error ejecutando plan {plan.id}: {e}")
            return [self._create_failed_result("execution_error", str(e)).to_dict()]
        finally:
            self.current_execution = None
    
    async def _execute_single_action(self, action: Action) -> ExecutionResult:
        """
        Ejecuta una acción individual
        
        Args:
            action: Acción a ejecutar
            
        Returns:
            Resultado de la ejecución
        """
        start_time = asyncio.get_event_loop().time()
        
        try:
            logger.debug(f"Ejecutando acción: {action.id} - {action.tool_name}")
            
            # 1. Verificar guardrails de seguridad
            decision, message, modified_params = await self.safety.evaluate_action(
                action.tool_name,
                action.parameters,
                action.type.value  # Convertir enum a string
            )
            
            if decision == ActionDecision.DENY:
                logger.warning(f"Acción denegada por seguridad: {action.id}")
                return ExecutionResult(
                    action_id=action.id,
                    status=ExecutionStatus.FAILED,
                    result=None,
                    error=f"Acción denegada: {message}",
                    execution_time=0,
                    metadata={"denial_reason": message}
                )
            
            # 2. Solicitar confirmación humana si es necesario
            if (decision == ActionDecision.REQUIRE_CONFIRMATION or 
                action.requires_confirmation) and self.human_loop:
                
                approved = await self.human_loop.request_confirmation(
                    f"Confirmar acción: {action.description}",
                    {
                        "tool": action.tool_name,
                        "parameters": action.parameters,
                        "risk_message": message
                    }
                )
                
                if not approved:
                    logger.info(f"Acción rechazada por el usuario: {action.id}")
                    return ExecutionResult(
                        action_id=action.id,
                        status=ExecutionStatus.CANCELLED,
                        result=None,
                        error="Acción cancelada por el usuario",
                        execution_time=0,
                        metadata={"cancelled_by": "user"}
                    )
            
            # 3. Usar parámetros modificados si los hay
            final_params = modified_params or action.parameters
            
            # 4. Obtener herramienta del registro
            tool = await self.tool_registry.get_tool(action.tool_name)
            if not tool:
                return ExecutionResult(
                    action_id=action.id,
                    status=ExecutionStatus.FAILED,
                    result=None,
                    error=f"Herramienta no encontrada: {action.tool_name}",
                    execution_time=0,
                    metadata={"tool_name": action.tool_name}
                )
            
            # 5. Validar parámetros
            validated_params = tool.validate_parameters(final_params)
            
            # 6. Ejecutar herramienta
            tool_result = await asyncio.wait_for(
                tool.execute(validated_params),
                timeout=action.estimated_duration + 30  # Buffer de 30 segundos
            )
            
            execution_time = asyncio.get_event_loop().time() - start_time
            
            # 7. Procesar resultado
            if tool_result.get("success", False):
                status = ExecutionStatus.COMPLETED
                error = None
            else:
                status = ExecutionStatus.FAILED
                error = tool_result.get("error", "Error desconocido")
            
            result = ExecutionResult(
                action_id=action.id,
                status=status,
                result=tool_result.get("result"),
                error=error,
                execution_time=execution_time,
                metadata={
                    "tool_name": action.tool_name,
                    "parameters": validated_params,
                    "tool_metadata": tool_result.get("metadata", {}),
                    "safety_decision": decision.value,
                    "safety_message": message
                }
            )
            
            logger.debug(f"Acción completada: {action.id} - {status.value}")
            return result
            
        except asyncio.TimeoutError:
            execution_time = asyncio.get_event_loop().time() - start_time
            logger.error(f"Acción {action.id} excedió timeout")
            
            return ExecutionResult(
                action_id=action.id,
                status=ExecutionStatus.FAILED,
                result=None,
                error=f"Timeout después de {execution_time:.1f} segundos",
                execution_time=execution_time,
                metadata={"timeout": True, "estimated_duration": action.estimated_duration}
            )
            
        except Exception as e:
            execution_time = asyncio.get_event_loop().time() - start_time
            logger.error(f"Error ejecutando acción {action.id}: {e}")
            
            return ExecutionResult(
                action_id=action.id,
                status=ExecutionStatus.FAILED,
                result=None,
                error=str(e),
                execution_time=execution_time,
                metadata={"exception": type(e).__name__}
            )
    
    async def _check_dependencies(
        self, 
        action: Action, 
        completed_results: List[Dict[str, Any]]
    ) -> bool:
        """
        Verifica si las dependencias de una acción están satisfechas
        
        Args:
            action: Acción a verificar
            completed_results: Resultados de acciones ya ejecutadas
            
        Returns:
            True si las dependencias están satisfechas
        """
        if not action.depends_on:
            return True
        
        completed_action_ids = {
            r["action_id"] for r in completed_results 
            if r["status"] == ExecutionStatus.COMPLETED.value
        }
        
        missing_dependencies = set(action.depends_on) - completed_action_ids
        
        if missing_dependencies:
            logger.warning(f"Dependencias faltantes para {action.id}: {missing_dependencies}")
            return False
        
        return True
    
    def _create_failed_result(self, action_id: str, error_message: str) -> ExecutionResult:
        """Crea un resultado de fallo"""
        return ExecutionResult(
            action_id=action_id,
            status=ExecutionStatus.FAILED,
            result=None,
            error=error_message,
            execution_time=0,
            metadata={}
        )
    
    def _create_cancelled_result(self, reason: str) -> Dict[str, Any]:
        """Crea un resultado de cancelación"""
        return {
            "action_id": "plan_cancelled",
            "status": ExecutionStatus.CANCELLED.value,
            "result": None,
            "error": f"Plan cancelado: {reason}",
            "execution_time": 0,
            "metadata": {"cancellation_reason": reason}
        }
    
    async def cancel_execution(self, plan_id: str) -> bool:
        """Cancela la ejecución de un plan"""
        try:
            self.cancelled_executions.add(plan_id)
            logger.info(f"Ejecución cancelada: {plan_id}")
            return True
        except Exception as e:
            logger.error(f"Error cancelando ejecución {plan_id}: {e}")
            return False
    
    async def get_execution_status(self, plan_id: str) -> Optional[Dict[str, Any]]:
        """Obtiene el estado de ejecución de un plan"""
        if plan_id not in self.execution_results:
            return None
        
        results = self.execution_results[plan_id]
        
        status_summary = {
            "plan_id": plan_id,
            "total_actions": len(results),
            "completed": len([r for r in results if r.status == ExecutionStatus.COMPLETED]),
            "failed": len([r for r in results if r.status == ExecutionStatus.FAILED]),
            "cancelled": len([r for r in results if r.status == ExecutionStatus.CANCELLED]),
            "total_execution_time": sum(r.execution_time for r in results),
            "is_cancelled": plan_id in self.cancelled_executions
        }
        
        return status_summary
    
    async def get_execution_logs(self, plan_id: str) -> List[Dict[str, Any]]:
        """Obtiene logs detallados de ejecución"""
        if plan_id not in self.execution_results:
            return []
        
        return [result.to_dict() for result in self.execution_results[plan_id]]
