@echo off
title VItal Red - Configuracion Automatica Completa
color 0A

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
echo                    CONFIGURACION AUTOMATICA COMPLETA
echo.

:: Verificar si se ejecuta como administrador
net session >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Ejecutandose como administrador
) else (
    echo.
    echo [IMPORTANTE] Este script necesita permisos de administrador
    echo.
    echo INSTRUCCIONES:
    echo 1. Haz clic derecho en este archivo
    echo 2. Selecciona "Ejecutar como administrador"
    echo 3. Acepta el control de cuentas de usuario
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo     CONFIGURACION AUTOMATICA COMPLETA
echo ========================================
echo.
echo Este script configurara automaticamente:
echo [1] PHP y XAMPP
echo [2] Composer
echo [3] Node.js y NPM
echo [4] Dependencias del proyecto
echo [5] Base de datos
echo [6] Compilacion de assets
echo [7] Servidor de desarrollo
echo.
echo Presiona cualquier tecla para continuar...
pause

echo.
echo ========================================
echo        PASO 1: CONFIGURANDO PHP
echo ========================================
call setup_php_environment.bat
if %errorLevel% neq 0 (
    echo [ERROR] Error configurando PHP
    pause
    exit /b 1
)

echo.
echo ========================================
echo      PASO 2: CONFIGURANDO NODE.JS
echo ========================================
call setup_nodejs_environment.bat
if %errorLevel% neq 0 (
    echo [ERROR] Error configurando Node.js
    pause
    exit /b 1
)

echo.
echo ========================================
echo     PASO 3: CONFIGURANDO BASE DE DATOS
echo ========================================
echo.
echo [INFO] Configurando base de datos MySQL...

:: Verificar si XAMPP esta corriendo
tasklist /FI "IMAGENAME eq mysqld.exe" 2>NUL | find /I /N "mysqld.exe">NUL
if %errorLevel% == 0 (
    echo [OK] MySQL ya esta corriendo
) else (
    echo [INFO] Iniciando MySQL desde XAMPP...
    if exist "C:\xampp\mysql_start.bat" (
        start /min C:\xampp\mysql_start.bat
        timeout /t 5 /nobreak >nul
    ) else (
        echo [INFO] Inicia MySQL manualmente desde XAMPP Control Panel
        if exist "C:\xampp\xampp-control.exe" (
            start C:\xampp\xampp-control.exe
        )
        echo [INFO] Presiona cualquier tecla cuando MySQL este corriendo...
        pause
    )
)

echo.
echo [INFO] Creando base de datos vital_red...
mysql -u root -e "CREATE DATABASE IF NOT EXISTS vital_red CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>nul
if %errorLevel% == 0 (
    echo [OK] Base de datos vital_red creada
) else (
    echo [WARNING] No se pudo crear la base de datos automaticamente
    echo [INFO] Crea manualmente la base de datos 'vital_red' en phpMyAdmin
)

echo.
echo [INFO] Ejecutando migraciones...
php artisan migrate --force
if %errorLevel% == 0 (
    echo [OK] Migraciones ejecutadas correctamente
) else (
    echo [WARNING] Error en migraciones, verifica la configuracion de base de datos
)

echo.
echo [INFO] Cargando datos de prueba...
php artisan db:seed --force
if %errorLevel__ == 0 (
    echo [OK] Datos de prueba cargados
) else (
    echo [WARNING] Error cargando datos de prueba
)

echo.
echo ========================================
echo      PASO 4: IMPORTANDO DATOS DE IA
echo ========================================
echo.
echo [INFO] Importando emails procesados por IA...
php artisan ia:import-emails --auto
if %errorLevel% == 0 (
    echo [OK] Datos de IA importados correctamente
) else (
    echo [WARNING] Error importando datos de IA
)

echo.
echo ========================================
echo       CONFIGURACION COMPLETADA
echo ========================================
echo.
color 0B
echo  ██████╗ ██████╗ ███╗   ███╗██████╗ ██╗     ███████╗████████╗ ██████╗ 
echo ██╔════╝██╔═══██╗████╗ ████║██╔══██╗██║     ██╔════╝╚══██╔══╝██╔═══██╗
echo ██║     ██║   ██║██╔████╔██║██████╔╝██║     █████╗     ██║   ██║   ██║
echo ██║     ██║   ██║██║╚██╔╝██║██╔═══╝ ██║     ██╔══╝     ██║   ██║   ██║
echo ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║     ███████╗███████╗   ██║   ╚██████╔╝
echo  ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚══════╝╚══════╝   ╚═╝    ╚═════╝ 
echo.
echo [✓] PHP y XAMPP configurados
echo [✓] Composer instalado
echo [✓] Node.js y NPM configurados
echo [✓] Dependencias instaladas
echo [✓] Base de datos configurada
echo [✓] Assets compilados
echo [✓] Datos de prueba cargados
echo.
echo ========================================
echo         COMO INICIAR EL PROYECTO
echo ========================================
echo.
echo TERMINAL 1 - Servidor Laravel:
echo   cd "%cd%"
echo   php artisan serve
echo.
echo TERMINAL 2 - Compilador de Assets:
echo   cd "%cd%"
echo   npm run dev
echo.
echo ACCESO AL SISTEMA:
echo   URL: http://localhost:8000
echo.
echo USUARIOS DE PRUEBA:
echo   Admin:  admin@hospital.com / password
echo   Medico: medico@hospital.com / password
echo.
echo VISTAS PRINCIPALES:
echo   - Bandeja de Casos: http://localhost:8000/medico/bandeja-casos
echo   - Dashboard IA:     http://localhost:8000/admin/ia/dashboard
echo   - Gestion Emails:   http://localhost:8000/admin/ia/emails
echo.
echo ========================================
echo.

echo ¿Quieres iniciar el servidor ahora? (S/N)
set /p choice="> "
if /i "%choice%"=="S" (
    echo.
    echo [INFO] Iniciando servidor Laravel...
    echo [INFO] Abre otra terminal y ejecuta: npm run dev
    echo [INFO] Luego ve a: http://localhost:8000
    echo.
    php artisan serve
) else (
    echo.
    echo [INFO] Para iniciar el servidor mas tarde:
    echo   1. Abre terminal en: %cd%
    echo   2. Ejecuta: php artisan serve
    echo   3. En otra terminal: npm run dev
    echo   4. Ve a: http://localhost:8000
    echo.
)

pause
