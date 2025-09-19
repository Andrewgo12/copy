# Resources - Recursos del Sistema CROSS

Directorio de recursos del sistema CROSS incluyendo documentación, sistemas legacy, portales, código fuente y vistas.

## 📁 Estructura Organizada

```
resources/
├── docs/                           # 📚 Documentación
│   ├── manual_CROSS7/              # Manual CROSS7
│   ├── manual_CROSSH/              # Manual CROSSH
│   └── Manual_tecnico_CROSSH/      # Manual técnico CROSSH
├── legacy/                         # 🏛️ Sistemas Legacy
│   ├── CROSS7/                     # Sistema CROSS7 organizado
│   ├── CROSS7Fuentes/              # Código fuente CROSS7
│   ├── CROSS7WORK/                 # Entorno desarrollo CROSS7
│   ├── CROSS7WORK-Copia/           # Copia trabajo CROSS7
│   └── CROSSHUV/                   # Sistema principal CROSSHUV ⭐
├── portals/                        # 🌐 Portales Web
│   ├── portal-id/                  # Portal ID (Python Flask)
│   └── portal-id-legacy/           # Portal ID legacy (PHP)
├── sources/                        # 📦 Código Fuente
│   └── fuentes/                    # Fuentes originales
├── views/                          # 👁️ Vistas y Templates
└── README.md                       # Esta documentación
```

## 🏛️ Sistemas Legacy

### CROSSHUV ⭐ (Sistema Principal)
- **Importancia**: Sistema de producción más crítico
- **Módulos**: 10 módulos completos (Agenda, Almacén, Clientes, etc.)
- **Arquitectura**: Modular con separación clara
- **Estado**: Completamente organizado y documentado

### CROSS7 (Sistema Base)
- **Propósito**: Sistema base con librerías core
- **Estructura**: MVC con controladores y servicios
- **Librerías**: ADOdb, JPGraph, Smarty, NuSOAP

### CROSS7Fuentes (Código Fuente)
- **Contenido**: Código fuente completo modular
- **Estructura**: Igual a CROSS7 pero con código fuente
- **Plantillas**: Templates compilados Smarty

### CROSS7WORK (Desarrollo)
- **Propósito**: Entorno de desarrollo activo
- **Características**: Base de datos de desarrollo
- **Configuración**: Local específica para desarrollo

## 🌐 Portales

### Portal ID (Python Flask)
- **Tecnología**: Python Flask moderno
- **Base de datos**: PostgreSQL
- **Características**: APIs REST, autenticación

### Portal ID Legacy (PHP)
- **Tecnología**: PHP nativo
- **Funcionalidades**: Formularios y grids CRUD
- **Módulos**: Clientes, países, publicaciones

## 📚 Documentación

### Manuales Disponibles
- **CROSS7**: Manual de usuario sistema CROSS7
- **CROSSH**: Manual de usuario CROSSH
- **Manual Técnico**: Documentación técnica detallada

## 🔄 Estado de Organización

### ✅ Completamente Organizados
- **CROSSHUV**: Sistema principal con máxima prioridad
- **CROSS7**: Sistema base normalizado
- **CROSS7Fuentes**: Código fuente organizado
- **CROSS7WORK**: Entorno desarrollo normalizado
- **Portales**: Ambos portales organizados

### 📊 Estadísticas Totales
- **Directorios renombrados**: 120+
- **Archivos renombrados**: 150+
- **Extensiones normalizadas**: 500+
- **Sistemas organizados**: 5 sistemas completos

## 🎯 Prioridades de Migración

1. **CROSSHUV** - Sistema principal (MÁXIMA PRIORIDAD)
2. **Portal ID Python** - Versión moderna
3. **CROSS7** - Librerías base
4. **Portal ID Legacy** - Funcionalidades específicas
5. **Otros sistemas** - Según necesidad

## 🔗 Integración

### Sistemas Interconectados
- Base de datos PostgreSQL compartida
- Autenticación centralizada
- APIs comunes entre sistemas
- Librerías compartidas

### Arquitectura General
```
CROSSHUV (Principal) ←→ Portal ID (Moderno)
     ↕                        ↕
CROSS7 (Base) ←→ Portal ID Legacy (PHP)
     ↕
Librerías Compartidas (ADOdb, Smarty, etc.)
```

## 📝 Notas Importantes

- **CROSSHUV** es el sistema más importante y crítico
- Todos los sistemas mantienen compatibilidad
- Nomenclatura normalizada facilita navegación
- Documentación completa disponible
- Preparado para migración gradual al nuevo CROSS

## 🚀 Próximos Pasos

1. Análisis detallado de CROSSHUV
2. Migración de módulos críticos
3. Integración con nuevo sistema CROSS
4. Mantenimiento de sistemas legacy
5. Documentación de APIs