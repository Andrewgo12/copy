# 🎯 Sistema de Tickets - Vistas Individuales

## 🚀 Inicio Rápido

### Opción 1: Archivo Batch (Windows)
```bash
# Doble clic en:
start-views.bat
```

### Opción 2: Comando Manual
```bash
node server.js
```

## 🌐 URLs de las Vistas

Una vez iniciado el servidor, accede a:

### 🔧 MyTickets (Vista Técnica)
**URL**: `http://localhost:3001/mytickets`
- Gestión de tickets biomédicos, industriales y transporte
- Modales específicos para técnicos especializados
- Interfaz azul con enfoque técnico

### 📊 GestionTickets (Vista Administrativa)
**URL**: `http://localhost:3001/gestiontickets`
- Órdenes de trabajo y supervisión
- Modales para supervisores y coordinadores
- Interfaz verde con enfoque administrativo

### 📁 ClosedTickets (Vista de Archivo)
**URL**: `http://localhost:3001/closedtickets`
- Documentos cerrados y archivados
- Modales para auditores y evaluadores
- Interfaz púrpura con enfoque de archivo

### 🏠 App Completa
**URL**: `http://localhost:3001/`
- Todas las vistas integradas con navegación por pestañas

## ✨ Características

- ✅ **Vistas independientes** que funcionan por separado
- ✅ **Estado compartido** entre todas las vistas
- ✅ **Modales únicos** para cada tipo de vista
- ✅ **Sin dependencias externas** - Todo funciona con React CDN
- ✅ **Responsive design** para móvil y desktop

## 🔄 Sincronización de Datos

Los cambios realizados en una vista se reflejan automáticamente en las otras:
- Crear ticket en MyTickets → Aparece en GestionTickets
- Cambiar estado en GestionTickets → Se actualiza en MyTickets
- Cerrar ticket → Se mueve a ClosedTickets

## 🛠️ Tecnologías

- **React 18** (CDN)
- **Express.js** (Servidor)
- **CSS Inline** (Sin dependencias)
- **Estado Global** (JavaScript puro)