# 🎯 VISTAS RELACIONADAS CON LA FICHA DE CASO

## 📋 **ANÁLISIS DE LA FICHA DE CASO #1061242025**

Basándome en la información mostrada en la ficha de caso, estas son todas las vistas y archivos relacionados:

---

## 🏗️ **VISTA PRINCIPAL - FICHA DE CASO**

### **📄 Archivos que Generan Esta Vista:**

#### **1. 🎯 Comando Principal**
```
📁 Ubicación: web/commands/FeCrCmdDefaultFichas.class.php
🔧 Función: Inicializa la vista de ficha completa
📝 Qué hace: Carga el sistema de frames para mostrar la ficha
```

#### **2. 🖼️ Template Contenedor**
```
📁 Ubicación: web/templates/Form_Fichas.tpl
🔧 Función: Estructura HTML con frames
📝 Qué hace: Divide la pantalla en cabecera (8%) y contenido (92%)
```

#### **3. 🔌 Plugin de Frames**
```
📁 Ubicación: web/plugins/function.frameficha.php
🔧 Función: Genera estructura de frames HTML
📝 Qué hace: Crea 2 frames independientes para cabecera y contenido
```

---

## 📊 **FRAME SUPERIOR - CABECERA**

### **📄 Archivos de la Cabecera:**

#### **1. 🎯 Comando de Cabecera**
```
📁 Ubicación: web/commands/FeCrCmdDefaultHeadRepoTiemposEjec.class.php
🔧 Función: Maneja la cabecera de la ficha
📝 Qué hace: Muestra información básica del caso (número, fechas)
```

#### **2. 🖼️ Template de Cabecera**
```
📁 Ubicación: web/templates/Form_HeadRepoTiemposEjec.tpl
🔧 Función: Diseño de la cabecera
📝 Qué hace: Muestra datos como:
   • Número de Caso: 1061242025
   • Fecha de registro: 2025/09/02 07:02:01
   • Estado actual del caso
```

---

## 📋 **FRAME PRINCIPAL - CONTENIDO COMPLETO**

### **📄 Archivos del Contenido Principal:**

#### **1. 🎯 Comando del Cuerpo**
```
📁 Ubicación: web/commands/FeCrCmdDefaultBodyFichaOrd.class.php
🔧 Función: Maneja el contenido principal de la ficha
📝 Qué hace: Inicializa la carga de toda la información del caso
```

#### **2. 🖼️ Template del Cuerpo**
```
📁 Ubicación: web/templates/Form_BodyFichaOrd.tpl
🔧 Función: Estructura del contenido principal
📝 Qué hace: Llama al plugin principal que genera todo el HTML
```

#### **3. ⭐ Plugin Principal (MÁS IMPORTANTE)**
```
📁 Ubicación: web/plugins/function.viewfichaord.php
🔧 Función: GENERA TODA LA FICHA COMPLETA
📝 Qué hace: Consulta BD y genera HTML para TODAS las secciones:
```

---

## 🗂️ **SECCIONES GENERADAS POR function.viewfichaord.php**

### **📊 1. INFORMACIÓN GENERAL DEL CASO**
```
🔍 Datos mostrados:
• Número de Caso: 1061242025
• Fecha de registro: 2025/09/02 07:02:01
• Fecha de digitación: 2025/09/02 07:14:30
• Fecha de vencimiento: 2025/09/09 23:59:59
• Fecha de finalización: 2025/09/04 16:11:46
• Tipo de Caso: SUGERENCIA-RECOMENDACIÓN
• Clasificación: Mejoramiento de los servicios prestados
• Subclasificación: Mejorar la oportunidad en la atención administrativa
• Medio recepción: BUZON DE SUGERENCIAS

📊 Origen en BD: Tabla 'orden'
🔧 Función: $gateway->getByIdOrden($orden__ordenumeros)
```

### **👤 2. INFORMACIÓN DEL USUARIO**
```
🔍 Datos mostrados:
• Paciente: (vacío)
• Número de Historia clínica: (vacío)
• Seguridad social: (vacío)
• Condición del usuario: (vacío)
• Emp. aseguradora de salud: (vacío)
• Acudiente/reclamante: (38552238) ALEXADRA MOLINA NAVIA
• Localización: CALI
• Area causante: Pediatria General
• Grupo de interés: ASMET SALUD
• Prioridad: Media

📊 Origen en BD: Tabla 'ordenempresa' + JOINs
🔧 Función: $gateway->getByIdOrdenempresajoin($orden__ordenumeros)
```

### **📝 3. OBSERVACIONES**
```
🔍 Datos mostrados:
"Sugerencia encontrada en la apertura del buzón de sugerencias de Pediatría 
Consulta Externa. El día 01.09.2025 y diligenciada el día 01.09.2025. 
Por favor, mucha demora. Casi una hora para atender los pacientes y entregar 
las órdenes que han enviado los médicos. Las enfermeras se la pasan viendo 
celular. Deberían estar pendientes del sistema. Hay que ser respetuosos 
con los pacientes."

📊 Origen en BD: Campo 'ordeobservs' de tabla 'orden'
```

### **📎 4. ANEXOS DEL CASO**
```
🔍 Datos mostrados:
• Archivos: ALEXANDRA OLINA .PDF

📊 Origen en BD: Tabla 'archivos'
🔧 Función: paintCasesFiles($orden__ordenumeros, $rclabels)
📁 Ubicación función: Dentro de function.viewfichaord.php (líneas 800+)
```

### **📋 5. TAREAS DEL CASO**
```
🔍 Datos mostrados:
TAREA 1: ATENCIÓN BÁSICA
• Estado: SOLUCIONADO (Pasa a Control y Cierre)
• Fecha de ingreso: 2025/09/02 07:02:01
• Código de usuario: yxmera
• Dependencia: SERVICIOS AMBULATORIOS

TAREA 2: CONTROL Y CIERRE DEFINITIVO
• Estado: NO SOLUCIONADO (Pasa a Atención)
• Fecha de ingreso: 2025/09/03 07:11:40
• Código de usuario: hgomez
• Dependencia: PQRSF

📊 Origen en BD: Tabla 'actaempresa'
🔧 Función: $gateway->getActas($orden__ordenumeros)
```

### **👥 6. ATENCIONES DETALLADAS**
```
🔍 Datos mostrados:
ATENCIÓN 1:
• Estado: SOLUCIONADO (Pasa a Control y Cierre)
• Registro: 2025/09/03 07:11:40
• Atención: 2025/09/03 07:09:15
• Hora inicial: 07:09:15
• Hora final: 07:09:15
• Dependencia: SERVICIOS AMBULATORIOS
• Personal: 1. (30.326.871) HILDA MARY GOMEZ HERRERA*
• Observaciones: "POR FAVOR SE REQUIERE DE LOS DATOS DEL PACIENTE..."

ATENCIÓN 2:
• Estado: NO SOLUCIONADO (Pasa a Atención)
• Registro: 2025/09/03 08:08:21
• Personal: 1. (98388533) LUIS GABRIEL LASSO PAREJA*
• Observaciones: "BUEN DIA, NO ES POSIBLE ENVIAR DATOS SOLICTADOS..."

📊 Origen en BD: Tabla 'actaempresa' (detalle)
🔧 Función: $gateway->getListActaempresa($actacodigos)
```

### **🔄 7. TRANSFERENCIAS**
```
🔍 Datos mostrados:
• SERVICIOS AMBULATORIOS → 2025/09/03 08:08:48
• PQRSF → 2025/09/03 08:08:48
• Observaciones de cada transferencia

📊 Origen en BD: Tabla 'transfertarea'
🔧 Función: $gateway->getTranfertarea($actacodigos)
```

### **⚡ 8. ACTIVIDADES**
```
🔍 Datos mostrados:
• Código: C3
• Actividad: Solucionar el caso

📊 Origen en BD: Tabla 'activiacta'
🔧 Función: $gateway->getActiviactaByAcem($actencion)
```

### **📎 9. ANEXOS DE ATENCIÓN**
```
🔍 Datos mostrados:
• ALEXANDRA MOLINA.pdf
• Correo pantallazo publicar en pagina wen alexnadra molina.pdf

📊 Origen en BD: Tabla 'archivos'
🔧 Función: paintAttentionFiles($acemnumeros, $rclabels)
📁 Ubicación función: Dentro de function.viewfichaord.php (líneas 900+)
```

---

## 🎨 **ARCHIVOS DE PRESENTACIÓN**

### **📄 Estilos CSS**
```
📁 Ubicación: web/css/estilos.css
🔧 Función: Estilos para la ficha
📝 Clases principales:
• .piedefoto - Contenedor general
• .titulofila - Cabeceras de sección
• .label - Etiquetas de campos
• .data - Valores de campos
```

### **⚡ JavaScript**
```
📁 Ubicación: web/js/fncWindowOpen.js
🔧 Función: Abrir ventanas para descargar archivos
📝 Qué hace: Maneja los enlaces de descarga de PDFs
```

### **🖼️ Imágenes**
```
📁 Ubicación: web/images/
🔧 Archivos relacionados:
• ico_doc.gif - Icono de documentos
• PDF.gif - Icono de archivos PDF
• actualizar_002.gif - Icono actualizar
• imprimir.gif - Icono imprimir
```

---

## 🌍 **ARCHIVOS DE IDIOMA**

### **📄 Etiquetas en Español**
```
📁 Ubicación: config/language/es/es.fichaord.php
🔧 Función: Todas las etiquetas de la ficha en español
📝 Variables principales:
• $rclabels["title"]["label"] = "Ficha de Caso"
• $rclabels["ordenumeros"]["label"] = "Número de Caso"
• $rclabels["ordefecregn"]["label"] = "Fecha de registro"
• $rclabels["tiornombres"]["label"] = "Tipo de Caso"
• $rclabels["atenciones"]["label"] = "Atenciones"
• $rclabels["anexos"]["label"] = "Anexos"
```

### **📄 Mensajes del Sistema**
```
📁 Ubicación: config/language/es/es.messages.php
🔧 Función: Mensajes de error y éxito
📝 Variables principales:
• $rcmessages[21] = "No se encontró el caso número"
• $rcmessages[102] = "Sesión expirada"
• $rcmessages[200] = "Operación realizada exitosamente"
```

---

## 🗄️ **ARCHIVOS DE BASE DE DATOS**

### **📊 Gateways (Conexiones BD)**
```
📁 Ubicación: data/Pgsql/
🔧 Archivos principales:
• FeCrPgsqlOrden.class.php - Datos principales del caso
• FeCrPgsqlOrdenempresaExtended.class.php - Datos del usuario
• FeCrPgsqlSqlExtended.class.php - Consultas complejas
• FeCrPgsqlActaempresa.class.php - Tareas y atenciones
```

---

## 🔗 **VISTAS RELACIONADAS**

### **📋 1. Listado de Órdenes**
```
📁 Template: web/templates/Form_ListadoOrden.tpl
🔧 Comando: FeCrCmdDefaultListadoOrden
🔗 Conexión: Desde aquí se accede a la ficha haciendo clic en el número de caso
```

### **👤 2. Login de Usuario**
```
📁 Template: web/templates/Form_WebUser.tpl
🔧 Comando: FeCrCmdDefaultWebUser
🔗 Conexión: Vista previa antes de acceder a las fichas
```

### **📊 3. Centro de Reportes**
```
📁 Template: web/templates/Form_ReportsCenter.tpl
🔧 Comando: FeCrCmdDefaultReportsCenter
🔗 Conexión: Genera reportes basados en los datos de las fichas
```

### **📄 4. Descarga de Archivos**
```
📁 Comando: FeCrCmdDefaultDownloadFile
🔧 Función: Descargar PDFs y documentos adjuntos
🔗 Conexión: Se llama desde los enlaces de anexos en la ficha
```

---

## 🎯 **RESUMEN DE ARCHIVOS CRÍTICOS**

### **⭐ Los 3 Archivos MÁS IMPORTANTES:**

1. **`function.viewfichaord.php`** - Genera TODA la ficha (1000+ líneas)
2. **`Form_BodyFichaOrd.tpl`** - Template que llama al plugin principal
3. **`function.frameficha.php`** - Crea la estructura de frames

### **🔧 Archivos de Soporte:**
- `FeCrCmdDefaultFichas.class.php` - Comando inicial
- `Form_Fichas.tpl` - Template contenedor
- `es.fichaord.php` - Etiquetas en español
- `estilos.css` - Estilos de presentación

**📍 Todos estos archivos trabajan juntos para generar la ficha completa que viste con toda la información del caso #1061242025.**