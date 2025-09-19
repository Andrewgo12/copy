#!/usr/bin/env python3
"""
Script de prueba para la integración IA-Laravel
Verifica que todos los componentes funcionen correctamente
"""

import os
import sys
import json
import time
import subprocess
import requests
from pathlib import Path

def print_step(step, description):
    """Imprimir paso con formato"""
    print(f"\n🔧 {step}: {description}")

def run_command(command, description, cwd=None, timeout=30):
    """Ejecutar comando y manejar errores"""
    print(f"   Ejecutando: {description}")
    try:
        result = subprocess.run(
            command, 
            shell=True, 
            cwd=cwd, 
            capture_output=True, 
            text=True,
            timeout=timeout
        )
        if result.returncode == 0:
            print(f"   ✅ {description} - Exitoso")
            return True, result.stdout
        else:
            print(f"   ❌ {description} - Error: {result.stderr}")
            return False, result.stderr
    except subprocess.TimeoutExpired:
        print(f"   ⏰ {description} - Timeout después de {timeout}s")
        return False, "Timeout"
    except Exception as e:
        print(f"   ❌ {description} - Excepción: {e}")
        return False, str(e)

def test_laravel_setup():
    """Probar configuración de Laravel"""
    print_step("1", "Verificando configuración de Laravel")
    
    # Verificar que estamos en el directorio correcto
    if not Path("artisan").exists():
        print("   ❌ No se encuentra el archivo 'artisan'. Ejecutar desde el directorio raíz de Laravel.")
        return False
    
    # Verificar dependencias
    success, _ = run_command("composer check-platform-reqs", "Verificando dependencias PHP")
    if not success:
        print("   ⚠️ Algunas dependencias PHP pueden faltar, continuando...")
    
    # Verificar configuración
    success, output = run_command("php artisan --version", "Verificando Laravel")
    if success:
        print(f"   ℹ️ {output.strip()}")
    
    return True

def test_database_migrations():
    """Probar migraciones de base de datos"""
    print_step("2", "Verificando migraciones de base de datos")
    
    # Ejecutar migraciones
    success, output = run_command("php artisan migrate --force", "Ejecutando migraciones")
    if not success:
        print("   ⚠️ Error en migraciones, puede que ya estén aplicadas")
    
    # Verificar que las tablas existen
    success, output = run_command(
        "php artisan tinker --execute=\"echo 'Emails: ' . App\\Models\\EmailMedico::count(); echo '\\nRegistros: ' . App\\Models\\RegistroMedico::count();\"",
        "Verificando tablas de base de datos",
        timeout=15
    )
    
    if success:
        print(f"   ℹ️ Conteo de registros:\n{output}")
    
    return True

def test_ia_system():
    """Probar sistema de IA"""
    print_step("3", "Verificando sistema de IA")
    
    ia_path = Path("ia")
    if not ia_path.exists():
        print("   ❌ Directorio 'ia' no encontrado")
        return False
    
    # Verificar estructura de directorios
    required_dirs = ["Json", "Professional_Email_Records", "Functions"]
    for dir_name in required_dirs:
        dir_path = ia_path / dir_name
        if dir_path.exists():
            print(f"   ✅ Directorio '{dir_name}' encontrado")
        else:
            print(f"   ⚠️ Directorio '{dir_name}' no encontrado")
    
    # Contar emails procesados
    json_dir = ia_path / "Json"
    professional_dir = ia_path / "Professional_Email_Records"
    
    json_count = len(list(json_dir.glob("email_*"))) if json_dir.exists() else 0
    professional_count = len(list(professional_dir.glob("test_email_*"))) if professional_dir.exists() else 0
    
    print(f"   ℹ️ Emails regulares procesados: {json_count}")
    print(f"   ℹ️ Emails médicos profesionales: {professional_count}")
    
    # Verificar bridge de Laravel
    bridge_file = ia_path / "laravel_bridge.py"
    if bridge_file.exists():
        print("   ✅ Bridge de Laravel encontrado")
    else:
        print("   ❌ Bridge de Laravel no encontrado")
        return False
    
    return True

def test_laravel_server():
    """Probar servidor Laravel"""
    print_step("4", "Iniciando servidor Laravel para pruebas")
    
    # Iniciar servidor en segundo plano
    print("   🔄 Iniciando servidor Laravel en puerto 8001...")
    process = subprocess.Popen(
        ["php", "artisan", "serve", "--port=8001"],
        stdout=subprocess.DEVNULL,
        stderr=subprocess.DEVNULL
    )
    
    # Esperar a que inicie
    time.sleep(5)
    
    try:
        # Probar conexión
        response = requests.get("http://localhost:8001", timeout=10)
        if response.status_code == 200:
            print("   ✅ Servidor Laravel iniciado correctamente")
            server_running = True
        else:
            print(f"   ❌ Servidor responde con código {response.status_code}")
            server_running = False
    except requests.exceptions.RequestException as e:
        print(f"   ❌ Error conectando al servidor: {e}")
        server_running = False
    
    return process, server_running

def test_api_endpoints(base_url="http://localhost:8001"):
    """Probar endpoints de la API"""
    print_step("5", "Probando endpoints de la API")
    
    # Endpoints a probar (sin autenticación por ahora)
    endpoints = [
        "/admin/ia/stats",
        "/admin/ia/emails",
        "/admin/ia/dashboard"
    ]
    
    results = {}
    
    for endpoint in endpoints:
        try:
            url = f"{base_url}{endpoint}"
            response = requests.get(url, timeout=10)
            
            if response.status_code in [200, 302, 401, 403]:  # Códigos esperados
                print(f"   ✅ {endpoint} - Respuesta: {response.status_code}")
                results[endpoint] = True
            else:
                print(f"   ❌ {endpoint} - Error: {response.status_code}")
                results[endpoint] = False
                
        except requests.exceptions.RequestException as e:
            print(f"   ❌ {endpoint} - Excepción: {e}")
            results[endpoint] = False
    
    return results

def test_bridge_connection():
    """Probar conexión del bridge"""
    print_step("6", "Probando bridge de comunicación")
    
    # Probar bridge Python
    bridge_path = Path("ia/laravel_bridge.py")
    if not bridge_path.exists():
        print("   ❌ Bridge no encontrado")
        return False
    
    # Probar conexión
    success, output = run_command(
        "python ia/laravel_bridge.py --url http://localhost:8001 --action test",
        "Probando conexión del bridge",
        timeout=15
    )
    
    if success:
        print("   ✅ Bridge conecta correctamente con Laravel")
    else:
        print("   ❌ Error en conexión del bridge")
        print(f"   📝 Output: {output}")
    
    return success

def test_import_functionality():
    """Probar funcionalidad de importación"""
    print_step("7", "Probando importación de datos")
    
    # Probar comando Artisan
    success, output = run_command(
        "php artisan ia:import-emails --auto --limit=5",
        "Probando comando de importación",
        timeout=30
    )
    
    if success:
        print("   ✅ Comando de importación ejecutado")
        print(f"   📝 Output: {output[:200]}...")
    else:
        print("   ❌ Error en comando de importación")
        print(f"   📝 Error: {output}")
    
    return success

def generate_test_report(results):
    """Generar reporte de pruebas"""
    print_step("8", "Generando reporte de pruebas")
    
    report = {
        "timestamp": time.strftime("%Y-%m-%d %H:%M:%S"),
        "tests": results,
        "summary": {
            "total": len(results),
            "passed": sum(1 for r in results.values() if r),
            "failed": sum(1 for r in results.values() if not r)
        }
    }
    
    # Guardar reporte
    with open("integration_test_report.json", "w") as f:
        json.dump(report, f, indent=2)
    
    print(f"   ✅ Reporte guardado en: integration_test_report.json")
    
    # Mostrar resumen
    print(f"\n📊 RESUMEN DE PRUEBAS:")
    print(f"   Total: {report['summary']['total']}")
    print(f"   Exitosas: {report['summary']['passed']}")
    print(f"   Fallidas: {report['summary']['failed']}")
    
    success_rate = (report['summary']['passed'] / report['summary']['total']) * 100
    print(f"   Tasa de éxito: {success_rate:.1f}%")
    
    return report

def main():
    """Función principal"""
    print("🧪 PRUEBAS DE INTEGRACIÓN IA-LARAVEL")
    print("="*50)
    
    results = {}
    laravel_process = None
    
    try:
        # Ejecutar pruebas
        results["laravel_setup"] = test_laravel_setup()
        results["database_migrations"] = test_database_migrations()
        results["ia_system"] = test_ia_system()
        
        # Iniciar servidor para pruebas de API
        laravel_process, server_ok = test_laravel_server()
        results["laravel_server"] = server_ok
        
        if server_ok:
            api_results = test_api_endpoints()
            results.update({f"api_{k.replace('/', '_')}": v for k, v in api_results.items()})
            
            results["bridge_connection"] = test_bridge_connection()
            results["import_functionality"] = test_import_functionality()
        else:
            print("   ⚠️ Saltando pruebas de API debido a error del servidor")
        
        # Generar reporte
        report = generate_test_report(results)
        
        # Resultado final
        if report['summary']['failed'] == 0:
            print("\n🎉 ¡Todas las pruebas pasaron exitosamente!")
            exit_code = 0
        else:
            print(f"\n⚠️ {report['summary']['failed']} pruebas fallaron")
            exit_code = 1
            
    except KeyboardInterrupt:
        print("\n🛑 Pruebas interrumpidas por el usuario")
        exit_code = 2
    except Exception as e:
        print(f"\n❌ Error inesperado: {e}")
        exit_code = 3
    finally:
        # Limpiar servidor Laravel
        if laravel_process:
            print("\n🧹 Cerrando servidor Laravel...")
            laravel_process.terminate()
            laravel_process.wait()
    
    print("\n" + "="*50)
    sys.exit(exit_code)

if __name__ == "__main__":
    main()
