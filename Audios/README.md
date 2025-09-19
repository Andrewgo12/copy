# Transcripto KD 🎙️

Transcripción inteligente de audios y videos largos con separación por voces y múltiples formatos de exportación.

## 🚀 Características

- ✅ Transcripción de audios y videos hasta 4+ horas
- 🎭 Separación automática por voces (Speaker Diarization)
- ⏰ Organización por bloques de tiempo (timestamps)
- 📄 Exportación en PDF, DOCX y TXT
- 🎨 Formatos: APA, BOEM y Libre
- 📱 Interfaz responsiva y moderna
- 🔄 Procesamiento en tiempo real con actualizaciones de estado

## 🏗️ Arquitectura

```
transcripto-kd/
├── frontend/          # React + Tailwind CSS
├── backend/           # FastAPI + Python
├── transcriber/       # Módulos de transcripción
├── exporter/          # Módulos de exportación
└── uploads/           # Archivos temporales
```

## 🛠️ Tecnologías

### Frontend
- React 18
- Tailwind CSS
- Axios
- React Router

### Backend
- FastAPI
- Whisper (OpenAI)
- pyannote-audio
- python-docx
- reportlab
- ffmpeg-python

## 🚀 Instalación y Uso

### 1. Backend (Python)
```bash
cd backend
pip install -r requirements.txt
uvicorn main:app --reload --port 8000
```

### 2. Frontend (React)
```bash
cd frontend
npm install
npm start
```

### 3. Acceder a la aplicación
- Frontend: http://localhost:3000
- Backend API: http://localhost:8000
- Documentación API: http://localhost:8000/docs

## 📝 API Endpoints

- `POST /upload` - Subir archivo de audio/video
- `GET /status/{task_id}` - Verificar estado del procesamiento
- `GET /result/{task_id}` - Obtener transcripción completa
- `GET /download/{task_id}` - Descargar en formato específico

## 🎯 Uso

1. **Subir archivo**: Arrastra o selecciona tu archivo de audio/video
2. **Procesar**: Espera mientras el sistema transcribe y separa voces
3. **Revisar**: Ve el resultado organizado por voces y timestamps
4. **Descargar**: Exporta en el formato que prefieras (PDF, DOCX, TXT)

## 🔧 Configuración

Crea un archivo `.env` en la carpeta `backend/`:

```env
OPENAI_API_KEY=tu_clave_openai_opcional
HUGGINGFACE_TOKEN=tu_token_huggingface
MAX_FILE_SIZE=500MB
UPLOAD_FOLDER=uploads
```

## 📄 Licencia

MIT License - Ver archivo LICENSE para más detalles.
