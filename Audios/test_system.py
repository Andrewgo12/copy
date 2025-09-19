#!/usr/bin/env python3
"""
Test script para verificar que Transcripto KD está funcionando correctamente
"""

import sys
import subprocess
import importlib
import requests
import time
from pathlib import Path

def test_python_version():
    """Test Python version"""
    print("🐍 Verificando versión de Python...")
    version = sys.version_info
    if version.major >= 3 and version.minor >= 8:
        print(f"   ✅ Python {version.major}.{version.minor}.{version.micro} - OK")
        return True
    else:
        print(f"   ❌ Python {version.major}.{version.minor}.{version.micro} - Requiere Python 3.8+")
        return False

def test_python_dependencies():
    """Test Python dependencies"""
    print("\n📦 Verificando dependencias de Python...")
    
    required_packages = [
        'fastapi',
        'uvicorn',
        'whisper',
        'torch',
        'pydub',
        'docx',
        'reportlab'
    ]
    
    all_ok = True
    for package in required_packages:
        try:
            importlib.import_module(package)
            print(f"   ✅ {package} - OK")
        except ImportError:
            print(f"   ❌ {package} - NO INSTALADO")
            all_ok = False
    
    return all_ok

def test_node_version():
    """Test Node.js version"""
    print("\n🟢 Verificando Node.js...")
    try:
        result = subprocess.run(['node', '--version'], capture_output=True, text=True)
        if result.returncode == 0:
            version = result.stdout.strip()
            print(f"   ✅ Node.js {version} - OK")
            return True
        else:
            print("   ❌ Node.js no encontrado")
            return False
    except FileNotFoundError:
        print("   ❌ Node.js no encontrado")
        return False

def test_npm_dependencies():
    """Test npm dependencies"""
    print("\n📦 Verificando dependencias de npm...")
    
    frontend_dir = Path("frontend")
    if not frontend_dir.exists():
        print("   ❌ Directorio frontend no encontrado")
        return False
    
    package_json = frontend_dir / "package.json"
    if not package_json.exists():
        print("   ❌ package.json no encontrado")
        return False
    
    node_modules = frontend_dir / "node_modules"
    if not node_modules.exists():
        print("   ⚠️  node_modules no encontrado - ejecuta 'npm install' en frontend/")
        return False
    
    print("   ✅ Dependencias de npm - OK")
    return True

def test_directory_structure():
    """Test directory structure"""
    print("\n📁 Verificando estructura de directorios...")
    
    required_dirs = [
        "backend",
        "frontend",
        "transcriber",
        "exporter",
        "utils"
    ]
    
    required_files = [
        "backend/main.py",
        "backend/requirements.txt",
        "frontend/package.json",
        "frontend/src/App.js",
        "README.md"
    ]
    
    all_ok = True
    
    for dir_name in required_dirs:
        if Path(dir_name).exists():
            print(f"   ✅ {dir_name}/ - OK")
        else:
            print(f"   ❌ {dir_name}/ - NO ENCONTRADO")
            all_ok = False
    
    for file_name in required_files:
        if Path(file_name).exists():
            print(f"   ✅ {file_name} - OK")
        else:
            print(f"   ❌ {file_name} - NO ENCONTRADO")
            all_ok = False
    
    return all_ok

def test_backend_startup():
    """Test if backend can start"""
    print("\n🚀 Probando inicio del backend...")
    
    backend_dir = Path("backend")
    if not backend_dir.exists():
        print("   ❌ Directorio backend no encontrado")
        return False
    
    # Check if main.py exists
    main_py = backend_dir / "main.py"
    if not main_py.exists():
        print("   ❌ main.py no encontrado")
        return False
    
    print("   ✅ Archivos del backend encontrados")
    print("   ℹ️  Para probar el backend completo, ejecuta: python backend/main.py")
    return True

def test_api_connection():
    """Test API connection if backend is running"""
    print("\n🌐 Probando conexión a la API...")
    
    try:
        response = requests.get("http://localhost:8000/health", timeout=5)
        if response.status_code == 200:
            print("   ✅ API respondiendo correctamente")
            data = response.json()
            print(f"   ℹ️  Estado: {data.get('status', 'unknown')}")
            return True
        else:
            print(f"   ⚠️  API respondió con código {response.status_code}")
            return False
    except requests.exceptions.ConnectionError:
        print("   ⚠️  Backend no está ejecutándose en http://localhost:8000")
        print("   ℹ️  Ejecuta 'start_backend.bat' para iniciar el backend")
        return False
    except requests.exceptions.Timeout:
        print("   ❌ Timeout al conectar con la API")
        return False

def test_frontend_files():
    """Test frontend files"""
    print("\n⚛️  Verificando archivos del frontend...")
    
    frontend_dir = Path("frontend")
    if not frontend_dir.exists():
        print("   ❌ Directorio frontend no encontrado")
        return False
    
    required_files = [
        "src/App.js",
        "src/index.js",
        "src/index.css",
        "src/components/FileUpload.js",
        "src/components/ProcessingView.js",
        "src/components/ResultView.js",
        "tailwind.config.js",
        "package.json"
    ]
    
    all_ok = True
    for file_name in required_files:
        file_path = frontend_dir / file_name
        if file_path.exists():
            print(f"   ✅ {file_name} - OK")
        else:
            print(f"   ❌ {file_name} - NO ENCONTRADO")
            all_ok = False
    
    return all_ok

def main():
    """Run all tests"""
    print("🔍 TRANSCRIPTO KD - VERIFICACIÓN DEL SISTEMA")
    print("=" * 50)
    
    tests = [
        ("Versión de Python", test_python_version),
        ("Dependencias de Python", test_python_dependencies),
        ("Versión de Node.js", test_node_version),
        ("Dependencias de npm", test_npm_dependencies),
        ("Estructura de directorios", test_directory_structure),
        ("Archivos del backend", test_backend_startup),
        ("Archivos del frontend", test_frontend_files),
        ("Conexión a la API", test_api_connection)
    ]
    
    results = []
    for test_name, test_func in tests:
        try:
            result = test_func()
            results.append((test_name, result))
        except Exception as e:
            print(f"   ❌ Error en {test_name}: {e}")
            results.append((test_name, False))
    
    # Summary
    print("\n" + "=" * 50)
    print("📊 RESUMEN DE VERIFICACIÓN")
    print("=" * 50)
    
    passed = sum(1 for _, result in results if result)
    total = len(results)
    
    for test_name, result in results:
        status = "✅ PASS" if result else "❌ FAIL"
        print(f"{status} - {test_name}")
    
    print(f"\n🎯 Resultado: {passed}/{total} pruebas pasaron")
    
    if passed == total:
        print("\n🎉 ¡Sistema completamente funcional!")
        print("\n📋 Próximos pasos:")
        print("   1. Ejecuta 'start_backend.bat' para iniciar el backend")
        print("   2. Ejecuta 'start_frontend.bat' para iniciar el frontend")
        print("   3. Abre http://localhost:3000 en tu navegador")
        print("   4. ¡Comienza a transcribir archivos!")
    else:
        print("\n⚠️  Algunos componentes necesitan atención.")
        print("\n📋 Acciones recomendadas:")
        if not any(name == "Dependencias de Python" and result for name, result in results):
            print("   • Ejecuta: pip install -r backend/requirements.txt")
        if not any(name == "Dependencias de npm" and result for name, result in results):
            print("   • Ejecuta: cd frontend && npm install")
        print("   • Revisa la guía de instalación en INSTALL.md")
        print("   • Verifica que Python 3.8+ y Node.js 16+ estén instalados")

if __name__ == "__main__":
    main()
