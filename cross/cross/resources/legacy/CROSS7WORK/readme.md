# CROSS7WORK - Development Environment

Entorno de desarrollo del sistema CROSS7 con estructura organizada y archivos normalizados.

## 📁 Estructura Organizada

```
CROSS7WORK/
├── config/                          # Configuración del sistema
│   ├── system-init.php             # Inicialización del sistema
│   ├── temp-registry.php           # Registro temporal
│   └── local/                      # Configuración local
├── database/                       # Base de datos de desarrollo
│   └── development-database.sql    # Script BD desarrollo
├── docs/                           # Documentación
│   ├── documentation.txt           # Documentación general
│   └── system-version.txt          # Versión del sistema
├── scripts/                        # Scripts de configuración
│   └── configure-system.sh         # Configurar sistema
├── src/                           # Código fuente de desarrollo
│   ├── apps/                      # Aplicaciones modulares
│   │   ├── agenda/                # Módulo agenda
│   │   │   ├── config/            # Configuración
│   │   │   ├── data/              # Datos
│   │   │   ├── domain/            # Lógica de dominio
│   │   │   ├── rs/                # Recursos
│   │   │   ├── templates_c/       # Plantillas compiladas
│   │   │   ├── web/               # Interfaz web
│   │   │   └── index.php          # Punto de entrada
│   │   ├── almacen/               # Módulo almacén
│   │   ├── clientes/              # Módulo clientes
│   │   ├── documentos/            # Módulo documentos
│   │   ├── formularios/           # Formularios
│   │   ├── perfiles/              # Perfiles de usuario
│   │   ├── productos/             # Productos
│   │   ├── workflow/              # Flujo de trabajo
│   │   ├── human-resources/       # Recursos humanos
│   │   ├── main-system/           # Sistema principal
│   │   └── utilities/             # Utilidades
│   ├── core/                      # Núcleo del sistema
│   │   ├── configuration/         # Configuración core
│   │   ├── controllers/           # Controladores
│   │   │   ├── datos/             # Controladores de datos
│   │   │   ├── web-interface/     # Interfaz web
│   │   │   ├── services/          # Servicios
│   │   │   ├── web-services/      # Servicios web
│   │   │   ├── Application.php    # Aplicación principal
│   │   │   └── ASAP.php           # Sistema ASAP
│   │   └── extensions/            # Extensiones
│   │       ├── app-name-function.php    # Función nombre app
│   │       └── appname-function.php     # Función appname
│   └── libraries/                 # Librerías del sistema
│       ├── database/              # Base de datos (ADOdb)
│       ├── db-connectors/         # Conectores BD
│       ├── pdf-converter/         # Convertir PDF
│       ├── word-converter/        # Convertir Word
│       ├── downloads/             # Descargas
│       ├── email-sender/          # Envío email
│       ├── excel-exporter/        # Exportar Excel
│       ├── js-framework/          # Framework JS
│       ├── pdf-generator/         # Generar PDF
│       ├── graphics/              # Gráficos (JPGraph)
│       ├── navigation/            # Navegación
│       ├── templates/             # Plantillas (Smarty)
│       ├── web-services/          # Servicios web (NuSOAP)
│       └── php-utilities/         # Utilidades PHP (PEAR)
└── README.md                      # Esta documentación
```

## 🔄 Cambios Realizados

### Directorios Renombrados (24)
- `flujo-trabajo` → `workflow`
- `recursos-humanos` → `human-resources`
- `sistema-principal` → `main-system`
- `utilidades` → `utilities`
- `configuracion` → `configuration`
- `controladores` → `controllers`
- `interfaz-web` → `web-interface`
- `servicios` → `services`
- `servicios-web` → `web-services`
- `extensiones` → `extensions`
- `base-datos` → `database`
- `conectores-bd` → `db-connectors`
- `convertir-pdf` → `pdf-converter`
- `convertir-word` → `word-converter`
- `descargas` → `downloads`
- `envio-email` → `email-sender`
- `exportar-excel` → `excel-exporter`
- `framework-js` → `js-framework`
- `generar-pdf` → `pdf-generator`
- `graficos` → `graphics`
- `navegacion` → `navigation`
- `plantillas` → `templates`
- `utilidades-php` → `php-utilities`

### Archivos Renombrados (10)
- `inicio-sistema.php` → `system-init.php`
- `registro-temporal.php` → `temp-registry.php`
- `documentacion.txt` → `documentation.txt`
- `version-sistema.txt` → `system-version.txt`
- `configurar-sistema.sh` → `configure-system.sh`
- `base-datos-desarrollo.sql` → `development-database.sql`
- `Application.class.php` → `Application.php`
- `ASAP.class.php` → `ASAP.php`
- `function.app_name.php` → `app-name-function.php`
- `function.appname.php` → `appname-function.php`

### Extensiones Normalizadas (100+)
- `.inc.php` → `.php`
- `.inc` → `.php`

## 🛠️ Características del Entorno de Desarrollo

### Base de Datos de Desarrollo
- `development-database.sql` - Script específico para desarrollo
- Configuración local separada en `config/local/`

### Estructura Modular
Cada aplicación mantiene:
- **config/** - Configuración específica del módulo
- **data/** - Archivos de datos y cache
- **domain/** - Lógica de negocio
- **rs/** - Recursos y assets
- **templates_c/** - Plantillas Smarty compiladas
- **web/** - Interfaz web pública
- **xslt/** - Transformaciones XML (algunos módulos)

### Librerías de Desarrollo
- **ADOdb** - Abstracción de base de datos
- **JPGraph** - Generación de gráficos
- **Smarty** - Motor de plantillas
- **NuSOAP** - Servicios web SOAP
- **PEAR** - Utilidades PHP estándar

## 🔗 Diferencias con Otros Entornos

**CROSS7WORK vs CROSS7:**
- Incluye base de datos de desarrollo
- Configuración local específica
- Entorno preparado para desarrollo activo

**CROSS7WORK vs CROSS7Fuentes:**
- Misma estructura de código fuente
- Añade herramientas de desarrollo
- Base de datos específica para testing

## 🚀 Uso del Entorno

1. **Configuración Local**: Ajustar `config/local/`
2. **Base de Datos**: Ejecutar `development-database.sql`
3. **Desarrollo**: Trabajar en módulos específicos
4. **Testing**: Usar plantillas compiladas en `templates_c/`

## 📝 Notas de Desarrollo

- Entorno optimizado para desarrollo activo
- Estructura normalizada facilita navegación
- Compatibilidad mantenida con sistema original
- Preparado para migración gradual al nuevo CROSS