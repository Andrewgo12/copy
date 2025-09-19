import os
import uuid
import asyncio
import logging
from datetime import datetime
from typing import Optional, Dict, Any
from pathlib import Path
from contextlib import asynccontextmanager

from fastapi import FastAPI, File, UploadFile, HTTPException, BackgroundTasks, Query
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import FileResponse, JSONResponse
from fastapi.staticfiles import StaticFiles
from pydantic import BaseModel
import aiofiles
from dotenv import load_dotenv

from transcriber.audio_processor import AudioProcessor
from transcriber.transcription_engine import TranscriptionEngine
from transcriber.speaker_diarization import SpeakerDiarizer
from exporter.document_generator import DocumentGenerator
from utils.file_manager import FileManager
from utils.task_manager import TaskManager
from logging_config import setup_logging

# Load environment variables
load_dotenv()

# Setup logging
setup_logging()
logger = logging.getLogger(__name__)

# Lifespan context manager
@asynccontextmanager
async def lifespan(_: FastAPI):
    # Startup
    logger.info("Starting up Transcripto KD API...")

    # Test components
    try:
        model_info = transcription_engine.get_model_info()
        logger.info(f"Transcription engine ready: {model_info}")

        diarization_info = speaker_diarizer.get_diarization_info()
        logger.info(f"Speaker diarization ready: {diarization_info}")

        logger.info("All systems ready!")
    except Exception as e:
        logger.error(f"Error during startup: {e}")

    yield

    # Shutdown
    logger.info("Shutting down Transcripto KD API...")

    # Cleanup tasks
    try:
        await file_manager.cleanup_old_files()
        logger.info("Cleanup completed")
    except Exception as e:
        logger.error(f"Error during shutdown cleanup: {e}")

# Initialize FastAPI app
app = FastAPI(
    title="Transcripto KD API",
    description="API para transcripción inteligente de audios y videos con separación por voces",
    version="1.0.0",
    docs_url="/docs",
    redoc_url="/redoc",
    lifespan=lifespan
)

# CORS middleware
app.add_middleware(
    CORSMiddleware,
    allow_origins=os.getenv("CORS_ORIGINS", "http://localhost:3000").split(","),
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Initialize components
try:
    audio_processor = AudioProcessor()
    transcription_engine = TranscriptionEngine()
    speaker_diarizer = SpeakerDiarizer()
    document_generator = DocumentGenerator()
    file_manager = FileManager()
    task_manager = TaskManager()
    logger.info("All components initialized successfully")
except Exception as e:
    logger.error(f"Error initializing components: {e}")
    raise

# Ensure upload directory exists
UPLOAD_DIR = Path(os.getenv("UPLOAD_FOLDER", "uploads"))
UPLOAD_DIR.mkdir(exist_ok=True)
(UPLOAD_DIR / "exports").mkdir(exist_ok=True)
(UPLOAD_DIR / "temp").mkdir(exist_ok=True)
logger.info(f"Upload directory initialized: {UPLOAD_DIR}")

# Response models
class UploadResponse(BaseModel):
    task_id: str
    message: str
    filename: str
    file_size: int

class StatusResponse(BaseModel):
    task_id: str
    status: str  # pending, processing, completed, failed
    progress: int  # 0-100
    current_step: str
    estimated_time: Optional[int] = None
    error: Optional[str] = None

class TranscriptionResult(BaseModel):
    task_id: str
    filename: str
    duration: float
    speakers: list
    word_count: int
    confidence: float
    created_at: datetime

# Health check endpoint
@app.get("/")
async def root():
    return {
        "message": "Transcripto KD API",
        "version": "1.0.0",
        "status": "active",
        "endpoints": {
            "upload": "/api/upload",
            "status": "/api/status/{task_id}",
            "result": "/api/result/{task_id}",
            "download": "/api/download/{task_id}",
            "docs": "/docs"
        }
    }

@app.get("/health")
async def health_check():
    return {
        "status": "healthy",
        "timestamp": datetime.now().isoformat(),
        "components": {
            "audio_processor": "ready",
            "transcription_engine": "ready",
            "speaker_diarizer": "ready",
            "document_generator": "ready"
        }
    }

# File upload endpoint
@app.post("/api/upload", response_model=UploadResponse)
async def upload_file(
    background_tasks: BackgroundTasks,
    file: UploadFile = File(...)
):
    logger.info(f"Upload request received for file: {file.filename}")

    # Validate file
    if not file.filename:
        logger.warning("Upload attempt without filename")
        raise HTTPException(status_code=400, detail="No se proporcionó un archivo")

    # Check file extension
    allowed_extensions = os.getenv("ALLOWED_EXTENSIONS", "mp3,wav,mp4,mov,avi,mkv,webm,m4a,aac,ogg,flac,m4v").split(",")
    file_extension = file.filename.split(".")[-1].lower()

    if file_extension not in allowed_extensions:
        logger.warning(f"Unsupported file extension: {file_extension} for file: {file.filename}")
        raise HTTPException(
            status_code=400,
            detail=f"Formato de archivo no soportado. Formatos permitidos: {', '.join(allowed_extensions)}"
        )

    # Check file size
    max_size = int(os.getenv("MAX_FILE_SIZE", 524288000))  # 500MB default
    file_size = 0

    # Generate task ID
    task_id = str(uuid.uuid4())
    logger.info(f"Generated task ID: {task_id} for file: {file.filename}")
    
    file_path = None
    try:
        # Save uploaded file
        file_path = UPLOAD_DIR / f"{task_id}_{file.filename}"

        async with aiofiles.open(file_path, 'wb') as f:
            while chunk := await file.read(8192):  # Read in 8KB chunks
                file_size += len(chunk)
                if file_size > max_size:
                    await f.close()
                    if file_path.exists():
                        file_path.unlink()  # Delete partial file
                    raise HTTPException(
                        status_code=413,
                        detail=f"Archivo demasiado grande. Tamaño máximo: {max_size // (1024*1024)}MB"
                    )
                await f.write(chunk)

        # Initialize task
        task_created = task_manager.create_task(task_id, {
            "filename": file.filename,
            "file_path": str(file_path),
            "file_size": file_size,
            "status": "pending",
            "progress": 0,
            "current_step": "upload",
            "created_at": datetime.now()
        })

        if not task_created:
            if file_path.exists():
                file_path.unlink()
            raise HTTPException(status_code=500, detail="Error al crear la tarea")

        # Start background processing
        background_tasks.add_task(process_audio_file, task_id, file_path)

        return UploadResponse(
            task_id=task_id,
            message="Archivo subido exitosamente. Procesamiento iniciado.",
            filename=file.filename,
            file_size=file_size
        )

    except HTTPException:
        # Re-raise HTTP exceptions
        raise
    except Exception as e:
        # Cleanup on error
        if file_path and file_path.exists():
            file_path.unlink()
        if task_id:
            task_manager.update_task(task_id, {"status": "failed", "error": str(e)})
        raise HTTPException(status_code=500, detail=f"Error al procesar archivo: {str(e)}")

# Status check endpoint
@app.get("/api/status/{task_id}", response_model=StatusResponse)
async def get_task_status(task_id: str):
    task = task_manager.get_task(task_id)
    
    if not task:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    
    return StatusResponse(
        task_id=task_id,
        status=task.get("status", "unknown"),
        progress=task.get("progress", 0),
        current_step=task.get("current_step", "unknown"),
        estimated_time=task.get("estimated_time"),
        error=task.get("error")
    )

# Get transcription result
@app.get("/api/result/{task_id}", response_model=TranscriptionResult)
async def get_transcription_result(task_id: str):
    task = task_manager.get_task(task_id)
    
    if not task:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    
    if task.get("status") != "completed":
        raise HTTPException(
            status_code=400, 
            detail=f"La transcripción aún no está completa. Estado actual: {task.get('status')}"
        )
    
    result = task.get("result")
    if not result:
        raise HTTPException(status_code=500, detail="Resultado de transcripción no disponible")
    
    return TranscriptionResult(
        task_id=task_id,
        filename=task.get("filename", ""),
        duration=result.get("duration", 0),
        speakers=result.get("speakers", []),
        word_count=result.get("word_count", 0),
        confidence=result.get("confidence", 0),
        created_at=task.get("created_at", datetime.now())
    )

# Download processed file
@app.get("/api/download/{task_id}")
async def download_file(
    task_id: str,
    format: str = Query("pdf", description="Formato de descarga: pdf, docx, txt"),
    style: str = Query("APA", description="Estilo de formato: APA, BOEM, FREE")
):
    task = task_manager.get_task(task_id)
    
    if not task:
        raise HTTPException(status_code=404, detail="Tarea no encontrada")
    
    if task.get("status") != "completed":
        raise HTTPException(status_code=400, detail="La transcripción aún no está completa")
    
    result = task.get("result")
    if not result:
        raise HTTPException(status_code=500, detail="Resultado no disponible")
    
    try:
        # Generate document
        output_path = await document_generator.generate_document(
            result, format, style, task_id
        )
        
        # Determine content type
        content_types = {
            "pdf": "application/pdf",
            "docx": "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "txt": "text/plain"
        }
        
        filename = f"transcripcion_{task_id}.{format}"
        
        return FileResponse(
            path=output_path,
            filename=filename,
            media_type=content_types.get(format, "application/octet-stream")
        )
        
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error al generar documento: {str(e)}")

# Background task for processing audio
async def process_audio_file(task_id: str, file_path: Path):
    """Process audio file in background"""
    try:
        # Update status
        task_manager.update_task(task_id, {
            "status": "processing",
            "progress": 5,
            "current_step": "audio_extraction"
        })
        
        # Step 1: Extract and process audio
        audio_path = await audio_processor.process_file(file_path)
        task_manager.update_task(task_id, {
            "progress": 25,
            "current_step": "transcription"
        })
        
        # Step 2: Transcribe audio
        transcription = await transcription_engine.transcribe(audio_path)
        task_manager.update_task(task_id, {
            "progress": 60,
            "current_step": "speaker_separation"
        })
        
        # Step 3: Speaker diarization
        speakers = await speaker_diarizer.separate_speakers(audio_path, transcription)
        task_manager.update_task(task_id, {
            "progress": 85,
            "current_step": "formatting"
        })
        
        # Step 4: Format result
        result = {
            "duration": transcription.get("duration", 0),
            "speakers": speakers,
            "word_count": sum(len(segment["text"].split()) for speaker in speakers for segment in speaker["segments"]),
            "confidence": transcription.get("confidence", 0),
            "raw_transcription": transcription
        }
        
        # Complete task
        task_manager.update_task(task_id, {
            "status": "completed",
            "progress": 100,
            "current_step": "completed",
            "result": result
        })
        
        # Cleanup temporary files
        await file_manager.cleanup_temp_files(task_id)
        
    except Exception as e:
        task_manager.update_task(task_id, {
            "status": "failed",
            "error": str(e)
        })
        # Cleanup on error
        await file_manager.cleanup_temp_files(task_id)

if __name__ == "__main__":
    import uvicorn
    uvicorn.run(
        "main:app",
        host=os.getenv("API_HOST", "0.0.0.0"),
        port=int(os.getenv("API_PORT", 8000)),
        reload=os.getenv("DEBUG", "False").lower() == "true"
    )
