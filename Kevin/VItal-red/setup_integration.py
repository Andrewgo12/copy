#!/usr/bin/env python3
"""
Script de configuración para la integración IA-Laravel
Automatiza la configuración inicial del sistema
"""

import os
import sys
import json
import subprocess
import shutil
from pathlib import Path

def print_header(title):
    """Imprimir encabezado con formato"""
    print("\n" + "="*60)
    print(f"  {title}")
    print("="*60)

def print_step(step, description):
    """Imprimir paso con formato"""
    print(f"\n🔧 Paso {step}: {description}")

def run_command(command, description, cwd=None):
    """Ejecutar comando y manejar errores"""
    print(f"   Ejecutando: {description}")
    try:
        result = subprocess.run(command, shell=True, cwd=cwd, capture_output=True, text=True)
        if result.returncode == 0:
            print(f"   ✅ {description} - Exitoso")
            return True
        else:
            print(f"   ❌ {description} - Error: {result.stderr}")
            return False
    except Exception as e:
        print(f"   ❌ {description} - Excepción: {e}")
        return False

def check_requirements():
    """Verificar requisitos del sistema"""
    print_step(1, "Verificando requisitos del sistema")
    
    requirements = {
        'python': 'python --version',
        'php': 'php --version',
        'composer': 'composer --version',
        'node': 'node --version',
        'npm': 'npm --version'
    }
    
    missing = []
    for req, cmd in requirements.items():
        if not run_command(cmd, f"Verificando {req}"):
            missing.append(req)
    
    if missing:
        print(f"\n❌ Faltan los siguientes requisitos: {', '.join(missing)}")
        return False
    
    print("\n✅ Todos los requisitos están instalados")
    return True

def setup_laravel_dependencies():
    """Configurar dependencias de Laravel"""
    print_step(2, "Configurando dependencias de Laravel")
    
    # Instalar dependencias PHP
    if not run_command("composer install", "Instalando dependencias PHP"):
        return False
    
    # Instalar dependencias Node.js
    if not run_command("npm install", "Instalando dependencias Node.js"):
        return False
    
    return True

def setup_database():
    """Configurar base de datos"""
    print_step(3, "Configurando base de datos")
    
    # Ejecutar migraciones
    migrations = [
        "php artisan migrate --force",
        "php artisan db:seed --force"
    ]
    
    for migration in migrations:
        if not run_command(migration, f"Ejecutando: {migration}"):
            print("   ⚠️ Error en migración, continuando...")
    
    return True

def setup_python_ia():
    """Configurar sistema de IA Python"""
    print_step(4, "Configurando sistema de IA Python")
    
    ia_path = Path("ia")
    if not ia_path.exists():
        print("   ❌ Directorio 'ia' no encontrado")
        return False
    
    # Instalar dependencias Python
    requirements_file = ia_path / "requirements.txt"
    if requirements_file.exists():
        if not run_command(f"pip install -r {requirements_file}", "Instalando dependencias Python"):
            return False
    
    # Hacer ejecutable el bridge
    bridge_file = ia_path / "laravel_bridge.py"
    if bridge_file.exists():
        os.chmod(bridge_file, 0o755)
        print("   ✅ Bridge de Laravel configurado")
    
    return True

def create_config_files():
    """Crear archivos de configuración"""
    print_step(5, "Creando archivos de configuración")
    
    # Crear archivo de configuración para el bridge
    config = {
        "laravel_url": "http://localhost:8000",
        "ia_path": "./ia",
        "auto_import": True,
        "monitor_interval": 300,
        "log_level": "INFO"
    }
    
    config_file = Path("ia_bridge_config.json")
    with open(config_file, 'w') as f:
        json.dump(config, f, indent=2)
    
    print(f"   ✅ Archivo de configuración creado: {config_file}")
    
    # Crear script de inicio
    startup_script = """#!/bin/bash
# Script de inicio para la integración IA-Laravel

echo "🚀 Iniciando integración IA-Laravel..."

# Verificar que Laravel esté ejecutándose
if ! curl -s http://localhost:8000 > /dev/null; then
    echo "⚠️ Laravel no está ejecutándose. Iniciando..."
    php artisan serve &
    sleep 5
fi

# Ejecutar importación inicial
echo "📥 Ejecutando importación inicial..."
python ia/laravel_bridge.py --action sync

# Iniciar monitoreo (opcional)
read -p "¿Desea iniciar el monitoreo automático? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "👁️ Iniciando monitoreo automático..."
    python ia/laravel_bridge.py --action monitor
fi
"""
    
    startup_file = Path("start_integration.sh")
    with open(startup_file, 'w') as f:
        f.write(startup_script)
    
    os.chmod(startup_file, 0o755)
    print(f"   ✅ Script de inicio creado: {startup_file}")
    
    return True

def test_integration():
    """Probar la integración"""
    print_step(6, "Probando la integración")
    
    # Iniciar Laravel en segundo plano para la prueba
    print("   🔄 Iniciando servidor Laravel para pruebas...")
    laravel_process = subprocess.Popen(
        ["php", "artisan", "serve", "--port=8001"],
        stdout=subprocess.DEVNULL,
        stderr=subprocess.DEVNULL
    )
    
    import time
    time.sleep(5)  # Esperar a que Laravel inicie
    
    try:
        # Probar conexión con el bridge
        bridge_cmd = "python ia/laravel_bridge.py --url http://localhost:8001 --action test"
        if run_command(bridge_cmd, "Probando conexión con Laravel"):
            print("   ✅ Integración funcionando correctamente")
            success = True
        else:
            print("   ❌ Error en la integración")
            success = False
    finally:
        # Terminar proceso de Laravel
        laravel_process.terminate()
        laravel_process.wait()
    
    return success

def create_documentation():
    """Crear documentación de uso"""
    print_step(7, "Creando documentación")
    
    docs = """# Integración IA-Laravel - Guía de Uso

## Comandos Principales

### 1. Importación Manual
```bash
# Importar emails desde el sistema de IA
python ia/laravel_bridge.py --action import --ia-path ./ia

# Importar usando comando Artisan
php artisan ia:import-emails --auto
```

### 2. Sincronización Completa
```bash
# Sincronizar todo (importar + procesar)
python ia/laravel_bridge.py --action sync --ia-path ./ia
```

### 3. Monitoreo Automático
```bash
# Iniciar monitoreo continuo (cada 5 minutos)
python ia/laravel_bridge.py --action monitor --interval 300
```

### 4. Acceso Web
- Dashboard de IA: http://localhost:8000/admin/ia/dashboard
- Lista de emails: http://localhost:8000/admin/ia/emails
- Estadísticas: http://localhost:8000/admin/ia/stats

## Estructura de Archivos

```
VItal-red/
├── ia/                          # Sistema de IA Python
│   ├── Json/                    # Emails procesados
│   ├── Professional_Email_Records/  # Emails médicos
│   ├── laravel_bridge.py        # Bridge de comunicación
│   └── requirements.txt         # Dependencias Python
├── app/
│   ├── Models/EmailMedico.php   # Modelo de emails
│   ├── Services/EmailIAImportService.php  # Servicio de importación
│   └── Http/Controllers/EmailIAController.php  # Controlador API
└── database/migrations/         # Migraciones de BD
```

## Flujo de Trabajo

1. **Procesamiento IA**: El sistema Python procesa emails y genera JSON
2. **Importación**: Laravel importa los datos JSON a la base de datos
3. **Validación**: Los médicos revisan y validan los emails médicos
4. **Creación de Registros**: Se crean registros médicos desde emails válidos
5. **Seguimiento**: Dashboard para monitorear todo el proceso

## Solución de Problemas

### Error de conexión
- Verificar que Laravel esté ejecutándose: `php artisan serve`
- Verificar la URL en la configuración

### Error de importación
- Verificar permisos de archivos en directorio `ia/`
- Revisar logs: `tail -f laravel_bridge.log`

### Error de base de datos
- Ejecutar migraciones: `php artisan migrate`
- Verificar configuración de BD en `.env`
"""
    
    docs_file = Path("INTEGRATION_GUIDE.md")
    with open(docs_file, 'w') as f:
        f.write(docs)
    
    print(f"   ✅ Documentación creada: {docs_file}")
    return True

def main():
    """Función principal"""
    print_header("CONFIGURACIÓN DE INTEGRACIÓN IA-LARAVEL")
    print("Este script configurará automáticamente la integración entre")
    print("el sistema de IA Python y la aplicación Laravel.")
    
    # Verificar que estamos en el directorio correcto
    if not Path("artisan").exists():
        print("\n❌ Error: Este script debe ejecutarse desde el directorio raíz de Laravel")
        print("   (donde se encuentra el archivo 'artisan')")
        sys.exit(1)
    
    steps = [
        check_requirements,
        setup_laravel_dependencies,
        setup_database,
        setup_python_ia,
        create_config_files,
        test_integration,
        create_documentation
    ]
    
    failed_steps = []
    
    for i, step in enumerate(steps, 1):
        try:
            if not step():
                failed_steps.append(i)
        except Exception as e:
            print(f"   ❌ Error inesperado en paso {i}: {e}")
            failed_steps.append(i)
    
    # Resumen final
    print_header("RESUMEN DE CONFIGURACIÓN")
    
    if not failed_steps:
        print("🎉 ¡Configuración completada exitosamente!")
        print("\n📋 Próximos pasos:")
        print("1. Iniciar Laravel: php artisan serve")
        print("2. Ejecutar importación: python ia/laravel_bridge.py --action sync")
        print("3. Acceder al dashboard: http://localhost:8000/admin/ia/dashboard")
        print("4. Revisar la documentación: INTEGRATION_GUIDE.md")
    else:
        print(f"⚠️ Configuración completada con errores en los pasos: {failed_steps}")
        print("\n📋 Acciones recomendadas:")
        print("1. Revisar los errores mostrados arriba")
        print("2. Ejecutar manualmente los pasos fallidos")
        print("3. Consultar la documentación para solución de problemas")
    
    print("\n" + "="*60)

if __name__ == "__main__":
    main()
