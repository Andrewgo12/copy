# Guía de Implementación - Migración CROSS Legacy a Node.js

## 🚀 **Inicio Rápido**

### **1. Configuración del Entorno**

```bash
# Clonar y configurar proyecto
cd cross
npm install

# Configurar variables de entorno
cp .env.example .env
# Editar .env con credenciales PostgreSQL

# Crear base de datos
npm run create-db

# Ejecutar migraciones
npm run migrate

# Iniciar servidor de desarrollo
npm run dev
```

### **2. Estructura del Proyecto Migrado**

```
cross/
├── app/                     # Aplicación Node.js
│   ├── Controllers/         # Controladores migrados
│   │   ├── BaseController.js
│   │   ├── OrdenController.js    # ✅ Migrado de FeCrOrdenManager
│   │   └── ClienteController.js  # ✅ Migrado de FeCuClienteManager
│   ├── Models/              # Modelos Sequelize
│   │   ├── BaseModel.js
│   │   ├── Cliente.js       # ✅ Migrado de cliente table
│   │   └── Orden.js         # ✅ Migrado de orden table
│   └── Services/            # Servicios de negocio
│       └── WorkflowService.js    # ✅ Migrado de workflow engine
├── config/                  # Configuraciones
│   └── database.js
├── database/               # Base de datos
│   ├── migrations/         # Migraciones Sequelize
│   └── seeders/           # Datos iniciales
├── routes/                # Rutas API
│   └── api.js
├── resources/             # Recursos legacy (preservados)
│   └── legacy/           # Sistemas PHP originales
└── docs/                 # Documentación
    ├── ANALISIS_LEGACY_MIGRACION.md
    ├── FUNCIONALIDADES_EXTRAIDAS.md
    └── GUIA_IMPLEMENTACION.md
```

## 📋 **Checklist de Implementación**

### **Fase 1: Infraestructura Base** ✅
- [x] Estructura de carpetas tipo Laravel
- [x] Configuración de base de datos PostgreSQL
- [x] Modelos base (BaseModel, BaseController)
- [x] Sistema de logging
- [x] Manejo de errores centralizado

### **Fase 2: Modelos Críticos** ✅
- [x] Modelo Cliente con validaciones
- [x] Modelo Orden con lógica de negocio
- [x] Relaciones entre modelos
- [x] Métodos de instancia y estáticos
- [x] Hooks de validación

### **Fase 3: Controladores Principales** ✅
- [x] OrdenController con lógica completa
- [x] Validaciones de permisos
- [x] Manejo de transacciones
- [x] Respuestas API estandarizadas

### **Fase 4: Servicios de Negocio** ✅
- [x] WorkflowService (motor de reglas)
- [x] Evaluador seguro de expresiones
- [x] Gestión de tareas y procesos

### **Fase 5: Servicios Pendientes** ⏳
- [ ] NumeradorService
- [ ] EmailService  
- [ ] FileService
- [ ] GeneralService
- [ ] CustomerService
- [ ] HumanResourcesService
- [ ] DimensionService
- [ ] ExecuteActionService
- [ ] NotificationService
- [ ] LlaveService

## 🔧 **Implementación de Servicios Pendientes**

### **1. NumeradorService**
```javascript
// app/Services/NumeradorService.js
class NumeradorService extends BaseService {
  async getNext(tipo, cantidad = 1) {
    // Lógica de consecutivos del legacy
    // Migrado de: NumeradorManager::fncgetByIdNumerador()
  }
}
```

### **2. EmailService**
```javascript
// app/Services/EmailService.js
class EmailService extends BaseService {
  async sendTemplateEmail(recipient, template, data) {
    // Migrado de: smtp-mail library
    // Usar Nodemailer
  }
}
```

### **3. FileService**
```javascript
// app/Services/FileService.js
class FileService extends BaseService {
  async processAttachments(ordenumeros, files, options) {
    // Migrado de: FeCrOrdenManager::addFiles()
    // Usar Multer + almacenamiento local/cloud
  }
}
```

## 📊 **Migración de Base de Datos**

### **1. Crear Migraciones Sequelize**

```bash
# Generar migración para tabla orden
npx sequelize-cli migration:generate --name create-orden-table

# Generar migración para tabla cliente  
npx sequelize-cli migration:generate --name create-cliente-table
```

### **2. Ejemplo de Migración**
```javascript
// database/migrations/001-create-orden-table.js
module.exports = {
  up: async (queryInterface, Sequelize) => {
    await queryInterface.createTable('orden', {
      ordenumeros: {
        type: Sequelize.STRING(50),
        primaryKey: true,
        allowNull: false
      },
      proccodigos: {
        type: Sequelize.STRING(20),
        allowNull: false,
        references: {
          model: 'proceso',
          key: 'proccodigos'
        }
      },
      // ... resto de campos migrados del legacy
    });
  },
  down: async (queryInterface, Sequelize) => {
    await queryInterface.dropTable('orden');
  }
};
```

### **3. Seeders para Datos Iniciales**
```javascript
// database/seeders/001-demo-data.js
module.exports = {
  up: async (queryInterface, Sequelize) => {
    // Insertar datos de prueba
    await queryInterface.bulkInsert('cliente', [
      {
        cliecodigos: 'CLI001',
        clieidentifs: '12345678',
        clienombres: 'Cliente Demo',
        clieactivas: true
      }
    ]);
  }
};
```

## 🌐 **APIs RESTful**

### **1. Rutas de Órdenes**
```javascript
// routes/api.js
const express = require('express');
const OrdenController = require('../app/Controllers/OrdenController');

const router = express.Router();

// Rutas migradas del legacy
router.post('/ordenes', OrdenController.create);           // addOrden()
router.put('/ordenes/:id', OrdenController.update);        // updateOrden()
router.get('/ordenes/:id', OrdenController.show);          // getByIdOrden()
router.get('/ordenes', OrdenController.index);             // getAllOrden()
router.delete('/ordenes/:id', OrdenController.destroy);    // deleteOrden()

module.exports = router;
```

### **2. Middleware de Autenticación**
```javascript
// app/Middleware/AuthMiddleware.js
const jwt = require('jsonwebtoken');

const authMiddleware = (req, res, next) => {
  // Migrar lógica de perfiles/autenticación del legacy
  const token = req.header('Authorization')?.replace('Bearer ', '');
  
  if (!token) {
    return res.status(401).json({ error: 'Token requerido' });
  }
  
  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.user = decoded;
    next();
  } catch (error) {
    res.status(401).json({ error: 'Token inválido' });
  }
};

module.exports = authMiddleware;
```

## 🧪 **Testing**

### **1. Tests Unitarios**
```javascript
// tests/unit/OrdenController.test.js
const request = require('supertest');
const app = require('../../server');

describe('OrdenController', () => {
  test('should create orden successfully', async () => {
    const ordenData = {
      ordenData: { ordeobservs: 'Test orden' },
      empresaData: { contidentis: '12345678' }
    };
    
    const response = await request(app)
      .post('/api/ordenes')
      .send(ordenData)
      .expect(200);
      
    expect(response.body.message).toBe('Orden creada exitosamente');
  });
});
```

### **2. Tests de Integración**
```javascript
// tests/integration/workflow.test.js
describe('Workflow Integration', () => {
  test('should execute complete order workflow', async () => {
    // Test del flujo completo migrado del legacy
    // 1. Crear orden
    // 2. Asignar proceso
    // 3. Crear tareas
    // 4. Ejecutar reglas
    // 5. Validar resultado
  });
});
```

## 🔍 **Debugging y Monitoreo**

### **1. Logging Estructurado**
```javascript
// app/Services/LoggerService.js
const winston = require('winston');

const logger = winston.createLogger({
  level: 'info',
  format: winston.format.combine(
    winston.format.timestamp(),
    winston.format.errors({ stack: true }),
    winston.format.json()
  ),
  transports: [
    new winston.transports.File({ filename: 'storage/logs/error.log', level: 'error' }),
    new winston.transports.File({ filename: 'storage/logs/combined.log' })
  ]
});

module.exports = logger;
```

### **2. Monitoreo de Performance**
```javascript
// app/Middleware/PerformanceMiddleware.js
const performanceMiddleware = (req, res, next) => {
  const start = Date.now();
  
  res.on('finish', () => {
    const duration = Date.now() - start;
    console.log(`${req.method} ${req.path} - ${duration}ms`);
  });
  
  next();
};
```

## 🚀 **Despliegue**

### **1. Configuración de Producción**
```javascript
// ecosystem.config.js (PM2)
module.exports = {
  apps: [{
    name: 'cross-api',
    script: 'server.js',
    instances: 'max',
    exec_mode: 'cluster',
    env: {
      NODE_ENV: 'development'
    },
    env_production: {
      NODE_ENV: 'production',
      PORT: 3000
    }
  }]
};
```

### **2. Docker**
```dockerfile
# Dockerfile
FROM node:18-alpine

WORKDIR /app
COPY package*.json ./
RUN npm ci --only=production

COPY . .
EXPOSE 3000

CMD ["npm", "start"]
```

### **3. Docker Compose**
```yaml
# docker-compose.yml
version: '3.8'
services:
  app:
    build: .
    ports:
      - "3000:3000"
    environment:
      - NODE_ENV=production
      - DB_HOST=postgres
    depends_on:
      - postgres
      
  postgres:
    image: postgres:13
    environment:
      POSTGRES_DB: cross_db
      POSTGRES_USER: cross_user
      POSTGRES_PASSWORD: cross_pass
    volumes:
      - postgres_data:/var/lib/postgresql/data

volumes:
  postgres_data:
```

## 📚 **Recursos Adicionales**

### **Documentación de Referencia**
- [Sequelize ORM](https://sequelize.org/docs/v6/)
- [Express.js](https://expressjs.com/)
- [Jest Testing](https://jestjs.io/)
- [Winston Logging](https://github.com/winstonjs/winston)

### **Herramientas Recomendadas**
- **Postman** - Testing de APIs
- **pgAdmin** - Administración PostgreSQL  
- **VS Code** - Editor con extensiones Node.js
- **Docker Desktop** - Contenedores locales

---

**Documento preparado por**: Amazon Q Developer  
**Fecha**: Diciembre 2024  
**Estado**: Guía completa de implementación