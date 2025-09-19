"""
Herramientas para ejecutar comandos del sistema de forma segura
"""
import asyncio
import subprocess
import shlex
import os
import signal
from typing import Dict, Any, List, Optional
from pathlib import Path
from loguru import logger

from .base import BaseTool, ToolDefinition, ToolParameter, ToolCategory, RiskLevel, requires_confirmation, requires_sandbox


class SystemCommandTool(BaseTool):
    """Herramienta para ejecutar comandos del sistema con sandboxing"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="system_command",
            description="Ejecuta comandos del sistema de forma segura",
            category=ToolCategory.SYSTEM_COMMANDS,
            risk_level=RiskLevel.HIGH,
            parameters=[
                ToolParameter(
                    name="command",
                    type="string",
                    description="Comando a ejecutar",
                    required=True
                ),
                ToolParameter(
                    name="working_directory",
                    type="string",
                    description="Directorio de trabajo",
                    required=False,
                    default="."
                ),
                ToolParameter(
                    name="timeout",
                    type="int",
                    description="Timeout en segundos",
                    required=False,
                    default=30
                ),
                ToolParameter(
                    name="capture_output",
                    type="bool",
                    description="Capturar stdout y stderr",
                    required=False,
                    default=True
                ),
                ToolParameter(
                    name="shell",
                    type="bool",
                    description="Ejecutar en shell",
                    required=False,
                    default=False
                )
            ],
            examples=[
                {"command": "ls -la", "working_directory": "/tmp"},
                {"command": "python --version"},
                {"command": "git status", "timeout": 10}
            ],
            requires_sandbox=True,
            requires_confirmation=True,
            max_execution_time=300
        )
    
    @requires_confirmation
    @requires_sandbox
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta el comando del sistema"""
        try:
            command = parameters["command"]
            working_dir = parameters.get("working_directory", ".")
            timeout = parameters.get("timeout", 30)
            capture_output = parameters.get("capture_output", True)
            use_shell = parameters.get("shell", False)
            
            # Validaciones de seguridad adicionales
            if not await self._is_command_safe(command):
                return {
                    "success": False,
                    "result": None,
                    "error": "Comando bloqueado por seguridad",
                    "metadata": {"command": command, "reason": "unsafe_command"}
                }
            
            # Preparar comando
            if use_shell:
                cmd_args = command
            else:
                cmd_args = shlex.split(command)
            
            # Configurar entorno limitado
            env = self._get_restricted_environment()
            
            # Ejecutar comando
            start_time = asyncio.get_event_loop().time()
            
            process = await asyncio.create_subprocess_exec(
                *cmd_args if not use_shell else ["/bin/sh", "-c", command],
                stdout=subprocess.PIPE if capture_output else None,
                stderr=subprocess.PIPE if capture_output else None,
                cwd=working_dir,
                env=env
            )
            
            try:
                stdout, stderr = await asyncio.wait_for(
                    process.communicate(), 
                    timeout=timeout
                )
                
                execution_time = asyncio.get_event_loop().time() - start_time
                
                # Decodificar salidas
                stdout_text = stdout.decode('utf-8', errors='replace') if stdout else ""
                stderr_text = stderr.decode('utf-8', errors='replace') if stderr else ""
                
                result = {
                    "stdout": stdout_text,
                    "stderr": stderr_text,
                    "return_code": process.returncode,
                    "execution_time": execution_time
                }
                
                metadata = {
                    "command": command,
                    "working_directory": working_dir,
                    "timeout": timeout,
                    "execution_time": execution_time,
                    "return_code": process.returncode,
                    "output_length": len(stdout_text) + len(stderr_text)
                }
                
                success = process.returncode == 0
                error_msg = stderr_text if not success else None
                
                logger.info(f"Comando ejecutado: {command} (código: {process.returncode})")
                
                return {
                    "success": success,
                    "result": result,
                    "error": error_msg,
                    "metadata": metadata
                }
                
            except asyncio.TimeoutError:
                # Matar proceso si excede timeout
                try:
                    process.kill()
                    await process.wait()
                except:
                    pass
                
                return {
                    "success": False,
                    "result": None,
                    "error": f"Comando excedió timeout de {timeout} segundos",
                    "metadata": {"command": command, "timeout": timeout}
                }
                
        except Exception as e:
            logger.error(f"Error ejecutando comando {command}: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"command": command}
            }
    
    async def _is_command_safe(self, command: str) -> bool:
        """Verifica si un comando es seguro para ejecutar"""
        dangerous_patterns = [
            r"rm\s+-rf",
            r"del\s+/[sq]",
            r"format\s+[cd]:",
            r"shutdown",
            r"reboot",
            r"halt",
            r"dd\s+if=",
            r"mkfs",
            r"fdisk",
            r"sudo\s+su",
            r"chmod\s+777",
            r"chown\s+root",
            r"curl.*\|\s*sh",
            r"wget.*\|\s*sh",
            r"bash\s*<\(",
            r"nc\s+-l",
            r"netcat\s+-l"
        ]
        
        import re
        command_lower = command.lower()
        
        for pattern in dangerous_patterns:
            if re.search(pattern, command_lower):
                logger.warning(f"Comando peligroso detectado: {command}")
                return False
        
        return True
    
    def _get_restricted_environment(self) -> Dict[str, str]:
        """Crea un entorno restringido para la ejecución"""
        # Entorno mínimo y seguro
        safe_env = {
            "PATH": "/usr/local/bin:/usr/bin:/bin",
            "HOME": "/tmp/agent_home",
            "USER": "agent",
            "SHELL": "/bin/sh",
            "TERM": "xterm",
            "LANG": "en_US.UTF-8"
        }
        
        # Añadir variables específicas si son necesarias
        allowed_vars = ["PYTHONPATH", "NODE_PATH", "JAVA_HOME"]
        for var in allowed_vars:
            if var in os.environ:
                safe_env[var] = os.environ[var]
        
        return safe_env


class InstallPackageTool(BaseTool):
    """Herramienta para instalar paquetes de forma segura"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="install_package",
            description="Instala paquetes usando gestores de paquetes estándar",
            category=ToolCategory.SYSTEM_COMMANDS,
            risk_level=RiskLevel.MEDIUM,
            parameters=[
                ToolParameter(
                    name="package_manager",
                    type="string",
                    description="Gestor de paquetes a usar",
                    required=True,
                    allowed_values=["pip", "npm", "yarn", "apt", "brew", "cargo"]
                ),
                ToolParameter(
                    name="package_name",
                    type="string",
                    description="Nombre del paquete a instalar",
                    required=True
                ),
                ToolParameter(
                    name="version",
                    type="string",
                    description="Versión específica (opcional)",
                    required=False
                ),
                ToolParameter(
                    name="extra_args",
                    type="list",
                    description="Argumentos adicionales",
                    required=False,
                    default=[]
                )
            ],
            examples=[
                {"package_manager": "pip", "package_name": "requests"},
                {"package_manager": "npm", "package_name": "express", "version": "4.18.0"},
                {"package_manager": "pip", "package_name": "numpy", "extra_args": ["--user"]}
            ],
            requires_confirmation=True
        )
    
    @requires_confirmation
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta la instalación del paquete"""
        try:
            package_manager = parameters["package_manager"]
            package_name = parameters["package_name"]
            version = parameters.get("version")
            extra_args = parameters.get("extra_args", [])
            
            # Construir comando según el gestor de paquetes
            commands = {
                "pip": ["pip", "install"],
                "npm": ["npm", "install"],
                "yarn": ["yarn", "add"],
                "apt": ["apt-get", "install", "-y"],
                "brew": ["brew", "install"],
                "cargo": ["cargo", "install"]
            }
            
            if package_manager not in commands:
                return {
                    "success": False,
                    "result": None,
                    "error": f"Gestor de paquetes no soportado: {package_manager}",
                    "metadata": {"package_manager": package_manager}
                }
            
            # Construir comando completo
            cmd = commands[package_manager].copy()
            
            if version:
                if package_manager == "pip":
                    cmd.append(f"{package_name}=={version}")
                elif package_manager in ["npm", "yarn"]:
                    cmd.append(f"{package_name}@{version}")
                else:
                    cmd.extend([package_name, version])
            else:
                cmd.append(package_name)
            
            cmd.extend(extra_args)
            
            # Ejecutar instalación
            logger.info(f"Instalando paquete: {' '.join(cmd)}")
            
            process = await asyncio.create_subprocess_exec(
                *cmd,
                stdout=subprocess.PIPE,
                stderr=subprocess.PIPE,
                cwd="."
            )
            
            stdout, stderr = await asyncio.wait_for(
                process.communicate(),
                timeout=300  # 5 minutos para instalaciones
            )
            
            stdout_text = stdout.decode('utf-8', errors='replace')
            stderr_text = stderr.decode('utf-8', errors='replace')
            
            success = process.returncode == 0
            
            result = {
                "package_manager": package_manager,
                "package_name": package_name,
                "version": version,
                "stdout": stdout_text,
                "stderr": stderr_text,
                "return_code": process.returncode
            }
            
            metadata = {
                "command": " ".join(cmd),
                "package_manager": package_manager,
                "package_name": package_name,
                "version": version,
                "execution_time": 0,  # Se calcularía en implementación real
                "output_length": len(stdout_text) + len(stderr_text)
            }
            
            if success:
                logger.info(f"Paquete instalado exitosamente: {package_name}")
            else:
                logger.error(f"Error instalando paquete {package_name}: {stderr_text}")
            
            return {
                "success": success,
                "result": result,
                "error": stderr_text if not success else None,
                "metadata": metadata
            }
            
        except asyncio.TimeoutError:
            return {
                "success": False,
                "result": None,
                "error": "Instalación excedió timeout de 5 minutos",
                "metadata": {"package_name": package_name}
            }
        except Exception as e:
            logger.error(f"Error en instalación de paquete: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"package_name": package_name}
            }


class GitOperationTool(BaseTool):
    """Herramienta para operaciones Git básicas"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="git_operation",
            description="Ejecuta operaciones Git básicas",
            category=ToolCategory.SYSTEM_COMMANDS,
            risk_level=RiskLevel.MEDIUM,
            parameters=[
                ToolParameter(
                    name="operation",
                    type="string",
                    description="Operación Git a ejecutar",
                    required=True,
                    allowed_values=["status", "log", "diff", "add", "commit", "push", "pull", "clone"]
                ),
                ToolParameter(
                    name="repository_path",
                    type="string",
                    description="Ruta del repositorio",
                    required=False,
                    default="."
                ),
                ToolParameter(
                    name="additional_args",
                    type="list",
                    description="Argumentos adicionales para el comando",
                    required=False,
                    default=[]
                ),
                ToolParameter(
                    name="commit_message",
                    type="string",
                    description="Mensaje de commit (para operación commit)",
                    required=False
                )
            ],
            examples=[
                {"operation": "status"},
                {"operation": "log", "additional_args": ["--oneline", "-10"]},
                {"operation": "commit", "commit_message": "Update documentation"},
                {"operation": "clone", "additional_args": ["https://github.com/user/repo.git"]}
            ],
            requires_confirmation=True  # Para operaciones que modifican el repo
        )
    
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta la operación Git"""
        try:
            operation = parameters["operation"]
            repo_path = parameters.get("repository_path", ".")
            additional_args = parameters.get("additional_args", [])
            commit_message = parameters.get("commit_message")
            
            # Verificar si el directorio es un repositorio Git
            if operation != "clone" and not await self._is_git_repository(repo_path):
                return {
                    "success": False,
                    "result": None,
                    "error": f"No es un repositorio Git: {repo_path}",
                    "metadata": {"repository_path": repo_path}
                }
            
            # Construir comando Git
            cmd = ["git", operation]
            
            # Añadir argumentos específicos por operación
            if operation == "commit" and commit_message:
                cmd.extend(["-m", commit_message])
            
            cmd.extend(additional_args)
            
            # Verificar si requiere confirmación
            dangerous_operations = ["push", "pull", "reset", "rebase", "merge"]
            if operation in dangerous_operations:
                logger.warning(f"Operación Git peligrosa: {operation}")
            
            # Ejecutar comando
            logger.info(f"Ejecutando Git: {' '.join(cmd)}")
            
            process = await asyncio.create_subprocess_exec(
                *cmd,
                stdout=subprocess.PIPE,
                stderr=subprocess.PIPE,
                cwd=repo_path
            )
            
            stdout, stderr = await asyncio.wait_for(
                process.communicate(),
                timeout=60  # 1 minuto para operaciones Git
            )
            
            stdout_text = stdout.decode('utf-8', errors='replace')
            stderr_text = stderr.decode('utf-8', errors='replace')
            
            success = process.returncode == 0
            
            result = {
                "operation": operation,
                "stdout": stdout_text,
                "stderr": stderr_text,
                "return_code": process.returncode,
                "repository_path": repo_path
            }
            
            metadata = {
                "command": " ".join(cmd),
                "operation": operation,
                "repository_path": repo_path,
                "return_code": process.returncode
            }
            
            if success:
                logger.info(f"Operación Git exitosa: {operation}")
            else:
                logger.error(f"Error en operación Git {operation}: {stderr_text}")
            
            return {
                "success": success,
                "result": result,
                "error": stderr_text if not success else None,
                "metadata": metadata
            }
            
        except Exception as e:
            logger.error(f"Error en operación Git: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"operation": parameters.get("operation")}
            }
    
    async def _is_git_repository(self, path: str) -> bool:
        """Verifica si un directorio es un repositorio Git"""
        try:
            git_dir = Path(path) / ".git"
            return git_dir.exists()
        except Exception:
            return False


class ProcessManagerTool(BaseTool):
    """Herramienta para gestionar procesos del sistema"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="process_manager",
            description="Gestiona procesos del sistema (listar, monitorear)",
            category=ToolCategory.SYSTEM_COMMANDS,
            risk_level=RiskLevel.LOW,
            parameters=[
                ToolParameter(
                    name="action",
                    type="string",
                    description="Acción a realizar",
                    required=True,
                    allowed_values=["list", "info", "monitor"]
                ),
                ToolParameter(
                    name="process_name",
                    type="string",
                    description="Nombre del proceso (para info/monitor)",
                    required=False
                ),
                ToolParameter(
                    name="filter_user",
                    type="bool",
                    description="Filtrar solo procesos del usuario actual",
                    required=False,
                    default=True
                )
            ],
            examples=[
                {"action": "list"},
                {"action": "info", "process_name": "python"},
                {"action": "monitor", "process_name": "node"}
            ]
        )
    
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta la gestión de procesos"""
        try:
            import psutil
            
            action = parameters["action"]
            process_name = parameters.get("process_name")
            filter_user = parameters.get("filter_user", True)
            
            if action == "list":
                return await self._list_processes(filter_user)
            elif action == "info":
                return await self._get_process_info(process_name)
            elif action == "monitor":
                return await self._monitor_process(process_name)
            else:
                return {
                    "success": False,
                    "result": None,
                    "error": f"Acción no soportada: {action}",
                    "metadata": {"action": action}
                }
                
        except ImportError:
            return {
                "success": False,
                "result": None,
                "error": "psutil no está instalado. Ejecuta: pip install psutil",
                "metadata": {"missing_dependency": "psutil"}
            }
        except Exception as e:
            logger.error(f"Error en gestión de procesos: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"action": parameters.get("action")}
            }
    
    async def _list_processes(self, filter_user: bool) -> Dict[str, Any]:
        """Lista procesos del sistema"""
        import psutil
        
        processes = []
        current_user = psutil.Process().username() if filter_user else None
        
        for proc in psutil.process_iter(['pid', 'name', 'username', 'cpu_percent', 'memory_percent']):
            try:
                if filter_user and proc.info['username'] != current_user:
                    continue
                
                processes.append({
                    "pid": proc.info['pid'],
                    "name": proc.info['name'],
                    "username": proc.info['username'],
                    "cpu_percent": proc.info['cpu_percent'],
                    "memory_percent": proc.info['memory_percent']
                })
            except (psutil.NoSuchProcess, psutil.AccessDenied):
                continue
        
        # Ordenar por uso de CPU
        processes.sort(key=lambda x: x['cpu_percent'], reverse=True)
        
        return {
            "success": True,
            "result": {
                "processes": processes[:20],  # Top 20
                "total_count": len(processes),
                "filtered_by_user": filter_user
            },
            "error": None,
            "metadata": {"action": "list", "filter_user": filter_user}
        }
