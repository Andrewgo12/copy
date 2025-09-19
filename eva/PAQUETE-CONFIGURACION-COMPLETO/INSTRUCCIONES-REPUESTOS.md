# 🚀 INSTRUCCIONES PARA VER REPUESTOS

## ⚡ **PASOS RÁPIDOS:**

### **1. Agregar la ruta en App.jsx:**
```jsx
// Importar el componente
import VistaRepuestosPrincipal from './components/repuestos/vista-repuestos-principal';

// Agregar la ruta en tu Router
<Route path="/repuestos" element={<VistaRepuestosPrincipal />} />
```

### **2. Navegar a la URL:**
```
http://localhost:5173/repuestos
```

### **3. Verificar estructura de carpetas:**
Asegúrate de que la carpeta `repuestos` esté en:
```
src/components/repuestos/
```

## 🔧 **EJEMPLO COMPLETO DE App.jsx:**

```jsx
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import VistaRepuestosPrincipal from './components/repuestos/vista-repuestos-principal';

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/repuestos" element={<VistaRepuestosPrincipal />} />
        {/* Otras rutas... */}
      </Routes>
    </Router>
  );
}

export default App;
```

## ✅ **VERIFICACIÓN:**

Si sigues sin ver la vista:

1. **Verifica la consola** del navegador para errores
2. **Confirma que la ruta** esté agregada correctamente
3. **Revisa que las carpetas** estén en la ubicación correcta
4. **Reinicia el servidor** de desarrollo

## 📁 **UBICACIÓN DE ARCHIVOS:**

```
src/
└── components/
    └── repuestos/
        ├── vista-repuestos-principal.jsx
        └── modals/
            ├── ui-modal-registrar-repuesto.jsx
            ├── ui-modal-depurar-repuesto.jsx
            ├── ui-modal-consolidar-repuesto.jsx
            ├── ui-modal-preventivos.jsx
            ├── ui-modal-calibraciones.jsx
            ├── ui-modal-correctivos.jsx
            ├── ui-modal-reportes.jsx
            ├── ui-modal-editar-repuesto.jsx
            ├── ui-modal-eliminar-repuesto.jsx
            └── ui-modal-ver-repuesto.jsx
```

**¡Después de agregar la ruta, deberías ver la vista completa de repuestos!** 🎯