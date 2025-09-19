import asyncio
import logging
from typing import Dict, Any, Optional
from datetime import datetime, timedelta
import json
from pathlib import Path

logger = logging.getLogger(__name__)

class TaskManager:
    """Manages transcription tasks and their status"""
    
    def __init__(self):
        self.tasks: Dict[str, Dict[str, Any]] = {}
        self.max_task_age = timedelta(hours=24)  # Keep tasks for 24 hours
        self.cleanup_interval = 3600  # Cleanup every hour
        self._cleanup_task = None
        self._start_cleanup_task()
    
    def _start_cleanup_task(self):
        """Start background cleanup task"""
        if self._cleanup_task is None:
            try:
                loop = asyncio.get_event_loop()
                self._cleanup_task = loop.create_task(self._periodic_cleanup())
            except RuntimeError:
                # No event loop running, will start later
                logger.info("No event loop running, cleanup task will start when needed")
    
    async def _periodic_cleanup(self):
        """Periodically clean up old tasks"""
        while True:
            try:
                await asyncio.sleep(self.cleanup_interval)
                await self.cleanup_old_tasks()
            except asyncio.CancelledError:
                break
            except Exception as e:
                logger.error(f"Error in periodic cleanup: {e}")
    
    def create_task(self, task_id: str, initial_data: Dict[str, Any]) -> bool:
        """
        Create a new task
        
        Args:
            task_id: Unique task identifier
            initial_data: Initial task data
            
        Returns:
            True if task was created successfully
        """
        try:
            if task_id in self.tasks:
                logger.warning(f"Task {task_id} already exists")
                return False
            
            self.tasks[task_id] = {
                **initial_data,
                "created_at": datetime.now(),
                "updated_at": datetime.now(),
                "status": initial_data.get("status", "pending"),
                "progress": initial_data.get("progress", 0),
                "current_step": initial_data.get("current_step", "created"),
                "error": None,
                "result": None
            }
            
            logger.info(f"Created task {task_id}")
            return True
            
        except Exception as e:
            logger.error(f"Error creating task {task_id}: {e}")
            return False
    
    def update_task(self, task_id: str, updates: Dict[str, Any]) -> bool:
        """
        Update an existing task
        
        Args:
            task_id: Task identifier
            updates: Dictionary of updates to apply
            
        Returns:
            True if task was updated successfully
        """
        try:
            if task_id not in self.tasks:
                logger.warning(f"Task {task_id} not found for update")
                return False
            
            # Update task data
            self.tasks[task_id].update(updates)
            self.tasks[task_id]["updated_at"] = datetime.now()
            
            # Log status changes
            if "status" in updates:
                logger.info(f"Task {task_id} status changed to: {updates['status']}")
            
            if "progress" in updates:
                logger.debug(f"Task {task_id} progress: {updates['progress']}%")
            
            return True
            
        except Exception as e:
            logger.error(f"Error updating task {task_id}: {e}")
            return False
    
    def get_task(self, task_id: str) -> Optional[Dict[str, Any]]:
        """
        Get task data
        
        Args:
            task_id: Task identifier
            
        Returns:
            Task data or None if not found
        """
        try:
            return self.tasks.get(task_id)
        except Exception as e:
            logger.error(f"Error getting task {task_id}: {e}")
            return None
    
    def delete_task(self, task_id: str) -> bool:
        """
        Delete a task
        
        Args:
            task_id: Task identifier
            
        Returns:
            True if task was deleted successfully
        """
        try:
            if task_id in self.tasks:
                del self.tasks[task_id]
                logger.info(f"Deleted task {task_id}")
                return True
            else:
                logger.warning(f"Task {task_id} not found for deletion")
                return False
                
        except Exception as e:
            logger.error(f"Error deleting task {task_id}: {e}")
            return False
    
    def list_tasks(self, status: Optional[str] = None) -> Dict[str, Dict[str, Any]]:
        """
        List all tasks, optionally filtered by status
        
        Args:
            status: Optional status filter
            
        Returns:
            Dictionary of tasks
        """
        try:
            if status is None:
                return self.tasks.copy()
            else:
                return {
                    task_id: task_data 
                    for task_id, task_data in self.tasks.items() 
                    if task_data.get("status") == status
                }
        except Exception as e:
            logger.error(f"Error listing tasks: {e}")
            return {}
    
    def get_task_count(self) -> Dict[str, int]:
        """
        Get count of tasks by status
        
        Returns:
            Dictionary with status counts
        """
        try:
            counts = {
                "total": len(self.tasks),
                "pending": 0,
                "processing": 0,
                "completed": 0,
                "failed": 0
            }
            
            for task_data in self.tasks.values():
                status = task_data.get("status", "unknown")
                if status in counts:
                    counts[status] += 1
            
            return counts
            
        except Exception as e:
            logger.error(f"Error getting task count: {e}")
            return {"total": 0, "pending": 0, "processing": 0, "completed": 0, "failed": 0}
    
    async def cleanup_old_tasks(self) -> int:
        """
        Clean up old completed or failed tasks
        
        Returns:
            Number of tasks cleaned up
        """
        try:
            current_time = datetime.now()
            tasks_to_remove = []
            
            for task_id, task_data in self.tasks.items():
                task_age = current_time - task_data.get("created_at", current_time)
                status = task_data.get("status", "unknown")
                
                # Remove old completed or failed tasks
                if (task_age > self.max_task_age and 
                    status in ["completed", "failed"]):
                    tasks_to_remove.append(task_id)
            
            # Remove tasks
            for task_id in tasks_to_remove:
                self.delete_task(task_id)
            
            if tasks_to_remove:
                logger.info(f"Cleaned up {len(tasks_to_remove)} old tasks")
            
            return len(tasks_to_remove)
            
        except Exception as e:
            logger.error(f"Error in cleanup_old_tasks: {e}")
            return 0
    
    def set_task_error(self, task_id: str, error_message: str) -> bool:
        """
        Set task as failed with error message
        
        Args:
            task_id: Task identifier
            error_message: Error description
            
        Returns:
            True if task was updated successfully
        """
        return self.update_task(task_id, {
            "status": "failed",
            "error": error_message,
            "progress": 0
        })
    
    def set_task_completed(self, task_id: str, result: Dict[str, Any]) -> bool:
        """
        Set task as completed with result
        
        Args:
            task_id: Task identifier
            result: Task result data
            
        Returns:
            True if task was updated successfully
        """
        return self.update_task(task_id, {
            "status": "completed",
            "progress": 100,
            "current_step": "completed",
            "result": result,
            "error": None
        })
    
    def get_task_summary(self, task_id: str) -> Optional[Dict[str, Any]]:
        """
        Get a summary of task information
        
        Args:
            task_id: Task identifier
            
        Returns:
            Task summary or None if not found
        """
        try:
            task = self.get_task(task_id)
            if not task:
                return None
            
            return {
                "task_id": task_id,
                "status": task.get("status", "unknown"),
                "progress": task.get("progress", 0),
                "current_step": task.get("current_step", "unknown"),
                "created_at": task.get("created_at"),
                "updated_at": task.get("updated_at"),
                "filename": task.get("filename", "unknown"),
                "file_size": task.get("file_size", 0),
                "error": task.get("error"),
                "has_result": task.get("result") is not None
            }
            
        except Exception as e:
            logger.error(f"Error getting task summary {task_id}: {e}")
            return None
    
    async def save_tasks_to_file(self, file_path: Path) -> bool:
        """
        Save tasks to a JSON file (for persistence)
        
        Args:
            file_path: Path to save file
            
        Returns:
            True if saved successfully
        """
        try:
            # Convert datetime objects to strings for JSON serialization
            serializable_tasks = {}
            
            for task_id, task_data in self.tasks.items():
                serializable_task = task_data.copy()
                
                # Convert datetime objects
                for key in ["created_at", "updated_at"]:
                    if key in serializable_task and isinstance(serializable_task[key], datetime):
                        serializable_task[key] = serializable_task[key].isoformat()
                
                serializable_tasks[task_id] = serializable_task
            
            # Write to file
            with open(file_path, 'w', encoding='utf-8') as f:
                json.dump(serializable_tasks, f, indent=2, ensure_ascii=False)
            
            logger.info(f"Saved {len(self.tasks)} tasks to {file_path}")
            return True
            
        except Exception as e:
            logger.error(f"Error saving tasks to file: {e}")
            return False
    
    async def load_tasks_from_file(self, file_path: Path) -> bool:
        """
        Load tasks from a JSON file
        
        Args:
            file_path: Path to load file
            
        Returns:
            True if loaded successfully
        """
        try:
            if not file_path.exists():
                logger.info(f"Tasks file {file_path} does not exist")
                return False
            
            with open(file_path, 'r', encoding='utf-8') as f:
                loaded_tasks = json.load(f)
            
            # Convert string dates back to datetime objects
            for task_id, task_data in loaded_tasks.items():
                for key in ["created_at", "updated_at"]:
                    if key in task_data and isinstance(task_data[key], str):
                        try:
                            task_data[key] = datetime.fromisoformat(task_data[key])
                        except ValueError:
                            task_data[key] = datetime.now()
            
            self.tasks = loaded_tasks
            logger.info(f"Loaded {len(self.tasks)} tasks from {file_path}")
            return True
            
        except Exception as e:
            logger.error(f"Error loading tasks from file: {e}")
            return False
    
    def __del__(self):
        """Cleanup when TaskManager is destroyed"""
        if self._cleanup_task and not self._cleanup_task.done():
            self._cleanup_task.cancel()
