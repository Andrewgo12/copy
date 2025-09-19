# Guía de Instalación - Transcripto KD

## 📋 Requisitos del Sistema

### Software Requerido
- **Python 3.8+** (recomendado 3.9 o superior)
- **Node.js 16+** (recomendado 18 LTS)
- **npm** o **yarn**
- **Git** (opcional, para clonar el repositorio)

### Hardware Recomendado
- **RAM**: Mínimo 8GB, recomendado 16GB+
- **Almacenamiento**: 10GB libres (para modelos de IA y archivos temporales)
- **GPU**: Opcional pero recomendada (NVIDIA con CUDA para mejor rendimiento)

## 🚀 Instalación Rápida (Windows)

### Opción 1: Instalación Automática
1. Descarga o clona este repositorio
2. Ejecuta `start_all.bat` como administrador
3. El script instalará automáticamente todas las dependencias

### Opción 2: Instalación Manual

#### 1. Configurar Backend (Python)
```bash
cd backend

# Crear entorno virtual
python -m venv venv

# Activar entorno virtual (Windows)
venv\Scripts\activate

# Instalar dependencias
pip install -r requirements.txt

# Copiar configuración
copy .env.example .env
```

#### 2. Configurar Frontend (React)
```bash
cd frontend

# Instalar dependencias
npm install

# O con yarn
yarn install
```

#### 3. Configuración Inicial
Edita el archivo `backend/.env` con tus configuraciones:

```env
# Configuración básica
API_HOST=0.0.0.0
API_PORT=8000
DEBUG=True

# Configuración de archivos
MAX_FILE_SIZE=524288000  # 500MB
UPLOAD_FOLDER=uploads

# Modelo de Whisper (tiny, base, small, medium, large)
WHISPER_MODEL=large

# Opcional: Token de Hugging Face para mejores modelos
HUGGINGFACE_TOKEN=tu_token_aqui

# Opcional: API Key de OpenAI para funciones avanzadas
OPENAI_API_KEY=tu_api_key_aqui
```

## 🔧 Instalación en Linux/macOS

### 1. Backend
```bash
cd backend

# Crear entorno virtual
python3 -m venv venv

# Activar entorno virtual
source venv/bin/activate

# Instalar dependencias
pip install -r requirements.txt

# Configuración
cp .env.example .env
```

### 2. Frontend
```bash
cd frontend
npm install
```

### 3. Ejecutar
```bash
# Terminal 1 - Backend
cd backend
source venv/bin/activate
uvicorn main:app --reload --host 0.0.0.0 --port 8000

# Terminal 2 - Frontend
cd frontend
npm start
```

## 🐳 Instalación con Docker (Próximamente)

```bash
# Construir y ejecutar con Docker Compose
docker-compose up --build
```

## 📦 Dependencias Principales

### Backend (Python)
- **FastAPI**: Framework web moderno
- **Whisper**: Transcripción de audio con IA
- **pyannote.audio**: Separación de voces
- **python-docx**: Generación de documentos Word
- **reportlab**: Generación de PDFs
- **ffmpeg-python**: Procesamiento de audio/video

### Frontend (React)
- **React 18**: Framework de interfaz
- **Tailwind CSS**: Estilos modernos
- **Axios**: Cliente HTTP
- **React Dropzone**: Carga de archivos
- **Lucide React**: Iconos

## 🔍 Verificación de Instalación

### 1. Verificar Backend
```bash
cd backend
python -c "import whisper; print('Whisper OK')"
python -c "import fastapi; print('FastAPI OK')"
```

### 2. Verificar Frontend
```bash
cd frontend
npm list react
```

### 3. Probar el Sistema
1. Ejecuta `start_all.bat` (Windows) o los comandos manuales
2. Abre http://localhost:3000
3. Sube un archivo de audio de prueba
4. Verifica que la transcripción funcione

## ⚠️ Solución de Problemas

### Error: "No module named 'torch'"
```bash
# Instalar PyTorch manualmente
pip install torch torchaudio --index-url https://download.pytorch.org/whl/cpu
```

### Error: "ffmpeg not found"
- **Windows**: Descarga ffmpeg desde https://ffmpeg.org/download.html
- **Linux**: `sudo apt install ffmpeg`
- **macOS**: `brew install ffmpeg`

### Error: "CUDA out of memory"
```env
# En .env, cambiar a CPU
DEVICE=cpu
WHISPER_MODEL=base  # Usar modelo más pequeño
```

### Error: "Port 3000/8000 already in use"
```bash
# Cambiar puertos en .env (backend) o package.json (frontend)
# O matar procesos existentes
netstat -ano | findstr :3000
taskkill /PID <PID> /F
```

## 🔧 Configuración Avanzada

### GPU/CUDA (Opcional)
Para mejor rendimiento con GPU NVIDIA:
```bash
pip install torch torchaudio --index-url https://download.pytorch.org/whl/cu118
```

### Modelos de Whisper
- **tiny**: Más rápido, menor precisión
- **base**: Equilibrio básico
- **small**: Buena precisión, velocidad moderada
- **medium**: Alta precisión, más lento
- **large**: Máxima precisión, más lento

### Tokens de API
- **Hugging Face**: Para modelos de separación de voces avanzados
- **OpenAI**: Para funciones de formateo inteligente (opcional)

## 📞 Soporte

Si encuentras problemas:
1. Revisa los logs en `backend/logs/`
2. Verifica que todas las dependencias estén instaladas
3. Consulta la documentación de la API en http://localhost:8000/docs
4. Revisa los issues en el repositorio de GitHub

## 🔄 Actualización

Para actualizar el sistema:
```bash
# Backend
cd backend
pip install -r requirements.txt --upgrade

# Frontend
cd frontend
npm update
```
