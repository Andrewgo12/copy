# 📋 MANUAL TÉCNICO AMPLIADO - FICHA DE CASO CROSS300
## PARTE 1: ARQUITECTURA Y RUTAS DEL SISTEMA

---

<div style="text-align: center; padding: 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 10px; margin: 20px 0;">

### 🏥 **HOSPITAL UNIVERSITARIO DEL VALLE**
### **"EVARISTO GARCÍA E.S.E."**

**SISTEMA CROSS300 - DOCUMENTACIÓN TÉCNICA COMPLETA**  
*Manual para Desarrolladores y Administradores del Sistema*

</div>

---

## 📁 **RUTAS COMPLETAS DE ESCRITORIO - COMPONENTES DEL SISTEMA**

### **🗂️ ESTRUCTURA DETALLADA DE CARPETAS Y ARCHIVOS**

#### **📍 RUTA BASE DEL PROYECTO:**
```
C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\
```

---

## 🎯 **COMPONENTES PRINCIPALES - ANÁLISIS TÉCNICO**

### **1. 📋 COMANDOS (CONTROLLERS)**

#### **📂 Ubicación:** `web\commands\`
```
C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\commands\
```

#### **📄 FeCrCmdDefaultFichas.class.php**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\commands\FeCrCmdDefaultFichas.class.php

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎯 CONTROLADOR PRINCIPAL DE FICHAS      │
├─────────────────────────────────────────┤
│ Clase: FeCrCmdDefaultFichas             │
│ Hereda de: Command (patrón MVC)         │
│ Método principal: execute()             │
│ Retorno: "success" (string)             │
│                                        │
│ RESPONSABILIDADES:                     │
│ • Inicializar vista de ficha           │
│ • Validar parámetros de entrada        │
│ • Establecer contexto de ejecución     │
│ • Retornar estado para el router       │
│                                        │
│ PARÁMETROS RECIBIDOS:                  │
│ • $_REQUEST["action"]                  │
│ • $_REQUEST["topFrame"]                │
│ • $_REQUEST["mainFrame"]               │
│ • $_REQUEST["ordenumerosFO"]           │
│                                        │
│ CONECTA CON:                          │
│ • WebRegistry (routing)                │
│ • Form_Fichas.tpl (vista)             │
│ • Sistema de autenticación             │
└─────────────────────────────────────────┘
```

#### **📄 FeCrCmdDefaultBodyFichaOrd.class.php**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\commands\FeCrCmdDefaultBodyFichaOrd.class.php

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎯 CONTROLADOR DEL CUERPO DE FICHA      │
├─────────────────────────────────────────┤
│ Clase: FeCrCmdDefaultBodyFichaOrd       │
│ Hereda de: Command                      │
│ Método principal: execute()             │
│ Retorno: "success" (string)             │
│                                        │
│ RESPONSABILIDADES:                     │
│ • Manejar frame principal              │
│ • Inicializar contenido de ficha       │
│ • Preparar contexto para plugins       │
│ • Gestionar parámetros del caso        │
│                                        │
│ VARIABLES IMPORTANTES:                 │
│ • $ordenumerosFO (número de caso)      │
│ • $vars (variables adicionales)        │
│                                        │
│ CONECTA CON:                          │
│ • Form_BodyFichaOrd.tpl               │
│ • function.viewfichaord.php           │
│ • Sistema de frames                    │
└─────────────────────────────────────────┘
```

#### **📄 FeCrCmdDefaultHeadRepoTiemposEjec.class.php**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\commands\FeCrCmdDefaultHeadRepoTiemposEjec.class.php

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎯 CONTROLADOR DE CABECERA              │
├─────────────────────────────────────────┤
│ Clase: FeCrCmdDefaultHeadRepoTiemposEjec│
│ Propósito: Frame superior (8%)          │
│ Contenido: Información contextual       │
│                                        │
│ RESPONSABILIDADES:                     │
│ • Mostrar datos básicos del caso       │
│ • Información de navegación            │
│ • Contexto temporal del caso           │
│ • Enlaces de navegación rápida         │
│                                        │
│ CONECTA CON:                          │
│ • Template de cabecera                 │
│ • Datos básicos de la orden            │
│ • Sistema de navegación                │
└─────────────────────────────────────────┘
```

---

### **2. 🎨 TEMPLATES (VISTAS)**

#### **📂 Ubicación:** `web\templates\`
```
C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\templates\
```

#### **📄 Form_Fichas.tpl**
```smarty
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\templates\Form_Fichas.tpl

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎨 TEMPLATE CONTENEDOR PRINCIPAL        │
├─────────────────────────────────────────┤
│ Motor: Smarty Template Engine           │
│ Tipo: Contenedor de frames              │
│ Estructura: HTML + Smarty tags         │
│                                        │
│ COMPONENTES SMARTY:                    │
│ • {head} - Cabecera HTML               │
│ • {appname} - Nombre de aplicación     │
│ • {frameficha} - Plugin de frames      │
│                                        │
│ ESTRUCTURA HTML:                       │
│ <html>                                 │
│   <head>                              │
│     <title>{appname}</title>          │
│   </head>                             │
│   {frameficha}                        │
│ </html>                               │
│                                        │
│ RESPONSABILIDADES:                     │
│ • Estructura base de la página         │
│ • Carga de metadatos                   │
│ • Inicialización de frames             │
│ • Configuración de viewport            │
│                                        │
│ CONECTA CON:                          │
│ • function.frameficha.php             │
│ • Archivos CSS del sistema            │
│ • JavaScript libraries                │
└─────────────────────────────────────────┘
```

#### **📄 Form_BodyFichaOrd.tpl**
```smarty
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\templates\Form_BodyFichaOrd.tpl

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎨 TEMPLATE DEL CUERPO PRINCIPAL        │
├─────────────────────────────────────────┤
│ Motor: Smarty Template Engine           │
│ Propósito: Contenido principal ficha    │
│ Estructura: HTML + Smarty plugins      │
│                                        │
│ COMPONENTES SMARTY:                    │
│ • {loadlabels} - Carga etiquetas i18n  │
│ • {head} - Cabecera específica         │
│ • {printtitle} - Título dinámico       │
│ • {putstyle} - Estilos CSS             │
│ • {putjsfiles} - Archivos JavaScript   │
│ • {body} - Cuerpo con eventos          │
│ • {form} - Formulario contenedor       │
│ • {infocompany} - Info del hospital    │
│ • {viewfichaord} - Plugin principal    │
│ • {droptmpfile} - Limpieza temporal    │
│                                        │
│ PARÁMETROS IMPORTANTES:                │
│ • table_name="FichaOrd"               │
│ • files[]="fncWindowOpen.js"          │
│ • name="frmFichaOrd"                  │
│ • method="post"                       │
│                                        │
│ ESTRUCTURA HTML:                       │
│ <html>                                 │
│   <head>...</head>                    │
│   <body>                              │
│     <form>                            │
│       <table>                         │
│         {viewfichaord}                │
│       </table>                        │
│     </form>                           │
│   </body>                             │
│ </html>                               │
│                                        │
│ CONECTA CON:                          │
│ • function.viewfichaord.php           │
│ • Archivos de idioma                  │
│ • fncWindowOpen.js                    │
│ • Estilos CSS del sistema             │
└─────────────────────────────────────────┘
```

---

### **3. 🔌 PLUGINS (LÓGICA DE NEGOCIO)**

#### **📂 Ubicación:** `web\plugins\`
```
C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\plugins\
```

#### **📄 function.frameficha.php**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\plugins\function.frameficha.php

ANÁLISIS TÉCNICO DETALLADO:
┌─────────────────────────────────────────┐
│ 🔌 PLUGIN GENERADOR DE FRAMES           │
├─────────────────────────────────────────┤
│ Función: smarty_function_frameficha()   │
│ Parámetros: $params, &$smarty          │
│ Tipo: Smarty Plugin Function           │
│ Propósito: Crear estructura de frames  │
│                                        │
│ LÓGICA DE FUNCIONAMIENTO:              │
│ 1. Extrae parámetros de $_REQUEST      │
│ 2. Procesa variable "vars"             │
│ 3. Construye URLs de frames            │
│ 4. Genera HTML de frameset             │
│                                        │
│ PARÁMETROS PROCESADOS:                 │
│ • $_REQUEST["topFrame"]                │
│ • $_REQUEST["mainFrame"]               │
│ • $_REQUEST["vars"]                    │
│ • Variables dinámicas del caso         │
│                                        │
│ PROCESAMIENTO DE VARIABLES:            │
│ if($_REQUEST["vars"]) {                │
│   $rcValores = explode(",",$_REQUEST["vars"]);│
│   foreach ($rcValores as $key => $valor) {   │
│     $rcValores[$key] = $valor."=".$_REQUEST[$valor];│
│   }                                    │
│   $sbCadena = "&".implode("&",$rcValores);   │
│ }                                      │
│                                        │
│ URLS GENERADAS:                        │
│ • $template1 = "index.php?action=".$_REQUEST["topFrame"]│
│ • $template3 = "index.php?action=".$_REQUEST["mainFrame"].$sbCadena│
│                                        │
│ HTML GENERADO:                         │
│ <frameset rows='8%,*' cols='*'         │
│           frameborder='NO' border='0'  │
│           framespacing='0'>            │
│   <frame src='$template1' name='topFrame'    │
│          scrolling='NO' noresize>     │
│   <frame src='$template3' name='mainFrame'   │
│          scrolling='AUTO'>            │
│ </frameset>                           │
│                                        │
│ RESPONSABILIDADES:                     │
│ • Dividir pantalla en 2 secciones     │
│ • Frame superior: 8% (cabecera)       │
│ • Frame principal: 92% (contenido)    │
│ • Pasar parámetros entre frames       │
│ • Configurar propiedades de scroll    │
│                                        │
│ CONECTA CON:                          │
│ • FeCrCmdDefaultHeadRepoTiemposEjec   │
│ • FeCrCmdDefaultBodyFichaOrd          │
│ • Sistema de parámetros URL           │
└─────────────────────────────────────────┘
```

#### **📄 function.viewfichaord.php** ⭐ **ARCHIVO PRINCIPAL**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\plugins\function.viewfichaord.php

ANÁLISIS TÉCNICO COMPLETO:
┌─────────────────────────────────────────┐
│ 🔌 PLUGIN PRINCIPAL - GENERADOR FICHA   │
├─────────────────────────────────────────┤
│ Función: smarty_function_viewfichaord() │
│ Líneas de código: 1000+                │
│ Consultas BD: 31+                      │
│ Complejidad: ALTA                      │
│                                        │
│ ESTRUCTURA DEL CÓDIGO:                 │
│ ├── Validación de parámetros           │
│ ├── Carga de configuración idioma      │
│ ├── Consultas a base de datos          │
│ ├── Procesamiento de datos             │
│ ├── Generación de HTML                 │
│ └── Funciones auxiliares               │
│                                        │
│ VARIABLES PRINCIPALES:                 │
│ • $orden__ordenumeros (ID del caso)    │
│ • $rcDataOrden (datos principales)     │
│ • $rcData (info usuario/empresa)       │
│ • $rcActas (tareas del caso)           │
│ • $rcAtenc (atenciones detalladas)     │
│ • $rcTranferencias (movimientos)       │
│ • $rcActividades (actividades)         │
│ • $rcCompromisos (compromisos)         │
│ • $rcHtml (HTML generado)              │
│                                        │
│ GATEWAYS UTILIZADOS:                   │
│ • Application::getDataGateway("orden") │
│ • Application::getDataGateway("OrdenempresaExtended")│
│ • Application::getDataGateway("SqlExtended")│
│ • Application::getDataGateway("actaempresa")│
│ • Application::loadServices('General') │
│                                        │
│ SERVICIOS CARGADOS:                    │
│ • DateController (formateo fechas)     │
│ • Html (generación de cards)           │
│ • General (constantes y parámetros)   │
│ • DimensionManager (datos dinámicos)   │
│                                        │
│ FUNCIONES AUXILIARES:                  │
│ • paintCasesFiles() - Anexos del caso │
│ • paintAttentionFiles() - Anexos atención│
│ • getDataAdicionalActa() - Datos dinámicos│
│ • getFichaDataAdicionalActa() - Ficha datos│
│ • changeDesc() - Cambio descriptores  │
│ • getDescLang() - Descriptores idioma  │
└─────────────────────────────────────────┘

FLUJO DE EJECUCIÓN DETALLADO:
┌─────────────────────────────────────────┐
│ 🔄 SECUENCIA DE PROCESAMIENTO           │
├─────────────────────────────────────────┤
│ 1. VALIDACIÓN INICIAL                  │
│    • Verificar $ordenumerosFO          │
│    • Cargar parámetros de usuario      │
│    • Incluir archivos de idioma        │
│                                        │
│ 2. CONSULTA DATOS PRINCIPALES          │
│    • SQL 1: getByIdOrden()             │
│    • Validar existencia del caso       │
│    • Mostrar error si no existe        │
│                                        │
│ 3. CONSULTA DATOS EMPRESA              │
│    • SQL 2-6: getByIdOrdenempresajoin()│
│    • SQL 7-18: getByOrdenOrdenempresa()│
│    • Obtener grupo de interés          │
│                                        │
│ 4. PROCESAMIENTO DIMENSIONES           │
│    • SQL 19-20: DimensionManager       │
│    • Obtener datos dinámicos           │
│    • Procesar campos adicionales       │
│                                        │
│ 5. GENERACIÓN CARD PRINCIPAL           │
│    • Formatear datos básicos           │
│    • Aplicar descriptores de idioma    │
│    • Generar HTML con htmlService      │
│                                        │
│ 6. PROCESAMIENTO ANEXOS CASO           │
│    • SQL 26: paintCasesFiles()         │
│    • Generar enlaces de descarga       │
│                                        │
│ 7. CONSULTA ACTAS/TAREAS               │
│    • SQL 27: getActas()                │
│    • Procesar cada acta encontrada     │
│                                        │
│ 8. PROCESAMIENTO POR ACTA              │
│    Para cada acta:                     │
│    • SQL 28-29: changeDesc()          │
│    • Formatear fechas                  │
│    • Generar card de tarea             │
│                                        │
│ 9. CONSULTA TRANSFERENCIAS             │
│    • SQL 30: getTranfertarea()         │
│    • Generar tabla de transferencias   │
│                                        │
│ 10. CONSULTA ATENCIONES                │
│     • SQL 31: getListActaempresa()     │
│     • Procesar cada atención           │
│                                        │
│ 11. PROCESAMIENTO POR ATENCIÓN         │
│     Para cada atención:                │
│     • Obtener datos adicionales       │
│     • Formatear personal responsable   │
│     • Generar observaciones            │
│                                        │
│ 12. CONSULTA ACTIVIDADES               │
│     • getActiviactaByAcem()            │
│     • Generar tabla de actividades    │
│                                        │
│ 13. CONSULTA COMPROMISOS               │
│     • getAcemcompromiByAcem()          │
│     • Generar tabla de compromisos    │
│                                        │
│ 14. ANEXOS DE ATENCIÓN                 │
│     • paintAttentionFiles()           │
│     • Enlaces de descarga específicos │
│                                        │
│ 15. COMPILACIÓN FINAL                  │
│     • Unir todos los HTML generados    │
│     • return implode("\n", $rcHtml)   │
└─────────────────────────────────────────┘
```

---

### **4. ⚙️ CONFIGURACIÓN**

#### **📂 Ubicación:** `config\`
```
C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\
```

#### **📄 config.inc.php**
```php
Ruta Completa: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\config.inc.php

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ ⚙️ ARCHIVO DE CONFIGURACIÓN PRINCIPAL   │
├─────────────────────────────────────────┤
│ Propósito: Configuración standalone    │
│ Tipo: Configuración freestanding       │
│                                        │
│ VARIABLES DEFINIDAS:                   │
│ • $asap_dir - Directorio raíz ASAP     │
│ • $app_dir - Directorio aplicación     │
│ • $app_name - Nombre aplicación        │
│                                        │
│ CÁLCULO DE RUTAS:                      │
│ $asap_dir = dirname(__FILE__).'/../../..';│
│ $app_dir = dirname(dirname(__FILE__)); │
│ $app_name = basename(dirname(dirname(__FILE__)));│
│                                        │
│ CONFIGURACIÓN INCLUDE_PATH:            │
│ $include_path = ini_get("include_path");│
│ $include_path .= (substr(php_uname(), 0, 3) == "Win") ? ";" : ":";│
│ $include_path .= $asap_dir."/system/classes";│
│ ini_set("include_path", $include_path);│
│                                        │
│ INICIALIZACIÓN:                        │
│ require_once ("Application.class.php");│
│ $app= new Application ($app_name, $app_dir);│
│                                        │
│ RESPONSABILIDADES:                     │
│ • Configurar rutas del sistema         │
│ • Establecer include_path              │
│ • Inicializar clase Application        │
│ • Configurar entorno de ejecución      │
└─────────────────────────────────────────┘
```