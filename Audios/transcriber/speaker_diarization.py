import os
import asyncio
import logging
from pathlib import Path
from typing import Dict, Any, List, Optional, Tuple
import torch
import numpy as np
from datetime import timedelta

logger = logging.getLogger(__name__)

class SpeakerDiarizer:
    """Handles speaker diarization (separation by voices)"""
    
    def __init__(self):
        self.device = self._get_device()
        self.pipeline = None
        self.min_speakers = 1
        self.max_speakers = 10
        self.use_auth_token = os.getenv("HUGGINGFACE_TOKEN")
        
    def _get_device(self) -> str:
        """Determine the best device for processing"""
        device_setting = os.getenv("DEVICE", "auto").lower()
        
        if device_setting == "auto":
            if torch.cuda.is_available():
                return "cuda"
            elif hasattr(torch.backends, 'mps') and torch.backends.mps.is_available():
                return "mps"
            else:
                return "cpu"
        else:
            return device_setting
    
    async def _load_pipeline(self):
        """Load pyannote speaker diarization pipeline"""
        if self.pipeline is None:
            try:
                logger.info("Loading speaker diarization pipeline...")
                
                # Import pyannote here to handle optional dependency
                from pyannote.audio import Pipeline
                
                # Load pipeline in executor
                self.pipeline = await asyncio.get_event_loop().run_in_executor(
                    None,
                    lambda: Pipeline.from_pretrained(
                        "pyannote/speaker-diarization-3.1",
                        use_auth_token=self.use_auth_token
                    )
                )
                
                # Move to device if CUDA is available
                if self.device == "cuda":
                    self.pipeline.to(torch.device("cuda"))
                
                logger.info("Speaker diarization pipeline loaded successfully")
                
            except ImportError:
                logger.warning("pyannote.audio not available, using fallback method")
                self.pipeline = "fallback"
            except Exception as e:
                logger.warning(f"Failed to load pyannote pipeline: {e}, using fallback")
                self.pipeline = "fallback"
    
    async def separate_speakers(
        self, 
        audio_path: Path, 
        transcription: Dict[str, Any]
    ) -> List[Dict[str, Any]]:
        """
        Separate speakers in the transcription
        
        Args:
            audio_path: Path to audio file
            transcription: Transcription result from Whisper
            
        Returns:
            List of speakers with their segments
        """
        try:
            await self._load_pipeline()
            
            if self.pipeline == "fallback":
                return await self._fallback_speaker_separation(transcription)
            else:
                return await self._pyannote_speaker_separation(audio_path, transcription)
                
        except Exception as e:
            logger.error(f"Error in speaker separation: {e}")
            # Fallback to simple separation
            return await self._fallback_speaker_separation(transcription)
    
    async def _pyannote_speaker_separation(
        self, 
        audio_path: Path, 
        transcription: Dict[str, Any]
    ) -> List[Dict[str, Any]]:
        """Use pyannote.audio for speaker diarization"""
        try:
            logger.info("Running speaker diarization with pyannote...")
            
            # Run diarization in executor
            diarization = await asyncio.get_event_loop().run_in_executor(
                None,
                lambda: self.pipeline(str(audio_path))
            )
            
            # Convert diarization to speaker segments
            speaker_segments = {}
            
            for turn, _, speaker in diarization.itertracks(yield_label=True):
                if speaker not in speaker_segments:
                    speaker_segments[speaker] = []
                
                speaker_segments[speaker].append({
                    "start": turn.start,
                    "end": turn.end
                })
            
            # Match transcription segments with speakers
            speakers = self._match_transcription_with_speakers(
                transcription["segments"], 
                speaker_segments
            )
            
            logger.info(f"Identified {len(speakers)} speakers")
            return speakers
            
        except Exception as e:
            logger.error(f"Pyannote diarization failed: {e}")
            raise
    
    async def _fallback_speaker_separation(
        self, 
        transcription: Dict[str, Any]
    ) -> List[Dict[str, Any]]:
        """
        Fallback speaker separation using simple heuristics
        This is used when pyannote.audio is not available
        """
        try:
            logger.info("Using fallback speaker separation method")
            
            segments = transcription.get("segments", [])
            if not segments:
                return []
            
            # Simple heuristic: detect speaker changes based on pauses and confidence
            speakers = []
            current_speaker_segments = []
            current_speaker_id = 0
            
            for i, segment in enumerate(segments):
                # Detect potential speaker change
                should_change_speaker = False
                
                if i > 0:
                    prev_segment = segments[i-1]
                    
                    # Long pause might indicate speaker change
                    pause_duration = segment["start"] - prev_segment["end"]
                    if pause_duration > 2.0:  # 2 second pause
                        should_change_speaker = True
                    
                    # Significant confidence change might indicate speaker change
                    confidence_diff = abs(segment["confidence"] - prev_segment["confidence"])
                    if confidence_diff > 0.3:
                        should_change_speaker = True
                    
                    # Text pattern changes (very basic)
                    if self._detect_text_pattern_change(prev_segment["text"], segment["text"]):
                        should_change_speaker = True
                
                # Start new speaker if needed
                if should_change_speaker and current_speaker_segments:
                    speakers.append(self._create_speaker_dict(
                        current_speaker_id, 
                        current_speaker_segments
                    ))
                    current_speaker_segments = []
                    current_speaker_id += 1
                
                # Add segment to current speaker
                current_speaker_segments.append(segment)
            
            # Add final speaker
            if current_speaker_segments:
                speakers.append(self._create_speaker_dict(
                    current_speaker_id, 
                    current_speaker_segments
                ))
            
            # If only one speaker detected, ensure we have at least reasonable separation
            if len(speakers) == 1 and len(segments) > 10:
                speakers = self._force_speaker_separation(segments)
            
            logger.info(f"Fallback method identified {len(speakers)} speakers")
            return speakers
            
        except Exception as e:
            logger.error(f"Fallback speaker separation failed: {e}")
            # Return single speaker as last resort
            return [self._create_speaker_dict(0, transcription.get("segments", []))]
    
    def _match_transcription_with_speakers(
        self, 
        transcription_segments: List[Dict], 
        speaker_segments: Dict[str, List[Dict]]
    ) -> List[Dict[str, Any]]:
        """Match transcription segments with speaker diarization results"""
        try:
            speakers = {}
            
            for segment in transcription_segments:
                segment_start = segment["start"]
                segment_end = segment["end"]
                segment_mid = (segment_start + segment_end) / 2
                
                # Find which speaker this segment belongs to
                best_speaker = None
                best_overlap = 0
                
                for speaker_id, speaker_turns in speaker_segments.items():
                    for turn in speaker_turns:
                        # Calculate overlap
                        overlap_start = max(segment_start, turn["start"])
                        overlap_end = min(segment_end, turn["end"])
                        overlap = max(0, overlap_end - overlap_start)
                        
                        if overlap > best_overlap:
                            best_overlap = overlap
                            best_speaker = speaker_id
                
                # Assign to best speaker or create new one
                if best_speaker is None:
                    best_speaker = f"SPEAKER_{len(speakers)}"
                
                if best_speaker not in speakers:
                    speakers[best_speaker] = []
                
                speakers[best_speaker].append(segment)
            
            # Convert to list format
            result = []
            for speaker_id, segments in speakers.items():
                result.append(self._create_speaker_dict_from_id(speaker_id, segments))
            
            return result
            
        except Exception as e:
            logger.error(f"Error matching transcription with speakers: {e}")
            raise
    
    def _detect_text_pattern_change(self, text1: str, text2: str) -> bool:
        """Detect if there's a significant pattern change between texts"""
        try:
            # Very basic pattern detection
            # Check for question vs statement
            if text1.strip().endswith('?') != text2.strip().endswith('?'):
                return True
            
            # Check for exclamation
            if text1.strip().endswith('!') != text2.strip().endswith('!'):
                return True
            
            # Check for significant length difference
            len_ratio = len(text2) / max(len(text1), 1)
            if len_ratio > 3 or len_ratio < 0.3:
                return True
            
            return False
            
        except:
            return False
    
    def _force_speaker_separation(self, segments: List[Dict]) -> List[Dict[str, Any]]:
        """Force separation into multiple speakers for long conversations"""
        try:
            # Split segments into roughly equal parts
            total_segments = len(segments)
            segments_per_speaker = max(3, total_segments // 3)  # At least 3 segments per speaker
            
            speakers = []
            current_segments = []
            speaker_id = 0
            
            for i, segment in enumerate(segments):
                current_segments.append(segment)
                
                # Create new speaker every N segments or at natural breaks
                if (len(current_segments) >= segments_per_speaker and 
                    i < total_segments - 1):
                    
                    # Look for a good break point (pause)
                    next_segment = segments[i + 1]
                    pause = next_segment["start"] - segment["end"]
                    
                    if pause > 1.0:  # 1 second pause
                        speakers.append(self._create_speaker_dict(speaker_id, current_segments))
                        current_segments = []
                        speaker_id += 1
            
            # Add remaining segments
            if current_segments:
                speakers.append(self._create_speaker_dict(speaker_id, current_segments))
            
            return speakers
            
        except Exception as e:
            logger.error(f"Error in forced speaker separation: {e}")
            return [self._create_speaker_dict(0, segments)]
    
    def _create_speaker_dict(self, speaker_id: int, segments: List[Dict]) -> Dict[str, Any]:
        """Create speaker dictionary from segments"""
        if not segments:
            return {
                "name": f"Voz {speaker_id + 1}",
                "id": speaker_id,
                "segments": [],
                "total_duration": 0,
                "word_count": 0
            }
        
        total_duration = sum(seg["end"] - seg["start"] for seg in segments)
        word_count = sum(len(seg["text"].split()) for seg in segments)
        
        return {
            "name": f"Voz {speaker_id + 1}",
            "id": speaker_id,
            "segments": segments,
            "total_duration": total_duration,
            "word_count": word_count
        }
    
    def _create_speaker_dict_from_id(self, speaker_id: str, segments: List[Dict]) -> Dict[str, Any]:
        """Create speaker dictionary from speaker ID string"""
        # Extract number from speaker ID if possible
        try:
            if "SPEAKER_" in speaker_id:
                num = int(speaker_id.split("_")[1])
            else:
                num = hash(speaker_id) % 100
        except:
            num = 0
        
        return self._create_speaker_dict(num, segments)
    
    def get_diarization_info(self) -> Dict[str, Any]:
        """Get information about the diarization system"""
        return {
            "device": self.device,
            "pipeline_loaded": self.pipeline is not None,
            "pipeline_type": "pyannote" if self.pipeline != "fallback" else "fallback",
            "min_speakers": self.min_speakers,
            "max_speakers": self.max_speakers,
            "has_auth_token": bool(self.use_auth_token)
        }
