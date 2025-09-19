# Guía de Uso Completa

## Inicio Rápido

### Ejecución Básica
```bash
# Activar entorno virtual
source venv/bin/activate  # Linux/macOS
# o
venv\Scripts\activate     # Windows

# Iniciar sesión interactiva
python main.py

# O usar CLI directamente
python -m local_agent.interfaces.cli interactive
```

### Primera Interacción
```
Usuario: Hola, ¿qué puedes hacer?

Agente: ¡Hola! Soy tu agente local de IA. Puedo ayudarte con:

🗂️ **Gestión de Archivos**
- Leer, escribir y organizar archivos
- Analizar código fuente
- Buscar contenido en directorios

⚙️ **Comandos del Sistema**
- Ejecutar comandos de terminal de forma segura
- Instalar paquetes y dependencias
- Gestionar repositorios Git

🌐 **Búsqueda Web**
- Buscar información en internet
- Obtener contenido de páginas web
- Investigar documentación técnica

🧠 **Memoria y Aprendizaje**
- Recordar conversaciones anteriores
- Aprender tus preferencias
- Mantener contexto de proyectos

¿En qué te gustaría que te ayude?
```

## Casos de Uso Detallados

### 1. Desarrollo de Software

#### Análisis de Código Existente
```
Usuario: Analiza el archivo main.py y dime qué hace

Agente: 
📋 **Plan de Análisis:**
1. Leer archivo main.py
2. Analizar estructura del código
3. Identificar funciones y clases principales
4. Evaluar complejidad y posibles mejoras

🔍 **Análisis Completado:**

El archivo main.py contiene:
- Función principal `main()` que inicializa el agente
- Configuración de logging con loguru
- Manejo de variables de entorno
- Gestión de errores con try/catch

**Estructura detectada:**
- 85 líneas de código
- 3 funciones principales
- 1 clase de configuración
- Imports de 8 módulos

**Recomendaciones:**
- Añadir docstrings a las funciones
- Considerar separar configuración en archivo aparte
- Añadir tests unitarios
```

#### Creación de Nuevas Funciones
```
Usuario: Crea una función para validar emails en Python

Agente:
📝 **Creando función de validación de emails...**

```python
import re
from typing import bool

def validate_email(email: str) -> bool:
    """
    Valida si una dirección de email tiene formato correcto
    
    Args:
        email: Dirección de email a validar
        
    Returns:
        True si el email es válido, False en caso contrario
        
    Examples:
        >>> validate_email("usuario@ejemplo.com")
        True
        >>> validate_email("email_invalido")
        False
    """
    if not email or not isinstance(email, str):
        return False
    
    # Patrón regex para validación básica de email
    pattern = r'^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'
    
    return bool(re.match(pattern, email.strip()))


# Tests unitarios
def test_validate_email():
    """Tests para la función validate_email"""
    # Casos válidos
    assert validate_email("test@example.com") == True
    assert validate_email("user.name@domain.co.uk") == True
    assert validate_email("user+tag@example.org") == True
    
    # Casos inválidos
    assert validate_email("invalid_email") == False
    assert validate_email("@example.com") == False
    assert validate_email("test@") == False
    assert validate_email("") == False
    assert validate_email(None) == False

if __name__ == "__main__":
    test_validate_email()
    print("✅ Todos los tests pasaron")
```

¿Te gustaría que guarde esta función en un archivo específico?
```

#### Refactoring de Código
```
Usuario: Refactoriza la función process_data() para que sea más eficiente

Agente:
🔍 **Analizando función actual...**

He identificado las siguientes optimizaciones:

**Problemas encontrados:**
- Loop anidado innecesario (O(n²) → O(n))
- Múltiples llamadas a la misma función
- Variables no utilizadas
- Falta manejo de errores

**Versión optimizada:**

```python
# ANTES (ineficiente)
def process_data(data_list):
    results = []
    for item in data_list:
        for other_item in data_list:  # ❌ Loop innecesario
            if expensive_function(item) == expensive_function(other_item):  # ❌ Llamadas duplicadas
                results.append(transform_item(item))
    return results

# DESPUÉS (optimizada)
def process_data(data_list):
    """
    Procesa lista de datos de forma eficiente
    Complejidad: O(n) en lugar de O(n²)
    """
    if not data_list:
        return []
    
    results = []
    processed_values = {}  # Cache para evitar recálculos
    
    try:
        for item in data_list:
            # Usar cache para evitar llamadas duplicadas
            if item not in processed_values:
                processed_values[item] = expensive_function(item)
            
            value = processed_values[item]
            
            # Procesar solo si cumple condición
            if value is not None:
                transformed = transform_item(item)
                results.append(transformed)
                
    except Exception as e:
        logger.error(f"Error procesando datos: {e}")
        raise
    
    return results
```

**Mejoras implementadas:**
- ✅ Eliminado loop anidado innecesario
- ✅ Cache para evitar recálculos
- ✅ Manejo de errores robusto
- ✅ Validación de entrada
- ✅ Documentación añadida

**Ganancia de rendimiento estimada:** 80-90% más rápido para listas grandes
```

### 2. Automatización de Tareas

#### Gestión de Proyectos
```
Usuario: Crea un nuevo proyecto Python con estructura estándar

Agente:
🏗️ **Creando estructura de proyecto Python...**

📋 **Plan de Ejecución:**
1. Crear directorio del proyecto
2. Inicializar estructura de carpetas
3. Crear archivos de configuración
4. Configurar entorno virtual
5. Crear archivos de ejemplo

✅ **Proyecto creado exitosamente:**

```
mi_proyecto/
├── src/
│   ├── __init__.py
│   ├── main.py
│   └── utils/
│       └── __init__.py
├── tests/
│   ├── __init__.py
│   └── test_main.py
├── docs/
│   └── README.md
├── requirements.txt
├── setup.py
├── .gitignore
├── .env.example
└── pyproject.toml
```

**Archivos creados:**
- ✅ Estructura de directorios estándar
- ✅ requirements.txt con dependencias básicas
- ✅ setup.py para instalación
- ✅ .gitignore para Python
- ✅ Tests unitarios de ejemplo
- ✅ Documentación inicial

**Próximos pasos sugeridos:**
1. `cd mi_proyecto`
2. `python -m venv venv`
3. `source venv/bin/activate`
4. `pip install -r requirements.txt`
```

#### Automatización DevOps
```
Usuario: Verifica el estado del repositorio, ejecuta tests y haz commit si todo está bien

Agente:
🔄 **Ejecutando workflow DevOps...**

**Paso 1: Verificación del repositorio**
```bash
$ git status
On branch main
Your branch is up to date with 'origin/main'.

Changes not staged for commit:
  modified:   src/main.py
  modified:   tests/test_main.py

Untracked files:
  new_feature.py
```

**Paso 2: Ejecutando tests**
```bash
$ python -m pytest tests/ -v
========================= test session starts =========================
tests/test_main.py::test_basic_functionality PASSED    [ 50%]
tests/test_main.py::test_edge_cases PASSED             [100%]

========================= 2 passed in 0.15s =========================
```

**Paso 3: Análisis de calidad de código**
```bash
$ flake8 src/
src/main.py:45:80: E501 line too long (85 > 79 characters)

$ black src/ --check
would reformat src/main.py
```

**Paso 4: Correcciones automáticas**
- ✅ Líneas largas corregidas
- ✅ Formato de código aplicado
- ✅ Tests ejecutados nuevamente: PASSED

**Paso 5: Commit automático**
```bash
$ git add .
$ git commit -m "feat: add new feature with tests and formatting fixes"
[main 7a8b9c2] feat: add new feature with tests and formatting fixes
 3 files changed, 45 insertions(+), 12 deletions(-)
```

✅ **Workflow completado exitosamente**
- Tests: ✅ Pasaron
- Calidad: ✅ Corregida
- Commit: ✅ Realizado
- Estado: Listo para push
```

### 3. Investigación y Aprendizaje

#### Búsqueda de Información Técnica
```
Usuario: Busca información sobre FastAPI y crea un ejemplo básico

Agente:
🔍 **Investigando FastAPI...**

**Información encontrada:**
FastAPI es un framework web moderno y rápido para construir APIs con Python 3.7+, basado en type hints estándar de Python.

**Características principales:**
- ⚡ Muy rápido: rendimiento comparable a NodeJS y Go
- 🚀 Rápido de codificar: aumenta la velocidad de desarrollo entre 200% y 300%
- 🐛 Menos bugs: reduce aproximadamente 40% de errores humanos
- 🧠 Intuitivo: gran soporte del editor con autocompletado
- 📝 Automático: documentación API interactiva automática

**Ejemplo básico creado:**

```python
# main.py - API básica con FastAPI
from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
from typing import List, Optional

# Crear instancia de FastAPI
app = FastAPI(
    title="Mi API con FastAPI",
    description="API de ejemplo creada por el agente local",
    version="1.0.0"
)

# Modelo de datos
class Item(BaseModel):
    id: Optional[int] = None
    name: str
    description: Optional[str] = None
    price: float
    tax: Optional[float] = None

# Base de datos simulada
items_db = []

# Endpoints
@app.get("/")
async def root():
    """Endpoint raíz"""
    return {"message": "¡Hola desde FastAPI!"}

@app.get("/items/", response_model=List[Item])
async def read_items():
    """Obtener todos los items"""
    return items_db

@app.get("/items/{item_id}", response_model=Item)
async def read_item(item_id: int):
    """Obtener item por ID"""
    for item in items_db:
        if item.id == item_id:
            return item
    raise HTTPException(status_code=404, detail="Item no encontrado")

@app.post("/items/", response_model=Item)
async def create_item(item: Item):
    """Crear nuevo item"""
    item.id = len(items_db) + 1
    items_db.append(item)
    return item

@app.put("/items/{item_id}", response_model=Item)
async def update_item(item_id: int, item: Item):
    """Actualizar item existente"""
    for i, existing_item in enumerate(items_db):
        if existing_item.id == item_id:
            item.id = item_id
            items_db[i] = item
            return item
    raise HTTPException(status_code=404, detail="Item no encontrado")

@app.delete("/items/{item_id}")
async def delete_item(item_id: int):
    """Eliminar item"""
    for i, item in enumerate(items_db):
        if item.id == item_id:
            del items_db[i]
            return {"message": "Item eliminado"}
    raise HTTPException(status_code=404, detail="Item no encontrado")

# Ejecutar con: uvicorn main:app --reload
```

**Para ejecutar:**
```bash
# Instalar FastAPI
pip install fastapi uvicorn

# Ejecutar servidor
uvicorn main:app --reload

# Acceder a:
# - API: http://localhost:8000
# - Documentación: http://localhost:8000/docs
# - Redoc: http://localhost:8000/redoc
```

**Archivos adicionales creados:**
- ✅ requirements.txt actualizado
- ✅ Dockerfile para containerización
- ✅ Tests unitarios básicos
- ✅ Documentación en README.md
```

### 4. Análisis de Datos

#### Procesamiento de CSV
```
Usuario: Analiza el archivo datos.csv y genera un reporte

Agente:
📊 **Analizando archivo datos.csv...**

**Información del archivo:**
- Tamaño: 2.3 MB
- Filas: 15,847
- Columnas: 8
- Formato: CSV con separador coma

**Estructura detectada:**
```
Columna          Tipo      Valores Únicos    Nulos
─────────────────────────────────────────────────
id               int       15,847            0
nombre           string    12,456            23
edad             int       78                5
salario          float     8,234             156
departamento     string    12                0
fecha_ingreso    date      2,847             8
activo           bool      2                 0
puntuacion       float     1,247             89
```

**Estadísticas Descriptivas:**

**Edad:**
- Media: 34.2 años
- Mediana: 33.0 años
- Desviación estándar: 8.7
- Rango: 22-65 años

**Salario:**
- Media: $67,450
- Mediana: $65,200
- Q1: $52,000, Q3: $78,500
- Outliers detectados: 23 casos

**Análisis por Departamento:**
```
Departamento     Empleados    Salario Promedio    Edad Promedio
──────────────────────────────────────────────────────────────
Ingeniería       4,234        $78,900            32.1
Marketing        2,156        $58,700            35.8
Ventas           3,789        $62,300            36.2
RRHH             1,245        $55,400            38.9
Finanzas         2,134        $71,200            34.5
```

**Insights Clave:**
- 📈 Ingeniería tiene los salarios más altos
- 👥 Ventas es el departamento más grande
- 📅 Pico de contrataciones en 2019-2020
- ⚠️ 23 outliers en salarios requieren revisión

**Archivos generados:**
- ✅ reporte_analisis.html
- ✅ graficos_estadisticas.png
- ✅ datos_limpios.csv
- ✅ resumen_ejecutivo.pdf
```

### 5. Gestión de Configuraciones

#### Setup de Entorno de Desarrollo
```
Usuario: Configura un entorno de desarrollo completo para React

Agente:
⚙️ **Configurando entorno React...**

**Paso 1: Verificación de prerequisitos**
```bash
$ node --version
v18.17.0 ✅

$ npm --version  
9.6.7 ✅
```

**Paso 2: Creación del proyecto**
```bash
$ npx create-react-app mi-app-react --template typescript
Creating a new React app in /current/path/mi-app-react...
✅ Proyecto creado exitosamente
```

**Paso 3: Instalación de dependencias adicionales**
```bash
$ cd mi-app-react
$ npm install @mui/material @emotion/react @emotion/styled
$ npm install axios react-router-dom
$ npm install -D @testing-library/jest-dom @testing-library/react
✅ Dependencias instaladas
```

**Paso 4: Configuración de herramientas de desarrollo**
```json
// .vscode/settings.json
{
  "editor.formatOnSave": true,
  "editor.codeActionsOnSave": {
    "source.fixAll.eslint": true
  },
  "typescript.preferences.importModuleSpecifier": "relative"
}
```

**Paso 5: Scripts personalizados añadidos**
```json
// package.json (scripts añadidos)
{
  "scripts": {
    "dev": "react-scripts start",
    "build": "react-scripts build", 
    "test": "react-scripts test",
    "test:coverage": "react-scripts test --coverage --watchAll=false",
    "lint": "eslint src/**/*.{js,jsx,ts,tsx}",
    "lint:fix": "eslint src/**/*.{js,jsx,ts,tsx} --fix",
    "format": "prettier --write src/**/*.{js,jsx,ts,tsx,css,md}"
  }
}
```

**Paso 6: Componente de ejemplo creado**
```typescript
// src/components/Welcome.tsx
import React from 'react';
import { Button, Typography, Container } from '@mui/material';

interface WelcomeProps {
  userName?: string;
}

const Welcome: React.FC<WelcomeProps> = ({ userName = 'Usuario' }) => {
  const handleClick = () => {
    alert(`¡Hola ${userName}! Bienvenido a tu nueva app React.`);
  };

  return (
    <Container maxWidth="sm" sx={{ textAlign: 'center', mt: 4 }}>
      <Typography variant="h3" component="h1" gutterBottom>
        🚀 ¡Proyecto React Listo!
      </Typography>
      
      <Typography variant="body1" sx={{ mb: 3 }}>
        Tu entorno de desarrollo está configurado y listo para usar.
      </Typography>
      
      <Button 
        variant="contained" 
        color="primary" 
        onClick={handleClick}
        size="large"
      >
        Comenzar a Desarrollar
      </Button>
    </Container>
  );
};

export default Welcome;
```

**✅ Entorno completamente configurado:**
- React 18 con TypeScript
- Material-UI para componentes
- ESLint y Prettier configurados
- Tests con Jest y Testing Library
- Scripts de desarrollo optimizados
- Estructura de carpetas estándar

**Para iniciar desarrollo:**
```bash
cd mi-app-react
npm run dev
```

**URLs importantes:**
- Aplicación: http://localhost:3000
- Documentación: http://localhost:3000/docs (si añades Storybook)
```

## Comandos Especiales del CLI

### Comandos de Información
```bash
# Ver estado del agente
status

# Listar herramientas disponibles
tools

# Ver resumen de memoria
memory

# Ver configuración actual
config

# Ver logs recientes
logs

# Ver estadísticas de uso
stats
```

### Comandos de Gestión
```bash
# Limpiar sesión actual
clear

# Reiniciar agente
restart

# Exportar conversación
export conversation.json

# Importar configuración
import config.yml

# Backup de memoria
backup memory_backup.json

# Restaurar memoria
restore memory_backup.json
```

### Comandos de Desarrollo
```bash
# Modo debug
debug on

# Recargar herramientas
reload tools

# Test de herramientas
test tools

# Validar configuración
validate config

# Generar documentación
generate docs
```

## Personalización Avanzada

### Crear Herramientas Personalizadas

```python
# tools/custom/mi_herramienta.py
from local_agent.tools.base import BaseTool, ToolDefinition, ToolParameter, ToolCategory, RiskLevel

class MiHerramientaPersonalizada(BaseTool):
    """Ejemplo de herramienta personalizada"""
    
    def get_definition(self) -> ToolDefinition:
        return ToolDefinition(
            name="mi_herramienta",
            description="Hace algo específico para mi workflow",
            category=ToolCategory.CUSTOM,
            risk_level=RiskLevel.LOW,
            parameters=[
                ToolParameter(
                    name="input_data",
                    type="string",
                    description="Datos de entrada",
                    required=True
                )
            ],
            examples=[{"input_data": "ejemplo"}]
        )
    
    async def execute(self, parameters):
        # Tu lógica personalizada aquí
        input_data = parameters["input_data"]
        
        # Procesar datos...
        result = f"Procesado: {input_data}"
        
        return {
            "success": True,
            "result": result,
            "error": None,
            "metadata": {"processed_at": time.time()}
        }
```

### Configurar Prompts Personalizados

```python
# config/custom_prompts.py
CUSTOM_PROMPTS = {
    "planning": """
    Eres un planificador experto especializado en {domain}.
    
    Contexto del usuario: {user_context}
    Preferencias: {user_preferences}
    
    Crea un plan detallado considerando:
    - Mejores prácticas de {domain}
    - Eficiencia y seguridad
    - Preferencias del usuario
    
    Solicitud: {user_request}
    """,
    
    "code_review": """
    Actúa como un senior developer experto en {language}.
    
    Revisa el siguiente código y proporciona:
    1. Análisis de calidad
    2. Sugerencias de mejora
    3. Posibles bugs o problemas
    4. Optimizaciones de rendimiento
    
    Código a revisar:
    {code}
    """
}
```

## Integración con IDEs

### VS Code Extension (Futuro)
```json
// .vscode/settings.json
{
  "local-agent.enabled": true,
  "local-agent.apiUrl": "http://localhost:8000",
  "local-agent.autoSuggest": true,
  "local-agent.confirmDangerous": true
}
```

### Comandos de VS Code
- `Ctrl+Shift+P` → "Local Agent: Analyze Current File"
- `Ctrl+Shift+P` → "Local Agent: Generate Tests"
- `Ctrl+Shift+P` → "Local Agent: Refactor Selection"
- `Ctrl+Shift+P` → "Local Agent: Explain Code"

## Mejores Prácticas

### Seguridad
1. **Siempre revisar** acciones que modifican archivos del sistema
2. **Usar sandbox** para comandos desconocidos
3. **Configurar guardrails** específicos para tu entorno
4. **Hacer backups** regulares de la memoria del agente

### Rendimiento
1. **Limitar contexto** para consultas simples
2. **Usar caché** para operaciones repetitivas
3. **Configurar timeouts** apropiados
4. **Monitorear uso** de recursos

### Mantenimiento
1. **Actualizar dependencias** regularmente
2. **Limpiar memoria** antigua periódicamente
3. **Revisar logs** para detectar problemas
4. **Hacer backups** antes de cambios importantes
