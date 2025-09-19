#!/usr/bin/env python3
"""
Script de verificación de implementación completa
Verifica que todos los componentes de la integración IA-Laravel estén implementados
"""

import os
import sys
from pathlib import Path

def check_file_exists(file_path, description):
    """Verificar que un archivo existe"""
    if Path(file_path).exists():
        print(f"✅ {description}: {file_path}")
        return True
    else:
        print(f"❌ {description}: {file_path} - NO ENCONTRADO")
        return False

def check_file_content(file_path, search_terms, description):
    """Verificar que un archivo contiene términos específicos"""
    if not Path(file_path).exists():
        print(f"❌ {description}: {file_path} - ARCHIVO NO ENCONTRADO")
        return False

    try:
        with open(file_path, 'r', encoding='utf-8') as f:
            content = f.read()

        missing_terms = []
        for term in search_terms:
            if term not in content:
                missing_terms.append(term)

        if not missing_terms:
            print(f"✅ {description}: Todos los términos encontrados")
            return True
        else:
            print(f"❌ {description}: Faltan términos: {missing_terms}")
            return False
    except Exception as e:
        print(f"❌ {description}: Error leyendo archivo: {e}")
        return False

def main():
    print("🔍 VERIFICACIÓN DE IMPLEMENTACIÓN COMPLETA")
    print("="*60)

    results = []

    # 1. Verificar modelos Laravel
    print("\n📋 1. MODELOS LARAVEL")
    results.append(check_file_exists("app/Models/EmailMedico.php", "Modelo EmailMedico"))
    results.append(check_file_content(
        "app/Models/EmailMedico.php",
        ["class EmailMedico", "protected $fillable", "registroMedico()", "getDataForRegistroMedico()"],
        "Contenido EmailMedico"
    ))

    results.append(check_file_content(
        "app/Models/RegistroMedico.php",
        ["email_unique_id", "email_procesado_ia", "emailMedico()"],
        "Campos IA en RegistroMedico"
    ))

    # 2. Verificar migraciones
    print("\n🗄️ 2. MIGRACIONES DE BASE DE DATOS")
    results.append(check_file_exists("database/migrations/2025_08_26_120000_create_emails_medicos_table.php", "Migración emails_medicos"))
    results.append(check_file_exists("database/migrations/2025_08_26_120001_add_ia_fields_to_registros_medicos_table.php", "Migración campos IA"))

    # 3. Verificar servicios
    print("\n⚙️ 3. SERVICIOS Y CONTROLADORES")
    results.append(check_file_exists("app/Services/EmailIAImportService.php", "Servicio de importación"))
    results.append(check_file_content(
        "app/Services/EmailIAImportService.php",
        ["importFromIASystem", "processRegularEmails", "processProfessionalEmails", "extractMedicalData"],
        "Métodos del servicio"
    ))

    results.append(check_file_exists("app/Http/Controllers/EmailIAController.php", "Controlador IA"))
    results.append(check_file_content(
        "app/Http/Controllers/EmailIAController.php",
        ["dashboard", "index", "show", "importFromIA", "createRegistroMedico", "validateEmail"],
        "Métodos del controlador"
    ))

    # 4. Verificar comando Artisan
    print("\n💻 4. COMANDO ARTISAN")
    results.append(check_file_exists("app/Console/Commands/ImportEmailsIA.php", "Comando ImportEmailsIA"))
    results.append(check_file_content(
        "app/Console/Commands/ImportEmailsIA.php",
        ["ia:import-emails", "EmailIAImportService", "handle()"],
        "Contenido del comando"
    ))

    # 5. Verificar rutas
    print("\n🛣️ 5. RUTAS WEB")
    results.append(check_file_content(
        "routes/web.php",
        ["name('ia.')", "dashboard", "emails", "import", "EmailIAController"],
        "Rutas de IA"
    ))

    # 6. Verificar vistas React
    print("\n⚛️ 6. VISTAS REACT")
    results.append(check_file_exists("resources/js/pages/admin/ia-dashboard.tsx", "Dashboard IA"))
    results.append(check_file_exists("resources/js/pages/admin/emails-ia.tsx", "Lista de emails"))
    results.append(check_file_exists("resources/js/pages/admin/email-ia-detail.tsx", "Detalle de email"))

    results.append(check_file_content(
        "resources/js/pages/admin/ia-dashboard.tsx",
        ["handleAutoImport", "handleProcessPending", "Stats", "EmailMedico"],
        "Funcionalidad dashboard"
    ))

    # 7. Verificar navegación
    print("\n🧭 7. NAVEGACIÓN")
    results.append(check_file_content(
        "resources/js/components/app-sidebar.tsx",
        ["Dashboard de IA", "/admin/ia/dashboard", "Brain"],
        "Navegación sidebar"
    ))

    results.append(check_file_content(
        "resources/js/components/app-header.tsx",
        ["Dashboard de IA", "/admin/ia/dashboard", "Brain"],
        "Navegación header"
    ))

    # 8. Verificar bridge Python
    print("\n🐍 8. BRIDGE PYTHON")
    results.append(check_file_exists("ia/laravel_bridge.py", "Bridge Laravel"))
    results.append(check_file_content(
        "ia/laravel_bridge.py",
        ["LaravelBridge", "test_connection", "send_processed_emails", "sync_with_laravel"],
        "Funcionalidad bridge"
    ))

    # 9. Verificar factories y seeders
    print("\n🏭 9. FACTORIES Y SEEDERS")
    results.append(check_file_exists("database/factories/EmailMedicoFactory.php", "Factory EmailMedico"))
    results.append(check_file_exists("database/factories/RegistroMedicoFactory.php", "Factory RegistroMedico"))
    results.append(check_file_exists("database/seeders/EmailMedicoSeeder.php", "Seeder EmailMedico"))

    # 10. Verificar requests de validación
    print("\n📝 10. REQUESTS DE VALIDACIÓN")
    results.append(check_file_exists("app/Http/Requests/EmailIA/ImportEmailsRequest.php", "Request ImportEmails"))
    results.append(check_file_exists("app/Http/Requests/EmailIA/ValidateEmailRequest.php", "Request ValidateEmail"))

    # 11. Verificar políticas
    print("\n🔒 11. POLÍTICAS DE AUTORIZACIÓN")
    results.append(check_file_exists("app/Policies/EmailMedicoPolicy.php", "Policy EmailMedico"))

    # 12. Verificar pruebas
    print("\n🧪 12. PRUEBAS")
    results.append(check_file_exists("tests/Feature/EmailIATest.php", "Pruebas Feature"))
    results.append(check_file_exists("tests/Unit/EmailIAImportServiceTest.php", "Pruebas Unit"))

    # 13. Verificar scripts de configuración
    print("\n🔧 13. SCRIPTS DE CONFIGURACIÓN")
    results.append(check_file_exists("setup_integration.py", "Script de configuración"))
    results.append(check_file_exists("test_integration.py", "Script de pruebas"))
    results.append(check_file_exists("INTEGRATION_README.md", "Documentación"))

    # 10. Verificar modelos de solicitudes de referencia
    print("\n📋 10. MODELOS DE SOLICITUDES")
    results.append(check_file_exists("app/Models/SolicitudReferencia.php", "Modelo SolicitudReferencia"))
    results.append(check_file_exists("app/Models/NotificacionInterna.php", "Modelo NotificacionInterna"))
    results.append(check_file_exists("database/migrations/2025_08_26_130000_create_solicitudes_referencia_table.php", "Migración solicitudes"))
    results.append(check_file_exists("database/migrations/2025_08_26_130001_create_notificaciones_internas_table.php", "Migración notificaciones"))

    # 11. Verificar controlador de solicitudes
    print("\n🎛️ 11. CONTROLADOR DE SOLICITUDES")
    results.append(check_file_exists("app/Http/Controllers/SolicitudReferenciaController.php", "Controlador Solicitudes"))
    results.append(check_file_content(
        "app/Http/Controllers/SolicitudReferenciaController.php",
        ["bandejaCasos", "detalleCaso", "tomarDecision", "solicitarInformacion", "crearDesdeEmail"],
        "Métodos del controlador solicitudes"
    ))

    # 12. Verificar vistas de bandeja de casos
    print("\n⚛️ 12. VISTAS DE BANDEJA DE CASOS")
    results.append(check_file_exists("resources/js/pages/medico/bandeja-casos.tsx", "Vista Bandeja de Casos"))
    results.append(check_file_exists("resources/js/pages/medico/detalle-caso.tsx", "Vista Detalle de Caso"))

    # 13. Verificar políticas de autorización
    print("\n🔒 13. POLÍTICAS DE AUTORIZACIÓN")
    results.append(check_file_exists("app/Policies/SolicitudReferenciaPolicy.php", "Policy SolicitudReferencia"))

    # 14. Verificar sistema IA existente
    print("\n🤖 14. SISTEMA IA EXISTENTE")
    results.append(check_file_exists("ia/Json", "Directorio emails JSON"))
    results.append(check_file_exists("ia/Professional_Email_Records", "Directorio emails médicos"))
    results.append(check_file_exists("ia/Functions", "Directorio funciones IA"))

    # Resumen final
    print("\n" + "="*60)
    print("📊 RESUMEN DE VERIFICACIÓN")
    print("="*60)

    total_checks = len(results)
    passed_checks = sum(results)
    failed_checks = total_checks - passed_checks

    print(f"Total de verificaciones: {total_checks}")
    print(f"✅ Exitosas: {passed_checks}")
    print(f"❌ Fallidas: {failed_checks}")

    success_rate = (passed_checks / total_checks) * 100
    print(f"📈 Tasa de éxito: {success_rate:.1f}%")

    if failed_checks == 0:
        print("\n🎉 ¡IMPLEMENTACIÓN COMPLETA!")
        print("✅ Todos los componentes están implementados correctamente")
        print("🚀 La integración IA-Laravel está lista para usar")
        exit_code = 0
    else:
        print(f"\n⚠️ IMPLEMENTACIÓN INCOMPLETA")
        print(f"❌ {failed_checks} componentes faltan o tienen problemas")
        print("🔧 Revisar los elementos marcados con ❌")
        exit_code = 1

    # Instrucciones finales
    print("\n📋 PRÓXIMOS PASOS:")
    if failed_checks == 0:
        print("1. Ejecutar: python setup_integration.py")
        print("2. Probar: python test_integration.py")
        print("3. Importar: php artisan ia:import-emails --auto")
        print("4. Acceder: http://localhost:8000/admin/ia/dashboard")
    else:
        print("1. Corregir los elementos faltantes marcados con ❌")
        print("2. Ejecutar nuevamente este script de verificación")
        print("3. Una vez completo, seguir con la configuración")

    print("\n" + "="*60)
    sys.exit(exit_code)

if __name__ == "__main__":
    main()
