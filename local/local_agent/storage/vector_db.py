"""
Base de datos vectorial para memoria y contexto del agente
"""
import asyncio
import json
import uuid
from typing import List, Dict, Any, Optional, Tuple
from dataclasses import dataclass
from pathlib import Path
import numpy as np
from loguru import logger

import chromadb
from chromadb.config import Settings
from sentence_transformers import SentenceTransformer


@dataclass
class VectorDocument:
    """Documento almacenado en la base vectorial"""
    id: str
    content: str
    metadata: Dict[str, Any]
    embedding: Optional[List[float]] = None
    timestamp: Optional[float] = None


class VectorDatabase:
    """
    Gestor de base de datos vectorial para almacenar y recuperar
    información contextual usando embeddings semánticos
    """
    
    def __init__(self, db_path: str = "./data/vector_db"):
        self.db_path = Path(db_path)
        self.db_path.mkdir(parents=True, exist_ok=True)
        
        # Inicializar ChromaDB
        self.client = chromadb.PersistentClient(
            path=str(self.db_path),
            settings=Settings(
                anonymized_telemetry=False,
                allow_reset=True
            )
        )
        
        # Modelo de embeddings
        self.embedding_model = SentenceTransformer('all-MiniLM-L6-v2')
        
        # Colecciones
        self.collections = {}
        self._initialize_collections()
        
        logger.info(f"Vector DB inicializada en: {self.db_path}")
    
    def _initialize_collections(self):
        """Inicializa las colecciones principales"""
        collection_configs = [
            {
                "name": "conversations",
                "description": "Historial de conversaciones",
                "metadata": {"type": "conversation"}
            },
            {
                "name": "code_context", 
                "description": "Contexto de código y archivos",
                "metadata": {"type": "code"}
            },
            {
                "name": "web_knowledge",
                "description": "Información obtenida de la web",
                "metadata": {"type": "web"}
            },
            {
                "name": "user_preferences",
                "description": "Preferencias y configuraciones del usuario",
                "metadata": {"type": "preferences"}
            }
        ]
        
        for config in collection_configs:
            try:
                collection = self.client.get_or_create_collection(
                    name=config["name"],
                    metadata=config["metadata"]
                )
                self.collections[config["name"]] = collection
                logger.debug(f"Colección inicializada: {config['name']}")
            except Exception as e:
                logger.error(f"Error inicializando colección {config['name']}: {e}")
    
    async def store_document(
        self, 
        content: str, 
        metadata: Dict[str, Any], 
        collection_name: str = "conversations"
    ) -> str:
        """
        Almacena un documento en la base vectorial
        
        Args:
            content: Contenido del documento
            metadata: Metadatos asociados
            collection_name: Nombre de la colección
            
        Returns:
            ID del documento almacenado
        """
        try:
            # Generar embedding
            embedding = self.embedding_model.encode(content).tolist()
            
            # Generar ID único
            doc_id = str(uuid.uuid4())
            
            # Añadir timestamp a metadatos
            metadata["timestamp"] = asyncio.get_event_loop().time()
            metadata["content_length"] = len(content)
            
            # Almacenar en ChromaDB
            collection = self.collections.get(collection_name)
            if not collection:
                raise ValueError(f"Colección no encontrada: {collection_name}")
            
            collection.add(
                documents=[content],
                embeddings=[embedding],
                metadatas=[metadata],
                ids=[doc_id]
            )
            
            logger.debug(f"Documento almacenado: {doc_id} en {collection_name}")
            return doc_id
            
        except Exception as e:
            logger.error(f"Error almacenando documento: {e}")
            raise
    
    async def search_similar(
        self, 
        query: str, 
        collection_name: str = "conversations",
        limit: int = 5,
        min_similarity: float = 0.7
    ) -> List[VectorDocument]:
        """
        Busca documentos similares usando búsqueda semántica
        
        Args:
            query: Consulta de búsqueda
            collection_name: Colección donde buscar
            limit: Número máximo de resultados
            min_similarity: Similitud mínima requerida
            
        Returns:
            Lista de documentos similares ordenados por relevancia
        """
        try:
            # Generar embedding de la consulta
            query_embedding = self.embedding_model.encode(query).tolist()
            
            # Buscar en ChromaDB
            collection = self.collections.get(collection_name)
            if not collection:
                logger.warning(f"Colección no encontrada: {collection_name}")
                return []
            
            results = collection.query(
                query_embeddings=[query_embedding],
                n_results=limit,
                include=["documents", "metadatas", "distances"]
            )
            
            # Convertir resultados a VectorDocument
            documents = []
            if results["documents"] and results["documents"][0]:
                for i, doc in enumerate(results["documents"][0]):
                    # Calcular similitud (ChromaDB retorna distancias)
                    distance = results["distances"][0][i]
                    similarity = 1 - distance  # Convertir distancia a similitud
                    
                    if similarity >= min_similarity:
                        vector_doc = VectorDocument(
                            id=results["ids"][0][i],
                            content=doc,
                            metadata=results["metadatas"][0][i],
                            timestamp=results["metadatas"][0][i].get("timestamp")
                        )
                        documents.append(vector_doc)
            
            logger.debug(f"Búsqueda completada: {len(documents)} documentos encontrados")
            return documents
            
        except Exception as e:
            logger.error(f"Error en búsqueda vectorial: {e}")
            return []
    
    async def get_document(self, doc_id: str, collection_name: str = "conversations") -> Optional[VectorDocument]:
        """Recupera un documento específico por ID"""
        try:
            collection = self.collections.get(collection_name)
            if not collection:
                return None
            
            results = collection.get(
                ids=[doc_id],
                include=["documents", "metadatas"]
            )
            
            if results["documents"] and results["documents"][0]:
                return VectorDocument(
                    id=doc_id,
                    content=results["documents"][0],
                    metadata=results["metadatas"][0],
                    timestamp=results["metadatas"][0].get("timestamp")
                )
            
            return None
            
        except Exception as e:
            logger.error(f"Error recuperando documento {doc_id}: {e}")
            return None
    
    async def delete_document(self, doc_id: str, collection_name: str = "conversations") -> bool:
        """Elimina un documento de la base vectorial"""
        try:
            collection = self.collections.get(collection_name)
            if not collection:
                return False
            
            collection.delete(ids=[doc_id])
            logger.debug(f"Documento eliminado: {doc_id}")
            return True
            
        except Exception as e:
            logger.error(f"Error eliminando documento {doc_id}: {e}")
            return False
    
    async def get_collection_stats(self, collection_name: str) -> Dict[str, Any]:
        """Obtiene estadísticas de una colección"""
        try:
            collection = self.collections.get(collection_name)
            if not collection:
                return {"error": "Colección no encontrada"}
            
            count = collection.count()
            
            return {
                "name": collection_name,
                "document_count": count,
                "embedding_dimension": 384,  # all-MiniLM-L6-v2 dimension
                "model": "all-MiniLM-L6-v2"
            }
            
        except Exception as e:
            logger.error(f"Error obteniendo estadísticas de {collection_name}: {e}")
            return {"error": str(e)}
    
    async def clear_collection(self, collection_name: str) -> bool:
        """Limpia todos los documentos de una colección"""
        try:
            collection = self.collections.get(collection_name)
            if not collection:
                return False
            
            # ChromaDB no tiene clear directo, recreamos la colección
            self.client.delete_collection(collection_name)
            new_collection = self.client.create_collection(collection_name)
            self.collections[collection_name] = new_collection
            
            logger.info(f"Colección limpiada: {collection_name}")
            return True
            
        except Exception as e:
            logger.error(f"Error limpiando colección {collection_name}: {e}")
            return False
    
    async def backup_collection(self, collection_name: str, backup_path: str) -> bool:
        """Crea un backup de una colección"""
        try:
            collection = self.collections.get(collection_name)
            if not collection:
                return False
            
            # Obtener todos los documentos
            results = collection.get(include=["documents", "metadatas"])
            
            backup_data = {
                "collection_name": collection_name,
                "documents": results["documents"],
                "metadatas": results["metadatas"],
                "ids": results["ids"],
                "backup_timestamp": asyncio.get_event_loop().time()
            }
            
            # Guardar backup
            backup_file = Path(backup_path)
            backup_file.parent.mkdir(parents=True, exist_ok=True)
            
            with open(backup_file, 'w', encoding='utf-8') as f:
                json.dump(backup_data, f, indent=2, ensure_ascii=False)
            
            logger.info(f"Backup creado: {backup_file}")
            return True
            
        except Exception as e:
            logger.error(f"Error creando backup de {collection_name}: {e}")
            return False
    
    async def close(self):
        """Cierra la conexión a la base de datos"""
        try:
            # ChromaDB se cierra automáticamente
            logger.info("Vector DB cerrada")
        except Exception as e:
            logger.error(f"Error cerrando Vector DB: {e}")
