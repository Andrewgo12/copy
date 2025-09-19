import os
import asyncio
import logging
from pathlib import Path
from typing import Dict, Any, List, Optional
import whisper
import torch
from datetime import timedelta

logger = logging.getLogger(__name__)

class TranscriptionEngine:
    """Handles audio transcription using OpenAI Whisper"""
    
    def __init__(self):
        self.model_name = os.getenv("WHISPER_MODEL", "large")
        self.device = self._get_device()
        self.model = None
        self.supported_languages = ["es", "en", "auto"]
        
    def _get_device(self) -> str:
        """Determine the best device for processing"""
        device_setting = os.getenv("DEVICE", "auto").lower()
        
        if device_setting == "auto":
            if torch.cuda.is_available():
                return "cuda"
            elif hasattr(torch.backends, 'mps') and torch.backends.mps.is_available():
                return "mps"  # Apple Silicon
            else:
                return "cpu"
        else:
            return device_setting
    
    async def _load_model(self):
        """Load Whisper model if not already loaded"""
        if self.model is None:
            logger.info(f"Loading Whisper model '{self.model_name}' on device '{self.device}'")
            
            # Load model in executor to avoid blocking
            self.model = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: whisper.load_model(self.model_name, device=self.device)
            )
            
            logger.info("Whisper model loaded successfully")
    
    async def transcribe(
        self, 
        audio_path: Path, 
        language: str = "es",
        task: str = "transcribe"
    ) -> Dict[str, Any]:
        """
        Transcribe audio file using Whisper
        
        Args:
            audio_path: Path to audio file
            language: Language code (es, en, auto)
            task: Task type (transcribe or translate)
            
        Returns:
            Dictionary with transcription results
        """
        try:
            await self._load_model()
            
            # Prepare transcription options
            options = {
                "language": language if language != "auto" else None,
                "task": task,
                "verbose": False,
                "word_timestamps": True,  # Enable word-level timestamps
                "fp16": self.device == "cuda",  # Use FP16 on CUDA for speed
            }
            
            logger.info(f"Starting transcription of {audio_path}")
            
            # Run transcription in executor
            result = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: self.model.transcribe(str(audio_path), **options)
            )
            
            # Process and format results
            formatted_result = self._format_transcription_result(result, audio_path)
            
            logger.info(f"Transcription completed. Duration: {formatted_result['duration']:.2f}s")
            return formatted_result
            
        except Exception as e:
            logger.error(f"Error during transcription: {e}")
            raise RuntimeError(f"Transcription failed: {e}")
    
    def _format_transcription_result(self, whisper_result: Dict, audio_path: Path) -> Dict[str, Any]:
        """Format Whisper result into standardized format"""
        try:
            segments = []
            total_confidence = 0
            word_count = 0
            
            for segment in whisper_result.get("segments", []):
                # Format timestamp
                start_time = self._format_timestamp(segment["start"])
                end_time = self._format_timestamp(segment["end"])
                
                # Process words if available
                words = []
                if "words" in segment:
                    for word_info in segment["words"]:
                        words.append({
                            "word": word_info.get("word", "").strip(),
                            "start": word_info.get("start", 0),
                            "end": word_info.get("end", 0),
                            "confidence": word_info.get("probability", 0)
                        })
                        word_count += 1
                
                # Calculate segment confidence
                segment_confidence = segment.get("avg_logprob", 0)
                # Convert log probability to confidence (approximate)
                confidence = min(1.0, max(0.0, (segment_confidence + 1.0)))
                total_confidence += confidence
                
                segments.append({
                    "id": segment.get("id", len(segments)),
                    "start": segment["start"],
                    "end": segment["end"],
                    "timestamp": f"{start_time} - {end_time}",
                    "text": segment["text"].strip(),
                    "confidence": confidence,
                    "words": words
                })
            
            # Calculate overall confidence
            avg_confidence = total_confidence / len(segments) if segments else 0
            
            return {
                "text": whisper_result.get("text", "").strip(),
                "language": whisper_result.get("language", "unknown"),
                "duration": self._get_audio_duration(whisper_result),
                "segments": segments,
                "word_count": word_count,
                "confidence": avg_confidence,
                "model_used": self.model_name,
                "device_used": self.device,
                "source_file": str(audio_path)
            }
            
        except Exception as e:
            logger.error(f"Error formatting transcription result: {e}")
            raise
    
    def _format_timestamp(self, seconds: float) -> str:
        """Format seconds to HH:MM:SS format"""
        try:
            td = timedelta(seconds=seconds)
            hours, remainder = divmod(td.total_seconds(), 3600)
            minutes, seconds = divmod(remainder, 60)
            return f"{int(hours):02d}:{int(minutes):02d}:{int(seconds):02d}"
        except:
            return "00:00:00"
    
    def _get_audio_duration(self, whisper_result: Dict) -> float:
        """Extract audio duration from Whisper result"""
        try:
            segments = whisper_result.get("segments", [])
            if segments:
                return segments[-1].get("end", 0)
            return 0
        except:
            return 0
    
    async def transcribe_chunks(self, audio_chunks: List[Path], language: str = "es") -> Dict[str, Any]:
        """
        Transcribe multiple audio chunks and combine results
        
        Args:
            audio_chunks: List of audio file paths
            language: Language code
            
        Returns:
            Combined transcription result
        """
        try:
            all_segments = []
            total_duration = 0
            total_word_count = 0
            total_confidence = 0
            combined_text = ""
            
            for i, chunk_path in enumerate(audio_chunks):
                logger.info(f"Transcribing chunk {i+1}/{len(audio_chunks)}: {chunk_path}")
                
                chunk_result = await self.transcribe(chunk_path, language)
                
                # Adjust timestamps for chunk offset
                chunk_offset = total_duration
                
                for segment in chunk_result["segments"]:
                    segment["start"] += chunk_offset
                    segment["end"] += chunk_offset
                    segment["timestamp"] = f"{self._format_timestamp(segment['start'])} - {self._format_timestamp(segment['end'])}"
                    
                    all_segments.append(segment)
                
                # Accumulate totals
                total_duration += chunk_result["duration"]
                total_word_count += chunk_result["word_count"]
                total_confidence += chunk_result["confidence"]
                combined_text += " " + chunk_result["text"]
            
            # Calculate average confidence
            avg_confidence = total_confidence / len(audio_chunks) if audio_chunks else 0

            # Get language from last chunk or default
            language = "unknown"
            if audio_chunks and 'chunk_result' in locals():
                language = chunk_result.get("language", "unknown")

            return {
                "text": combined_text.strip(),
                "language": language,
                "duration": total_duration,
                "segments": all_segments,
                "word_count": total_word_count,
                "confidence": avg_confidence,
                "model_used": self.model_name,
                "device_used": self.device,
                "chunks_processed": len(audio_chunks)
            }
            
        except Exception as e:
            logger.error(f"Error transcribing chunks: {e}")
            raise
    
    async def detect_language(self, audio_path: Path) -> str:
        """
        Detect the language of the audio file
        
        Args:
            audio_path: Path to audio file
            
        Returns:
            Detected language code
        """
        try:
            await self._load_model()
            
            # Load audio and detect language
            audio = whisper.load_audio(str(audio_path))
            audio = whisper.pad_or_trim(audio)
            
            # Make log-Mel spectrogram and move to the same device as the model
            mel = whisper.log_mel_spectrogram(audio).to(self.model.device)
            
            # Detect the spoken language
            _, probs = self.model.detect_language(mel)
            detected_language = max(probs, key=probs.get)
            
            logger.info(f"Detected language: {detected_language} (confidence: {probs[detected_language]:.2f})")
            
            return detected_language
            
        except Exception as e:
            logger.warning(f"Language detection failed: {e}")
            return "es"  # Default to Spanish
    
    def get_model_info(self) -> Dict[str, Any]:
        """Get information about the loaded model"""
        return {
            "model_name": self.model_name,
            "device": self.device,
            "is_loaded": self.model is not None,
            "supported_languages": self.supported_languages,
            "cuda_available": torch.cuda.is_available(),
            "mps_available": hasattr(torch.backends, 'mps') and torch.backends.mps.is_available()
        }
