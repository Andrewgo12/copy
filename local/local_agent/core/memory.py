"""
Sistema de memoria del agente - Gestiona memoria a corto y largo plazo
"""
import asyncio
import json
import uuid
from typing import Dict, Any, List, Optional
from dataclasses import dataclass, asdict
from datetime import datetime, timedelta
from loguru import logger

from ..storage.vector_db import VectorDatabase, VectorDocument


@dataclass
class MemoryEntry:
    """Entrada individual de memoria"""
    id: str
    type: str  # conversation, fact, preference, skill
    content: str
    metadata: Dict[str, Any]
    importance: float  # 0.0 - 1.0
    timestamp: float
    session_id: str
    tags: List[str] = None
    
    def to_dict(self) -> Dict[str, Any]:
        return asdict(self)


@dataclass
class ConversationMemory:
    """Memoria específica de conversación"""
    user_input: str
    agent_response: str
    plan_executed: Dict[str, Any]
    results: List[Dict[str, Any]]
    session_id: str
    timestamp: float
    success: bool


class MemoryManager:
    """
    Gestor de memoria que maneja tanto memoria a corto plazo (sesión actual)
    como memoria a largo plazo (persistente entre sesiones)
    """
    
    def __init__(self, vector_db: VectorDatabase):
        self.vector_db = vector_db
        self.short_term_memory: List[MemoryEntry] = []
        self.current_session_facts: Dict[str, Any] = {}
        self.user_preferences: Dict[str, Any] = {}
        
        # Configuración de memoria
        self.max_short_term_entries = 100
        self.importance_threshold = 0.3  # Umbral para memoria a largo plazo
        
        logger.info("Memory Manager inicializado")
    
    async def store_interaction(
        self,
        user_input: str,
        agent_response: str, 
        plan: Any,
        results: List[Dict[str, Any]],
        session_id: str
    ):
        """
        Almacena una interacción completa en memoria
        
        Args:
            user_input: Entrada del usuario
            agent_response: Respuesta del agente
            plan: Plan ejecutado
            results: Resultados de la ejecución
            session_id: ID de la sesión
        """
        try:
            timestamp = asyncio.get_event_loop().time()
            
            # Crear memoria de conversación
            conversation = ConversationMemory(
                user_input=user_input,
                agent_response=agent_response,
                plan_executed=plan.to_dict() if hasattr(plan, 'to_dict') else {},
                results=results,
                session_id=session_id,
                timestamp=timestamp,
                success=all(r.get("success", False) for r in results)
            )
            
            # Calcular importancia de la interacción
            importance = await self._calculate_importance(conversation)
            
            # Crear entrada de memoria
            memory_entry = MemoryEntry(
                id=str(uuid.uuid4()),
                type="conversation",
                content=f"Usuario: {user_input}\nAgente: {agent_response}",
                metadata={
                    "plan": conversation.plan_executed,
                    "results": conversation.results,
                    "success": conversation.success,
                    "tools_used": [r.get("tool_name") for r in results],
                    "session_id": session_id
                },
                importance=importance,
                timestamp=timestamp,
                session_id=session_id,
                tags=await self._extract_tags(user_input, agent_response)
            )
            
            # Almacenar en memoria a corto plazo
            self.short_term_memory.append(memory_entry)
            
            # Si es importante, almacenar en memoria a largo plazo
            if importance >= self.importance_threshold:
                await self._store_long_term(memory_entry)
            
            # Limpiar memoria a corto plazo si es necesario
            await self._cleanup_short_term_memory()
            
            # Extraer y almacenar hechos/conocimientos
            await self._extract_and_store_facts(user_input, agent_response, results)
            
            logger.debug(f"Interacción almacenada - Importancia: {importance:.2f}")
            
        except Exception as e:
            logger.error(f"Error almacenando interacción: {e}")
    
    async def _calculate_importance(self, conversation: ConversationMemory) -> float:
        """
        Calcula la importancia de una conversación para determinar
        si debe almacenarse en memoria a largo plazo
        """
        importance = 0.0
        
        # Factores que aumentan importancia
        factors = {
            # Éxito de la ejecución
            "success": 0.2 if conversation.success else -0.1,
            
            # Número de herramientas usadas
            "tools_complexity": min(len(conversation.results) * 0.1, 0.3),
            
            # Longitud de la respuesta (más detalle = más importante)
            "response_length": min(len(conversation.agent_response) / 1000 * 0.1, 0.2),
            
            # Palabras clave importantes
            "keywords": self._check_important_keywords(conversation.user_input) * 0.3,
            
            # Errores o problemas (importante para aprender)
            "errors": 0.2 if any("error" in str(r) for r in conversation.results) else 0.0
        }
        
        importance = sum(factors.values())
        return min(max(importance, 0.0), 1.0)  # Clamp entre 0 y 1
    
    def _check_important_keywords(self, text: str) -> float:
        """Verifica presencia de palabras clave importantes"""
        important_keywords = [
            "error", "problema", "bug", "fix", "solución",
            "configurar", "instalar", "crear", "proyecto",
            "aprender", "explicar", "tutorial", "documentación",
            "optimizar", "mejorar", "refactorizar"
        ]
        
        text_lower = text.lower()
        matches = sum(1 for keyword in important_keywords if keyword in text_lower)
        return min(matches / len(important_keywords), 1.0)
    
    async def _extract_tags(self, user_input: str, agent_response: str) -> List[str]:
        """Extrae tags relevantes de la conversación"""
        tags = []
        
        # Tags basados en contenido
        content = f"{user_input} {agent_response}".lower()
        
        tag_patterns = {
            "programming": ["código", "programar", "función", "clase", "variable"],
            "files": ["archivo", "directorio", "carpeta", "leer", "escribir"],
            "web": ["buscar", "internet", "url", "página", "web"],
            "system": ["comando", "terminal", "ejecutar", "instalar"],
            "learning": ["aprender", "explicar", "tutorial", "cómo"],
            "debugging": ["error", "bug", "problema", "arreglar", "debug"]
        }
        
        for tag, keywords in tag_patterns.items():
            if any(keyword in content for keyword in keywords):
                tags.append(tag)
        
        return tags
    
    async def _store_long_term(self, memory_entry: MemoryEntry):
        """Almacena una entrada en memoria a largo plazo"""
        try:
            await self.vector_db.store_document(
                content=memory_entry.content,
                metadata={
                    "type": memory_entry.type,
                    "importance": memory_entry.importance,
                    "timestamp": memory_entry.timestamp,
                    "session_id": memory_entry.session_id,
                    "tags": memory_entry.tags or [],
                    **memory_entry.metadata
                },
                collection_name="conversations"
            )
            
            logger.debug(f"Memoria a largo plazo almacenada: {memory_entry.id}")
            
        except Exception as e:
            logger.error(f"Error almacenando memoria a largo plazo: {e}")
    
    async def get_summary(self, session_id: str) -> Dict[str, Any]:
        """Obtiene un resumen de la memoria del agente"""
        try:
            # Estadísticas de memoria a corto plazo
            short_term_stats = {
                "total_entries": len(self.short_term_memory),
                "current_session_entries": len([
                    e for e in self.short_term_memory 
                    if e.session_id == session_id
                ]),
                "average_importance": sum(e.importance for e in self.short_term_memory) / len(self.short_term_memory) if self.short_term_memory else 0
            }
            
            # Estadísticas de memoria a largo plazo
            long_term_stats = await self.vector_db.get_collection_stats("conversations")
            
            # Preferencias del usuario
            preferences_summary = {
                "total_preferences": len(self.user_preferences),
                "preferences": self.user_preferences
            }
            
            return {
                "short_term_memory": short_term_stats,
                "long_term_memory": long_term_stats,
                "user_preferences": preferences_summary,
                "session_id": session_id
            }
            
        except Exception as e:
            logger.error(f"Error obteniendo resumen de memoria: {e}")
            return {"error": str(e)}
    
    async def close(self):
        """Cierra el gestor de memoria"""
        try:
            # Guardar memoria a corto plazo importante antes de cerrar
            important_entries = [
                e for e in self.short_term_memory 
                if e.importance >= self.importance_threshold
            ]
            
            for entry in important_entries:
                await self._store_long_term(entry)
            
            logger.info("Memory Manager cerrado")
            
        except Exception as e:
            logger.error(f"Error cerrando Memory Manager: {e}")
