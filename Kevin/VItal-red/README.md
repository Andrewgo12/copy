# 🏥 VItal Red - Sistema de Referencia Médica

**Hospital Universitario ESE - Sistema de Gestión de Referencias y Contra-referencias**

## 🚀 **INICIO RÁPIDO**

### **📦 Configuración Automática (Recomendada)**

1. **Haz clic derecho** en `CONFIGURAR_TODO.bat`
2. **Selecciona "Ejecutar como administrador"**
3. **Espera** a que termine la configuración (5-10 minutos)
4. **Doble clic** en `INICIAR_PROYECTO.bat`
5. **Ve a**: http://localhost:8000

### **👥 Usuarios de Prueba**

```
Admin:
- Email: admin@hospital.com
- Password: password

Médico:
- Email: medico@hospital.com  
- Password: password
```

## 🎯 **Funcionalidades Principales**

### **🔹 Para Médicos Evaluadores**
- **Bandeja de Casos Médicos** - Gestión centralizada de solicitudes
- **Evaluación Clínica** - Formularios de decisión médica
- **Priorización** - Clasificación por urgencia y especialidad
- **Historial** - Seguimiento completo de decisiones

### **🔹 Para Administradores**
- **Dashboard de IA** - Monitoreo de emails procesados
- **Gestión de Usuarios** - Control de acceso por roles
- **Supervisión** - Métricas y reportes en tiempo real
- **Configuración** - Parámetros del sistema

### **🔹 Integración con IA**
- **Procesamiento Automático** - Análisis de emails médicos
- **Extracción de Datos** - Información clínica estructurada
- **Clasificación Inteligente** - Priorización automática
- **Validación Médica** - Control de calidad humano

## 🌐 **Acceso al Sistema**

### **📋 Vistas Principales**

| **Rol** | **Vista** | **URL** |
|---------|-----------|---------|
| **Médico** | Bandeja de Casos | http://localhost:8000/medico/bandeja-casos |
| **Médico** | Ingresar Registro | http://localhost:8000/medico/ingresar-registro |
| **Admin** | Dashboard IA | http://localhost:8000/admin/ia/dashboard |
| **Admin** | Gestión Emails | http://localhost:8000/admin/ia/emails |
| **Admin** | Usuarios | http://localhost:8000/admin/usuarios |

### **🔐 Autenticación**
- **Login**: http://localhost:8000/login
- **Dashboard**: http://localhost:8000/dashboard (redirige según rol)

## 🛠️ **Comandos Útiles**

### **🚀 Inicio del Proyecto**
```bash
# Opción 1: Script automático
INICIAR_PROYECTO.bat

# Opción 2: Manual
php artisan serve          # Terminal 1
npm run dev                # Terminal 2
```

### **🗄️ Base de Datos**
```bash
php artisan migrate         # Crear tablas
php artisan db:seed         # Cargar datos de prueba
php artisan migrate:fresh --seed  # Reiniciar BD
```

### **🤖 Importación de IA**
```bash
php artisan ia:import-emails --auto    # Importar emails automáticamente
php artisan ia:import-emails --path=./ia  # Importar desde ruta específica
```

### **🧹 Mantenimiento**
```bash
php artisan cache:clear     # Limpiar caché
php artisan config:clear    # Limpiar configuración
php artisan view:clear      # Limpiar vistas compiladas
```

## 📁 **Estructura del Proyecto**

```
VItal-red/
├── 📄 CONFIGURAR_TODO.bat          # Configuración automática
├── 📄 INICIAR_PROYECTO.bat         # Inicio rápido
├── 📄 INTEGRATION_README.md        # Documentación técnica
├── 
├── app/
│   ├── Models/
│   │   ├── EmailMedico.php          # Emails procesados por IA
│   │   ├── SolicitudReferencia.php  # Solicitudes médicas
│   │   └── NotificacionInterna.php  # Sistema de alertas
│   ├── Http/Controllers/
│   │   ├── EmailIAController.php    # Gestión de IA
│   │   └── SolicitudReferenciaController.php  # Bandeja de casos
│   └── Services/
│       └── EmailIAImportService.php # Importación de datos
├── 
├── resources/js/pages/
│   ├── admin/
│   │   ├── ia-dashboard.tsx         # Dashboard de IA
│   │   └── emails-ia.tsx            # Gestión de emails
│   └── medico/
│       ├── bandeja-casos.tsx        # Bandeja principal
│       └── detalle-caso.tsx         # Formulario de decisión
├── 
└── ia/                              # Sistema de IA Python
    ├── Json/                        # Emails procesados
    ├── Professional_Email_Records/  # Emails médicos
    └── laravel_bridge.py           # Puente con Laravel
```

## 🔧 **Requisitos del Sistema**

### **💻 Software Necesario**
- **Windows 10/11**
- **XAMPP** (PHP 8.1+, MySQL, Apache)
- **Node.js 18+** (incluye NPM)
- **Composer** (gestor de dependencias PHP)

### **🌐 Navegadores Compatibles**
- **Chrome 90+** (Recomendado)
- **Firefox 88+**
- **Edge 90+**

## 📊 **Flujo de Trabajo**

### **📧 1. Recepción de Emails**
```
Email médico → Análisis IA → Extracción datos → Base de datos
```

### **📋 2. Gestión de Solicitudes**
```
Solicitud creada → Bandeja médico → Evaluación → Decisión → Notificación
```

### **🔄 3. Proceso de Decisión**
```
Revisar caso → Asignar prioridad → Aceptar/Rechazar → Observaciones → Seguimiento
```

## 🆘 **Solución de Problemas**

### **❌ Error: "php no se reconoce"**
1. Ejecuta `CONFIGURAR_TODO.bat` como administrador
2. O instala XAMPP manualmente desde https://www.apachefriends.org/

### **❌ Error: "npm no se reconoce"**
1. Instala Node.js desde https://nodejs.org/
2. Reinicia Command Prompt

### **❌ Error de base de datos**
1. Inicia MySQL desde XAMPP Control Panel
2. Verifica configuración en archivo `.env`

### **❌ Error de permisos**
```bash
# En el directorio del proyecto
chmod -R 775 storage bootstrap/cache
```

## 📞 **Soporte**

### **📧 Contacto Técnico**
- **Desarrollador**: Equipo VItal Red
- **Hospital**: Hospital Universitario ESE
- **Sistema**: Referencia y Contra-referencia Médica

### **📚 Documentación**
- **Técnica**: `INTEGRATION_README.md`
- **Usuario**: Disponible en el sistema
- **API**: `/admin/ia/docs` (próximamente)

---

**🏥 VItal Red - Transformando la gestión médica con tecnología de vanguardia**
