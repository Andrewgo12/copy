# 🤖 Integración IA-Laravel - VItal Red

## � **CONFIGURACIÓN AUTOMÁTICA COMPLETA**

### **OPCIÓN 1: CONFIGURACIÓN AUTOMÁTICA (RECOMENDADA)**

#### **Paso 1: Configurar todo automáticamente**
1. **Haz clic derecho** en `CONFIGURAR_TODO.bat`
2. **Selecciona "Ejecutar como administrador"**
3. **Acepta** el control de cuentas de usuario
4. **Espera** a que termine la configuración (5-10 minutos)

#### **Paso 2: Iniciar el proyecto**
1. **Doble clic** en `INICIAR_PROYECTO.bat`
2. **Selecciona opción 1** (Servidor completo)
3. **Ve a**: http://localhost:8000

#### **Usuarios de prueba:**
- **Admin**: admin@hospital.com / password
- **Médico**: medico@hospital.com / password

### **OPCIÓN 2: CONFIGURACIÓN MANUAL**

Si prefieres configurar manualmente, sigue las instrucciones detalladas más abajo.

---

## �📋 Resumen

Este documento describe la integración completa entre el sistema de IA Python y la aplicación Laravel de VItal Red. La integración permite el procesamiento automático de emails médicos y su importación a la base de datos para su gestión hospitalaria.

## 🏗️ Arquitectura de la Integración

```
┌─────────────────┐    ┌──────────────────┐    ┌─────────────────┐
│   Sistema IA    │    │   Laravel App    │    │   Base de Datos │
│   (Python)      │    │   (PHP/React)    │    │   (MySQL)       │
├─────────────────┤    ├──────────────────┤    ├─────────────────┤
│ • Gmail IMAP    │◄──►│ • API Bridge     │◄──►│ • emails_medicos│
│ • OCR/PDF       │    │ • Import Service │    │ • registros_med │
│ • NLP/Gemini    │    │ • Controllers    │    │ • users         │
│ • JSON Output   │    │ • React Views    │    │                 │
└─────────────────┘    └──────────────────┘    └─────────────────┘
```

## 🚀 Configuración Rápida

### 1. Ejecutar Script de Configuración
```bash
# Configuración automática completa
python setup_integration.py

# O configuración manual paso a paso
python setup_integration.py --manual
```

### 2. Verificar Integración
```bash
# Ejecutar pruebas de integración
python test_integration.py

# Verificar conexión específica
python ia/laravel_bridge.py --action test
```

### 3. Importación Inicial
```bash
# Importar emails existentes
php artisan ia:import-emails --auto

# O usando el bridge Python
python ia/laravel_bridge.py --action sync
```

## 📁 Estructura de Archivos

```
VItal-red/
├── ia/                                    # Sistema de IA Python
│   ├── Json/                             # Emails procesados (regulares)
│   ├── Professional_Email_Records/       # Emails médicos profesionales
│   ├── Functions/                        # Módulos de procesamiento
│   ├── laravel_bridge.py                # Bridge de comunicación
│   └── requirements.txt                  # Dependencias Python
├── app/
│   ├── Models/
│   │   ├── EmailMedico.php              # Modelo de emails procesados
│   │   └── RegistroMedico.php           # Modelo de registros médicos
│   ├── Services/
│   │   └── EmailIAImportService.php     # Servicio de importación
│   ├── Http/Controllers/
│   │   └── EmailIAController.php        # Controlador de API
│   └── Console/Commands/
│       └── ImportEmailsIA.php           # Comando Artisan
├── database/migrations/
│   ├── *_create_emails_medicos_table.php
│   └── *_add_ia_fields_to_registros_medicos_table.php
├── resources/js/pages/admin/
│   ├── ia-dashboard.tsx                 # Dashboard de IA
│   └── emails-ia.tsx                    # Lista de emails
├── routes/web.php                       # Rutas de integración
├── setup_integration.py                # Script de configuración
├── test_integration.py                 # Script de pruebas
└── INTEGRATION_README.md               # Este archivo
```

## 🔧 Componentes Principales

### 1. Modelo EmailMedico
- **Propósito**: Almacenar emails procesados por IA
- **Campos clave**: 
  - `unique_id`: Identificador único del email
  - `patient_name`: Nombre del paciente extraído
  - `ia_confidence_score`: Confianza de la extracción
  - `processing_status`: Estado del procesamiento
  - `imported_to_registro`: Si se creó registro médico

### 2. EmailIAImportService
- **Propósito**: Importar datos desde el sistema Python
- **Funciones principales**:
  - `importFromIASystem()`: Importación masiva
  - `processRegularEmails()`: Emails regulares
  - `processProfessionalEmails()`: Emails médicos
  - `extractMedicalData()`: Extracción de datos médicos

### 3. Laravel Bridge (Python)
- **Propósito**: Comunicación bidireccional
- **Funciones principales**:
  - `test_connection()`: Verificar conectividad
  - `send_processed_emails()`: Enviar datos a Laravel
  - `sync_with_laravel()`: Sincronización completa
  - `monitor_and_sync()`: Monitoreo automático

### 4. Dashboard de IA (React)
- **Propósito**: Interfaz de monitoreo y gestión
- **Características**:
  - Estadísticas en tiempo real
  - Importación manual/automática
  - Procesamiento en lotes
  - Filtros y búsqueda avanzada

## 🔄 Flujo de Trabajo

### 1. Procesamiento Automático
```bash
# El sistema Python procesa emails continuamente
cd ia/
python gmail_processor.py

# Monitoreo automático con bridge
python laravel_bridge.py --action monitor --interval 300
```

### 2. Importación Manual
```bash
# Desde Laravel (recomendado)
php artisan ia:import-emails --auto

# Desde Python
python ia/laravel_bridge.py --action import --ia-path ./ia
```

### 3. Procesamiento en Lotes
```bash
# Procesar emails médicos válidos pendientes
curl -X POST http://localhost:8000/admin/ia/process-pending \
  -H "Content-Type: application/json"
```

### 4. Monitoreo Web
- **Dashboard**: `http://localhost:8000/admin/ia/dashboard`
- **Lista de emails**: `http://localhost:8000/admin/ia/emails`
- **Estadísticas**: `http://localhost:8000/admin/ia/stats`

## 📊 Estados y Flujos

### Estados de Emails
- `pending`: Recién detectado, sin procesar
- `processing`: En proceso de extracción
- `extracted`: Datos extraídos por IA
- `validated`: Validado por personal médico
- `imported`: Convertido a registro médico
- `error`: Error en procesamiento
- `rejected`: Rechazado por validación

### Estados de Validación
- `pending`: Pendiente de validación
- `valid`: Validado como email médico
- `invalid`: No es email médico válido
- `needs_review`: Requiere revisión manual

### Niveles de Urgencia
- `urgente`/`crítica`: Atención inmediata
- `alta`: Prioridad alta
- `media`: Prioridad media
- `baja`/`normal`: Prioridad normal

## 🛠️ Comandos Útiles

### Laravel (PHP)
```bash
# Importar emails
php artisan ia:import-emails --auto --limit=50

# Verificar migraciones
php artisan migrate:status

# Limpiar cache
php artisan cache:clear
php artisan config:clear

# Ver logs
tail -f storage/logs/laravel.log
```

### Python Bridge
```bash
# Probar conexión
python ia/laravel_bridge.py --action test

# Importación única
python ia/laravel_bridge.py --action import

# Sincronización completa
python ia/laravel_bridge.py --action sync

# Monitoreo continuo
python ia/laravel_bridge.py --action monitor --interval 300
```

### Base de Datos
```sql
-- Verificar emails importados
SELECT COUNT(*) FROM emails_medicos;

-- Emails médicos válidos
SELECT COUNT(*) FROM emails_medicos WHERE validation_status = 'valid';

-- Emails pendientes de importar
SELECT COUNT(*) FROM emails_medicos 
WHERE imported_to_registro = false AND validation_status = 'valid';

-- Registros creados desde emails
SELECT COUNT(*) FROM registros_medicos WHERE email_procesado_ia = true;
```

## 🔍 Solución de Problemas

### Error: "Directorio IA no encontrado"
```bash
# Verificar estructura
ls -la ia/
ls -la ia/Json/
ls -la ia/Professional_Email_Records/

# Verificar permisos
chmod -R 755 ia/
```

### Error: "Conexión con Laravel fallida"
```bash
# Verificar servidor Laravel
php artisan serve --port=8000

# Probar conectividad
curl http://localhost:8000/admin/ia/stats
```

### Error: "Migraciones no aplicadas"
```bash
# Ejecutar migraciones
php artisan migrate --force

# Verificar tablas
php artisan tinker
>>> Schema::hasTable('emails_medicos')
>>> Schema::hasTable('registros_medicos')
```

### Error: "Dependencias Python faltantes"
```bash
# Instalar dependencias
pip install -r ia/requirements.txt

# Verificar instalación
python -c "import requests, json; print('OK')"
```

## 📈 Métricas y Monitoreo

### Métricas Clave
- **Total de emails procesados**: Volumen general
- **Emails médicos válidos**: Calidad de detección
- **Tasa de importación**: Eficiencia del proceso
- **Emails urgentes**: Casos críticos
- **Distribución por especialidad**: Análisis de demanda

### Logs Importantes
- `storage/logs/laravel.log`: Logs de Laravel
- `ia/laravel_bridge.log`: Logs del bridge Python
- `integration_test_report.json`: Reporte de pruebas

## 🔐 Seguridad

### Consideraciones
- **Autenticación**: Todas las rutas requieren login de administrador
- **Validación**: Datos médicos validados antes de importación
- **Logs**: Trazabilidad completa de acciones
- **Permisos**: Acceso restringido por roles

### Configuración Recomendada
```bash
# Permisos de archivos
chmod 644 ia/*.json
chmod 755 ia/*.py
chmod 600 .env

# Variables de entorno sensibles
echo "IA_BRIDGE_TOKEN=your-secret-token" >> .env
```

## 🚀 Próximos Pasos

1. **Completar integración**: Finalizar conexión automática
2. **Optimizar rendimiento**: Mejorar velocidad de procesamiento
3. **Agregar notificaciones**: Alertas en tiempo real
4. **Implementar webhooks**: Comunicación bidireccional
5. **Crear API pública**: Para integraciones externas

---

**Documentación actualizada**: 2025-08-26  
**Versión de integración**: 1.0  
**Compatibilidad**: Laravel 12, Python 3.8+
