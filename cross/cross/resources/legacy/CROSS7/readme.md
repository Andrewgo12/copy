# CROSS7 Legacy System

Sistema legacy CROSS7 organizado con estructura moderna y nombres de archivos normalizados.

## 📁 Estructura Organizada

```
CROSS7/
├── config/                           # Configuración del sistema
│   ├── system-init.php              # Inicialización del sistema
│   └── temp-registry.php            # Registro temporal
├── docs/                            # Documentación
│   ├── documentation.txt            # Documentación general
│   └── system-version.txt           # Versión del sistema
├── scripts/                         # Scripts de configuración
│   └── configure-system.sh          # Configurar sistema
├── src/                            # Código fuente
│   ├── apps/                       # Aplicaciones
│   │   ├── agenda/                 # Módulo agenda
│   │   ├── almacen/                # Módulo almacén
│   │   ├── clientes/               # Módulo clientes
│   │   ├── documentos/             # Módulo documentos
│   │   ├── workflow/               # Flujo de trabajo
│   │   ├── formularios/            # Formularios
│   │   ├── perfiles/               # Perfiles de usuario
│   │   ├── productos/              # Productos
│   │   ├── human-resources/        # Recursos humanos
│   │   ├── main-system/            # Sistema principal
│   │   └── utilities/              # Utilidades
│   ├── core/                       # Núcleo del sistema
│   │   ├── configuration/          # Configuración core
│   │   ├── controllers/            # Controladores
│   │   │   ├── datos/              # Controladores de datos
│   │   │   ├── web-interface/      # Interfaz web
│   │   │   ├── services/           # Servicios
│   │   │   └── web-services/       # Servicios web
│   │   ├── extensions/             # Extensiones
│   │   ├── main-application.php    # Aplicación principal
│   │   └── asap-system.php         # Sistema ASAP
│   └── libraries/                  # Librerías
│       ├── database/               # Base de datos (ADOdb)
│       ├── db-connectors/          # Conectores BD
│       ├── pdf-converter/          # Convertir PDF
│       ├── word-converter/         # Convertir Word
│       ├── downloads/              # Descargas
│       ├── email-sender/           # Envío email
│       ├── excel-exporter/         # Exportar Excel
│       ├── js-framework/           # Framework JS
│       ├── pdf-generator/          # Generar PDF
│       ├── graphics/               # Gráficos (JPGraph)
│       ├── navigation/             # Navegación
│       ├── templates/              # Plantillas (Smarty)
│       ├── web-services/           # Servicios web (NuSOAP)
│       └── php-utilities/          # Utilidades PHP (PEAR)
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
- `serializador-datos.php` → `data-serializer.php`
- `comando-web.php` → `web-command.php`
- `controlador-frontal.php` → `front-controller.php`
- `peticion-web.php` → `web-request.php`
- `registro-web-php5.php` → `web-registry-php5.php`
- `registro-web.php` → `web-registry.php`
- `sesion-web.php` → `web-session.php`
- `vista-plantilla.php` → `template-view.php`
- `vista-xsl.php` → `xsl-view.php`
- `admin-esquemas.php` → `schema-admin.php`
- `barra-progreso.php` → `progress-bar.php`
- `controlador-fechas.php` → `date-controller.php`
- `ejecutor-acciones.php` → `action-executor.php`
- `generador-html.php` → `html-generator.php`
- `servicio-agenda.php` → `agenda-service.php`
- `servicio-clientes.php` → `clients-service.php`
- `servicio-cross300.php` → `cross300-service.php`
- `servicio-documentos.php` → `documents-service.php`
- `servicio-flujo.php` → `workflow-service.php`
- `servicio-formularios.php` → `forms-service.php`
- `servicio-general.php` → `general-service.php`
- `servicio-perfiles.php` → `profiles-service.php`
- `servicio-productos.php` → `products-service.php`
- `servicio-rrhh.php` → `hr-service.php`
- `servidor-jsrs.php` → `jsrs-server.php`
- `tipo-datos.php` → `data-types.php`
- `validador-datos.php` → `data-validator.php`
- `verificador-paginas.php` → `page-verifier.php`
- `servicio-web-cross.php` → `cross-web-service.php`
- `servicio-web-perfiles.php` → `profiles-web-service.php`
- `aplicacion-principal.php` → `main-application.php`
- `sistema-asap.php` → `asap-system.php`
- `funcion-nombre-aplicacion.php` → `app-name-function.php`
- `funcion-nombre-app.php` → `app-name-func.php`

### Extensiones Normalizadas
- `.inc.php` → `.php`
- `.htm` → `.html`
- `.inc` → `.php`

## 🏗️ Librerías Incluidas

- **ADOdb**: Abstracción de base de datos
- **JPGraph**: Generación de gráficos
- **Smarty**: Motor de plantillas
- **NuSOAP**: Servicios web SOAP
- **PEAR**: Utilidades PHP
- **FPDF**: Generación de PDF
- **PHPExcel**: Exportación Excel

## 📝 Notas

- Todos los nombres de archivos y directorios ahora siguen convenciones modernas
- Las extensiones están normalizadas para mejor compatibilidad
- La estructura mantiene la funcionalidad original pero con mejor organización
- Los archivos legacy permanecen intactos en su funcionalidad

## 🔗 Integración

Este sistema legacy se integra con el nuevo sistema CROSS a través de:
- APIs de compatibilidad
- Migración gradual de módulos
- Mantenimiento de funcionalidades críticas