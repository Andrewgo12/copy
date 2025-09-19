@echo off
title VItal Red - Inicio Rapido
color 0B

echo.
echo  ██╗   ██╗██╗████████╗ █████╗ ██╗         ██████╗ ███████╗██████╗ 
echo  ██║   ██║██║╚══██╔══╝██╔══██╗██║         ██╔══██╗██╔════╝██╔══██╗
echo  ██║   ██║██║   ██║   ███████║██║         ██████╔╝█████╗  ██║  ██║
echo  ╚██╗ ██╔╝██║   ██║   ██╔══██║██║         ██╔══██╗██╔══╝  ██║  ██║
echo   ╚████╔╝ ██║   ██║   ██║  ██║███████╗    ██║  ██║███████╗██████╔╝
echo    ╚═══╝  ╚═╝   ╚═╝   ╚═╝  ╚═╝╚══════╝    ╚═╝  ╚═╝╚══════╝╚═════╝ 
echo.
echo            HOSPITAL UNIVERSITARIO ESE - SISTEMA DE REFERENCIA
echo            ================================================
echo.
echo                         INICIO RAPIDO DEL PROYECTO
echo.

echo [INFO] Verificando entorno...

:: Verificar PHP
php --version >nul 2>&1
if %errorLevel__ == 0 (
    echo [✓] PHP funcionando
) else (
    echo [✗] PHP no encontrado
    echo [INFO] Ejecuta primero: CONFIGURAR_TODO.bat
    pause
    exit /b 1
)

:: Verificar Composer
composer --version >nul 2>&1
if %errorLevel__ == 0 (
    echo [✓] Composer funcionando
) else (
    echo [✗] Composer no encontrado
    echo [INFO] Ejecuta primero: CONFIGURAR_TODO.bat
    pause
    exit /b 1
)

:: Verificar Node.js
node --version >nul 2>&1
if %errorLevel__ == 0 (
    echo [✓] Node.js funcionando
) else (
    echo [✗] Node.js no encontrado
    echo [INFO] Ejecuta primero: CONFIGURAR_TODO.bat
    pause
    exit /b 1
)

:: Verificar archivo .env
if exist ".env" (
    echo [✓] Configuracion encontrada
) else (
    echo [✗] Archivo .env no encontrado
    echo [INFO] Ejecuta primero: CONFIGURAR_TODO.bat
    pause
    exit /b 1
)

echo.
echo [INFO] Verificando MySQL...
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if %errorLevel__ == 0 (
    echo [✓] MySQL corriendo
) else (
    echo [!] MySQL no esta corriendo
    echo [INFO] Iniciando XAMPP Control Panel...
    if exist "C:\xampp\xampp-control.exe" (
        start C:\xampp\xampp-control.exe
        echo [INFO] Inicia MySQL desde XAMPP y presiona cualquier tecla...
        pause
    ) else (
        echo [ERROR] XAMPP no encontrado
        echo [INFO] Ejecuta primero: CONFIGURAR_TODO.bat
        pause
        exit /b 1
    )
)

echo.
echo ========================================
echo           OPCIONES DE INICIO
echo ========================================
echo.
echo [1] Iniciar servidor completo (Laravel + Assets)
echo [2] Solo servidor Laravel
echo [3] Solo compilador de assets
echo [4] Verificar estado del proyecto
echo [5] Limpiar cache y reiniciar
echo [6] Salir
echo.
set /p option="Selecciona una opcion (1-6): "

if "%option%"=="1" goto :start_full
if "%option%"=="2" goto :start_laravel
if "%option%"=="3" goto :start_assets
if "%option%"=="4" goto :check_status
if "%option%"=="5" goto :clear_cache
if "%option%"=="6" goto :exit
goto :invalid_option

:start_full
echo.
echo [INFO] Iniciando servidor completo...
echo [INFO] Se abriran 2 ventanas:
echo   - Servidor Laravel (puerto 8000)
echo   - Compilador de assets (Vite)
echo.
echo [INFO] Iniciando compilador de assets...
start "VItal Red - Assets" cmd /k "npm run dev"
timeout /t 3 /nobreak >nul

echo [INFO] Iniciando servidor Laravel...
echo [INFO] El proyecto estara disponible en: http://localhost:8000
echo.
php artisan serve
goto :end

:start_laravel
echo.
echo [INFO] Iniciando solo servidor Laravel...
echo [INFO] El proyecto estara disponible en: http://localhost:8000
echo [WARNING] Recuerda compilar assets con: npm run build
echo.
php artisan serve
goto :end

:start_assets
echo.
echo [INFO] Iniciando solo compilador de assets...
echo [INFO] Los assets se compilaran automaticamente al hacer cambios
echo.
npm run dev
goto :end

:check_status
echo.
echo ========================================
echo        ESTADO DEL PROYECTO
echo ========================================
echo.
echo PHP Version:
php --version
echo.
echo Laravel Version:
php artisan --version
echo.
echo Node.js Version:
node --version
echo.
echo NPM Version:
npm --version
echo.
echo Composer Version:
composer --version
echo.
echo Estado de la base de datos:
php artisan migrate:status
echo.
echo Rutas disponibles:
php artisan route:list --compact
echo.
pause
goto :start

:clear_cache
echo.
echo [INFO] Limpiando cache del proyecto...
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
echo [OK] Cache limpiado
echo.
echo [INFO] Reinstalando dependencias...
composer install
npm install
echo [OK] Dependencias actualizadas
echo.
echo [INFO] Recompilando assets...
npm run build
echo [OK] Assets recompilados
echo.
echo [✓] Proyecto limpio y actualizado
pause
goto :start

:invalid_option
echo.
echo [ERROR] Opcion invalida
pause
goto :start

:exit
echo.
echo [INFO] Saliendo...
goto :end

:end
echo.
echo ========================================
echo.
echo ACCESO AL SISTEMA:
echo   URL: http://localhost:8000
echo.
echo USUARIOS DE PRUEBA:
echo   Admin:  admin@hospital.com / password
echo   Medico: medico@hospital.com / password
echo.
echo VISTAS PRINCIPALES:
echo   - Login:           http://localhost:8000/login
echo   - Bandeja Casos:   http://localhost:8000/medico/bandeja-casos
echo   - Dashboard IA:    http://localhost:8000/admin/ia/dashboard
echo   - Gestion Emails:  http://localhost:8000/admin/ia/emails
echo.
echo ========================================
echo.
pause
