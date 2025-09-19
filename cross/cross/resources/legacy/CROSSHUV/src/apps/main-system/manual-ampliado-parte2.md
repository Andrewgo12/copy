# 📋 MANUAL TÉCNICO AMPLIADO - FICHA DE CASO CROSS300
## PARTE 2: BACKEND Y BASE DE DATOS DETALLADO

---

## 🗄️ **ARQUITECTURA DE BASE DE DATOS - ANÁLISIS COMPLETO**

### **🔗 CONEXIONES Y GATEWAYS DEL BACKEND**

#### **📊 GATEWAY PRINCIPAL - OrdenempresaExtended**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\data\Pgsql\FeCrPgsqlOrdenempresaExtended.class.php

ANÁLISIS TÉCNICO DETALLADO:
┌─────────────────────────────────────────┐
│ 🗄️ GATEWAY ORDENEMPRESA EXTENDIDO       │
├─────────────────────────────────────────┤
│ Clase: FeCrPgsqlOrdenempresaExtended    │
│ Hereda de: FeCrPgsqlOrdenempresa        │
│ Propósito: Consultas complejas con JOIN │
│                                        │
│ MÉTODOS PRINCIPALES:                   │
│ • getByIdOrdenempresajoin()            │
│ • getByOrdenOrdenempresa()             │
│ • getDataFichaAdicional()              │
│ • getDataAdicionalActa()               │
│ • getReqByGrupoInteres()               │
│                                        │
│ CONSULTA PRINCIPAL (getByIdOrdenempresajoin):│
│ SELECT o.ordenumeros, o.ordefecregn,   │
│        o.ordefecdigtn, o.ordefecvenn,  │
│        o.ordefecfinn, o.ordeobservs,   │
│        oe.oremradicas, oe.oremtipoids, │
│        oe.oremnombres, oe.oremapell1s, │
│        oe.oremapell2s, oe.oremdireccis,│
│        oe.oremtelefonos, oe.oremcelulars,│
│        l.locanombres, ac.areacausnombres,│
│        gi.grinnombres, p.prionombres,   │
│        mr.merenombres, to.tiornombres,  │
│        e.evennombres, c.causnombres     │
│ FROM orden o                           │
│ LEFT JOIN ordenempresa oe ON o.ordenumeros = oe.ordenumeros│
│ LEFT JOIN localizacion l ON oe.locacodigos = l.locacodigos│
│ LEFT JOIN areacausante ac ON oe.areacauscodigos = ac.areacauscodigos│
│ LEFT JOIN gruposinteres gi ON oe.grincodigos = gi.grincodigos│
│ LEFT JOIN prioridad p ON o.priocodigos = p.priocodigos│
│ LEFT JOIN mediorecepcion mr ON o.merecodigos = mr.merecodigos│
│ LEFT JOIN tipoorden to ON o.tiorcodigos = to.tiorcodigos│
│ LEFT JOIN evento e ON o.evencodigos = e.evencodigos│
│ LEFT JOIN causa c ON o.causcodigos = c.causcodigos│
│ WHERE o.ordenumeros = $ordenumeros     │
│                                        │
│ DATOS OBTENIDOS:                       │
│ • Información básica del caso          │
│ • Datos del reportante/paciente        │
│ • Localización geográfica              │
│ • Área causante del problema           │
│ • Grupo de interés (EPS/ARS)          │
│ • Prioridad asignada                   │
│ • Medio de recepción                   │
│ • Tipo de orden/caso                   │
│ • Evento relacionado                   │
│ • Causa específica                     │
└─────────────────────────────────────────┘
```

#### **📋 GATEWAY ACTAS - SqlExtended**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\data\Pgsql\FeCrPgsqlSqlExtended.class.php

ANÁLISIS TÉCNICO DETALLADO:
┌─────────────────────────────────────────┐
│ 🗄️ GATEWAY SQL EXTENDIDO               │
├─────────────────────────────────────────┤
│ Clase: FeCrPgsqlSqlExtended             │
│ Propósito: Consultas complejas múltiples│
│                                        │
│ MÉTODO: getActas($ordenumeros)          │
│ CONSULTA SQL:                          │
│ SELECT a.actacodigos, a.tarecodigos,   │
│        a.actafechingn, a.actafechinin, │
│        a.actafechvenn, a.actaestacts,  │
│        a.actaactivas, a.ordenumeros,   │
│        t.tarenombres, t.taredescris,   │
│        ea.esacnombres as estadoacta    │
│ FROM actaempresa a                     │
│ INNER JOIN tarea t ON a.tarecodigos = t.tarecodigos│
│ LEFT JOIN estadoacta ea ON a.actaestacts = ea.esaccodigos│
│ WHERE a.ordenumeros = $ordenumeros     │
│   AND a.actaactivas = 'S'             │
│ ORDER BY a.actafechingn ASC            │
│                                        │
│ MÉTODO: getTranfertarea($actacodigos)   │
│ CONSULTA SQL:                          │
│ SELECT tt.trtacodigos, tt.actacodigos, │
│        tt.orgacodigosorig, tt.orgacodigosdest,│
│        tt.trtafecingn, tt.trtafechan,  │
│        tt.trtaobservas, tt.trtaactivas,│
│        o1.organombres as origen,       │
│        o2.organombres as destino       │
│ FROM transfertarea tt                  │
│ LEFT JOIN organizacion o1 ON tt.orgacodigosorig = o1.orgacodigos│
│ LEFT JOIN organizacion o2 ON tt.orgacodigosdest = o2.orgacodigos│
│ WHERE tt.actacodigos = $actacodigos    │
│   AND tt.trtaactivas = 'S'            │
│ ORDER BY tt.trtafecingn ASC            │
│                                        │
│ MÉTODO: getListActaempresa($actacodigos)│
│ CONSULTA SQL:                          │
│ SELECT ae.acemnumeros, ae.actacodigos, │
│        ae.acemfecregn, ae.acemfecaten, │
│        ae.acemhorinin, ae.acemhorfinn, │
│        ae.acemobservas, ae.acemradicas,│
│        ae.esaccodigos, ea.esacnombres, │
│        o.organombres as dependencia    │
│ FROM actaempresa ae                    │
│ LEFT JOIN estadoacta ea ON ae.esaccodigos = ea.esaccodigos│
│ LEFT JOIN organizacion o ON ae.orgacodigos = o.orgacodigos│
│ WHERE ae.actacodigos = $actacodigos    │
│   AND ae.acemactivas = 'S'            │
│ ORDER BY ae.acemfecregn ASC            │
│                                        │
│ MÉTODO: getActiviactaByAcem($acemnumeros)│
│ CONSULTA SQL:                          │
│ SELECT aa.acticodigos, aa.acemnumeros, │
│        aa.acivfecregn, aa.acivactivas, │
│        a.actinombres, a.actidescris    │
│ FROM activiacta aa                     │
│ INNER JOIN actividad a ON aa.acticodigos = a.acticodigos│
│ WHERE aa.acemnumeros = $acemnumeros    │
│   AND aa.acivactivas = 'S'            │
│ ORDER BY aa.acivfecregn ASC            │
│                                        │
│ MÉTODO: getAcemcompromiByAcem($acemnumeros)│
│ CONSULTA SQL:                          │
│ SELECT ac.compcodigos, ac.acemnumeros, │
│        ac.accofecrevn, ac.accoactivas, │
│        c.compdescris, c.compobservs    │
│ FROM acemcompromiso ac                 │
│ INNER JOIN compromiso c ON ac.compcodigos = c.compcodigos│
│ WHERE ac.acemnumeros = $acemnumeros    │
│   AND ac.accoactivas IN ('S', 'A')    │
│ ORDER BY ac.accofecrevn ASC            │
└─────────────────────────────────────────┘
```

#### **📎 GATEWAY ARCHIVOS**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\system\classes\data\Pgsql\PgsqlArchivos.class.php

ANÁLISIS TÉCNICO DETALLADO:
┌─────────────────────────────────────────┐
│ 📎 GATEWAY GESTIÓN DE ARCHIVOS          │
├─────────────────────────────────────────┤
│ Clase: PgsqlArchivos                    │
│ Propósito: Manejo de documentos adjuntos│
│                                        │
│ MÉTODO: getDescArchivo($tipo, $codigo)  │
│ CONSULTA SQL:                          │
│ SELECT a.archcodigon, a.archnombres,   │
│        a.archrutas, a.archfecregn,     │
│        a.archtamanios, a.archtipos,    │
│        a.archdescris, a.archactivos    │
│ FROM archivos a                        │
│ WHERE a.archtipoents = $tipo           │
│   AND a.archcodigoents = $codigo       │
│   AND a.archactivos = 'S'             │
│ ORDER BY a.archfecregn DESC            │
│                                        │
│ TIPOS DE ARCHIVO:                      │
│ • 'anexo' - Archivos del caso          │
│ • 'atencion' - Archivos de atención    │
│ • 'solucion' - Archivos de solución    │
│ • 'compromiso' - Archivos de compromiso│
│                                        │
│ ESTRUCTURA TABLA ARCHIVOS:             │
│ • archcodigon (PK) - ID único          │
│ • archnombres - Nombre del archivo     │
│ • archrutas - Ruta física del archivo │
│ • archfecregn - Fecha de registro      │
│ • archtamanios - Tamaño en bytes       │
│ • archtipos - Tipo MIME               │
│ • archdescris - Descripción           │
│ • archtipoents - Tipo de entidad      │
│ • archcodigoents - Código de entidad  │
│ • archactivos - Estado activo         │
└─────────────────────────────────────────┘
```

---

## 🔄 **SERVICIOS Y MANAGERS DEL BACKEND**

### **📅 DateController Service**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\system\classes\services\DateController\

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 📅 SERVICIO DE CONTROL DE FECHAS        │
├─────────────────────────────────────────┤
│ Clase: DateController                   │
│ Propósito: Formateo y validación fechas │
│                                        │
│ MÉTODO PRINCIPAL:                      │
│ fncformatofechahora($fecha)            │
│                                        │
│ FUNCIONALIDADES:                       │
│ • Conversión de formatos de fecha      │
│ • Validación de fechas válidas         │
│ • Formateo según configuración local   │
│ • Manejo de zonas horarias             │
│                                        │
│ FORMATOS SOPORTADOS:                   │
│ • YYYY-MM-DD HH:MM:SS (BD)            │
│ • DD/MM/YYYY HH:MM:SS (Display)       │
│ • Timestamp Unix                       │
│ • Formato ISO 8601                     │
│                                        │
│ CONFIGURACIÓN:                         │
│ • Zona horaria: America/Bogota         │
│ • Idioma: Español                      │
│ • Formato 24 horas                     │
└─────────────────────────────────────────┘
```

### **🎨 HTML Service**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\system\classes\services\Html\

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🎨 SERVICIO DE GENERACIÓN HTML          │
├─────────────────────────────────────────┤
│ Clase: HtmlService                      │
│ Propósito: Generación de componentes HTML│
│                                        │
│ MÉTODO PRINCIPAL:                      │
│ genCard($data, $labels, $params)       │
│                                        │
│ PARÁMETROS DE CONFIGURACIÓN:           │
│ • $params["cols"] - Número de columnas │
│ • $params["size_table"] - Ancho tabla  │
│ • $params["size_label"] - Ancho etiqueta│
│ • $params["size_datos"] - Ancho datos  │
│ • $params["align"] - Alineación        │
│                                        │
│ ESTRUCTURA HTML GENERADA:              │
│ <table width="$size_table">            │
│   <tr>                                 │
│     <td class="label" width="$size_label">│
│       $label                           │
│     </td>                              │
│     <td width="5%">:</td>              │
│     <td width="$size_datos">           │
│       $data                            │
│     </td>                              │
│   </tr>                                │
│ </table>                               │
│                                        │
│ TIPOS DE CARDS:                        │
│ • Card de información básica           │
│ • Card de datos de usuario             │
│ • Card de atenciones                   │
│ • Card de transferencias               │
│ • Card de actividades                  │
└─────────────────────────────────────────┘
```

### **📊 DimensionManager**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\system\classes\services\General\DimensionManager.class.php

ANÁLISIS TÉCNICO DETALLADO:
┌─────────────────────────────────────────┐
│ 📊 MANAGER DE DIMENSIONES DINÁMICAS     │
├─────────────────────────────────────────┤
│ Clase: DimensionManager                 │
│ Propósito: Gestión de campos dinámicos  │
│                                        │
│ PROPIEDADES PRINCIPALES:               │
│ • $codidominios - Dominio principal    │
│ • $codidomicams - Campo clave          │
│ • $codidomivals - Valor del campo      │
│ • $vadidominios - Dominio de validación│
│ • $vadidomivals - Valor de validación  │
│ • $params - Parámetros adicionales     │
│ • $operation - Operación a realizar    │
│                                        │
│ MÉTODO PRINCIPAL:                      │
│ execute() - Ejecuta operación configurada│
│                                        │
│ OPERACIÓN: getValorDimension           │
│ 1. Consulta configuración de dimensiones│
│ 2. Crea tabla temporal con campos      │
│ 3. Ejecuta consulta de datos           │
│ 4. Retorna resultado y tabla temporal  │
│                                        │
│ CONSULTA DE CONFIGURACIÓN:             │
│ SELECT dd.dedinombres, dd.dediformatos,│
│        dd.dedilongituds, dd.dediobligats,│
│        dd.dediordenes, dd.dedietiquetas │
│ FROM detadimension dd                  │
│ WHERE dd.dimenombres = $codidominios   │
│   AND dd.dimecampos = $codidomicams    │
│   AND dd.dimevalores = $codidomivals   │
│ ORDER BY dd.dediordenes ASC            │
│                                        │
│ CREACIÓN TABLA TEMPORAL:               │
│ CREATE TEMP TABLE tmp_dimension_$id (  │
│   campo1 VARCHAR(255),                 │
│   campo2 DATE,                         │
│   campo3 INTEGER,                      │
│   ...                                  │
│ )                                      │
│                                        │
│ CONSULTA DE DATOS:                     │
│ SELECT * FROM tmp_dimension_$id        │
│ WHERE codigo_entidad = $vadidomivals   │
│                                        │
│ RESULTADOS:                            │
│ • $result - Boolean éxito/fallo       │
│ • $tmpTable - Nombre tabla temporal    │
│ • $detalleDimension - Config campos    │
└─────────────────────────────────────────┘
```

---

## 🌍 **SISTEMA DE INTERNACIONALIZACIÓN (i18n)**

### **📂 Estructura de Idiomas**
```
Ruta Base: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\language\

├── 📁 es/ (Español)
│   ├── 📄 es.fichaord.php
│   ├── 📄 es.messages.php
│   ├── 📄 es.generic.php
│   ├── 📄 es.orden.php
│   ├── 📄 es.solucion.php
│   ├── 📄 es.actaempresa.php
│   ├── 📄 es.compromiso.php
│   ├── 📄 es.anexos.php
│   └── 📄 es.webuser.php
│
└── 📁 en/ (English)
    ├── 📄 en.fichaord.php
    ├── 📄 en.messages.php
    ├── 📄 en.generic.php
    ├── 📄 en.orden.php
    ├── 📄 en.solucion.php
    ├── 📄 en.actaempresa.php
    ├── 📄 en.compromiso.php
    ├── 📄 en.anexos.php
    └── 📄 en.webuser.php
```

#### **📄 es.fichaord.php - Etiquetas Principales**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\language\es\es.fichaord.php

ESTRUCTURA DEL ARCHIVO:
┌─────────────────────────────────────────┐
│ 🌍 ARCHIVO DE ETIQUETAS ESPAÑOL         │
├─────────────────────────────────────────┤
│ Variable: $rclabels (array asociativo)  │
│ Propósito: Etiquetas de la ficha        │
│                                        │
│ ETIQUETAS PRINCIPALES:                 │
│ $rclabels["title"]["label"] = "Ficha de Caso";│
│ $rclabels["ordenumeros"]["label"] = "Número de Caso";│
│ $rclabels["ordefecregn"]["label"] = "Fecha de registro";│
│ $rclabels["ordefecdigtn"]["label"] = "Fecha de digitación";│
│ $rclabels["ordefecvenn"]["label"] = "Fecha de vencimiento";│
│ $rclabels["ordefecfinn"]["label"] = "Fecha de finalización";│
│ $rclabels["tiornombres"]["label"] = "Tipo de Caso";│
│ $rclabels["evennombres"]["label"] = "Clasificación";│
│ $rclabels["causnombres"]["label"] = "Subclasificación";│
│ $rclabels["merenombres"]["label"] = "Medio recepción";│
│                                        │
│ ETIQUETAS DE USUARIO:                  │
│ $rclabels["oremtipoids"]["label"] = "Tipo documento";│
│ $rclabels["oremradicas"]["label"] = "Número documento";│
│ $rclabels["oremnombres"]["label"] = "Nombres";│
│ $rclabels["oremapell1s"]["label"] = "Primer apellido";│
│ $rclabels["oremapell2s"]["label"] = "Segundo apellido";│
│ $rclabels["oremdireccis"]["label"] = "Dirección";│
│ $rclabels["oremtelefonos"]["label"] = "Teléfono";│
│ $rclabels["oremcelulars"]["label"] = "Celular";│
│                                        │
│ ETIQUETAS DE UBICACIÓN:                │
│ $rclabels["locanombres"]["label"] = "Localización";│
│ $rclabels["areacausnombres"]["label"] = "Área causante";│
│ $rclabels["grinnombres"]["label"] = "Grupo de interés";│
│ $rclabels["prionombres"]["label"] = "Prioridad";│
│                                        │
│ ETIQUETAS DE FLUJO:                    │
│ $rclabels["tareas"]["label"] = "Tarea";│
│ $rclabels["tarenombres"]["label"] = "Tarea";│
│ $rclabels["esacnombres"]["label"] = "Estado";│
│ $rclabels["actafechingn"]["label"] = "Fecha de ingreso";│
│ $rclabels["actafechinin"]["label"] = "Fecha de inicio";│
│ $rclabels["actafechvenn"]["label"] = "Fecha de vencimiento";│
│                                        │
│ ETIQUETAS DE ATENCIÓN:                 │
│ $rclabels["atenciones"]["label"] = "Atenciones";│
│ $rclabels["acemfecregn"]["label"] = "Registro";│
│ $rclabels["acemfecaten"]["label"] = "Atención";│
│ $rclabels["acemhorinin"]["label"] = "Hora inicial";│
│ $rclabels["acemhorfinn"]["label"] = "Hora final";│
│ $rclabels["organombres"]["label"] = "Dependencia";│
│ $rclabels["acemusuars"]["label"] = "Personal";│
│ $rclabels["acemobservas"]["label"] = "Observaciones";│
│                                        │
│ ETIQUETAS DE TRANSFERENCIA:            │
│ $rclabels["transferencia"]["label"] = "Transferencias";│
│ $rclabels["trtafecingn"]["label"] = "Fecha de ingreso";│
│ $rclabels["trtafechan"]["label"] = "Fecha de registro";│
│ $rclabels["trtaobservas"]["label"] = "Observaciones";│
│                                        │
│ ETIQUETAS DE ACTIVIDADES:              │
│ $rclabels["actividades"]["label"] = "Actividades";│
│ $rclabels["acticodigos"]["label"] = "Código";│
│ $rclabels["actinombres"]["label"] = "Actividad";│
│                                        │
│ ETIQUETAS DE COMPROMISOS:              │
│ $rclabels["compromisos"]["label"] = "Compromisos";│
│ $rclabels["compcodigo"]["label"] = "Código";│
│ $rclabels["compdescris"]["label"] = "Descripción";│
│ $rclabels["accofecrevn"]["label"] = "Fecha de revisión";│
│ $rclabels["accoactivas"]["label"] = "Estado";│
│                                        │
│ ETIQUETAS DE ANEXOS:                   │
│ $rclabels["anexos"]["label"] = "Anexos";│
│ $rclabels["anexos_at"]["label"] = "Anexos de la atención";│
│ $rclabels["files"]["label"] = "Archivos";│
│ $rclabels["descargar"]["label"] = "Descargar archivo";│
└─────────────────────────────────────────┘
```

#### **📄 es.messages.php - Mensajes del Sistema**
```php
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\language\es\es.messages.php

ESTRUCTURA DEL ARCHIVO:
┌─────────────────────────────────────────┐
│ 🌍 ARCHIVO DE MENSAJES ESPAÑOL          │
├─────────────────────────────────────────┤
│ Variable: $rcmessages (array numérico)  │
│ Propósito: Mensajes de error y éxito    │
│                                        │
│ MENSAJES PRINCIPALES:                  │
│ $rcmessages[21] = "No se encontró el caso número";│
│ $rcmessages[102] = "Sesión expirada. Debe autenticarse nuevamente";│
│ $rcmessages[103] = "No tiene permisos para acceder a esta función";│
│ $rcmessages[200] = "Operación realizada exitosamente";│
│ $rcmessages[201] = "Caso creado correctamente";│
│ $rcmessages[202] = "Caso actualizado correctamente";│
│ $rcmessages[203] = "Caso eliminado correctamente";│
│                                        │
│ MENSAJES DE ERROR:                     │
│ $rcmessages[400] = "Error en la consulta de datos";│
│ $rcmessages[401] = "Error de conexión a la base de datos";│
│ $rcmessages[402] = "Parámetros inválidos";│
│ $rcmessages[403] = "Archivo no encontrado";│
│ $rcmessages[404] = "Registro no encontrado";│
│                                        │
│ MENSAJES DE VALIDACIÓN:                │
│ $rcmessages[500] = "Campo obligatorio";│
│ $rcmessages[501] = "Formato de fecha inválido";│
│ $rcmessages[502] = "Número de documento inválido";│
│ $rcmessages[503] = "Email inválido";│
│ $rcmessages[504] = "Teléfono inválido";│
└─────────────────────────────────────────┘
```

---

## 🔧 **SISTEMA DE CONSTANTES Y CONFIGURACIÓN**

### **📄 application.constant.data**
```
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\application.constant.data

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🔧 ARCHIVO DE CONSTANTES SERIALIZADAS   │
├─────────────────────────────────────────┤
│ Formato: PHP Serialized Array          │
│ Propósito: Configuración del sistema    │
│                                        │
│ CONSTANTES PRINCIPALES:                │
│ • ACCOACTIVAS - Estados de compromisos │
│ • TIPO_FILE - Tipos de archivos       │
│ • TAB_TIP_DESC - Descriptores de tablas│
│ • DOM_COL_DIN - Dominios dinámicos     │
│                                        │
│ ESTRUCTURA ACCOACTIVAS:                │
│ array(                                 │
│   'S' => 'ACTIVO',                    │
│   'N' => 'INACTIVO',                  │
│   'C' => 'CUMPLIDO',                  │
│   'V' => 'VENCIDO'                    │
│ )                                      │
│                                        │
│ ESTRUCTURA TIPO_FILE:                  │
│ array(                                 │
│   'anexo' => 'AN',                    │
│   'atencion' => 'AT',                 │
│   'solucion' => 'SO',                 │
│   'compromiso' => 'CO'                │
│ )                                      │
│                                        │
│ ESTRUCTURA TAB_TIP_DESC:               │
│ array(                                 │
│   'tipoorden' => array(               │
│     'primarykey' => 'tiorcodigos',    │
│     'name_desc' => 'tiornombres'      │
│   ),                                  │
│   'evento' => array(                  │
│     'primarykey' => 'evencodigos',    │
│     'name_desc' => 'evennombres'      │
│   ),                                  │
│   'causa' => array(                   │
│     'primarykey' => 'causcodigos',    │
│     'name_desc' => 'causnombres'      │
│   )                                   │
│ )                                      │
└─────────────────────────────────────────┘
```

### **📄 web.conf.data**
```
Ruta: C:\Users\Soporte\Desktop\cross\cross\apps\CROSSHUV\ASAP\applications\cross300\config\web.conf.data

ANÁLISIS TÉCNICO:
┌─────────────────────────────────────────┐
│ 🔧 CONFIGURACIÓN WEB SERIALIZADAS       │
├─────────────────────────────────────────┤
│ Formato: PHP Serialized Array          │
│ Propósito: Routing y vistas del sistema │
│                                        │
│ ESTRUCTURA PRINCIPAL:                  │
│ array(                                 │
│   'default_action' => 'FeCrCmdDefaultWebUser',│
│   'error_view' => 'Form_WindowError',  │
│   'login_view' => 'Form_WebUser',      │
│   'commands' => array(...),           │
│   'views' => array(...)               │
│ )                                      │
│                                        │
│ CONFIGURACIÓN COMANDOS:                │
│ 'commands' => array(                   │
│   'FeCrCmdDefaultFichas' => array(     │
│     'class' => 'FeCrCmdDefaultFichas', │
│     'views' => array(                  │
│       'success' => array(              │
│         'view' => 'Form_Fichas'        │
│       )                                │
│     )                                  │
│   ),                                   │
│   'FeCrCmdDefaultBodyFichaOrd' => array(│
│     'class' => 'FeCrCmdDefaultBodyFichaOrd',│
│     'views' => array(                  │
│       'success' => array(              │
│         'view' => 'Form_BodyFichaOrd'  │
│       )                                │
│     )                                  │
│   )                                    │
│ )                                      │
│                                        │
│ CONFIGURACIÓN VISTAS:                  │
│ 'views' => array(                      │
│   'Form_Fichas' => array(              │
│     'template' => 'Form_Fichas.tpl'    │
│   ),                                   │
│   'Form_BodyFichaOrd' => array(        │
│     'template' => 'Form_BodyFichaOrd.tpl'│
│   ),                                   │
│   'Form_WebUser' => array(             │
│     'template' => 'Form_WebUser.tpl'   │
│   )                                    │
│ )                                      │
└─────────────────────────────────────────┘
```