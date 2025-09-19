# 📋 MANUAL TÉCNICO AMPLIADO - FICHA DE CASO CROSS300
## PARTE 3: COMPONENTES ADICIONALES Y FLUJOS AVANZADOS

---

## 🎨 **RECURSOS FRONTEND - ANÁLISIS DETALLADO**

### **📂 Archivos CSS - Estilos del Sistema**
```
Ruta Base: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\css\
```

#### **📄 estilos.css - Hoja de Estilos Principal**
```css
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\css\estilos.css

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎨 HOJA DE ESTILOS PRINCIPAL            │
├─────────────────────────────────────────┤
│ Propósito: Estilos para ficha de caso   │
│ Compatibilidad: IE6+, Firefox, Chrome   │
│                                        │
│ CLASES PRINCIPALES:                    │
│ .piedefoto {                           │
│   font-family: Verdana, Arial;        │
│   font-size: 11px;                    │
│   color: #333333;                     │
│   background-color: #FFFFFF;          │
│   padding: 5px;                       │
│   border: 1px solid #CCCCCC;          │
│ }                                      │
│                                        │
│ .titulofila {                          │
│   font-family: Verdana, Arial;        │
│   font-size: 11px;                    │
│   font-weight: bold;                  │
│   color: #FFFFFF;                     │
│   background-color: #4682B4;          │
│   padding: 8px;                       │
│   text-align: center;                 │
│   border: 1px solid #336699;          │
│ }                                      │
│                                        │
│ .label {                               │
│   font-family: Verdana, Arial;        │
│   font-size: 11px;                    │
│   font-weight: bold;                  │
│   color: #000080;                     │
│   background-color: #F0F8FF;          │
│   padding: 5px;                       │
│   text-align: right;                  │
│   vertical-align: top;                │
│   border: 1px solid #DDDDDD;          │
│ }                                      │
│                                        │
│ .data {                                │
│   font-family: Verdana, Arial;        │
│   font-size: 11px;                    │
│   color: #333333;                     │
│   background-color: #FFFFFF;          │
│   padding: 5px;                       │
│   vertical-align: top;                │
│   border: 1px solid #DDDDDD;          │
│ }                                      │
│                                        │
│ USO EN LA FICHA:                       │
│ • .piedefoto - Contenedor general      │
│ • .titulofila - Cabeceras de sección   │
│ • .label - Etiquetas de campos         │
│ • .data - Valores de campos            │
└─────────────────────────────────────────┘
```

#### **📄 estilocvc.css - Estilos Específicos CVC**
```css
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\css\estilocvc.css

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎨 ESTILOS ESPECÍFICOS HOSPITAL         │
├─────────────────────────────────────────┤
│ Propósito: Personalización HUV          │
│ Colores institucionales del hospital    │
│                                        │
│ PALETA DE COLORES HUV:                 │
│ • Azul principal: #003366              │
│ • Azul secundario: #4682B4             │
│ • Verde institucional: #006633         │
│ • Gris texto: #333333                  │
│ • Fondo claro: #F8F9FA                 │
│                                        │
│ ESTILOS ESPECÍFICOS:                   │
│ .header-huv {                          │
│   background: linear-gradient(         │
│     135deg, #003366 0%, #4682B4 100%  │
│   );                                   │
│   color: white;                        │
│   padding: 15px;                       │
│   text-align: center;                  │
│   font-weight: bold;                   │
│ }                                      │
│                                        │
│ .info-hospital {                       │
│   background-color: #F0F8FF;          │
│   border-left: 4px solid #003366;     │
│   padding: 10px;                       │
│   margin: 10px 0;                      │
│ }                                      │
│                                        │
│ .estado-caso {                         │
│   padding: 5px 10px;                   │
│   border-radius: 15px;                 │
│   font-weight: bold;                   │
│   text-align: center;                  │
│ }                                      │
│                                        │
│ .estado-finalizado {                   │
│   background-color: #28a745;          │
│   color: white;                        │
│ }                                      │
│                                        │
│ .estado-proceso {                      │
│   background-color: #ffc107;          │
│   color: #212529;                      │
│ }                                      │
│                                        │
│ .estado-pendiente {                    │
│   background-color: #dc3545;          │
│   color: white;                        │
│ }                                      │
└─────────────────────────────────────────┘
```

---

### **📂 Archivos JavaScript - Funcionalidad Interactiva**
```
Ruta Base: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\js\
```

#### **📄 fncWindowOpen.js - Gestión de Ventanas**
```javascript
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\js\fncWindowOpen.js

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ ⚡ SCRIPT DE GESTIÓN DE VENTANAS        │
├─────────────────────────────────────────┤
│ Propósito: Abrir ventanas popup         │
│ Uso principal: Descarga de archivos     │
│                                        │
│ FUNCIÓN PRINCIPAL:                     │
│ function fncopenwindows(action, params) {│
│   var url = 'index.php?action=' + action;│
│   if (params) {                        │
│     url += '&' + params;               │
│   }                                    │
│   var windowFeatures = 'width=800,height=600,'+│
│     'scrollbars=yes,resizable=yes,'+   │
│     'menubar=no,toolbar=no,'+          │
│     'location=no,status=no';           │
│   window.open(url, 'popup', windowFeatures);│
│ }                                      │
│                                        │
│ PARÁMETROS DE VENTANA:                 │
│ • width: 800px                         │
│ • height: 600px                        │
│ • scrollbars: Sí                       │
│ • resizable: Sí                        │
│ • menubar: No                          │
│ • toolbar: No                          │
│ • location: No                         │
│ • status: No                           │
│                                        │
│ USO EN LA FICHA:                       │
│ onclick="fncopenwindows(               │
│   'FeCrCmdDefaultDownloadFile',        │
│   'archcodigon=123'                    │
│ )"                                     │
│                                        │
│ CASOS DE USO:                          │
│ • Descarga de anexos del caso          │
│ • Descarga de anexos de atención       │
│ • Visualización de documentos PDF      │
│ • Reportes en ventana separada         │
└─────────────────────────────────────────┘
```

#### **📄 jsOrden.js - Funciones Específicas de Órdenes**
```javascript
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\js\jsOrden.js

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ ⚡ SCRIPT ESPECÍFICO DE ÓRDENES         │
├─────────────────────────────────────────┤
│ Propósito: Funcionalidad de casos       │
│ Integración con ficha de caso           │
│                                        │
│ FUNCIONES PRINCIPALES:                 │
│                                        │
│ function validarCaso() {               │
│   // Validación de datos del caso     │
│   var numero = document.getElementById('ordenumeros').value;│
│   if (!numero || numero.length < 8) { │
│     alert('Número de caso inválido'); │
│     return false;                      │
│   }                                    │
│   return true;                         │
│ }                                      │
│                                        │
│ function buscarCaso(numero) {          │
│   // Búsqueda AJAX de caso             │
│   var xhr = new XMLHttpRequest();     │
│   xhr.open('GET', 'index.php?action=BuscarCaso&numero=' + numero);│
│   xhr.onreadystatechange = function() {│
│     if (xhr.readyState === 4 && xhr.status === 200) {│
│       mostrarResultado(xhr.responseText);│
│     }                                  │
│   };                                   │
│   xhr.send();                          │
│ }                                      │
│                                        │
│ function mostrarResultado(data) {      │
│   // Mostrar resultado de búsqueda     │
│   var resultado = JSON.parse(data);   │
│   if (resultado.encontrado) {         │
│     window.location.href = 'index.php?action=FeCrCmdDefaultFichas&ordenumerosFO=' + resultado.numero;│
│   } else {                             │
│     alert('Caso no encontrado');      │
│   }                                    │
│ }                                      │
│                                        │
│ function imprimirFicha() {             │
│   // Imprimir ficha de caso            │
│   window.print();                      │
│ }                                      │
│                                        │
│ function exportarPDF() {               │
│   // Exportar ficha a PDF              │
│   fncopenwindows(                      │
│     'FeCrCmdExportPDF',               │
│     'ordenumerosFO=' + getNumeroOrden()│
│   );                                   │
│ }                                      │
│                                        │
│ EVENTOS CONFIGURADOS:                  │
│ • onload - Inicialización              │
│ • onclick - Botones de acción          │
│ • onchange - Campos de formulario      │
│ • onsubmit - Validación de envío       │
└─────────────────────────────────────────┘
```

---

### **📂 Imágenes y Recursos Gráficos**
```
Ruta Base: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\web\images\
```

#### **📁 Iconos de Navegación**
```
📁 images/
├── 📄 actualizar_002.gif - Icono actualizar
├── 📄 borrar.gif - Icono eliminar
├── 📄 calendar.gif - Icono calendario
├── 📄 consultar_002.gif - Icono consultar
├── 📄 crear.gif - Icono crear nuevo
├── 📄 editar.gif - Icono editar
├── 📄 formulario.gif - Icono formulario
├── 📄 generar_excel.gif - Icono Excel
├── 📄 ico_doc.gif - Icono documento
├── 📄 imprimir.gif - Icono imprimir
├── 📄 menu.gif - Icono menú
├── 📄 PDF.gif - Icono PDF
├── 📄 positivo_002.gif - Icono éxito
├── 📄 referencia.gif - Icono referencia
├── 📄 zoomprev.gif - Icono zoom
├── 📄 es.jpg - Bandera español
├── 📄 en.jpg - Bandera inglés
└── 📁 pager/
    ├── 📄 derecha.gif - Flecha derecha
    ├── 📄 derechafin.gif - Última página
    ├── 📄 izquierda.gif - Flecha izquierda
    └── 📄 izquierdaini.gif - Primera página

USO EN LA FICHA:
• Botones de navegación entre casos
• Iconos de estado del caso
• Indicadores de tipo de documento
• Elementos de paginación
• Banderas para cambio de idioma
```

---

## 🔄 **FLUJOS DE DATOS AVANZADOS**

### **📊 Procesamiento de Datos Dinámicos**
```php
FLUJO COMPLETO DE DATOS DINÁMICOS:

1. CONFIGURACIÓN DE DIMENSIONES
┌─────────────────────────────────────────┐
│ Tabla: dimension                        │
│ • dimenombres - Nombre dimensión        │
│ • dimecampos - Campo clave              │
│ • dimevalores - Valor del campo         │
│ • dimeactivas - Estado activo           │
└─────────────────────────────────────────┘

2. DETALLE DE DIMENSIONES
┌─────────────────────────────────────────┐
│ Tabla: detadimension                    │
│ • dedinombres - Nombre del campo        │
│ • dediformatos - Tipo de dato           │
│ • dedilongituds - Longitud máxima       │
│ • dediobligats - Campo obligatorio      │
│ • dediordenes - Orden de presentación   │
│ • dedietiquetas - Etiqueta a mostrar    │
└─────────────────────────────────────────┘

3. PROCESAMIENTO EN DimensionManager
┌─────────────────────────────────────────┐
│ PASO 1: Consultar configuración        │
│ SELECT * FROM detadimension             │
│ WHERE dimenombres = 'proceso'           │
│   AND dimecampos = 'proccodigos'        │
│   AND dimevalores = $proccodigos        │
│                                        │
│ PASO 2: Crear tabla temporal           │
│ CREATE TEMP TABLE tmp_dim_$id (         │
│   campo1 VARCHAR(255),                  │
│   campo2 DATE,                          │
│   campo3 INTEGER                        │
│ )                                       │
│                                        │
│ PASO 3: Insertar datos                 │
│ INSERT INTO tmp_dim_$id                 │
│ SELECT campo1, campo2, campo3           │
│ FROM tabla_origen                       │
│ WHERE codigo_entidad = $codigo          │
│                                        │
│ PASO 4: Consultar datos finales        │
│ SELECT * FROM tmp_dim_$id               │
│ WHERE condiciones_adicionales           │
└─────────────────────────────────────────┘

4. INTEGRACIÓN EN LA FICHA
┌─────────────────────────────────────────┐
│ • Los datos dinámicos se muestran       │
│   como campos adicionales               │
│ • Se formatean según el tipo de dato    │
│ • Se aplican las etiquetas configuradas │
│ • Se validan según las reglas definidas │
└─────────────────────────────────────────┘
```

### **📎 Gestión Avanzada de Archivos**
```php
FLUJO COMPLETO DE GESTIÓN DE ARCHIVOS:

1. CARGA DE ARCHIVO
┌─────────────────────────────────────────┐
│ PROCESO DE UPLOAD:                      │
│ • Validación de tipo MIME              │
│ • Verificación de tamaño máximo         │
│ • Generación de nombre único            │
│ • Almacenamiento en directorio seguro   │
│ • Registro en base de datos             │
└─────────────────────────────────────────┘

2. REGISTRO EN BASE DE DATOS
┌─────────────────────────────────────────┐
│ INSERT INTO archivos (                  │
│   archnombres,     -- Nombre original   │
│   archrutas,       -- Ruta física       │
│   archtamanios,    -- Tamaño en bytes   │
│   archtipos,       -- Tipo MIME         │
│   archtipoents,    -- Tipo entidad      │
│   archcodigoents,  -- Código entidad    │
│   archfecregn,     -- Fecha registro    │
│   archusuregn,     -- Usuario registro  │
│   archactivos      -- Estado activo     │
│ ) VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, 'S')│
└─────────────────────────────────────────┘

3. CONSULTA PARA MOSTRAR
┌─────────────────────────────────────────┐
│ function paintCasesFiles():             │
│ • Consulta archivos por tipo y código   │
│ • Genera enlaces de descarga            │
│ • Aplica permisos de acceso             │
│ • Formatea nombres para mostrar         │
│                                        │
│ function paintAttentionFiles():         │
│ • Similar a paintCasesFiles             │
│ • Específico para archivos de atención  │
│ • Agrupa por número de atención         │
└─────────────────────────────────────────┘

4. DESCARGA SEGURA
┌─────────────────────────────────────────┐
│ FeCrCmdDefaultDownloadFile:             │
│ • Validar permisos del usuario          │
│ • Verificar existencia del archivo      │
│ • Establecer headers HTTP correctos     │
│ • Enviar archivo al navegador           │
│ • Registrar descarga en log             │
└─────────────────────────────────────────┘
```

---

## 🔐 **SISTEMA DE SEGURIDAD AVANZADO**

### **🛡️ Validación de Sesiones**
```php
FLUJO DE VALIDACIÓN DE SEGURIDAD:

1. VALIDACIÓN EN FrontController
┌─────────────────────────────────────────┐
│ if(($action_name != WebRegistry::getDefaultAction()) && │
│    (strpos($action_name, "CmdLogin")===false)) {       │
│   if((!array_key_exists("username",$_REQUEST) &&       │
│       !array_key_exists("context",$_REQUEST))) {       │
│     $user = Application::getUserParam();               │
│     if(!is_array($user) || !$user) {                  │
│       $action_name = "CmdExit";                        │
│       $_REQUEST["cod_message"] = 102;                  │
│     }                                                  │
│   }                                                    │
│ }                                                      │
└─────────────────────────────────────────┘

2. VALIDACIÓN DE PERFILES
┌─────────────────────────────────────────┐
│ $security = Application::validateProfiles($action_name);│
│ if($security == false) {                               │
│   $action_name = "CmdExit";                           │
│   $_REQUEST["cod_message"] = 103;                     │
│ }                                                      │
└─────────────────────────────────────────┘

3. ESTRUCTURA DE USUARIO EN SESIÓN
┌─────────────────────────────────────────┐
│ $_SESSION['user'] = array(              │
│   'username' => 'usuario123',           │
│   'nombre' => 'Juan Pérez',             │
│   'perfil' => 'ADMIN_PQRSF',           │
│   'dependencia' => 'PQRSF',            │
│   'permisos' => array(                  │
│     'VER_FICHAS' => true,              │
│     'EDITAR_CASOS' => true,            │
│     'DESCARGAR_ARCHIVOS' => true,      │
│     'GENERAR_REPORTES' => false        │
│   ),                                   │
│   'lang' => 'es',                      │
│   'fecha_login' => '2024-12-09 08:30:00',│
│   'ip_address' => '192.168.1.100'      │
│ )                                       │
└─────────────────────────────────────────┘
```

### **🔍 Sistema de Auditoría**
```php
REGISTRO DE AUDITORÍA:

1. CLASE ProvitionalLog
┌─────────────────────────────────────────┐
│ class ProvitionalLog {                  │
│   const FILE_ROUTE = "/var/www/html/provitional_log.txt";│
│                                        │
│   public static function write_log($message) {          │
│     $file = fopen(ProvitionalLog::FILE_ROUTE, "a");    │
│     fwrite($file, time()." ".$message."\n");           │
│     fclose($file);                                     │
│   }                                                    │
│ }                                                      │
└─────────────────────────────────────────┘

2. PUNTOS DE AUDITORÍA
┌─────────────────────────────────────────┐
│ • Inicio de comando                     │
│   ProvitionalLog::write_log(print_r($command, true));  │
│                                        │
│ • Resultado de ejecución                │
│   ProvitionalLog::write_log(print_r($result, true));   │
│                                        │
│ • Vista seleccionada                    │
│   ProvitionalLog::write_log(print_r($view_name, true));│
│                                        │
│ • Vista cargada                         │
│   ProvitionalLog::write_log(print_r($view, true));     │
└─────────────────────────────────────────┘

3. FORMATO DE LOG
┌─────────────────────────────────────────┐
│ 1733742123 Command: FeCrCmdDefaultFichas│
│ 1733742123 Parameters: array(          │
│   'action' => 'FeCrCmdDefaultFichas',   │
│   'ordenumerosFO' => '1061242025',      │
│   'topFrame' => 'FeCrCmdDefaultHeadRepoTiemposEjec',│
│   'mainFrame' => 'FeCrCmdDefaultBodyFichaOrd'       │
│ )                                       │
│ 1733742124 Result: success              │
│ 1733742124 View: Form_Fichas            │
│ 1733742125 Template loaded successfully │
└─────────────────────────────────────────┘
```

---

## 📈 **OPTIMIZACIÓN Y RENDIMIENTO**

### **⚡ Cache de Templates Smarty**
```php
SISTEMA DE CACHE SMARTY:

1. DIRECTORIO DE CACHE
┌─────────────────────────────────────────┐
│ Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\templates_c\│
│                                        │
│ ESTRUCTURA:                            │
│ templates_c/                           │
│ ├── es/                                │
│ │   ├── %%343/                         │
│ │   │   └── %%3437230710/              │
│ │   │       └── Form_Orden.tpl.php     │
│ │   └── %%423/                         │
│ │       └── %%4233011815/              │
│ │           └── Form_WebUser.tpl.php   │
│ └── en/                                │
│     └── [archivos compilados inglés]   │
└─────────────────────────────────────────┘

2. PROCESO DE COMPILACIÓN
┌─────────────────────────────────────────┐
│ PASO 1: Verificar cache existente      │
│ • Comparar fecha template vs compilado  │
│ • Si compilado es más nuevo, usar cache │
│                                        │
│ PASO 2: Compilar si es necesario       │
│ • Parsear template .tpl                │
│ • Convertir tags Smarty a PHP          │
│ • Generar archivo .php optimizado      │
│                                        │
│ PASO 3: Ejecutar template compilado    │
│ • Incluir archivo PHP generado         │
│ • Pasar variables al contexto          │
│ • Generar HTML final                   │
└─────────────────────────────────────────┘

3. EJEMPLO DE COMPILACIÓN
┌─────────────────────────────────────────┐
│ TEMPLATE ORIGINAL (Form_Fichas.tpl):   │
│ <html>                                 │
│ {head}                                 │
│   <title>{appname}</title>             │
│ {/head}                                │
│ {frameficha}                           │
│ </html>                                │
│                                        │
│ COMPILADO (%%343%%3437230710.php):     │
│ <html>                                 │
│ <?php echo $this->_tpl_vars['head']; ?>│
│   <title><?php echo $this->_tpl_vars['appname']; ?></title>│
│ <?php echo $this->_tpl_vars['head_close']; ?>              │
│ <?php echo smarty_function_frameficha(array(), $this); ?>  │
│ </html>                                │
└─────────────────────────────────────────┘
```

### **🗄️ Optimización de Consultas**
```sql
CONSULTAS OPTIMIZADAS:

1. ÍNDICES PRINCIPALES
┌─────────────────────────────────────────┐
│ CREATE INDEX idx_orden_numero           │
│ ON orden(ordenumeros);                  │
│                                        │
│ CREATE INDEX idx_ordenempresa_orden     │
│ ON ordenempresa(ordenumeros);           │
│                                        │
│ CREATE INDEX idx_actaempresa_orden      │
│ ON actaempresa(ordenumeros, actaactivas);│
│                                        │
│ CREATE INDEX idx_archivos_entidad       │
│ ON archivos(archtipoents, archcodigoents, archactivos);│
└─────────────────────────────────────────┘

2. CONSULTA OPTIMIZADA PRINCIPAL
┌─────────────────────────────────────────┐
│ EXPLAIN ANALYZE                         │
│ SELECT o.*, oe.*, l.locanombres, ...    │
│ FROM orden o                           │
│ LEFT JOIN ordenempresa oe USING(ordenumeros)│
│ LEFT JOIN localizacion l USING(locacodigos) │
│ WHERE o.ordenumeros = $1;              │
│                                        │
│ RESULTADO:                             │
│ Index Scan using idx_orden_numero      │
│ (cost=0.29..8.31 rows=1 width=500)    │
│ Execution time: 0.123 ms               │
└─────────────────────────────────────────┘

3. PAGINACIÓN EFICIENTE
┌─────────────────────────────────────────┐
│ SELECT COUNT(*) OVER() as total_rows,   │
│        o.ordenumeros, o.ordefecregn,    │
│        oe.oremnombres                   │
│ FROM orden o                           │
│ LEFT JOIN ordenempresa oe USING(ordenumeros)│
│ ORDER BY o.ordefecregn DESC            │
│ LIMIT $limit OFFSET $offset;           │
└─────────────────────────────────────────┘
```

---

## 🔧 **HERRAMIENTAS DE DESARROLLO Y DEBUGGING**

### **🐛 Sistema de Debug**
```php
CONFIGURACIÓN DE DEBUG:

1. ACTIVACIÓN DE DEBUG
┌─────────────────────────────────────────┐
│ // En config.inc.php                    │
│ define('DEBUG_MODE', true);             │
│ define('DEBUG_LEVEL', 3);               │
│ define('DEBUG_LOG_FILE', '/tmp/cross_debug.log');│
│                                        │
│ // Niveles de debug:                    │
│ // 1 = Errores críticos                │
│ // 2 = Advertencias                    │
│ // 3 = Información general             │
│ // 4 = Debug detallado                 │
└─────────────────────────────────────────┘

2. FUNCIÓN DE DEBUG
┌─────────────────────────────────────────┐
│ function debug_log($message, $level = 3) {│
│   if (DEBUG_MODE && $level <= DEBUG_LEVEL) {│
│     $timestamp = date('Y-m-d H:i:s');  │
│     $caller = debug_backtrace()[1];    │
│     $log_entry = sprintf(               │
│       "[%s] [%s:%d] %s\n",            │
│       $timestamp,                      │
│       basename($caller['file']),       │
│       $caller['line'],                 │
│       $message                         │
│     );                                 │
│     file_put_contents(DEBUG_LOG_FILE, $log_entry, FILE_APPEND);│
│   }                                    │
│ }                                      │
└─────────────────────────────────────────┘

3. USO EN EL CÓDIGO
┌─────────────────────────────────────────┐
│ // En function.viewfichaord.php         │
│ debug_log("Iniciando generación de ficha para caso: $orden__ordenumeros", 3);│
│                                        │
│ $rcDataOrden = $gateway->getByIdOrden($orden__ordenumeros);│
│ debug_log("Datos obtenidos: " . print_r($rcDataOrden, true), 4);│
│                                        │
│ if (!is_array($rcDataOrden)) {         │
│   debug_log("Error: Caso no encontrado: $orden__ordenumeros", 1);│
│   return null;                         │
│ }                                      │
└─────────────────────────────────────────┘
```

---

**📅 Documento Actualizado:** Diciembre 2024  
**🔧 Sistema:** CROSS300 v3.0 - Documentación Técnica Completa  
**🏥 Institución:** Hospital Universitario del Valle "Evaristo García E.S.E."  
**📍 Ubicación:** Cali, Valle del Cauca, Colombia