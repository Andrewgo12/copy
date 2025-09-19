@echo off
echo ========================================
echo    Transcripto KD - Iniciando Backend
echo ========================================
echo.

cd backend

echo Verificando Python...
python --version
if %errorlevel% neq 0 (
    echo Error: Python no encontrado. Por favor instala Python 3.8 o superior.
    pause
    exit /b 1
)

echo.
echo Verificando dependencias...
if not exist "venv" (
    echo Creando entorno virtual...
    python -m venv venv
)

echo Activando entorno virtual...
call venv\Scripts\activate.bat

echo Instalando dependencias...
pip install -r requirements.txt

echo.
echo Copiando archivo de configuracion...
if not exist ".env" (
    copy .env.example .env
    echo Archivo .env creado. Por favor configuralo segun tus necesidades.
)

echo.
echo Creando directorios necesarios...
if not exist "uploads" mkdir uploads
if not exist "uploads\exports" mkdir uploads\exports
if not exist "uploads\temp" mkdir uploads\temp
if not exist "logs" mkdir logs

echo.
echo ========================================
echo    Iniciando servidor FastAPI...
echo ========================================
echo.
echo Backend disponible en: http://localhost:8000
echo Documentacion API en: http://localhost:8000/docs
echo.

uvicorn main:app --reload --host 0.0.0.0 --port 8000

pause
