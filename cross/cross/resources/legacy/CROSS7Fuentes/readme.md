# CROSS7Fuentes - Source Code Legacy

Código fuente del sistema CROSS7 organizado con estructura moderna y nombres normalizados.

## 📁 Estructura Organizada

```
CROSS7Fuentes/
├── config/                          # Configuración del sistema
│   ├── system-init.php             # Inicialización del sistema
│   └── temp-registry.php           # Registro temporal
├── docs/                           # Documentación
│   ├── documentation.txt           # Documentación general
│   └── system-version.txt          # Versión del sistema
├── scripts/                        # Scripts de configuración
│   └── configure-system.sh         # Configurar sistema
├── src/                           # Código fuente principal
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

### Directorios Renombrados
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

### Archivos Renombrados
- `inicio-sistema.php` → `system-init.php`
- `registro-temporal.php` → `temp-registry.php`
- `documentacion.txt` → `documentation.txt`
- `version-sistema.txt` → `system-version.txt`
- `configurar-sistema.sh` → `configure-system.sh`
- `Application.class.php` → `Application.php`
- `ASAP.class.php` → `ASAP.php`
- `function.app_name.php` → `app-name-function.php`
- `function.appname.php` → `appname-function.php`

### Extensiones Normalizadas
- `.inc.php` → `.php` (100+ archivos)
- `.inc` → `.php` (archivos de configuración)

## 🏗️ Arquitectura Modular

### Aplicaciones (Apps)
Cada módulo tiene la misma estructura:
- `config/` - Configuración específica
- `data/` - Archivos de datos
- `domain/` - Lógica de negocio
- `rs/` - Recursos y assets
- `templates_c/` - Plantillas compiladas Smarty
- `web/` - Interfaz web pública
- `index.php` - Punto de entrada

### Core System
- **Controllers**: Lógica de control MVC
- **Extensions**: Funciones personalizadas
- **Configuration**: Configuración del núcleo

### Libraries
- **Database**: ADOdb para abstracción BD
- **Graphics**: JPGraph para gráficos
- **Templates**: Smarty para plantillas
- **Web Services**: NuSOAP para SOAP
- **Utilities**: PEAR para utilidades PHP

## 🔗 Diferencias con CROSS7

CROSS7Fuentes contiene:
- **Código fuente completo** de cada módulo
- **Estructura modular** más detallada
- **Plantillas compiladas** (templates_c)
- **Recursos específicos** por módulo
- **Configuraciones individuales** por app

## 📝 Notas de Migración

- Mantiene compatibilidad con sistema original
- Estructura preparada para migración gradual
- Nombres normalizados facilitan integración
- Documentación completa de cambios realizados