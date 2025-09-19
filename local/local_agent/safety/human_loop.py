"""
Sistema Human-in-the-Loop para confirmaciones y supervisión
"""
import asyncio
import json
from typing import Dict, Any, Optional, Callable
from dataclasses import dataclass
from enum import Enum
from loguru import logger

from rich.console import Console
from rich.panel import Panel
from rich.prompt import Confirm, Prompt
from rich.table import Table
from rich.syntax import Syntax


class ConfirmationType(Enum):
    """Tipos de confirmación"""
    ACTION_APPROVAL = "action_approval"
    PLAN_APPROVAL = "plan_approval"
    RISK_CONFIRMATION = "risk_confirmation"
    PARAMETER_MODIFICATION = "parameter_modification"


@dataclass
class ConfirmationRequest:
    """Solicitud de confirmación al usuario"""
    id: str
    type: ConfirmationType
    message: str
    details: Dict[str, Any]
    timeout: int = 60  # segundos
    default_response: bool = False


class HumanLoopManager:
    """
    Gestor del bucle humano que maneja confirmaciones y supervisión
    durante la ejecución del agente
    """
    
    def __init__(self, config):
        self.config = config
        self.console = Console()
        self.pending_confirmations: Dict[str, ConfirmationRequest] = {}
        self.confirmation_handlers: Dict[str, Callable] = {}
        
        # Configuración
        self.auto_approve_safe_actions = True
        self.require_confirmation_threshold = "medium"  # low, medium, high, critical
        
        logger.info("Human Loop Manager inicializado")
    
    async def request_confirmation(
        self, 
        message: str, 
        details: Dict[str, Any],
        confirmation_type: ConfirmationType = ConfirmationType.ACTION_APPROVAL,
        timeout: int = 60
    ) -> bool:
        """
        Solicita confirmación al usuario para una acción
        
        Args:
            message: Mensaje descriptivo de la acción
            details: Detalles técnicos de la acción
            confirmation_type: Tipo de confirmación
            timeout: Tiempo límite para respuesta
            
        Returns:
            True si el usuario aprueba, False si rechaza
        """
        try:
            # Crear solicitud de confirmación
            request = ConfirmationRequest(
                id=f"conf_{asyncio.get_event_loop().time()}",
                type=confirmation_type,
                message=message,
                details=details,
                timeout=timeout,
                default_response=False
            )
            
            # Mostrar solicitud al usuario
            await self._display_confirmation_request(request)
            
            # Esperar respuesta del usuario
            response = await self._wait_for_user_response(request)
            
            logger.info(f"Confirmación {request.id}: {'Aprobada' if response else 'Rechazada'}")
            return response
            
        except Exception as e:
            logger.error(f"Error en solicitud de confirmación: {e}")
            return False  # Por seguridad, denegar en caso de error
    
    async def request_approval(self, message: str, plan_details: Dict[str, Any]) -> bool:
        """Solicita aprobación para un plan completo"""
        return await self.request_confirmation(
            message,
            plan_details,
            ConfirmationType.PLAN_APPROVAL,
            timeout=120  # Más tiempo para revisar planes
        )
    
    async def _display_confirmation_request(self, request: ConfirmationRequest):
        """Muestra la solicitud de confirmación al usuario"""
        
        # Panel principal con el mensaje
        self.console.print(Panel(
            f"[bold yellow]⚠️ Confirmación Requerida[/bold yellow]\n\n{request.message}",
            title=f"🔐 {request.type.value.replace('_', ' ').title()}",
            border_style="yellow"
        ))
        
        # Mostrar detalles técnicos
        if request.details:
            await self._display_action_details(request.details)
        
        # Mostrar opciones
        self.console.print(Panel(
            "[bold]Opciones:[/bold]\n"
            "• [green]y/yes[/green] - Aprobar acción\n"
            "• [red]n/no[/red] - Rechazar acción\n"
            "• [blue]d/details[/blue] - Ver más detalles\n"
            "• [yellow]m/modify[/yellow] - Modificar parámetros\n"
            f"• [dim]Timeout: {request.timeout} segundos[/dim]",
            title="🎛️ Controles",
            border_style="blue"
        ))
    
    async def _display_action_details(self, details: Dict[str, Any]):
        """Muestra detalles técnicos de la acción"""
        
        # Tabla con parámetros
        if "parameters" in details:
            table = Table(title="📋 Parámetros de la Acción")
            table.add_column("Parámetro", style="cyan")
            table.add_column("Valor", style="white")
            table.add_column("Tipo", style="magenta")
            
            for key, value in details["parameters"].items():
                table.add_row(
                    key,
                    str(value)[:50] + "..." if len(str(value)) > 50 else str(value),
                    type(value).__name__
                )
            
            self.console.print(table)
        
        # Mostrar código si está presente
        if "code" in details:
            syntax = Syntax(
                details["code"],
                "python",  # Detectar lenguaje automáticamente en implementación real
                theme="monokai",
                line_numbers=True
            )
            self.console.print(Panel(syntax, title="📄 Código a Ejecutar"))
        
        # Mostrar información de riesgo
        if "risk_message" in details:
            self.console.print(Panel(
                f"[yellow]{details['risk_message']}[/yellow]",
                title="⚠️ Información de Riesgo",
                border_style="yellow"
            ))
    
    async def _wait_for_user_response(self, request: ConfirmationRequest) -> bool:
        """Espera la respuesta del usuario con timeout"""
        
        try:
            # Crear tarea para input del usuario
            user_input_task = asyncio.create_task(
                self._get_user_input_async()
            )
            
            # Crear tarea para timeout
            timeout_task = asyncio.create_task(
                asyncio.sleep(request.timeout)
            )
            
            # Esperar la primera que complete
            done, pending = await asyncio.wait(
                [user_input_task, timeout_task],
                return_when=asyncio.FIRST_COMPLETED
            )
            
            # Cancelar tareas pendientes
            for task in pending:
                task.cancel()
            
            # Procesar resultado
            if user_input_task in done:
                user_response = user_input_task.result()
                return await self._process_user_response(user_response, request)
            else:
                # Timeout
                self.console.print(f"[red]⏰ Timeout después de {request.timeout} segundos[/red]")
                return request.default_response
                
        except Exception as e:
            logger.error(f"Error esperando respuesta del usuario: {e}")
            return False
    
    async def _get_user_input_async(self) -> str:
        """Obtiene input del usuario de forma asíncrona"""
        loop = asyncio.get_event_loop()
        
        # Ejecutar input en thread pool para no bloquear
        return await loop.run_in_executor(
            None,
            lambda: input("👤 Tu respuesta: ").strip().lower()
        )
    
    async def _process_user_response(self, response: str, request: ConfirmationRequest) -> bool:
        """Procesa la respuesta del usuario"""
        
        if response in ['y', 'yes', 'sí', 'si', 'approve', 'ok']:
            self.console.print("[green]✅ Acción aprobada[/green]")
            return True
        
        elif response in ['n', 'no', 'deny', 'cancel', 'abort']:
            self.console.print("[red]❌ Acción rechazada[/red]")
            return False
        
        elif response in ['d', 'details', 'info']:
            # Mostrar más detalles
            await self._show_extended_details(request.details)
            # Solicitar confirmación nuevamente
            return await self._wait_for_user_response(request)
        
        elif response in ['m', 'modify', 'edit']:
            # Permitir modificar parámetros
            modified = await self._modify_parameters(request.details)
            if modified:
                request.details.update(modified)
                self.console.print("[blue]📝 Parámetros modificados[/blue]")
            # Solicitar confirmación nuevamente
            return await self._wait_for_user_response(request)
        
        else:
            self.console.print(f"[yellow]❓ Respuesta no reconocida: {response}[/yellow]")
            self.console.print("[dim]Usa: y/n/d/m[/dim]")
            # Solicitar nuevamente
            return await self._wait_for_user_response(request)
    
    async def _show_extended_details(self, details: Dict[str, Any]):
        """Muestra detalles extendidos de la acción"""
        
        details_json = json.dumps(details, indent=2, ensure_ascii=False)
        
        self.console.print(Panel(
            details_json,
            title="🔍 Detalles Completos",
            border_style="cyan"
        ))
    
    async def _modify_parameters(self, details: Dict[str, Any]) -> Optional[Dict[str, Any]]:
        """Permite al usuario modificar parámetros de la acción"""
        
        if "parameters" not in details:
            self.console.print("[yellow]No hay parámetros modificables[/yellow]")
            return None
        
        parameters = details["parameters"]
        modifications = {}
        
        self.console.print("[bold]Parámetros actuales:[/bold]")
        for key, value in parameters.items():
            self.console.print(f"  {key}: {value}")
        
        self.console.print("\n[dim]Presiona Enter para mantener valor actual[/dim]")
        
        for key, current_value in parameters.items():
            try:
                new_value = input(f"Nuevo valor para {key} [{current_value}]: ").strip()
                
                if new_value:
                    # Intentar convertir al tipo apropiado
                    if isinstance(current_value, int):
                        modifications[key] = int(new_value)
                    elif isinstance(current_value, bool):
                        modifications[key] = new_value.lower() in ['true', '1', 'yes', 'on']
                    elif isinstance(current_value, list):
                        modifications[key] = new_value.split(',')
                    else:
                        modifications[key] = new_value
                        
            except ValueError as e:
                self.console.print(f"[red]Error en conversión de tipo: {e}[/red]")
                continue
            except KeyboardInterrupt:
                self.console.print("\n[yellow]Modificación cancelada[/yellow]")
                break
        
        return modifications if modifications else None
    
    def set_auto_approval(self, enabled: bool, risk_threshold: str = "low"):
        """Configura aprobación automática para acciones de bajo riesgo"""
        self.auto_approve_safe_actions = enabled
        self.require_confirmation_threshold = risk_threshold
        
        logger.info(f"Auto-aprobación: {'habilitada' if enabled else 'deshabilitada'} (umbral: {risk_threshold})")
    
    def get_stats(self) -> Dict[str, Any]:
        """Obtiene estadísticas del human loop"""
        return {
            "pending_confirmations": len(self.pending_confirmations),
            "auto_approve_enabled": self.auto_approve_safe_actions,
            "confirmation_threshold": self.require_confirmation_threshold,
            "total_handlers": len(self.confirmation_handlers)
        }
