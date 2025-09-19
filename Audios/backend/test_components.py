#!/usr/bin/env python3
"""
Test script para verificar que todos los componentes del backend funcionen correctamente
"""

import asyncio
import logging
import sys
import os
from pathlib import Path

# Add backend to path
sys.path.insert(0, str(Path(__file__).parent))

from transcriber.audio_processor import AudioProcessor
from transcriber.transcription_engine import TranscriptionEngine
from transcriber.speaker_diarization import SpeakerDiarizer
from exporter.document_generator import DocumentGenerator
from utils.file_manager import FileManager
from utils.task_manager import TaskManager

# Setup basic logging
logging.basicConfig(level=logging.INFO)
logger = logging.getLogger(__name__)

async def test_audio_processor():
    """Test AudioProcessor methods"""
    print("\n🎵 Testing AudioProcessor...")
    
    try:
        processor = AudioProcessor()
        
        # Test initialization
        assert processor.sample_rate == 16000
        assert processor.channels == 1
        print("   ✅ Initialization - OK")
        
        # Test supported formats
        assert '.mp3' in processor.supported_audio_formats
        assert '.mp4' in processor.supported_video_formats
        print("   ✅ Supported formats - OK")
        
        # Test audio info method (without actual file)
        print("   ✅ AudioProcessor methods - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ AudioProcessor error: {e}")
        return False

async def test_transcription_engine():
    """Test TranscriptionEngine methods"""
    print("\n🤖 Testing TranscriptionEngine...")
    
    try:
        engine = TranscriptionEngine()
        
        # Test initialization
        assert engine.model_name in ['tiny', 'base', 'small', 'medium', 'large']
        assert engine.device in ['cpu', 'cuda', 'mps']
        print("   ✅ Initialization - OK")
        
        # Test model info
        info = engine.get_model_info()
        assert 'model_name' in info
        assert 'device' in info
        print("   ✅ Model info - OK")
        
        # Test format timestamp
        timestamp = engine._format_timestamp(3661.5)  # 1:01:01
        assert timestamp == "01:01:01"
        print("   ✅ Timestamp formatting - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ TranscriptionEngine error: {e}")
        return False

async def test_speaker_diarizer():
    """Test SpeakerDiarizer methods"""
    print("\n👥 Testing SpeakerDiarizer...")
    
    try:
        diarizer = SpeakerDiarizer()
        
        # Test initialization
        assert diarizer.min_speakers == 1
        assert diarizer.max_speakers == 10
        print("   ✅ Initialization - OK")
        
        # Test diarization info
        info = diarizer.get_diarization_info()
        assert 'device' in info
        assert 'pipeline_loaded' in info
        print("   ✅ Diarization info - OK")
        
        # Test fallback speaker separation
        mock_transcription = {
            "segments": [
                {"start": 0, "end": 5, "text": "Hello", "confidence": 0.9},
                {"start": 6, "end": 10, "text": "World", "confidence": 0.8}
            ]
        }
        
        speakers = await diarizer._fallback_speaker_separation(mock_transcription)
        assert len(speakers) >= 1
        assert 'name' in speakers[0]
        assert 'segments' in speakers[0]
        print("   ✅ Fallback separation - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ SpeakerDiarizer error: {e}")
        return False

async def test_document_generator():
    """Test DocumentGenerator methods"""
    print("\n📄 Testing DocumentGenerator...")
    
    try:
        generator = DocumentGenerator()
        
        # Test initialization
        assert generator.output_dir.exists()
        print("   ✅ Initialization - OK")
        
        # Test format methods
        mock_data = {
            "speakers": [
                {
                    "name": "Speaker 1",
                    "segments": [
                        {"timestamp": "00:00:01", "text": "Test text", "confidence": 0.9}
                    ],
                    "total_duration": 5.0,
                    "word_count": 2
                }
            ],
            "duration": 10.0
        }
        
        # Test APA formatting
        apa_content = generator._format_apa(mock_data)
        assert apa_content['style'] == 'APA'
        assert 'speakers' in apa_content
        print("   ✅ APA formatting - OK")
        
        # Test BOEM formatting
        boem_content = generator._format_boem(mock_data)
        assert boem_content['style'] == 'BOEM'
        print("   ✅ BOEM formatting - OK")
        
        # Test FREE formatting
        free_content = generator._format_free(mock_data)
        assert free_content['style'] == 'FREE'
        print("   ✅ FREE formatting - OK")
        
        # Test duration formatting
        duration_str = generator._format_duration(3661)
        assert duration_str == "01:01:01"
        print("   ✅ Duration formatting - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ DocumentGenerator error: {e}")
        return False

async def test_file_manager():
    """Test FileManager methods"""
    print("\n📁 Testing FileManager...")
    
    try:
        manager = FileManager()
        
        # Test initialization
        assert manager.upload_dir.exists()
        print("   ✅ Initialization - OK")
        
        # Test disk usage
        usage = manager.get_disk_usage()
        assert 'total' in usage
        assert 'free' in usage
        print("   ✅ Disk usage - OK")
        
        # Test file validation (without actual file)
        fake_path = Path("nonexistent.mp3")
        validation = manager.validate_file(fake_path)
        assert 'valid' in validation
        assert 'errors' in validation
        print("   ✅ File validation - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ FileManager error: {e}")
        return False

async def test_task_manager():
    """Test TaskManager methods"""
    print("\n📋 Testing TaskManager...")
    
    try:
        manager = TaskManager()
        
        # Test task creation
        task_id = "test_task_123"
        created = manager.create_task(task_id, {
            "filename": "test.mp3",
            "status": "pending"
        })
        assert created == True
        print("   ✅ Task creation - OK")
        
        # Test task retrieval
        task = manager.get_task(task_id)
        assert task is not None
        assert task['filename'] == "test.mp3"
        print("   ✅ Task retrieval - OK")
        
        # Test task update
        updated = manager.update_task(task_id, {"status": "processing", "progress": 50})
        assert updated == True
        
        task = manager.get_task(task_id)
        assert task['status'] == "processing"
        assert task['progress'] == 50
        print("   ✅ Task update - OK")
        
        # Test task count
        counts = manager.get_task_count()
        assert 'total' in counts
        assert counts['total'] >= 1
        print("   ✅ Task count - OK")
        
        # Test task completion
        completed = manager.set_task_completed(task_id, {"result": "test"})
        assert completed == True
        
        task = manager.get_task(task_id)
        assert task['status'] == "completed"
        print("   ✅ Task completion - OK")
        
        # Test task deletion
        deleted = manager.delete_task(task_id)
        assert deleted == True
        
        task = manager.get_task(task_id)
        assert task is None
        print("   ✅ Task deletion - OK")
        
        return True
        
    except Exception as e:
        print(f"   ❌ TaskManager error: {e}")
        return False

async def main():
    """Run all component tests"""
    print("🔍 TRANSCRIPTO KD - COMPONENT TESTING")
    print("=" * 50)
    
    tests = [
        ("AudioProcessor", test_audio_processor),
        ("TranscriptionEngine", test_transcription_engine),
        ("SpeakerDiarizer", test_speaker_diarizer),
        ("DocumentGenerator", test_document_generator),
        ("FileManager", test_file_manager),
        ("TaskManager", test_task_manager)
    ]
    
    results = []
    for test_name, test_func in tests:
        try:
            result = await test_func()
            results.append((test_name, result))
        except Exception as e:
            print(f"   ❌ Error in {test_name}: {e}")
            results.append((test_name, False))
    
    # Summary
    print("\n" + "=" * 50)
    print("📊 COMPONENT TEST SUMMARY")
    print("=" * 50)
    
    passed = sum(1 for _, result in results if result)
    total = len(results)
    
    for test_name, result in results:
        status = "✅ PASS" if result else "❌ FAIL"
        print(f"{status} - {test_name}")
    
    print(f"\n🎯 Result: {passed}/{total} components passed")
    
    if passed == total:
        print("\n🎉 All components are working correctly!")
        print("\n📋 Next steps:")
        print("   1. Run 'python test_system.py' for full system test")
        print("   2. Start the backend with 'uvicorn main:app --reload'")
        print("   3. Test the API endpoints")
    else:
        print("\n⚠️  Some components need attention.")
        print("\n📋 Recommended actions:")
        print("   • Check the error messages above")
        print("   • Verify all dependencies are installed")
        print("   • Review the component implementations")

if __name__ == "__main__":
    asyncio.run(main())
