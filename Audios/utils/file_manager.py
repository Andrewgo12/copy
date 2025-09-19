import os
import asyncio
import logging
from pathlib import Path
from typing import List, Optional
from datetime import datetime, timedelta
import shutil

logger = logging.getLogger(__name__)

class FileManager:
    """Manages file operations and cleanup"""
    
    def __init__(self):
        self.upload_dir = Path(os.getenv("UPLOAD_FOLDER", "uploads"))
        self.temp_retention = int(os.getenv("TEMP_FILE_RETENTION", 86400))  # 24 hours
        self.max_file_size = int(os.getenv("MAX_FILE_SIZE", 524288000))  # 500MB
        
        # Ensure directories exist
        self.upload_dir.mkdir(exist_ok=True)
        (self.upload_dir / "exports").mkdir(exist_ok=True)
        (self.upload_dir / "temp").mkdir(exist_ok=True)
    
    async def cleanup_temp_files(self, task_id: str) -> bool:
        """
        Clean up temporary files for a specific task
        
        Args:
            task_id: Task identifier
            
        Returns:
            True if cleanup was successful
        """
        try:
            files_removed = 0
            
            # Clean up original uploaded file
            for file_path in self.upload_dir.glob(f"{task_id}_*"):
                if file_path.is_file():
                    file_path.unlink()
                    files_removed += 1
            
            # Clean up processed audio files
            for file_path in self.upload_dir.glob(f"*{task_id}*_processed.*"):
                if file_path.is_file():
                    file_path.unlink()
                    files_removed += 1
            
            # Clean up audio chunks
            for file_path in self.upload_dir.glob(f"*{task_id}*_chunk_*"):
                if file_path.is_file():
                    file_path.unlink()
                    files_removed += 1
            
            # Clean up temporary files
            temp_dir = self.upload_dir / "temp"
            for file_path in temp_dir.glob(f"*{task_id}*"):
                if file_path.is_file():
                    file_path.unlink()
                    files_removed += 1
            
            logger.info(f"Cleaned up {files_removed} temporary files for task {task_id}")
            return True
            
        except Exception as e:
            logger.error(f"Error cleaning up temp files for task {task_id}: {e}")
            return False
    
    async def cleanup_old_files(self) -> int:
        """
        Clean up old files based on retention policy
        
        Returns:
            Number of files cleaned up
        """
        try:
            current_time = datetime.now()
            cutoff_time = current_time - timedelta(seconds=self.temp_retention)
            files_removed = 0
            
            # Clean up old uploaded files
            for file_path in self.upload_dir.iterdir():
                if file_path.is_file():
                    file_mtime = datetime.fromtimestamp(file_path.stat().st_mtime)
                    if file_mtime < cutoff_time:
                        file_path.unlink()
                        files_removed += 1
            
            # Clean up old temporary files
            temp_dir = self.upload_dir / "temp"
            if temp_dir.exists():
                for file_path in temp_dir.iterdir():
                    if file_path.is_file():
                        file_mtime = datetime.fromtimestamp(file_path.stat().st_mtime)
                        if file_mtime < cutoff_time:
                            file_path.unlink()
                            files_removed += 1
            
            # Clean up old export files (keep for longer - 7 days)
            export_cutoff = current_time - timedelta(days=7)
            export_dir = self.upload_dir / "exports"
            if export_dir.exists():
                for file_path in export_dir.iterdir():
                    if file_path.is_file():
                        file_mtime = datetime.fromtimestamp(file_path.stat().st_mtime)
                        if file_mtime < export_cutoff:
                            file_path.unlink()
                            files_removed += 1
            
            if files_removed > 0:
                logger.info(f"Cleaned up {files_removed} old files")
            
            return files_removed
            
        except Exception as e:
            logger.error(f"Error cleaning up old files: {e}")
            return 0
    
    def get_file_info(self, file_path: Path) -> dict:
        """
        Get information about a file
        
        Args:
            file_path: Path to the file
            
        Returns:
            Dictionary with file information
        """
        try:
            if not file_path.exists():
                return {"exists": False}
            
            stat = file_path.stat()
            
            return {
                "exists": True,
                "size": stat.st_size,
                "size_mb": round(stat.st_size / (1024 * 1024), 2),
                "created": datetime.fromtimestamp(stat.st_ctime),
                "modified": datetime.fromtimestamp(stat.st_mtime),
                "extension": file_path.suffix.lower(),
                "name": file_path.name,
                "is_audio": file_path.suffix.lower() in ['.mp3', '.wav', '.m4a', '.aac', '.ogg', '.flac'],
                "is_video": file_path.suffix.lower() in ['.mp4', '.mov', '.avi', '.mkv', '.webm', '.m4v']
            }
            
        except Exception as e:
            logger.error(f"Error getting file info for {file_path}: {e}")
            return {"exists": False, "error": str(e)}
    
    def validate_file(self, file_path: Path) -> dict:
        """
        Validate a file for processing
        
        Args:
            file_path: Path to the file
            
        Returns:
            Dictionary with validation results
        """
        try:
            result = {
                "valid": False,
                "errors": [],
                "warnings": []
            }
            
            # Check if file exists
            if not file_path.exists():
                result["errors"].append("File does not exist")
                return result
            
            # Get file info
            file_info = self.get_file_info(file_path)
            
            # Check file size
            if file_info["size"] > self.max_file_size:
                result["errors"].append(f"File too large: {file_info['size_mb']}MB (max: {self.max_file_size // (1024*1024)}MB)")
            
            # Check file extension
            if not (file_info["is_audio"] or file_info["is_video"]):
                result["errors"].append(f"Unsupported file type: {file_info['extension']}")
            
            # Check if file is empty
            if file_info["size"] == 0:
                result["errors"].append("File is empty")
            
            # Warnings for large files
            if file_info["size"] > 100 * 1024 * 1024:  # 100MB
                result["warnings"].append(f"Large file ({file_info['size_mb']}MB) may take longer to process")
            
            # Set valid if no errors
            result["valid"] = len(result["errors"]) == 0
            
            return result
            
        except Exception as e:
            logger.error(f"Error validating file {file_path}: {e}")
            return {
                "valid": False,
                "errors": [f"Validation error: {str(e)}"],
                "warnings": []
            }
    
    async def move_file(self, source: Path, destination: Path) -> bool:
        """
        Move a file from source to destination
        
        Args:
            source: Source file path
            destination: Destination file path
            
        Returns:
            True if move was successful
        """
        try:
            # Ensure destination directory exists
            destination.parent.mkdir(parents=True, exist_ok=True)
            
            # Move file
            await asyncio.get_event_loop().run_in_executor(
                None, shutil.move, str(source), str(destination)
            )
            
            logger.info(f"Moved file from {source} to {destination}")
            return True
            
        except Exception as e:
            logger.error(f"Error moving file from {source} to {destination}: {e}")
            return False
    
    async def copy_file(self, source: Path, destination: Path) -> bool:
        """
        Copy a file from source to destination
        
        Args:
            source: Source file path
            destination: Destination file path
            
        Returns:
            True if copy was successful
        """
        try:
            # Ensure destination directory exists
            destination.parent.mkdir(parents=True, exist_ok=True)
            
            # Copy file
            await asyncio.get_event_loop().run_in_executor(
                None, shutil.copy2, str(source), str(destination)
            )
            
            logger.info(f"Copied file from {source} to {destination}")
            return True
            
        except Exception as e:
            logger.error(f"Error copying file from {source} to {destination}: {e}")
            return False
    
    def get_disk_usage(self) -> dict:
        """
        Get disk usage information for the upload directory
        
        Returns:
            Dictionary with disk usage information
        """
        try:
            usage = shutil.disk_usage(self.upload_dir)
            
            return {
                "total": usage.total,
                "used": usage.used,
                "free": usage.free,
                "total_gb": round(usage.total / (1024**3), 2),
                "used_gb": round(usage.used / (1024**3), 2),
                "free_gb": round(usage.free / (1024**3), 2),
                "usage_percent": round((usage.used / usage.total) * 100, 2)
            }
            
        except Exception as e:
            logger.error(f"Error getting disk usage: {e}")
            return {}
    
    def list_files(self, directory: Optional[Path] = None, pattern: str = "*") -> List[dict]:
        """
        List files in a directory
        
        Args:
            directory: Directory to list (defaults to upload_dir)
            pattern: File pattern to match
            
        Returns:
            List of file information dictionaries
        """
        try:
            if directory is None:
                directory = self.upload_dir
            
            files = []
            for file_path in directory.glob(pattern):
                if file_path.is_file():
                    files.append(self.get_file_info(file_path))
            
            # Sort by modification time (newest first)
            files.sort(key=lambda x: x.get("modified", datetime.min), reverse=True)
            
            return files
            
        except Exception as e:
            logger.error(f"Error listing files in {directory}: {e}")
            return []
    
    async def create_temp_file(self, task_id: str, suffix: str = ".tmp") -> Path:
        """
        Create a temporary file for a task
        
        Args:
            task_id: Task identifier
            suffix: File suffix
            
        Returns:
            Path to temporary file
        """
        try:
            temp_dir = self.upload_dir / "temp"
            temp_dir.mkdir(exist_ok=True)
            
            temp_file = temp_dir / f"{task_id}_{datetime.now().strftime('%Y%m%d_%H%M%S')}{suffix}"
            
            # Create empty file
            temp_file.touch()
            
            logger.debug(f"Created temporary file: {temp_file}")
            return temp_file
            
        except Exception as e:
            logger.error(f"Error creating temporary file for task {task_id}: {e}")
            raise
    
    def get_directory_size(self, directory: Path) -> int:
        """
        Get total size of a directory
        
        Args:
            directory: Directory path
            
        Returns:
            Total size in bytes
        """
        try:
            total_size = 0
            for file_path in directory.rglob('*'):
                if file_path.is_file():
                    total_size += file_path.stat().st_size
            return total_size
            
        except Exception as e:
            logger.error(f"Error calculating directory size for {directory}: {e}")
            return 0
