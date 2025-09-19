@echo off
echo ========================================
echo   Transcripto KD - Iniciando Frontend
echo ========================================
echo.

cd frontend

echo Verificando Node.js...
node --version
if %errorlevel% neq 0 (
    echo Error: Node.js no encontrado. Por favor instala Node.js 16 o superior.
    pause
    exit /b 1
)

echo Verificando npm...
npm --version
if %errorlevel% neq 0 (
    echo Error: npm no encontrado.
    pause
    exit /b 1
)

echo.
echo Instalando dependencias...
npm install

echo.
echo ========================================
echo    Iniciando servidor de desarrollo...
echo ========================================
echo.
echo Frontend disponible en: http://localhost:3000
echo.
echo IMPORTANTE: Asegurate de que el backend este ejecutandose en http://localhost:8000
echo.

npm start

pause
