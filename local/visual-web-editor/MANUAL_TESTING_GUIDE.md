# Manual Testing Guide 🧪

Esta guía te ayudará a probar todas las funcionalidades del Visual Web Editor de manera sistemática.

## 🚀 Inicio Rápido

### 1. **Iniciar los Servicios**

**Opción A: Manual (Recomendado)**
```bash
# Terminal 1 - Backend
cd backend
npm start

# Terminal 2 - Frontend  
cd frontend
npm start
```

**Opción B: Script de PowerShell**
```bash
powershell -ExecutionPolicy Bypass -File start-simple.ps1
```

### 2. **URLs de Acceso**
- **Frontend:** http://localhost:3002
- **Backend API:** http://localhost:3001
- **Health Check:** http://localhost:3001/api/health

---

## 🧪 Lista de Pruebas

### ✅ **1. Verificación de Servicios**

#### Backend Health Check
- [ ] Abrir http://localhost:3001/api/health
- [ ] Verificar respuesta JSON con status "healthy"
- [ ] Verificar timestamp y versión

#### Frontend Loading
- [ ] Abrir http://localhost:3002
- [ ] Verificar que la página carga sin errores
- [ ] Verificar que no hay errores en la consola del navegador

### ✅ **2. Sistema de Autenticación**

#### Registro de Usuario
- [ ] Ir a la página de registro
- [ ] Completar formulario con:
  - Email: test@example.com
  - Password: TestPassword123!
  - Nombre: Test User
  - Confirmar Password: TestPassword123!
- [ ] Verificar registro exitoso
- [ ] Verificar redirección al dashboard

#### Login de Usuario
- [ ] Ir a la página de login
- [ ] Usar credenciales:
  - Email: test@example.com
  - Password: TestPassword123!
- [ ] Verificar login exitoso
- [ ] Verificar token JWT en localStorage

#### Cuenta de Administrador
- [ ] Login con credenciales de admin:
  - Email: admin@visualwebeditor.com
  - Password: admin123!
- [ ] Verificar acceso a funciones de admin

### ✅ **3. Editor Visual**

#### Interfaz Principal
- [ ] Verificar que el editor carga correctamente
- [ ] Verificar paneles: Componentes, Canvas, Propiedades
- [ ] Verificar barra de herramientas superior

#### Drag & Drop
- [ ] Arrastrar un botón desde la librería al canvas
- [ ] Arrastrar un input desde la librería al canvas
- [ ] Arrastrar un contenedor desde la librería al canvas
- [ ] Verificar que los elementos se posicionan correctamente

#### Selección de Elementos
- [ ] Hacer clic en un elemento para seleccionarlo
- [ ] Verificar que aparece el borde de selección
- [ ] Verificar que las propiedades aparecen en el panel derecho
- [ ] Probar multi-selección con Ctrl+clic

#### Edición de Propiedades
- [ ] Seleccionar un botón
- [ ] Cambiar el texto del botón
- [ ] Cambiar el color de fondo
- [ ] Cambiar el tamaño de fuente
- [ ] Verificar que los cambios se reflejan en tiempo real

#### Responsive Design
- [ ] Cambiar entre breakpoints: Mobile, Tablet, Desktop
- [ ] Verificar que el canvas cambia de tamaño
- [ ] Hacer ajustes específicos para cada breakpoint

### ✅ **4. Gestión de Proyectos**

#### Crear Proyecto
- [ ] Hacer clic en "Nuevo Proyecto"
- [ ] Ingresar nombre: "Proyecto de Prueba"
- [ ] Ingresar descripción: "Proyecto para testing"
- [ ] Verificar que el proyecto se crea correctamente

#### Guardar Proyecto
- [ ] Hacer cambios en el editor
- [ ] Hacer clic en "Guardar"
- [ ] Verificar mensaje de confirmación
- [ ] Verificar que los cambios persisten al recargar

#### Cargar Proyecto
- [ ] Ir a la lista de proyectos
- [ ] Seleccionar un proyecto existente
- [ ] Verificar que el proyecto carga correctamente
- [ ] Verificar que todos los elementos están presentes

#### Exportar Proyecto
- [ ] Abrir un proyecto con elementos
- [ ] Hacer clic en "Exportar"
- [ ] Seleccionar formato: React
- [ ] Verificar que se descarga el archivo ZIP
- [ ] Extraer y verificar el código generado

### ✅ **5. Generación de Código**

#### Código React
- [ ] Crear un diseño con varios componentes
- [ ] Generar código React
- [ ] Verificar que el código es válido
- [ ] Verificar que incluye imports necesarios
- [ ] Verificar que usa Tailwind CSS

#### Código Vue
- [ ] Generar código Vue del mismo diseño
- [ ] Verificar sintaxis Vue correcta
- [ ] Verificar que los estilos se aplican correctamente

#### Código Angular
- [ ] Generar código Angular
- [ ] Verificar sintaxis TypeScript
- [ ] Verificar estructura de componentes

### ✅ **6. Funciones AI (Si está disponible)**

#### AI Assistant
- [ ] Abrir el panel de AI
- [ ] Hacer una pregunta: "¿Cómo puedo mejorar este botón?"
- [ ] Verificar que recibe una respuesta
- [ ] Aplicar una sugerencia del AI

#### Generación desde Imagen
- [ ] Subir una imagen de un diseño web
- [ ] Solicitar replicación del diseño
- [ ] Verificar que genera elementos similares

### ✅ **7. Colaboración (Si está habilitada)**

#### Compartir Proyecto
- [ ] Abrir un proyecto
- [ ] Hacer clic en "Compartir"
- [ ] Generar enlace de compartir
- [ ] Verificar que el enlace funciona

#### Permisos
- [ ] Configurar permisos de solo lectura
- [ ] Configurar permisos de edición
- [ ] Verificar que los permisos se respetan

### ✅ **8. Pruebas de Performance**

#### Carga de Elementos
- [ ] Agregar 50+ elementos al canvas
- [ ] Verificar que la interfaz sigue siendo responsiva
- [ ] Verificar que no hay lag en las interacciones

#### Generación de Código Grande
- [ ] Crear un proyecto complejo
- [ ] Generar código para el proyecto
- [ ] Verificar que la generación es rápida (<5 segundos)

### ✅ **9. Pruebas de Compatibilidad**

#### Navegadores
- [ ] Probar en Chrome
- [ ] Probar en Firefox
- [ ] Probar en Edge
- [ ] Probar en Safari (si está disponible)

#### Dispositivos
- [ ] Probar en desktop
- [ ] Probar en tablet (modo responsive)
- [ ] Probar en móvil (modo responsive)

### ✅ **10. Pruebas de Error**

#### Manejo de Errores
- [ ] Intentar acceder sin autenticación
- [ ] Intentar cargar proyecto inexistente
- [ ] Intentar subir archivo muy grande
- [ ] Verificar que los errores se manejan correctamente

#### Recuperación
- [ ] Simular pérdida de conexión
- [ ] Verificar que la aplicación se recupera
- [ ] Verificar que los datos no se pierden

---

## 📋 **Checklist de Resultados**

### ✅ **Funcionalidades Básicas**
- [ ] Autenticación funciona
- [ ] Editor visual funciona
- [ ] Drag & drop funciona
- [ ] Propiedades se editan correctamente
- [ ] Proyectos se guardan y cargan

### ✅ **Funcionalidades Avanzadas**
- [ ] Generación de código funciona
- [ ] Responsive design funciona
- [ ] Exportación funciona
- [ ] AI assistant funciona (si disponible)

### ✅ **Performance y Estabilidad**
- [ ] No hay errores en consola
- [ ] Interfaz es responsiva
- [ ] No hay memory leaks
- [ ] Funciona en múltiples navegadores

---

## 🐛 **Reporte de Problemas**

Si encuentras algún problema durante las pruebas:

1. **Anota el problema específico**
2. **Incluye pasos para reproducir**
3. **Toma screenshot si es necesario**
4. **Verifica la consola del navegador**
5. **Reporta en GitHub Issues**

---

## 🎯 **Criterios de Éxito**

El proyecto pasa las pruebas si:
- ✅ **90%+ de las funcionalidades básicas funcionan**
- ✅ **80%+ de las funcionalidades avanzadas funcionan**
- ✅ **No hay errores críticos**
- ✅ **Performance es aceptable**
- ✅ **Funciona en navegadores principales**

---

**¡Feliz testing! 🎉**
