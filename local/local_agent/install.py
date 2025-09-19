#!/usr/bin/env python3
"""
Script de instalación automatizada para el Agente Local
Configura todo el entorno de forma automática
"""
import os
import sys
import subprocess
import shutil
import platform
from pathlib import Path
from typing import List, Dict, Any
import json


class Colors:
    """Colores para output en terminal"""
    HEADER = '\033[95m'
    OKBLUE = '\033[94m'
    OKCYAN = '\033[96m'
    OKGREEN = '\033[92m'
    WARNING = '\033[93m'
    FAIL = '\033[91m'
    ENDC = '\033[0m'
    BOLD = '\033[1m'


class AgentInstaller:
    """Instalador automatizado del agente local"""
    
    def __init__(self):
        self.system = platform.system()
        self.python_version = sys.version_info
        self.errors = []
        self.warnings = []
        
        print(f"{Colors.HEADER}{Colors.BOLD}")
        print("🤖 INSTALADOR DEL AGENTE LOCAL")
        print("=" * 50)
        print(f"{Colors.ENDC}")
    
    def check_requirements(self) -> bool:
        """Verifica requisitos del sistema"""
        print(f"{Colors.OKBLUE}📋 Verificando requisitos del sistema...{Colors.ENDC}")
        
        # Verificar Python
        if self.python_version < (3, 8):
            self.errors.append(f"Python 3.8+ requerido. Actual: {sys.version}")
            return False
        else:
            print(f"✅ Python {sys.version.split()[0]} - OK")
        
        # Verificar pip
        try:
            subprocess.run([sys.executable, "-m", "pip", "--version"], 
                         check=True, capture_output=True)
            print("✅ pip - OK")
        except subprocess.CalledProcessError:
            self.errors.append("pip no está disponible")
            return False
        
        # Verificar git (opcional)
        try:
            subprocess.run(["git", "--version"], check=True, capture_output=True)
            print("✅ git - OK")
        except (subprocess.CalledProcessError, FileNotFoundError):
            self.warnings.append("git no está disponible (opcional)")
        
        # Verificar Docker (opcional)
        try:
            subprocess.run(["docker", "--version"], check=True, capture_output=True)
            print("✅ Docker - OK")
        except (subprocess.CalledProcessError, FileNotFoundError):
            self.warnings.append("Docker no está disponible (opcional para sandbox)")
        
        # Verificar espacio en disco
        free_space = shutil.disk_usage(".").free / (1024**3)  # GB
        if free_space < 2:
            self.errors.append(f"Espacio insuficiente. Requerido: 2GB, Disponible: {free_space:.1f}GB")
            return False
        else:
            print(f"✅ Espacio en disco: {free_space:.1f}GB - OK")
        
        return len(self.errors) == 0
    
    def create_virtual_environment(self) -> bool:
        """Crea entorno virtual"""
        print(f"{Colors.OKBLUE}🐍 Creando entorno virtual...{Colors.ENDC}")
        
        try:
            # Crear entorno virtual
            subprocess.run([
                sys.executable, "-m", "venv", "venv"
            ], check=True)
            
            print("✅ Entorno virtual creado")
            return True
            
        except subprocess.CalledProcessError as e:
            self.errors.append(f"Error creando entorno virtual: {e}")
            return False
    
    def install_dependencies(self) -> bool:
        """Instala dependencias Python"""
        print(f"{Colors.OKBLUE}📦 Instalando dependencias...{Colors.ENDC}")
        
        try:
            # Determinar ejecutable de Python en venv
            if self.system == "Windows":
                python_exe = "venv\\Scripts\\python.exe"
                pip_exe = "venv\\Scripts\\pip.exe"
            else:
                python_exe = "venv/bin/python"
                pip_exe = "venv/bin/pip"
            
            # Actualizar pip
            subprocess.run([
                python_exe, "-m", "pip", "install", "--upgrade", "pip"
            ], check=True)
            
            # Instalar dependencias
            subprocess.run([
                pip_exe, "install", "-r", "requirements.txt"
            ], check=True)
            
            print("✅ Dependencias instaladas")
            return True
            
        except subprocess.CalledProcessError as e:
            self.errors.append(f"Error instalando dependencias: {e}")
            return False
    
    def setup_configuration(self) -> bool:
        """Configura archivos de configuración"""
        print(f"{Colors.OKBLUE}⚙️ Configurando archivos...{Colors.ENDC}")
        
        try:
            # Copiar .env.example a .env si no existe
            if not Path(".env").exists():
                shutil.copy(".env.example", ".env")
                print("✅ Archivo .env creado")
            else:
                print("⚠️ Archivo .env ya existe")
            
            # Crear directorios necesarios
            directories = [
                "data/vector_db",
                "data/cache",
                "data/logs", 
                "data/backups",
                "tools/custom",
                "config"
            ]
            
            for directory in directories:
                Path(directory).mkdir(parents=True, exist_ok=True)
                print(f"✅ Directorio creado: {directory}")
            
            return True
            
        except Exception as e:
            self.errors.append(f"Error configurando archivos: {e}")
            return False
    
    def test_installation(self) -> bool:
        """Prueba la instalación"""
        print(f"{Colors.OKBLUE}🧪 Probando instalación...{Colors.ENDC}")
        
        try:
            # Determinar ejecutable de Python en venv
            if self.system == "Windows":
                python_exe = "venv\\Scripts\\python.exe"
            else:
                python_exe = "venv/bin/python"
            
            # Test básico de importación
            test_script = """
import sys
sys.path.insert(0, '.')

try:
    from core.agent import LocalAgent, AgentConfig
    print("✅ Importación de core exitosa")
    
    from tools.base import BaseTool
    print("✅ Importación de tools exitosa")
    
    from storage.vector_db import VectorDatabase
    print("✅ Importación de storage exitosa")
    
    print("🎉 Instalación verificada exitosamente")
    
except ImportError as e:
    print(f"❌ Error de importación: {e}")
    sys.exit(1)
except Exception as e:
    print(f"❌ Error general: {e}")
    sys.exit(1)
"""
            
            # Ejecutar test
            result = subprocess.run([
                python_exe, "-c", test_script
            ], capture_output=True, text=True)
            
            if result.returncode == 0:
                print(result.stdout)
                return True
            else:
                self.errors.append(f"Test falló: {result.stderr}")
                return False
                
        except Exception as e:
            self.errors.append(f"Error en test de instalación: {e}")
            return False
    
    def configure_api_keys(self) -> bool:
        """Guía interactiva para configurar API keys"""
        print(f"{Colors.OKBLUE}🔑 Configuración de API Keys...{Colors.ENDC}")
        
        try:
            env_file = Path(".env")
            
            # Leer archivo .env actual
            env_content = env_file.read_text() if env_file.exists() else ""
            
            # Configurar OpenAI
            if "OPENAI_API_KEY=your-openai-key-here" in env_content or "OPENAI_API_KEY=" in env_content:
                print("\n🔸 Configuración de OpenAI:")
                print("1. Ve a: https://platform.openai.com/api-keys")
                print("2. Crea una nueva API key")
                print("3. Cópiala y pégala aquí")
                
                openai_key = input("OpenAI API Key (o Enter para omitir): ").strip()
                if openai_key:
                    env_content = env_content.replace(
                        "OPENAI_API_KEY=your-openai-key-here",
                        f"OPENAI_API_KEY={openai_key}"
                    )
                    print("✅ OpenAI API Key configurada")
            
            # Configurar Anthropic
            if "ANTHROPIC_API_KEY=your-anthropic-key-here" in env_content:
                print("\n🔸 Configuración de Anthropic (opcional):")
                print("1. Ve a: https://console.anthropic.com/")
                print("2. Crea una nueva API key")
                
                anthropic_key = input("Anthropic API Key (o Enter para omitir): ").strip()
                if anthropic_key:
                    env_content = env_content.replace(
                        "ANTHROPIC_API_KEY=your-anthropic-key-here",
                        f"ANTHROPIC_API_KEY={anthropic_key}"
                    )
                    print("✅ Anthropic API Key configurada")
            
            # Guardar archivo .env actualizado
            env_file.write_text(env_content)
            
            return True
            
        except Exception as e:
            self.errors.append(f"Error configurando API keys: {e}")
            return False
    
    def create_startup_scripts(self) -> bool:
        """Crea scripts de inicio convenientes"""
        print(f"{Colors.OKBLUE}📜 Creando scripts de inicio...{Colors.ENDC}")
        
        try:
            # Script para Windows
            if self.system == "Windows":
                startup_script = """@echo off
echo 🤖 Iniciando Agente Local...
call venv\\Scripts\\activate
python main.py
pause
"""
                with open("start_agent.bat", "w") as f:
                    f.write(startup_script)
                print("✅ Script start_agent.bat creado")
            
            # Script para Unix/Linux/macOS
            else:
                startup_script = """#!/bin/bash
echo "🤖 Iniciando Agente Local..."
source venv/bin/activate
python main.py
"""
                with open("start_agent.sh", "w") as f:
                    f.write(startup_script)
                
                # Hacer ejecutable
                os.chmod("start_agent.sh", 0o755)
                print("✅ Script start_agent.sh creado")
            
            return True
            
        except Exception as e:
            self.errors.append(f"Error creando scripts: {e}")
            return False
    
    def show_final_instructions(self):
        """Muestra instrucciones finales"""
        print(f"\n{Colors.OKGREEN}{Colors.BOLD}")
        print("🎉 INSTALACIÓN COMPLETADA EXITOSAMENTE")
        print("=" * 50)
        print(f"{Colors.ENDC}")
        
        print(f"{Colors.OKGREEN}✅ Agente Local instalado y configurado{Colors.ENDC}")
        
        if self.warnings:
            print(f"\n{Colors.WARNING}⚠️ Advertencias:{Colors.ENDC}")
            for warning in self.warnings:
                print(f"  • {warning}")
        
        print(f"\n{Colors.OKBLUE}🚀 Para iniciar el agente:{Colors.ENDC}")
        
        if self.system == "Windows":
            print("  • Doble click en start_agent.bat")
            print("  • O ejecuta: venv\\Scripts\\activate && python main.py")
        else:
            print("  • Ejecuta: ./start_agent.sh")
            print("  • O ejecuta: source venv/bin/activate && python main.py")
        
        print(f"\n{Colors.OKBLUE}📚 Recursos útiles:{Colors.ENDC}")
        print("  • Documentación: docs/")
        print("  • Ejemplos: examples/")
        print("  • Configuración: .env")
        print("  • Logs: data/logs/")
        
        print(f"\n{Colors.OKBLUE}🆘 Si tienes problemas:{Colors.ENDC}")
        print("  • Revisa docs/TROUBLESHOOTING.md")
        print("  • Verifica logs en data/logs/agent.log")
        print("  • Ejecuta: python examples/complete_example.py")
        
        print(f"\n{Colors.OKCYAN}¡Disfruta tu agente local! 🤖{Colors.ENDC}")
    
    def run_installation(self) -> bool:
        """Ejecuta el proceso completo de instalación"""
        steps = [
            ("Verificar requisitos", self.check_requirements),
            ("Crear entorno virtual", self.create_virtual_environment),
            ("Instalar dependencias", self.install_dependencies),
            ("Configurar archivos", self.setup_configuration),
            ("Configurar API keys", self.configure_api_keys),
            ("Crear scripts de inicio", self.create_startup_scripts),
            ("Probar instalación", self.test_installation)
        ]
        
        for step_name, step_function in steps:
            print(f"\n{Colors.OKCYAN}🔄 {step_name}...{Colors.ENDC}")
            
            try:
                if not step_function():
                    print(f"{Colors.FAIL}❌ Error en: {step_name}{Colors.ENDC}")
                    self.show_errors()
                    return False
                    
            except KeyboardInterrupt:
                print(f"\n{Colors.WARNING}⚠️ Instalación interrumpida por el usuario{Colors.ENDC}")
                return False
            except Exception as e:
                self.errors.append(f"Error inesperado en {step_name}: {e}")
                print(f"{Colors.FAIL}❌ Error inesperado en: {step_name}{Colors.ENDC}")
                self.show_errors()
                return False
        
        return True
    
    def show_errors(self):
        """Muestra errores encontrados"""
        if self.errors:
            print(f"\n{Colors.FAIL}❌ Errores encontrados:{Colors.ENDC}")
            for error in self.errors:
                print(f"  • {error}")
        
        if self.warnings:
            print(f"\n{Colors.WARNING}⚠️ Advertencias:{Colors.ENDC}")
            for warning in self.warnings:
                print(f"  • {warning}")


def main():
    """Función principal del instalador"""
    
    # Verificar que estamos en el directorio correcto
    if not Path("requirements.txt").exists():
        print(f"{Colors.FAIL}❌ Error: Ejecuta este script desde el directorio raíz del proyecto{Colors.ENDC}")
        print("   Debe contener: requirements.txt, main.py, core/, tools/, etc.")
        sys.exit(1)
    
    # Crear instalador
    installer = AgentInstaller()
    
    try:
        # Ejecutar instalación
        success = installer.run_installation()
        
        if success:
            installer.show_final_instructions()
            sys.exit(0)
        else:
            print(f"\n{Colors.FAIL}❌ Instalación falló{Colors.ENDC}")
            print(f"{Colors.OKBLUE}💡 Revisa los errores arriba y consulta docs/TROUBLESHOOTING.md{Colors.ENDC}")
            sys.exit(1)
            
    except KeyboardInterrupt:
        print(f"\n{Colors.WARNING}⚠️ Instalación cancelada{Colors.ENDC}")
        sys.exit(1)


if __name__ == "__main__":
    main()
