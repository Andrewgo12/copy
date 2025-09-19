"""
Herramientas para operaciones con archivos y directorios
"""
import os
import shutil
import asyncio
from pathlib import Path
from typing import Dict, Any, List
from loguru import logger

from .base import BaseTool, ToolDefinition, ToolParameter, ToolCategory, RiskLevel, requires_confirmation


class ReadFileTool(BaseTool):
    """Herramienta para leer archivos"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="read_file",
            description="Lee el contenido completo de un archivo",
            category=ToolCategory.FILE_SYSTEM,
            risk_level=RiskLevel.SAFE,
            parameters=[
                ToolParameter(
                    name="path",
                    type="string",
                    description="Ruta del archivo a leer",
                    required=True
                ),
                ToolParameter(
                    name="encoding",
                    type="string", 
                    description="Codificación del archivo",
                    required=False,
                    default="utf-8"
                ),
                ToolParameter(
                    name="max_lines",
                    type="int",
                    description="Máximo número de líneas a leer",
                    required=False,
                    default=None
                )
            ],
            examples=[
                {"path": "src/main.py"},
                {"path": "config.json", "encoding": "utf-8"},
                {"path": "large_file.txt", "max_lines": 100}
            ]
        )
    
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta la lectura del archivo"""
        try:
            path = Path(parameters["path"])
            encoding = parameters.get("encoding", "utf-8")
            max_lines = parameters.get("max_lines")
            
            if not path.exists():
                return {
                    "success": False,
                    "result": None,
                    "error": f"Archivo no encontrado: {path}",
                    "metadata": {"path": str(path)}
                }
            
            if not path.is_file():
                return {
                    "success": False,
                    "result": None,
                    "error": f"La ruta no es un archivo: {path}",
                    "metadata": {"path": str(path)}
                }
            
            # Leer archivo
            with open(path, 'r', encoding=encoding) as f:
                if max_lines:
                    lines = []
                    for i, line in enumerate(f):
                        if i >= max_lines:
                            break
                        lines.append(line.rstrip('\n'))
                    content = '\n'.join(lines)
                else:
                    content = f.read()
            
            # Metadatos del archivo
            stat = path.stat()
            metadata = {
                "path": str(path),
                "size_bytes": stat.st_size,
                "lines_read": len(content.split('\n')) if content else 0,
                "encoding": encoding,
                "truncated": max_lines is not None and len(content.split('\n')) == max_lines
            }
            
            return {
                "success": True,
                "result": content,
                "error": None,
                "metadata": metadata
            }
            
        except Exception as e:
            logger.error(f"Error leyendo archivo {parameters.get('path')}: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"path": parameters.get("path")}
            }


class WriteFileTool(BaseTool):
    """Herramienta para escribir archivos"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="write_file",
            description="Escribe contenido a un archivo, creándolo si no existe",
            category=ToolCategory.FILE_SYSTEM,
            risk_level=RiskLevel.MEDIUM,
            parameters=[
                ToolParameter(
                    name="path",
                    type="string",
                    description="Ruta del archivo a escribir",
                    required=True
                ),
                ToolParameter(
                    name="content",
                    type="string",
                    description="Contenido a escribir",
                    required=True
                ),
                ToolParameter(
                    name="mode",
                    type="string",
                    description="Modo de escritura",
                    required=False,
                    default="w",
                    allowed_values=["w", "a", "x"]  # write, append, exclusive
                ),
                ToolParameter(
                    name="encoding",
                    type="string",
                    description="Codificación del archivo",
                    required=False,
                    default="utf-8"
                ),
                ToolParameter(
                    name="create_dirs",
                    type="bool",
                    description="Crear directorios padre si no existen",
                    required=False,
                    default=True
                )
            ],
            examples=[
                {"path": "output.txt", "content": "Hello World"},
                {"path": "logs/app.log", "content": "Log entry", "mode": "a"},
                {"path": "new_file.py", "content": "# Python code", "mode": "x"}
            ],
            requires_confirmation=True
        )
    
    @requires_confirmation
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta la escritura del archivo"""
        try:
            path = Path(parameters["path"])
            content = parameters["content"]
            mode = parameters.get("mode", "w")
            encoding = parameters.get("encoding", "utf-8")
            create_dirs = parameters.get("create_dirs", True)
            
            # Crear directorios padre si es necesario
            if create_dirs and not path.parent.exists():
                path.parent.mkdir(parents=True, exist_ok=True)
                logger.info(f"Directorios creados: {path.parent}")
            
            # Verificar si el archivo existe en modo exclusivo
            if mode == "x" and path.exists():
                return {
                    "success": False,
                    "result": None,
                    "error": f"Archivo ya existe (modo exclusivo): {path}",
                    "metadata": {"path": str(path), "mode": mode}
                }
            
            # Escribir archivo
            with open(path, mode, encoding=encoding) as f:
                f.write(content)
            
            # Metadatos
            stat = path.stat()
            metadata = {
                "path": str(path),
                "size_bytes": stat.st_size,
                "lines_written": len(content.split('\n')),
                "mode": mode,
                "encoding": encoding,
                "created_dirs": create_dirs and not path.parent.exists()
            }
            
            logger.info(f"Archivo escrito: {path} ({stat.st_size} bytes)")
            
            return {
                "success": True,
                "result": f"Archivo escrito exitosamente: {path}",
                "error": None,
                "metadata": metadata
            }
            
        except Exception as e:
            logger.error(f"Error escribiendo archivo {parameters.get('path')}: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"path": parameters.get("path")}
            }


class ListDirectoryTool(BaseTool):
    """Herramienta para listar contenido de directorios"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="list_directory",
            description="Lista archivos y subdirectorios en una ruta",
            category=ToolCategory.FILE_SYSTEM,
            risk_level=RiskLevel.SAFE,
            parameters=[
                ToolParameter(
                    name="path",
                    type="string",
                    description="Ruta del directorio a listar",
                    required=True
                ),
                ToolParameter(
                    name="recursive",
                    type="bool",
                    description="Listar recursivamente subdirectorios",
                    required=False,
                    default=False
                ),
                ToolParameter(
                    name="include_hidden",
                    type="bool",
                    description="Incluir archivos ocultos",
                    required=False,
                    default=False
                ),
                ToolParameter(
                    name="file_pattern",
                    type="string",
                    description="Patrón de archivos a incluir (glob)",
                    required=False,
                    default="*"
                )
            ],
            examples=[
                {"path": "."},
                {"path": "src", "recursive": True},
                {"path": ".", "file_pattern": "*.py", "include_hidden": False}
            ]
        )
    
    async def execute(self, parameters: Dict[str, Any]) -> Dict[str, Any]:
        """Ejecuta el listado del directorio"""
        try:
            path = Path(parameters["path"])
            recursive = parameters.get("recursive", False)
            include_hidden = parameters.get("include_hidden", False)
            file_pattern = parameters.get("file_pattern", "*")
            
            if not path.exists():
                return {
                    "success": False,
                    "result": None,
                    "error": f"Directorio no encontrado: {path}",
                    "metadata": {"path": str(path)}
                }
            
            if not path.is_dir():
                return {
                    "success": False,
                    "result": None,
                    "error": f"La ruta no es un directorio: {path}",
                    "metadata": {"path": str(path)}
                }
            
            # Listar archivos
            files = []
            directories = []
            
            if recursive:
                pattern_path = path / "**" / file_pattern
                items = path.glob(str(pattern_path))
            else:
                items = path.glob(file_pattern)
            
            for item in items:
                # Filtrar archivos ocultos si es necesario
                if not include_hidden and item.name.startswith('.'):
                    continue
                
                item_info = {
                    "name": item.name,
                    "path": str(item.relative_to(path)),
                    "absolute_path": str(item),
                    "size": item.stat().st_size if item.is_file() else None,
                    "modified": item.stat().st_mtime,
                    "is_file": item.is_file(),
                    "is_directory": item.is_dir()
                }
                
                if item.is_file():
                    files.append(item_info)
                else:
                    directories.append(item_info)
            
            result = {
                "directories": sorted(directories, key=lambda x: x["name"]),
                "files": sorted(files, key=lambda x: x["name"]),
                "total_files": len(files),
                "total_directories": len(directories)
            }
            
            metadata = {
                "path": str(path),
                "recursive": recursive,
                "include_hidden": include_hidden,
                "file_pattern": file_pattern,
                "total_items": len(files) + len(directories)
            }
            
            return {
                "success": True,
                "result": result,
                "error": None,
                "metadata": metadata
            }
            
        except Exception as e:
            logger.error(f"Error listando directorio {parameters.get('path')}: {e}")
            return {
                "success": False,
                "result": None,
                "error": str(e),
                "metadata": {"path": parameters.get("path")}
            }
