"""
Sistema de guardrails de seguridad para el agente local
"""
import re
import os
from typing import Dict, Any, List, Optional, Tuple
from dataclasses import dataclass
from enum import Enum
from pathlib import Path
from loguru import logger

from ..tools.base import RiskLevel, ActionType


class GuardrailViolation(Exception):
    """Excepción para violaciones de seguridad"""
    pass


class ActionDecision(Enum):
    """Decisiones posibles para una acción"""
    ALLOW = "allow"
    DENY = "deny"
    REQUIRE_CONFIRMATION = "require_confirmation"
    MODIFY = "modify"


@dataclass
class GuardrailRule:
    """Definición de una regla de seguridad"""
    name: str
    description: str
    pattern: str  # Regex o patrón a verificar
    action: ActionDecision
    applies_to: List[str]  # Tipos de herramientas a las que aplica
    severity: str  # low, medium, high, critical
    message: str  # Mensaje para el usuario


class SafetyGuardrails:
    """
    Sistema de guardrails que evalúa la seguridad de las acciones
    antes de su ejecución
    """
    
    def __init__(self, config):
        self.config = config
        self.rules = self._load_default_rules()
        self.violation_count = 0
        self.allowed_paths = self._get_allowed_paths()
        self.blocked_commands = self._get_blocked_commands()
        
        logger.info(f"Guardrails inicializados con {len(self.rules)} reglas")
    
    def _load_default_rules(self) -> List[GuardrailRule]:
        """Carga las reglas de seguridad por defecto"""
        return [
            # Reglas para comandos del sistema
            GuardrailRule(
                name="block_dangerous_commands",
                description="Bloquea comandos potencialmente peligrosos",
                pattern=r"(rm\s+-rf|del\s+/[sq]|format\s+[cd]:|shutdown|reboot|halt)",
                action=ActionDecision.DENY,
                applies_to=["system_command"],
                severity="critical",
                message="Comando bloqueado por seguridad. Comandos destructivos no están permitidos."
            ),
            
            GuardrailRule(
                name="require_confirmation_system_changes",
                description="Requiere confirmación para cambios del sistema",
                pattern=r"(sudo|su\s+|chmod|chown|usermod|passwd)",
                action=ActionDecision.REQUIRE_CONFIRMATION,
                applies_to=["system_command"],
                severity="high",
                message="Este comando requiere confirmación humana por seguridad."
            ),
            
            # Reglas para archivos
            GuardrailRule(
                name="protect_system_files",
                description="Protege archivos críticos del sistema",
                pattern=r"(/etc/|/sys/|/proc/|C:\\Windows\\|C:\\Program Files\\)",
                action=ActionDecision.DENY,
                applies_to=["file_write", "file_delete"],
                severity="critical",
                message="No se permite modificar archivos del sistema."
            ),
            
            GuardrailRule(
                name="large_file_confirmation",
                description="Confirma operaciones con archivos grandes",
                pattern=r".*",  # Se evalúa por tamaño, no patrón
                action=ActionDecision.REQUIRE_CONFIRMATION,
                applies_to=["file_write"],
                severity="medium",
                message="Archivo grande detectado. ¿Confirmas la operación?"
            ),
            
            # Reglas para web
            GuardrailRule(
                name="block_malicious_urls",
                description="Bloquea URLs potencialmente maliciosas",
                pattern=r"(malware|phishing|suspicious-domain\.com)",
                action=ActionDecision.DENY,
                applies_to=["web_fetch", "web_search"],
                severity="high",
                message="URL bloqueada por seguridad."
            ),
            
            # Reglas para código
            GuardrailRule(
                name="dangerous_code_patterns",
                description="Detecta patrones de código peligrosos",
                pattern=r"(eval\(|exec\(|__import__|subprocess\.call)",
                action=ActionDecision.REQUIRE_CONFIRMATION,
                applies_to=["code_execution"],
                severity="high",
                message="Código con patrones potencialmente peligrosos detectado."
            )
        ]
    
    def _get_allowed_paths(self) -> List[Path]:
        """Define rutas permitidas para operaciones de archivos"""
        home = Path.home()
        cwd = Path.cwd()
        
        return [
            cwd,  # Directorio de trabajo actual
            home / "Documents",
            home / "Desktop", 
            home / "Downloads",
            Path("/tmp") if os.name != "nt" else Path(os.environ.get("TEMP", "")),
            # Añadir más rutas según necesidades
        ]
    
    def _get_blocked_commands(self) -> List[str]:
        """Lista de comandos completamente bloqueados"""
        return [
            "rm", "del", "format", "fdisk", "mkfs",
            "shutdown", "reboot", "halt", "poweroff",
            "dd", "shred", "wipe", "sdelete",
            "chmod 777", "chown root", "sudo su",
            "curl | sh", "wget | sh", "bash <(curl",
            # Comandos de red peligrosos
            "nc -l", "netcat -l", "nmap", "masscan"
        ]
    
    async def evaluate_action(
        self, 
        tool_name: str, 
        parameters: Dict[str, Any],
        risk_level: RiskLevel
    ) -> Tuple[ActionDecision, Optional[str], Optional[Dict]]:
        """
        Evalúa si una acción es segura para ejecutar
        
        Args:
            tool_name: Nombre de la herramienta
            parameters: Parámetros de la acción
            risk_level: Nivel de riesgo de la herramienta
            
        Returns:
            Tupla con (decisión, mensaje, parámetros_modificados)
        """
        try:
            # 1. Verificar reglas generales por nivel de riesgo
            if risk_level == RiskLevel.CRITICAL:
                return (
                    ActionDecision.REQUIRE_CONFIRMATION,
                    "Acción crítica requiere confirmación humana",
                    None
                )
            
            # 2. Evaluar reglas específicas
            for rule in self.rules:
                if tool_name in rule.applies_to or "all" in rule.applies_to:
                    violation, message, modified_params = await self._check_rule(
                        rule, tool_name, parameters
                    )
                    
                    if violation:
                        self.violation_count += 1
                        logger.warning(f"Violación de guardrail: {rule.name} - {message}")
                        
                        if rule.action == ActionDecision.DENY:
                            return (ActionDecision.DENY, message, None)
                        elif rule.action == ActionDecision.REQUIRE_CONFIRMATION:
                            return (ActionDecision.REQUIRE_CONFIRMATION, message, modified_params)
                        elif rule.action == ActionDecision.MODIFY:
                            return (ActionDecision.ALLOW, message, modified_params)
            
            # 3. Verificaciones específicas por tipo de herramienta
            specific_check = await self._tool_specific_checks(tool_name, parameters)
            if specific_check[0] != ActionDecision.ALLOW:
                return specific_check
            
            # 4. Si pasa todas las verificaciones
            return (ActionDecision.ALLOW, "Acción aprobada", None)
            
        except Exception as e:
            logger.error(f"Error evaluando acción: {e}")
            return (
                ActionDecision.DENY, 
                f"Error en evaluación de seguridad: {str(e)}", 
                None
            )
    
    async def _check_rule(
        self, 
        rule: GuardrailRule, 
        tool_name: str, 
        parameters: Dict[str, Any]
    ) -> Tuple[bool, str, Optional[Dict]]:
        """Verifica una regla específica"""
        
        # Convertir parámetros a string para verificación de patrones
        params_str = str(parameters)
        
        # Verificar patrón regex
        if re.search(rule.pattern, params_str, re.IGNORECASE):
            return (True, rule.message, None)
        
        # Verificaciones específicas por regla
        if rule.name == "large_file_confirmation":
            return await self._check_large_file(parameters)
        elif rule.name == "protect_system_files":
            return await self._check_system_paths(parameters)
        
        return (False, "", None)
    
    async def _check_large_file(self, parameters: Dict[str, Any]) -> Tuple[bool, str, Optional[Dict]]:
        """Verifica si se está trabajando con archivos grandes"""
        if "content" in parameters:
            content_size = len(parameters["content"])
            if content_size > 1024 * 1024:  # 1MB
                return (
                    True, 
                    f"Archivo grande ({content_size // 1024}KB). ¿Confirmas?",
                    None
                )
        
        if "path" in parameters:
            path = Path(parameters["path"])
            if path.exists() and path.stat().st_size > 10 * 1024 * 1024:  # 10MB
                return (
                    True,
                    f"Archivo existente muy grande ({path.stat().st_size // (1024*1024)}MB). ¿Confirmas?",
                    None
                )
        
        return (False, "", None)
    
    async def _check_system_paths(self, parameters: Dict[str, Any]) -> Tuple[bool, str, Optional[Dict]]:
        """Verifica si se está accediendo a rutas del sistema"""
        if "path" in parameters:
            path = Path(parameters["path"]).resolve()
            
            # Verificar si está en rutas permitidas
            for allowed_path in self.allowed_paths:
                try:
                    path.relative_to(allowed_path)
                    return (False, "", None)  # Está en ruta permitida
                except ValueError:
                    continue
            
            # Si llegamos aquí, no está en ninguna ruta permitida
            return (
                True,
                f"Acceso denegado a ruta del sistema: {path}",
                None
            )
        
        return (False, "", None)
    
    async def _tool_specific_checks(
        self, 
        tool_name: str, 
        parameters: Dict[str, Any]
    ) -> Tuple[ActionDecision, str, Optional[Dict]]:
        """Verificaciones específicas por tipo de herramienta"""
        
        if tool_name == "system_command":
            return await self._check_system_command(parameters)
        elif tool_name in ["file_write", "file_delete"]:
            return await self._check_file_operation(parameters)
        elif tool_name in ["web_fetch", "web_search"]:
            return await self._check_web_operation(parameters)
        
        return (ActionDecision.ALLOW, "", None)
    
    async def _check_system_command(self, parameters: Dict[str, Any]) -> Tuple[ActionDecision, str, Optional[Dict]]:
        """Verifica comandos del sistema"""
        command = parameters.get("command", "")
        
        # Verificar comandos bloqueados
        for blocked in self.blocked_commands:
            if blocked in command.lower():
                return (
                    ActionDecision.DENY,
                    f"Comando bloqueado: {blocked}",
                    None
                )
        
        # Comandos que requieren confirmación
        confirmation_patterns = [
            r"pip\s+install",
            r"npm\s+install", 
            r"git\s+push",
            r"docker\s+run"
        ]
        
        for pattern in confirmation_patterns:
            if re.search(pattern, command, re.IGNORECASE):
                return (
                    ActionDecision.REQUIRE_CONFIRMATION,
                    f"Comando requiere confirmación: {command}",
                    None
                )
        
        return (ActionDecision.ALLOW, "", None)
    
    async def _check_file_operation(self, parameters: Dict[str, Any]) -> Tuple[ActionDecision, str, Optional[Dict]]:
        """Verifica operaciones de archivos"""
        path = parameters.get("path", "")
        
        # Verificar extensiones peligrosas
        dangerous_extensions = [".exe", ".bat", ".cmd", ".ps1", ".sh", ".scr"]
        if any(path.lower().endswith(ext) for ext in dangerous_extensions):
            return (
                ActionDecision.REQUIRE_CONFIRMATION,
                f"Operación con archivo ejecutable: {path}",
                None
            )
        
        return (ActionDecision.ALLOW, "", None)
    
    async def _check_web_operation(self, parameters: Dict[str, Any]) -> Tuple[ActionDecision, str, Optional[Dict]]:
        """Verifica operaciones web"""
        url = parameters.get("url", "")
        
        # Lista de dominios bloqueados (ejemplo)
        blocked_domains = [
            "malware.com",
            "phishing-site.net",
            "suspicious-domain.org"
        ]
        
        for domain in blocked_domains:
            if domain in url.lower():
                return (
                    ActionDecision.DENY,
                    f"Dominio bloqueado: {domain}",
                    None
                )
        
        return (ActionDecision.ALLOW, "", None)
    
    def add_custom_rule(self, rule: GuardrailRule):
        """Añade una regla personalizada"""
        self.rules.append(rule)
        logger.info(f"Regla personalizada añadida: {rule.name}")
    
    def remove_rule(self, rule_name: str) -> bool:
        """Elimina una regla por nombre"""
        original_count = len(self.rules)
        self.rules = [r for r in self.rules if r.name != rule_name]
        removed = len(self.rules) < original_count
        
        if removed:
            logger.info(f"Regla eliminada: {rule_name}")
        
        return removed
    
    def get_stats(self) -> Dict[str, Any]:
        """Retorna estadísticas de los guardrails"""
        return {
            "total_rules": len(self.rules),
            "violation_count": self.violation_count,
            "rules_by_severity": {
                "low": len([r for r in self.rules if r.severity == "low"]),
                "medium": len([r for r in self.rules if r.severity == "medium"]),
                "high": len([r for r in self.rules if r.severity == "high"]),
                "critical": len([r for r in self.rules if r.severity == "critical"])
            },
            "allowed_paths_count": len(self.allowed_paths),
            "blocked_commands_count": len(self.blocked_commands)
        }
    
    def list_rules(self) -> List[Dict[str, Any]]:
        """Lista todas las reglas activas"""
        return [
            {
                "name": rule.name,
                "description": rule.description,
                "severity": rule.severity,
                "applies_to": rule.applies_to,
                "action": rule.action.value
            }
            for rule in self.rules
        ]
    
    async def is_path_allowed(self, path: str) -> bool:
        """Verifica si una ruta está permitida"""
        try:
            target_path = Path(path).resolve()
            
            for allowed_path in self.allowed_paths:
                try:
                    target_path.relative_to(allowed_path)
                    return True
                except ValueError:
                    continue
            
            return False
            
        except Exception as e:
            logger.error(f"Error verificando ruta {path}: {e}")
            return False
    
    async def sanitize_command(self, command: str) -> Tuple[str, List[str]]:
        """
        Sanitiza un comando eliminando partes peligrosas
        
        Returns:
            Tupla con (comando_sanitizado, warnings)
        """
        warnings = []
        sanitized = command
        
        # Eliminar pipes peligrosos
        dangerous_pipes = ["|sh", "|bash", "|python", "|perl"]
        for pipe in dangerous_pipes:
            if pipe in sanitized:
                sanitized = sanitized.replace(pipe, "")
                warnings.append(f"Pipe peligroso eliminado: {pipe}")
        
        # Eliminar redirecciones a archivos del sistema
        system_redirects = ["> /etc/", "> C:\\Windows\\"]
        for redirect in system_redirects:
            if redirect in sanitized:
                sanitized = sanitized.replace(redirect, "> /tmp/safe_output")
                warnings.append(f"Redirección peligrosa modificada: {redirect}")
        
        return sanitized, warnings
    
    def enable_rule(self, rule_name: str) -> bool:
        """Habilita una regla específica"""
        # En una implementación completa, las reglas tendrían un estado enabled/disabled
        logger.info(f"Regla habilitada: {rule_name}")
        return True
    
    def disable_rule(self, rule_name: str) -> bool:
        """Deshabilita una regla específica"""
        logger.warning(f"Regla deshabilitada: {rule_name}")
        return True
