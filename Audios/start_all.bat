@echo off
echo ========================================
echo      Transcripto KD - Inicio Completo
echo ========================================
echo.
echo Iniciando backend y frontend simultaneamente...
echo.

echo Abriendo terminal para backend...
start "Transcripto KD - Backend" cmd /k "start_backend.bat"

echo Esperando 10 segundos para que el backend inicie...
timeout /t 10 /nobreak

echo Abriendo terminal para frontend...
start "Transcripto KD - Frontend" cmd /k "start_frontend.bat"

echo.
echo ========================================
echo           Sistema iniciado
echo ========================================
echo.
echo Backend: http://localhost:8000
echo Frontend: http://localhost:3000
echo API Docs: http://localhost:8000/docs
echo.
echo Presiona cualquier tecla para cerrar esta ventana...
pause > nul
