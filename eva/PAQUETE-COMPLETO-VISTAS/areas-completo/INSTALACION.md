# 🚀 Guía de Instalación - Sistema de Áreas

## 📋 Requisitos Previos

### 1. Dependencias de Shadcn/ui
```bash
# Instalar componentes necesarios
npx shadcn-ui@latest add card
npx shadcn-ui@latest add button
npx shadcn-ui@latest add badge
npx shadcn-ui@latest add table
npx shadcn-ui@latest add select
npx shadcn-ui@latest add input
npx shadcn-ui@latest add label
npx shadcn-ui@latest add dialog
npx shadcn-ui@latest add textarea
```

### 2. Iconos Lucide
```bash
npm install lucide-react
```

## 📁 Estructura de Instalación

### Opción 1: Integración directa
```
src/
├── components/
│   ├── areas/
│   │   ├── vista-areas-principal.jsx       # Vista principal
│   │   └── modals/                         # Modales
│   │       ├── ui-modal-agregar-area.jsx
│   │       ├── ui-modal-editar-area.jsx
│   │       ├── ui-modal-eliminar-area.jsx
│   │       └── ui-modal-ver-area.jsx
│   └── ui/                                 # Componentes Shadcn/ui
```

### Opción 2: Como módulo independiente
```
src/
├── modules/
│   └── areas-completo/                     # Copiar toda la carpeta
└── components/
    └── ui/                                 # Componentes Shadcn/ui
```

## 🔧 Configuración

### 1. Configurar rutas en App.jsx
```jsx
import VistaAreasPrincipal from './components/areas/vista-areas-principal';
// o
import VistaAreasPrincipal from './modules/areas-completo/vista-areas-principal';

// En tu router
<Route path="/config/areas" element={<VistaAreasPrincipal />} />
```

### 2. Verificar alias de importación
Asegúrate de que tu `vite.config.js` tenga configurado el alias `@`:

```js
// vite.config.js
export default defineConfig({
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
})
```

### 3. Verificar Tailwind CSS
El sistema usa clases avanzadas de Tailwind CSS:

```js
// tailwind.config.js
module.exports = {
  content: [
    "./src/**/*.{js,jsx,ts,tsx}",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

## ✅ Verificación de Instalación

### 1. Comprobar imports
Todos los componentes deben importar correctamente:
- ✅ Card, Button, Badge, Table, Select
- ✅ Input, Label, Dialog, Textarea
- ✅ Iconos de Lucide React (11 iconos)

### 2. Probar funcionalidades básicas
- ✅ La tabla se renderiza con 15 áreas
- ✅ La búsqueda filtra resultados en tiempo real
- ✅ El botón "Agregar Área" abre el modal completo
- ✅ Los botones de editar cargan los datos correctamente
- ✅ Los botones de ver muestran información detallada
- ✅ Los botones de eliminar muestran confirmación

### 3. Verificar responsividad
- ✅ **Mobile (320px)**: Header compacto, menú hamburguesa
- ✅ **Tablet (768px)**: Layout híbrido, búsqueda visible
- ✅ **Desktop (1024px+)**: Experiencia completa

## 🐛 Solución de Problemas

### Error: "Cannot resolve module @/components/ui/..."
```bash
# Verificar que Shadcn/ui esté instalado
npx shadcn-ui@latest add [component-name]
```

### Error: "lucide-react not found"
```bash
npm install lucide-react
```

### Error: Textarea no funciona
```bash
# Instalar componente Textarea
npx shadcn-ui@latest add textarea
```

### Error: Modales no se abren
Verificar que los estados se manejen correctamente:
```jsx
const [isAddModalOpen, setIsAddModalOpen] = useState(false);
const [isEditModalOpen, setIsEditModalOpen] = useState(false);
const [isDeleteModalOpen, setIsDeleteModalOpen] = useState(false);
const [isViewModalOpen, setIsViewModalOpen] = useState(false);
```

### Error: Búsqueda no funciona en móvil
Verificar que el estado `isMobileMenuOpen` esté implementado:
```jsx
const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
```

## 🎯 Prueba Completa

Después de la instalación, visita `/config/areas` y verifica:

### Header Responsivo
- [ ] Título "Áreas" visible
- [ ] Búsqueda en desktop (md+)
- [ ] Menú hamburguesa en móvil
- [ ] Búsqueda desplegable en móvil

### Tabla de Áreas
- [ ] 15 áreas cargadas correctamente
- [ ] Información completa por área
- [ ] Badges de estado coloridos
- [ ] Botones de acción (Ver/Editar/Eliminar)

### Modales Funcionales
- [ ] **Agregar**: Formulario con 11 campos
- [ ] **Editar**: Pre-carga datos del área seleccionada
- [ ] **Ver**: Muestra información detallada
- [ ] **Eliminar**: Confirmación con información completa

### Búsqueda y Paginación
- [ ] Búsqueda filtra en tiempo real
- [ ] Contador de resultados actualiza
- [ ] Paginación funciona correctamente
- [ ] Controles adaptativos por pantalla

## 📱 Pruebas de Responsividad

### Mobile (320px - 640px)
- [ ] Header compacto con menú hamburguesa
- [ ] Búsqueda desplegable funcional
- [ ] Tabla con información condensada
- [ ] Modales ocupan toda la pantalla
- [ ] Botones apilados verticalmente

### Tablet (640px - 1024px)
- [ ] Header con búsqueda visible
- [ ] Layout híbrido en formularios
- [ ] Modales centrados con scroll
- [ ] Información parcialmente visible

### Desktop (1024px+)
- [ ] Experiencia completa
- [ ] Todos los controles visibles
- [ ] Modales amplios con 2 columnas
- [ ] Información detallada completa

## 🔄 Personalización

### Cambiar colores de estado
Edita la función `getEstadoColor`:
```jsx
const getEstadoColor = (estado) => {
  switch (estado) {
    case "ACTIVA":
      return "bg-green-100 text-green-800";    // Cambiar aquí
    case "INACTIVA":
      return "bg-red-100 text-red-800";        // Cambiar aquí
    case "MANTENIMIENTO":
      return "bg-yellow-100 text-yellow-800";  // Cambiar aquí
  }
};
```

### Agregar nuevos servicios
Actualizar las opciones en los modales:
```jsx
<SelectContent>
  <SelectItem value="NUEVO_SERVICIO">NUEVO SERVICIO</SelectItem>
  // ... otros servicios
</SelectContent>
```

### Modificar campos del formulario
1. Actualizar el estado `formData`
2. Agregar campos en los modales
3. Actualizar la tabla si es necesario

### Conectar con API
Reemplazar los `console.log` en:
- `handleSubmit` (agregar/editar)
- `handleConfirmDelete` (eliminar)

## 📞 Soporte

Si encuentras problemas:
1. Verifica que todas las dependencias estén instaladas
2. Comprueba las rutas de importación de modales
3. Revisa la consola del navegador para errores específicos
4. Asegúrate de que Tailwind CSS esté configurado correctamente
5. Verifica que el alias `@` esté funcionando
6. Confirma que todos los iconos de Lucide estén disponibles