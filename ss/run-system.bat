@echo off
echo.
echo ========================================
echo   SISTEMA DE TICKETS - INICIO COMPLETO
echo ========================================
echo.
echo Verificando dependencias...
if not exist node_modules (
    echo Instalando dependencias...
    npm install
)
echo.
echo Iniciando sistema completo...
echo.
echo URLs disponibles:
echo - App completa: http://localhost:3000
echo - MyTickets: http://localhost:3001/mytickets  
echo - GestionTickets: http://localhost:3001/gestiontickets
echo - ClosedTickets: http://localhost:3001/closedtickets
echo.
echo Presiona Ctrl+C para detener
echo.
start /B npm run server
npm start