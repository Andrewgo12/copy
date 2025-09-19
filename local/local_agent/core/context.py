"""
Context Engine - Mantiene y recupera contexto relevante para el agente
"""
import asyncio
import json
import os
from typing import Dict, Any, List, Optional
from pathlib import Path
from dataclasses import dataclass
from loguru import logger

from ..storage.vector_db import VectorDatabase


@dataclass
class ContextItem:
    """Item individual de contexto"""
    source: str  # file, memory, web, system
    content: str
    metadata: Dict[str, Any]
    relevance_score: float
    timestamp: float


class ContextEngine:
    """
    Motor de contexto que mantiene información relevante sobre:
    - Estado actual del sistema de archivos
    - Código y proyectos activos
    - Configuraciones del usuario
    - Historial de comandos exitosos
    """
    
    def __init__(self, vector_db: VectorDatabase):
        self.vector_db = vector_db
        self.file_cache: Dict[str, Dict[str, Any]] = {}
        self.system_context: Dict[str, Any] = {}
        self.project_context: Dict[str, Any] = {}
        
        # Configuración
        self.max_context_items = 20
        self.file_cache_ttl = 300  # 5 minutos
        self.auto_refresh_interval = 60  # 1 minuto
        
        # Inicializar contexto del sistema
        asyncio.create_task(self._initialize_system_context())
        
        logger.info("Context Engine inicializado")
    
    async def get_relevant_context(
        self, 
        query: str, 
        session_id: str,
        include_files: bool = True,
        include_system: bool = True,
        include_memory: bool = True
    ) -> List[Dict[str, Any]]:
        """
        Recupera contexto relevante para una consulta
        
        Args:
            query: Consulta del usuario
            session_id: ID de la sesión actual
            include_files: Incluir contexto de archivos
            include_system: Incluir contexto del sistema
            include_memory: Incluir contexto de memoria
            
        Returns:
            Lista de items de contexto relevantes
        """
        try:
            context_items = []
            
            # 1. Contexto de archivos del proyecto actual
            if include_files:
                file_context = await self._get_file_context(query)
                context_items.extend(file_context)
            
            # 2. Contexto del sistema
            if include_system:
                system_context = await self._get_system_context(query)
                context_items.extend(system_context)
            
            # 3. Contexto de memoria (delegado al MemoryManager)
            if include_memory:
                # Esto se haría a través del MemoryManager
                memory_context = await self._get_memory_context(query, session_id)
                context_items.extend(memory_context)
            
            # 4. Contexto del proyecto actual
            project_context = await self._get_project_context(query)
            context_items.extend(project_context)
            
            # 5. Ordenar por relevancia y limitar
            context_items.sort(key=lambda x: x.get("relevance_score", 0), reverse=True)
            context_items = context_items[:self.max_context_items]
            
            logger.debug(f"Contexto recuperado: {len(context_items)} items")
            return context_items
            
        except Exception as e:
            logger.error(f"Error recuperando contexto: {e}")
            return []
    
    async def _get_file_context(self, query: str) -> List[Dict[str, Any]]:
        """Obtiene contexto relevante de archivos"""
        context = []
        
        try:
            # Obtener directorio de trabajo actual
            cwd = Path.cwd()
            
            # Buscar archivos relevantes basados en la consulta
            relevant_files = await self._find_relevant_files(query, cwd)
            
            for file_path in relevant_files:
                # Verificar caché
                file_info = await self._get_cached_file_info(file_path)
                
                if file_info:
                    context.append({
                        "source": "file_system",
                        "type": "file_content",
                        "content": file_info["summary"],
                        "metadata": {
                            "file_path": str(file_path),
                            "file_size": file_info["size"],
                            "last_modified": file_info["modified"],
                            "file_type": file_info["type"]
                        },
                        "relevance_score": file_info["relevance"]
                    })
            
            return context
            
        except Exception as e:
            logger.error(f"Error obteniendo contexto de archivos: {e}")
            return []
    
    async def _find_relevant_files(self, query: str, base_path: Path) -> List[Path]:
        """Encuentra archivos relevantes para la consulta"""
        relevant_files = []
        query_lower = query.lower()
        
        # Patrones de archivos importantes
        important_patterns = [
            "*.py", "*.js", "*.ts", "*.java", "*.cpp", "*.c", "*.h",
            "*.md", "*.txt", "*.json", "*.yml", "*.yaml", "*.toml",
            "README*", "requirements*", "package.json", "Cargo.toml",
            "Dockerfile", "docker-compose*", ".env*", "config*"
        ]
        
        try:
            # Buscar archivos que coincidan con patrones
            for pattern in important_patterns:
                for file_path in base_path.rglob(pattern):
                    if file_path.is_file() and file_path.stat().st_size < 1024 * 1024:  # < 1MB
                        # Verificar relevancia básica
                        if await self._is_file_relevant(file_path, query_lower):
                            relevant_files.append(file_path)
            
            # Limitar número de archivos
            return relevant_files[:10]
            
        except Exception as e:
            logger.error(f"Error buscando archivos relevantes: {e}")
            return []
    
    async def _is_file_relevant(self, file_path: Path, query: str) -> bool:
        """Determina si un archivo es relevante para la consulta"""
        try:
            # Relevancia por nombre de archivo
            if any(word in file_path.name.lower() for word in query.split()):
                return True
            
            # Relevancia por contenido (solo para archivos pequeños)
            if file_path.stat().st_size < 50 * 1024:  # < 50KB
                try:
                    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                        content = f.read(1000)  # Primeros 1000 caracteres
                        if any(word in content.lower() for word in query.split()):
                            return True
                except:
                    pass
            
            return False
            
        except Exception:
            return False
    
    async def _get_cached_file_info(self, file_path: Path) -> Optional[Dict[str, Any]]:
        """Obtiene información de archivo desde caché o la genera"""
        file_key = str(file_path)
        current_time = asyncio.get_event_loop().time()
        
        # Verificar caché
        if file_key in self.file_cache:
            cached = self.file_cache[file_key]
            if current_time - cached["cached_at"] < self.file_cache_ttl:
                return cached
        
        # Generar nueva información
        try:
            stat = file_path.stat()
            
            # Leer contenido para generar resumen
            content_summary = await self._generate_file_summary(file_path)
            
            file_info = {
                "summary": content_summary,
                "size": stat.st_size,
                "modified": stat.st_mtime,
                "type": file_path.suffix,
                "relevance": 0.5,  # Relevancia base
                "cached_at": current_time
            }
            
            # Cachear información
            self.file_cache[file_key] = file_info
            
            return file_info
            
        except Exception as e:
            logger.error(f"Error obteniendo info de archivo {file_path}: {e}")
            return None
    
    async def _generate_file_summary(self, file_path: Path) -> str:
        """Genera un resumen del contenido de un archivo"""
        try:
            # Leer archivo
            with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                content = f.read(2000)  # Primeros 2000 caracteres
            
            # Generar resumen básico
            lines = content.split('\n')
            total_lines = len(lines)
            
            # Para archivos de código, extraer funciones/clases
            if file_path.suffix in ['.py', '.js', '.ts', '.java']:
                summary = await self._extract_code_structure(content, file_path.suffix)
            else:
                # Para otros archivos, usar primeras líneas
                summary = '\n'.join(lines[:10])
            
            return f"Archivo: {file_path.name} ({total_lines} líneas)\n{summary}"
            
        except Exception as e:
            logger.error(f"Error generando resumen de {file_path}: {e}")
            return f"Archivo: {file_path.name} (error leyendo contenido)"
    
    async def _extract_code_structure(self, content: str, file_extension: str) -> str:
        """Extrae estructura básica de archivos de código"""
        try:
            lines = content.split('\n')
            structure = []
            
            if file_extension == '.py':
                # Extraer clases y funciones de Python
                for line in lines:
                    stripped = line.strip()
                    if stripped.startswith('class ') or stripped.startswith('def '):
                        structure.append(stripped)
            
            elif file_extension in ['.js', '.ts']:
                # Extraer funciones de JavaScript/TypeScript
                for line in lines:
                    stripped = line.strip()
                    if ('function ' in stripped or 
                        'const ' in stripped and '=>' in stripped or
                        'class ' in stripped):
                        structure.append(stripped)
            
            return '\n'.join(structure[:10]) if structure else "Sin estructura detectada"
            
        except Exception as e:
            logger.error(f"Error extrayendo estructura de código: {e}")
            return "Error analizando estructura"
    
    async def _get_system_context(self, query: str) -> List[Dict[str, Any]]:
        """Obtiene contexto del sistema actual"""
        context = []
        
        try:
            # Información del directorio actual
            cwd = Path.cwd()
            context.append({
                "source": "system",
                "type": "working_directory",
                "content": f"Directorio actual: {cwd}",
                "metadata": {"path": str(cwd)},
                "relevance_score": 0.3
            })
            
            # Información del entorno Python
            python_info = f"Python {os.sys.version.split()[0]}"
            context.append({
                "source": "system",
                "type": "python_environment",
                "content": f"Entorno: {python_info}",
                "metadata": {"python_version": python_info},
                "relevance_score": 0.2
            })
            
            # Variables de entorno relevantes
            relevant_env_vars = ["PATH", "PYTHONPATH", "NODE_PATH", "JAVA_HOME"]
            for var in relevant_env_vars:
                if var in os.environ:
                    context.append({
                        "source": "system",
                        "type": "environment_variable",
                        "content": f"{var}: {os.environ[var][:100]}...",
                        "metadata": {"variable": var},
                        "relevance_score": 0.1
                    })
            
            return context
            
        except Exception as e:
            logger.error(f"Error obteniendo contexto del sistema: {e}")
            return []
    
    async def _get_memory_context(self, query: str, session_id: str) -> List[Dict[str, Any]]:
        """Obtiene contexto de memoria (placeholder - se integra con MemoryManager)"""
        # En la implementación real, esto se delegaría al MemoryManager
        return []
    
    async def _get_project_context(self, query: str) -> List[Dict[str, Any]]:
        """Obtiene contexto del proyecto actual"""
        context = []
        
        try:
            cwd = Path.cwd()
            
            # Detectar tipo de proyecto
            project_type = await self._detect_project_type(cwd)
            
            if project_type:
                context.append({
                    "source": "project",
                    "type": "project_info",
                    "content": f"Proyecto detectado: {project_type}",
                    "metadata": {"project_type": project_type},
                    "relevance_score": 0.6
                })
                
                # Contexto específico del tipo de proyecto
                specific_context = await self._get_project_specific_context(cwd, project_type)
                context.extend(specific_context)
            
            return context
            
        except Exception as e:
            logger.error(f"Error obteniendo contexto del proyecto: {e}")
            return []
    
    async def _detect_project_type(self, path: Path) -> Optional[str]:
        """Detecta el tipo de proyecto basado en archivos presentes"""
        
        project_indicators = {
            "python": ["requirements.txt", "setup.py", "pyproject.toml", "Pipfile"],
            "node": ["package.json", "yarn.lock", "npm-shrinkwrap.json"],
            "rust": ["Cargo.toml", "Cargo.lock"],
            "java": ["pom.xml", "build.gradle", "gradle.properties"],
            "go": ["go.mod", "go.sum"],
            "docker": ["Dockerfile", "docker-compose.yml"],
            "git": [".git"]
        }
        
        detected_types = []
        
        for project_type, indicators in project_indicators.items():
            for indicator in indicators:
                if (path / indicator).exists():
                    detected_types.append(project_type)
                    break
        
        # Retornar el tipo más específico
        priority = ["python", "node", "rust", "java", "go", "docker", "git"]
        for ptype in priority:
            if ptype in detected_types:
                return ptype
        
        return None
    
    async def _get_project_specific_context(self, path: Path, project_type: str) -> List[Dict[str, Any]]:
        """Obtiene contexto específico del tipo de proyecto"""
        context = []
        
        try:
            if project_type == "python":
                context.extend(await self._get_python_project_context(path))
            elif project_type == "node":
                context.extend(await self._get_node_project_context(path))
            elif project_type == "git":
                context.extend(await self._get_git_project_context(path))
            
            return context
            
        except Exception as e:
            logger.error(f"Error obteniendo contexto específico de {project_type}: {e}")
            return []
    
    async def _get_python_project_context(self, path: Path) -> List[Dict[str, Any]]:
        """Obtiene contexto específico de proyectos Python"""
        context = []
        
        # Leer requirements.txt si existe
        requirements_file = path / "requirements.txt"
        if requirements_file.exists():
            try:
                with open(requirements_file, 'r') as f:
                    requirements = f.read()
                
                context.append({
                    "source": "project",
                    "type": "python_requirements",
                    "content": f"Dependencias Python:\n{requirements[:500]}",
                    "metadata": {"file": "requirements.txt"},
                    "relevance_score": 0.7
                })
            except Exception as e:
                logger.error(f"Error leyendo requirements.txt: {e}")
        
        # Buscar archivos Python principales
        main_files = ["main.py", "app.py", "__init__.py", "manage.py"]
        for main_file in main_files:
            file_path = path / main_file
            if file_path.exists():
                try:
                    with open(file_path, 'r', encoding='utf-8', errors='ignore') as f:
                        content = f.read(1000)  # Primeros 1000 caracteres
                    
                    context.append({
                        "source": "project",
                        "type": "python_main_file",
                        "content": f"Archivo principal {main_file}:\n{content}",
                        "metadata": {"file": main_file},
                        "relevance_score": 0.8
                    })
                    break  # Solo incluir un archivo principal
                except Exception as e:
                    logger.error(f"Error leyendo {main_file}: {e}")
        
        return context
    
    async def _get_node_project_context(self, path: Path) -> List[Dict[str, Any]]:
        """Obtiene contexto específico de proyectos Node.js"""
        context = []
        
        # Leer package.json
        package_json = path / "package.json"
        if package_json.exists():
            try:
                with open(package_json, 'r') as f:
                    package_data = json.load(f)
                
                context.append({
                    "source": "project",
                    "type": "node_package",
                    "content": f"Proyecto Node.js: {package_data.get('name', 'Sin nombre')}\n"
                             f"Versión: {package_data.get('version', 'Sin versión')}\n"
                             f"Descripción: {package_data.get('description', 'Sin descripción')}",
                    "metadata": {
                        "package_name": package_data.get('name'),
                        "version": package_data.get('version'),
                        "dependencies": list(package_data.get('dependencies', {}).keys())
                    },
                    "relevance_score": 0.7
                })
            except Exception as e:
                logger.error(f"Error leyendo package.json: {e}")
        
        return context
    
    async def _get_git_project_context(self, path: Path) -> List[Dict[str, Any]]:
        """Obtiene contexto específico de repositorios Git"""
        context = []
        
        try:
            # Información básica del repositorio
            git_dir = path / ".git"
            if git_dir.exists():
                # Leer configuración Git
                git_config = git_dir / "config"
                if git_config.exists():
                    with open(git_config, 'r') as f:
                        config_content = f.read()
                    
                    # Extraer URL del repositorio remoto
                    import re
                    url_match = re.search(r'url = (.+)', config_content)
                    repo_url = url_match.group(1) if url_match else "Local repository"
                    
                    context.append({
                        "source": "project",
                        "type": "git_repository",
                        "content": f"Repositorio Git: {repo_url}",
                        "metadata": {"repository_url": repo_url},
                        "relevance_score": 0.5
                    })
        
        except Exception as e:
            logger.error(f"Error obteniendo contexto Git: {e}")
        
        return context
    
    async def _initialize_system_context(self):
        """Inicializa el contexto del sistema"""
        try:
            import platform
            import psutil
            
            self.system_context = {
                "os": platform.system(),
                "os_version": platform.version(),
                "python_version": platform.python_version(),
                "cpu_count": psutil.cpu_count(),
                "memory_total": psutil.virtual_memory().total,
                "disk_free": psutil.disk_usage('/').free if platform.system() != 'Windows' else psutil.disk_usage('C:').free,
                "working_directory": str(Path.cwd()),
                "user": os.getenv("USER", os.getenv("USERNAME", "unknown"))
            }
            
            logger.debug("Contexto del sistema inicializado")
            
        except Exception as e:
            logger.error(f"Error inicializando contexto del sistema: {e}")
            self.system_context = {}
    
    async def refresh_context(self):
        """Refresca todo el contexto del sistema"""
        try:
            # Limpiar caché de archivos
            self.file_cache.clear()
            
            # Reinicializar contexto del sistema
            await self._initialize_system_context()
            
            # Reescanear proyecto actual
            cwd = Path.cwd()
            self.project_context = {
                "project_type": await self._detect_project_type(cwd),
                "last_scan": asyncio.get_event_loop().time()
            }
            
            logger.info("Contexto refrescado")
            
        except Exception as e:
            logger.error(f"Error refrescando contexto: {e}")
    
    async def add_custom_context(self, key: str, value: Any, relevance: float = 0.5):
        """Añade contexto personalizado"""
        try:
            await self.vector_db.store_document(
                content=f"Contexto personalizado: {key} = {value}",
                metadata={
                    "type": "custom_context",
                    "key": key,
                    "value": value,
                    "relevance": relevance
                },
                collection_name="code_context"
            )
            
            logger.info(f"Contexto personalizado añadido: {key}")
            
        except Exception as e:
            logger.error(f"Error añadiendo contexto personalizado: {e}")
    
    async def get_context_summary(self) -> Dict[str, Any]:
        """Obtiene un resumen del contexto actual"""
        return {
            "system_context": self.system_context,
            "project_context": self.project_context,
            "file_cache_size": len(self.file_cache),
            "last_refresh": asyncio.get_event_loop().time()
        }
