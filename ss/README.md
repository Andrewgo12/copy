# 🎯 Sistema de Tickets Completo

## 📋 Descripción
Sistema integral de gestión de tickets para equipos biomédicos, industriales y de transporte con funcionalidades completas de CRUD, filtros avanzados, exportación y gestión de usuarios.

## 🚀 Características Principales

### ✅ Vistas Principales
- **Dashboard**: Métricas, gráficos y resumen general
- **MyTickets**: Gestión personal de tickets técnicos
- **GestionTickets**: Administración y supervisión
- **ClosedTickets**: Archivo y documentos cerrados

### ✅ Funcionalidades Completas
- CRUD completo de tickets
- Filtros avanzados y búsqueda
- Exportación múltiple (CSV, PDF, Excel)
- Sistema de notificaciones
- Acciones masivas
- Modales especializados por vista
- Estado global sincronizado

### ✅ Tipos de Tickets
- **Biomédicos**: Ventiladores, monitores, bombas de infusión
- **Industriales**: Aire acondicionado, sistemas eléctricos, ascensores
- **Transporte**: Ambulancias, vehículos, mantenimiento

## 🛠️ Instalación y Uso

### Requisitos
- Node.js 16+
- npm o yarn

### Instalación
```bash
# Clonar o descargar el proyecto
cd data/ss

# Instalar dependencias
npm install

# Ejecutar aplicación completa
npm start

# Ejecutar vistas individuales
npm run server
```

### URLs Disponibles
- **App Completa**: http://localhost:3000
- **MyTickets**: http://localhost:3001/mytickets
- **GestionTickets**: http://localhost:3001/gestiontickets
- **ClosedTickets**: http://localhost:3001/closedtickets

## 📁 Estructura del Proyecto

```
ss/
├── components/           # Componentes reutilizables
│   ├── ui/              # Componentes UI base
│   ├── modals/          # Modales específicos
│   └── *.jsx            # Componentes funcionales
├── store/               # Estado global
├── views/               # Vistas individuales
├── lib/                 # Utilidades
├── assets/              # Recursos estáticos
└── public/              # Archivos públicos
```

## 🎨 Tecnologías

- **Frontend**: React 18, Tailwind CSS
- **Estado**: Context API + Store personalizado
- **UI**: Componentes personalizados
- **Iconos**: Lucide React
- **Servidor**: Express.js (para vistas individuales)

## 📊 Componentes Principales

### UI Components (10)
- Button, Input, Select, Table, Dialog
- Card, Badge, Label, Textarea, Tabs

### Functional Components (21)
- TicketForm, Dashboard, StatsCard
- NotificationSystem, AdvancedFilters
- ExportModal, BulkActions, etc.

### Modals Especializados (9)
- MyTicketsModals (3): Técnicos, Docs Técnicos, Biblioteca
- GestionModals (3): Supervisores, Docs Admin, Centro Docs
- ClosedModals (3): Auditores, Archivo, Retención

## 🔄 Estado Global

El sistema utiliza un store global que sincroniza datos entre todas las vistas:
- Tickets compartidos entre vistas
- Notificaciones en tiempo real
- Estadísticas actualizadas
- Filtros persistentes

## 📱 Responsive Design

- Desktop: Tablas completas con todas las funciones
- Tablet: Vista adaptada con navegación optimizada
- Mobile: Cards apiladas con información esencial

## 🚀 Scripts Disponibles

```bash
npm start          # App React completa
npm run server     # Servidor para vistas individuales
npm run dev        # Ambos simultáneamente
npm run build      # Build de producción
```

## 📄 Licencia

Proyecto desarrollado para gestión interna de tickets.
Todos los derechos reservados.