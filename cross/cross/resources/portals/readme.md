# Portals - Sistema de Portales CROSS

Portales web del sistema CROSS con interfaces de usuario y aplicaciones específicas.

## 📁 Estructura

```
portals/
├── portal-id/                       # Portal ID principal (Python Flask)
│   ├── env/                        # Entorno virtual Python
│   ├── sql_insert/                 # Aplicación Flask
│   │   ├── flask_session/          # Sesiones Flask
│   │   ├── static/                 # Archivos estáticos
│   │   ├── templates/              # Plantillas HTML
│   │   ├── app.py                  # Aplicación principal
│   │   ├── requirements.txt        # Dependencias Python
│   │   └── wsgi.py                 # WSGI config
│   ├── virtualenv/                 # Entorno virtual alternativo
│   └── database-test-script.php    # Script prueba BD
├── portal-id-legacy/               # Portal ID legacy (PHP)
│   ├── _lib/                       # Librerías del sistema
│   │   ├── buttons/                # Botones
│   │   ├── chart/                  # Gráficos
│   │   ├── css/                    # Estilos CSS
│   │   ├── js/                     # JavaScript
│   │   └── libraries/              # Librerías PHP
│   ├── blank-payments/             # Módulo pagos en blanco
│   ├── form-applications/          # Formulario aplicaciones
│   ├── form-clients/               # Formulario clientes
│   ├── form-clients-backup/        # Backup formulario clientes
│   ├── form-external-clients/      # Clientes externos
│   ├── form-client-states/         # Estados de clientes
│   ├── form-auth-methods/          # Métodos autenticación
│   ├── form-countries/             # Formulario países
│   ├── form-publications/          # Publicaciones
│   ├── form-client-types/          # Tipos de clientes
│   ├── form-id-types/              # Tipos identificación
│   ├── grid-applications/          # Grid aplicaciones
│   ├── grid-clients/               # Grid clientes
│   ├── grid-clients-backup/        # Grid clientes backup
│   ├── grid-client-states/         # Grid estados clientes
│   ├── grid-auth-methods/          # Grid métodos auth
│   ├── grid-onegate-logs/          # Grid logs OneGate
│   ├── grid-countries/             # Grid países
│   ├── grid-publications/          # Grid publicaciones
│   ├── grid-client-types/          # Grid tipos clientes
│   ├── grid-id-types/              # Grid tipos ID
│   ├── menu-portal-id/             # Menú portal
│   ├── index.php                   # Página principal
│   └── portal-id-v1.sql            # Base de datos
└── README.md                       # Esta documentación
```

## 🐍 Portal ID Principal (Python Flask)

### Características
- **Framework**: Flask (Python)
- **Base de datos**: PostgreSQL
- **Sesiones**: Flask-Session
- **Despliegue**: WSGI compatible

### Archivos Clave
- `app.py` - Aplicación Flask principal
- `requirements.txt` - Dependencias Python
- `wsgi.py` - Configuración WSGI
- `passenger_wsgi.py` - Passenger WSGI

### Configuración
```bash
# Activar entorno virtual
source env/bin/activate

# Instalar dependencias
pip install -r requirements.txt

# Ejecutar aplicación
python run.py
```

## 🐘 Portal ID Legacy (PHP)

### Características
- **Framework**: PHP nativo con librerías personalizadas
- **Base de datos**: PostgreSQL/MySQL
- **UI**: Formularios y grids dinámicos
- **Funcionalidades**: CRUD completo

### Módulos Principales

#### Formularios (Forms)
- **Aplicaciones**: Gestión de aplicaciones del sistema
- **Clientes**: Registro y edición de clientes
- **Países**: Catálogo de países
- **Publicaciones**: Gestión de contenido
- **Tipos**: Catálogos de tipos (clientes, identificación)
- **Autenticación**: Métodos de autenticación

#### Grids (Listados)
- **Funcionalidades**: Búsqueda, filtrado, exportación
- **Formatos**: CSV, XLS, PDF, RTF
- **Características**: Paginación, ordenamiento
- **Mobile**: Versiones móviles disponibles

#### Características Técnicas
- **AJAX**: Búsquedas dinámicas
- **jQuery**: Interactividad frontend
- **CSS**: Soporte LTR/RTL
- **Exportación**: Múltiples formatos
- **Impresión**: Configuración personalizada

## 🔧 Funcionalidades

### Portal Principal
- Autenticación de usuarios
- Dashboard personalizado
- Integración con CROSS
- APIs REST

### Portal Legacy
- Gestión de clientes
- Catálogos maestros
- Reportes y exportaciones
- Administración de usuarios

## 🚀 Despliegue

### Portal Python
```bash
# Producción con Gunicorn
gunicorn --bind 0.0.0.0:8000 wsgi:application

# Desarrollo
python run.py
```

### Portal PHP
- Servidor web Apache/Nginx
- PHP 7.4+
- Extensiones: PDO, GD, mbstring
- Base de datos PostgreSQL

## 🔗 Integración

Los portales se integran con:
- **Sistema CROSS principal**
- **Base de datos compartida**
- **Autenticación centralizada**
- **APIs comunes**

## 📝 Notas

- Portal Python es la versión moderna
- Portal PHP mantiene funcionalidades legacy
- Ambos comparten la misma base de datos
- Migración gradual en progreso