# CROSSHUV - Sistema Principal CROSS (PRIORIDAD MÁXIMA)

**Sistema CROSSHUV** - La implementación más importante y completa del ecosistema CROSS. Sistema de gestión integral con arquitectura modular avanzada.

## 🎯 Importancia del Sistema

CROSSHUV es el **sistema principal** y más crítico del ecosistema CROSS:
- **Sistema de producción activo**
- **Arquitectura modular completa**
- **Múltiples módulos integrados**
- **Base para migración al nuevo CROSS**

## 📁 Estructura Organizada

```
CROSSHUV/
├── config/                          # Configuración del sistema
│   ├── system-init.php             # Inicialización del sistema
│   └── temp-registry.php           # Registro temporal
├── docs/                           # Documentación del sistema
│   ├── documentation.txt           # Documentación general
│   ├── system-routes.txt           # Rutas del sistema
│   └── system-version.txt          # Versión del sistema
├── logs/                           # Logs del sistema
│   ├── debug-alerts-log.txt        # Log de alertas debug
│   └── tests-log.log               # Log de pruebas
├── scripts/                        # Scripts de configuración
│   ├── configure-system.sh         # Configurar sistema
│   └── scheduled-tasks.txt         # Tareas programadas
├── src/                           # Código fuente principal
│   ├── apps/                      # Aplicaciones modulares
│   │   ├── agenda/                # 📅 Módulo Agenda/Calendario
│   │   │   ├── config/            # Configuración
│   │   │   │   ├── language/      # Idiomas
│   │   │   │   ├── application.conf.data
│   │   │   │   ├── application.constant.data
│   │   │   │   ├── config.php
│   │   │   │   └── web.conf.data
│   │   │   ├── data/              # Datos y cache
│   │   │   │   └── Pgsql/         # Scripts PostgreSQL
│   │   │   ├── domain/            # Lógica de negocio
│   │   │   │   ├── FeScAutoCompletar.php
│   │   │   │   ├── FeScCategoriaManager.php
│   │   │   │   ├── FeScEntradaManager.php
│   │   │   │   └── FeScScheduleManager.php
│   │   │   ├── rs/                # Servicios remotos
│   │   │   ├── templates_c/       # Plantillas compiladas
│   │   │   ├── web/               # Interfaz web
│   │   │   └── index.php
│   │   ├── almacen/               # 📦 Módulo Almacén/Inventario
│   │   │   ├── config/
│   │   │   ├── data/
│   │   │   │   ├── almacen.const.sql
│   │   │   │   └── almacen.sql
│   │   │   ├── domain/
│   │   │   │   ├── FeStBalanceManager.php
│   │   │   │   ├── FeStBodegaManager.php
│   │   │   │   ├── FeStMovimialmaceManager.php
│   │   │   │   └── FeStRecursoManager.php
│   │   │   └── web/
│   │   ├── clientes/              # 👥 Módulo Clientes/CRM
│   │   │   ├── config/
│   │   │   │   └── config.solicitante.php
│   │   │   ├── domain/
│   │   │   │   ├── FeCuClienteManager.php
│   │   │   │   ├── FeCuContactoManager.php
│   │   │   │   ├── FeCuContratoManager.php
│   │   │   │   └── FeCuPacienteManager.php
│   │   │   └── web/
│   │   ├── documentos/            # 📄 Módulo Documentos
│   │   │   ├── config/
│   │   │   │   └── languages/
│   │   │   ├── data/
│   │   │   │   ├── anexos/
│   │   │   │   ├── Oci8/
│   │   │   │   └── Pgsql/
│   │   │   └── web/
│   │   ├── formularios/           # 📋 Módulo Formularios/Encuestas
│   │   │   ├── config/
│   │   │   ├── domain/
│   │   │   │   ├── FeEnFormularioManager.php
│   │   │   │   ├── FeEnPreguntaManager.php
│   │   │   │   └── FeEnRespuestausuManager.php
│   │   │   └── templates_c/       # ⚠️ Contiene directorios de pruebas de seguridad
│   │   ├── perfiles/              # 👤 Módulo Perfiles/Usuarios
│   │   │   ├── config/
│   │   │   │   ├── profiles/
│   │   │   │   └── schema.data
│   │   │   ├── domain/
│   │   │   │   ├── FePrAuthManager.php
│   │   │   │   ├── FePrLoginManager.php
│   │   │   │   ├── FePrPermisionsManager.php
│   │   │   │   └── FePrProfilesManager.php
│   │   │   └── xslt/
│   │   ├── productos/             # 🛍️ Módulo Productos
│   │   ├── workflow/              # 🔄 Módulo Flujo de Trabajo
│   │   │   ├── domain/
│   │   │   │   ├── FeWFActaManager.php
│   │   │   │   ├── FeWFProcesoManager.php
│   │   │   │   ├── FeWFTareaManager.php
│   │   │   │   └── FeWFWorkflowManager.php
│   │   │   └── web/
│   │   ├── human-resources/       # 👨‍💼 Módulo Recursos Humanos
│   │   │   ├── domain/
│   │   │   │   ├── FeHrPersonalManager.php
│   │   │   │   ├── FeHrOrganizacionManager.php
│   │   │   │   └── FeHrCargoManager.php
│   │   │   └── web/
│   │   ├── main-system/           # 🏢 Sistema Principal/PQRSF
│   │   │   ├── domain/
│   │   │   │   ├── FeCrOrdenManager.php
│   │   │   │   ├── FeCrActividadManager.php
│   │   │   │   ├── FeCrSolucionManager.php
│   │   │   │   └── FeCrReportesManager.php
│   │   │   ├── templates_c/       # ⚠️ Contiene pruebas de penetración
│   │   │   ├── web/
│   │   │   ├── actualizar_config.php
│   │   │   ├── consultar_pqrs.html
│   │   │   ├── DOCUMENTACION_FICHA_CASO.md
│   │   │   ├── MANUAL_FICHA_CASO_CROSS300.md
│   │   │   └── test_sistema.php
│   │   └── utilities/             # 🔧 Módulo Utilidades
│   │       ├── config/
│   │       │   ├── DiasInhabiles.data
│   │       │   └── transferdependencies.data
│   │       ├── domain/
│   │       │   ├── FeGeEmailManager.php
│   │       │   ├── FeGePdfManager.php
│   │       │   ├── FeGeExcelManager.php
│   │       │   └── FeGeComunicacionManager.php
│   │       └── xslt/
│   ├── core/                      # Núcleo del sistema
│   │   ├── configuration/         # Configuración core
│   │   ├── controllers/           # Controladores principales
│   │   │   ├── datos/             # Controladores de datos
│   │   │   │   └── Serializer.php
│   │   │   ├── web-interface/     # Interfaz web
│   │   │   │   ├── FrontController.php
│   │   │   │   ├── WebRequest.php
│   │   │   │   ├── WebSession.php
│   │   │   │   └── TemplateView.php
│   │   │   ├── services/          # Servicios del sistema
│   │   │   │   ├── Cross300.php
│   │   │   │   ├── Customers.php
│   │   │   │   ├── HumanResources.php
│   │   │   │   ├── Workflow.php
│   │   │   │   └── Statistics.php
│   │   │   ├── web-services/      # Servicios web
│   │   │   │   ├── crossWS.php
│   │   │   │   └── ProfilesWS.php
│   │   │   ├── Application.php    # Aplicación principal
│   │   │   └── ASAP.php           # Sistema ASAP
│   │   └── extensions/            # Extensiones
│   │       ├── app-name-function.php
│   │       └── appname-function.php
│   └── libraries/                 # Librerías del sistema
│       ├── database/              # Base de datos (ADOdb)
│       ├── db-connectors/         # Conectores BD
│       ├── pdf-converter/         # Convertir PDF
│       ├── word-converter/        # Convertir Word
│       ├── downloads/             # Descargas
│       ├── email-sender/          # Envío email
│       ├── excel-exporter/        # Exportar Excel
│       ├── js-framework/          # Framework JS (Dojo)
│       ├── pdf-generator/         # Generar PDF
│       ├── graphics/              # Gráficos (JPGraph)
│       ├── navigation/            # Navegación
│       ├── templates/             # Plantillas (Smarty)
│       ├── web-services/          # Servicios web (NuSOAP)
│       └── php-utilities/         # Utilidades PHP (PEAR)
├── tests/                         # Pruebas del sistema
│   ├── test-socket-connection.php # Prueba conexión socket
│   ├── test-email-sending.php     # Prueba envío email
│   └── test-alternative-socket.php # Prueba socket alternativo
├── smtp-email-class.php           # Clase SMTP para email
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
- Y todas las librerías normalizadas

### Archivos Renombrados (30+)
- `inicio-sistema.php` → `system-init.php`
- `registro-temporal.php` → `temp-registry.php`
- `rutas-sistema.txt` → `system-routes.txt`
- `tareas-programadas.txt` → `scheduled-tasks.txt`
- `registro-debug-alertas.txt` → `debug-alerts-log.txt`
- `Application.class.php` → `Application.php`
- `FrontController.class.php` → `FrontController.php`
- `Cross300.class.php` → `Cross300.php`
- `Human_resources.class.php` → `HumanResources.php`
- `Data_type.class.php` → `DataType.php`
- `Dimentions.class.php` → `Dimensions.php`
- `Docunet.class.php` → `Document.php`
- `Encuestas.class.php` → `Surveys.php`
- `Statistic.class.php` → `Statistics.php`
- Y muchos más archivos de clases normalizados

### Extensiones Normalizadas (150+)
- `.inc.php` → `.php`
- `.inc` → `.php`
- `.htm` → `.html`
- `.class.php` → `.php`

## 🏗️ Módulos del Sistema

### 📅 Agenda/Calendario
- Gestión de citas y eventos
- Categorías y programación
- Integración con usuarios

### 📦 Almacén/Inventario
- Control de stock y bodegas
- Movimientos de inventario
- Proveedores y recursos

### 👥 Clientes/CRM
- Gestión de clientes y contactos
- Contratos y servicios
- Pacientes (sector salud)

### 📄 Documentos
- Gestión documental
- Anexos y archivos
- Soporte Oci8 y PostgreSQL

### 📋 Formularios/Encuestas
- Creación de formularios dinámicos
- Gestión de preguntas y respuestas
- Reportes y estadísticas

### 👤 Perfiles/Usuarios
- Autenticación y autorización
- Perfiles y permisos
- Esquemas de seguridad

### 🔄 Workflow
- Procesos y tareas
- Estados y transiciones
- Actas y seguimiento

### 👨‍💼 Recursos Humanos
- Personal y organización
- Cargos y dependencias
- Estructura organizacional

### 🏢 Sistema Principal (PQRSF)
- Gestión de PQRSF
- Órdenes y actividades
- Soluciones y reportes
- **Documentación técnica completa**

### 🔧 Utilidades
- Configuración del sistema
- Comunicaciones y email
- Generación de PDF y Excel
- Días inhábiles y transferencias

## ⚠️ Notas de Seguridad

El sistema contiene directorios con **pruebas de penetración** en:
- `formularios/templates_c/`
- `main-system/templates_c/`

Estos directorios contienen pruebas de:
- XSS (Cross-Site Scripting)
- SQL Injection
- Path Traversal
- Inyección de comandos

**Recomendación**: Limpiar estos directorios en producción.

## 🔗 Integración y Migración

CROSSHUV es la **base principal** para la migración al nuevo sistema CROSS:
- **Arquitectura modular** bien definida
- **Separación clara** de responsabilidades
- **APIs internas** para integración
- **Documentación técnica** completa

## 📝 Prioridades de Migración

1. **Sistema Principal (PQRSF)** - Funcionalidad crítica
2. **Perfiles/Usuarios** - Autenticación base
3. **Clientes/CRM** - Gestión de clientes
4. **Workflow** - Procesos de negocio
5. **Utilidades** - Servicios transversales
6. **Otros módulos** - Funcionalidades específicas

## 🎯 Importancia Estratégica

CROSSHUV representa:
- **Sistema de producción activo**
- **Arquitectura de referencia**
- **Base de conocimiento técnico**
- **Punto de partida para modernización**

La organización realizada facilita la **comprensión**, **mantenimiento** y **migración gradual** de este sistema crítico.