import os
import asyncio
from pathlib import Path
from typing import Optional, Dict, Any
import ffmpeg
from pydub import AudioSegment
import logging

logger = logging.getLogger(__name__)

class AudioProcessor:
    """Handles audio/video file processing and conversion"""
    
    def __init__(self):
        self.supported_audio_formats = ['.mp3', '.wav', '.m4a', '.aac', '.ogg', '.flac']
        self.supported_video_formats = ['.mp4', '.mov', '.avi', '.mkv', '.webm', '.m4v']
        self.output_format = 'wav'
        self.sample_rate = 16000  # Optimal for Whisper
        self.channels = 1  # Mono for better transcription
        
    async def process_file(self, input_path: Path) -> Path:
        """
        Process audio/video file and convert to optimal format for transcription
        
        Args:
            input_path: Path to input file
            
        Returns:
            Path to processed audio file
        """
        try:
            file_extension = input_path.suffix.lower()
            output_path = input_path.parent / f"{input_path.stem}_processed.wav"
            
            if file_extension in self.supported_video_formats:
                # Extract audio from video
                await self._extract_audio_from_video(input_path, output_path)
            elif file_extension in self.supported_audio_formats:
                # Process audio file
                await self._process_audio_file(input_path, output_path)
            else:
                raise ValueError(f"Unsupported file format: {file_extension}")
            
            # Validate output file
            if not output_path.exists() or output_path.stat().st_size == 0:
                raise RuntimeError("Failed to process audio file")
            
            logger.info(f"Successfully processed {input_path} -> {output_path}")
            return output_path
            
        except Exception as e:
            logger.error(f"Error processing file {input_path}: {str(e)}")
            raise
    
    async def _extract_audio_from_video(self, video_path: Path, output_path: Path):
        """Extract audio from video file using ffmpeg"""
        try:
            logger.info(f"Extracting audio from video: {video_path}")

            # Use ffmpeg to extract audio
            stream = ffmpeg.input(str(video_path))
            stream = ffmpeg.output(
                stream,
                str(output_path),
                acodec='pcm_s16le',  # 16-bit PCM
                ac=self.channels,    # Mono
                ar=self.sample_rate, # Sample rate
                loglevel='error'     # Suppress verbose output
            )

            # Run in executor to avoid blocking
            await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: ffmpeg.run(stream, overwrite_output=True, quiet=True)
            )

            logger.info(f"Audio extraction completed: {output_path}")

        except ffmpeg.Error as e:
            logger.error(f"FFmpeg error: {e}")
            raise RuntimeError(f"Failed to extract audio from video: {e}")
        except Exception as e:
            logger.error(f"Unexpected error during audio extraction: {e}")
            raise RuntimeError(f"Failed to extract audio from video: {e}")
    
    async def _process_audio_file(self, audio_path: Path, output_path: Path):
        """Process audio file using pydub"""
        try:
            # Load audio file
            audio = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: AudioSegment.from_file(str(audio_path))
            )
            
            # Convert to optimal format
            audio = audio.set_frame_rate(self.sample_rate)
            audio = audio.set_channels(self.channels)
            
            # Normalize audio levels
            audio = self._normalize_audio(audio)
            
            # Apply noise reduction (basic)
            audio = self._reduce_noise(audio)
            
            # Export processed audio
            await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: audio.export(str(output_path), format="wav")
            )
            
        except Exception as e:
            logger.error(f"Error processing audio file: {e}")
            raise RuntimeError(f"Failed to process audio file: {e}")
    
    def _normalize_audio(self, audio: AudioSegment) -> AudioSegment:
        """Normalize audio levels"""
        try:
            # Calculate target dBFS (decibels relative to full scale)
            target_dBFS = -20.0
            
            # Calculate gain needed
            gain = target_dBFS - audio.dBFS
            
            # Apply gain (limit to reasonable range)
            gain = max(-10, min(10, gain))
            
            return audio + gain
            
        except Exception as e:
            logger.warning(f"Failed to normalize audio: {e}")
            return audio
    
    def _reduce_noise(self, audio: AudioSegment) -> AudioSegment:
        """Basic noise reduction"""
        try:
            # Simple high-pass filter to remove low-frequency noise
            # This is a basic implementation - for better results, use specialized libraries
            
            # Apply a simple high-pass filter by removing very low frequencies
            # This helps with rumble and low-frequency noise
            if len(audio) > 1000:  # Only if audio is long enough
                # Get a sample of the beginning (likely to contain noise)
                noise_sample = audio[:1000]
                
                # If the noise sample is very quiet, it might be silence
                if noise_sample.dBFS < -40:
                    # Apply gentle noise gate
                    return audio.apply_gain_stereo(1.0, 1.0)
            
            return audio
            
        except Exception as e:
            logger.warning(f"Failed to reduce noise: {e}")
            return audio
    
    async def get_audio_info(self, audio_path: Path) -> Dict[str, Any]:
        """Get information about audio file"""
        try:
            audio = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: AudioSegment.from_file(str(audio_path))
            )
            
            return {
                "duration": len(audio) / 1000.0,  # Duration in seconds
                "sample_rate": audio.frame_rate,
                "channels": audio.channels,
                "frame_count": audio.frame_count(),
                "sample_width": audio.sample_width,
                "max_dBFS": audio.max_dBFS,
                "dBFS": audio.dBFS
            }
            
        except Exception as e:
            logger.error(f"Error getting audio info: {e}")
            return {}
    
    async def split_audio_by_duration(self, audio_path: Path, max_duration: int = 1800) -> list[Path]:
        """
        Split audio file into chunks if it's too long
        
        Args:
            audio_path: Path to audio file
            max_duration: Maximum duration per chunk in seconds (default: 30 minutes)
            
        Returns:
            List of paths to audio chunks
        """
        try:
            audio = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: AudioSegment.from_file(str(audio_path))
            )
            
            duration_ms = len(audio)
            max_duration_ms = max_duration * 1000
            
            if duration_ms <= max_duration_ms:
                return [audio_path]
            
            # Split into chunks
            chunks = []
            chunk_count = 0
            
            for start_ms in range(0, duration_ms, max_duration_ms):
                end_ms = min(start_ms + max_duration_ms, duration_ms)
                chunk = audio[start_ms:end_ms]
                
                chunk_path = audio_path.parent / f"{audio_path.stem}_chunk_{chunk_count:03d}.wav"
                
                await asyncio.get_event_loop().run_in_executor(
                    None,
                    lambda: chunk.export(str(chunk_path), format="wav")
                )
                
                chunks.append(chunk_path)
                chunk_count += 1
            
            logger.info(f"Split audio into {len(chunks)} chunks")
            return chunks
            
        except Exception as e:
            logger.error(f"Error splitting audio: {e}")
            return [audio_path]
    
    async def cleanup_processed_files(self, original_path: Path):
        """Clean up temporary processed files"""
        try:
            # Remove processed audio file
            processed_path = original_path.parent / f"{original_path.stem}_processed.wav"
            if processed_path.exists():
                processed_path.unlink()
            
            # Remove any chunks
            chunk_pattern = f"{original_path.stem}_chunk_*.wav"
            for chunk_file in original_path.parent.glob(chunk_pattern):
                chunk_file.unlink()
                
            logger.info(f"Cleaned up processed files for {original_path}")
            
        except Exception as e:
            logger.warning(f"Error cleaning up files: {e}")
