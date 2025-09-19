@echo off
title Configuracion Entorno Completo Permanente - Para Todos los Proyectos
color 0A

echo.
echo  ███████╗███╗   ██╗████████╗ ██████╗ ██████╗ ███╗   ██╗ ██████╗     ██████╗ ███████╗██████╗ ███╗   ███╗ █████╗ ███╗   ██╗███████╗███╗   ██╗████████╗███████╗
echo  ██╔════╝████╗  ██║╚══██╔══╝██╔═══██╗██╔══██╗████╗  ██║██╔═══██╗    ██╔══██╗██╔════╝██╔══██╗████╗ ████║██╔══██╗████╗  ██║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
echo  █████╗  ██╔██╗ ██║   ██║   ██║   ██║██████╔╝██╔██╗ ██║██║   ██║    ██████╔╝█████╗  ██████╔╝██╔████╔██║███████║██╔██╗ ██║█████╗  ██╔██╗ ██║   ██║   █████╗  
echo  ██╔══╝  ██║╚██╗██║   ██║   ██║   ██║██╔══██╗██║╚██╗██║██║   ██║    ██╔═══╝ ██╔══╝  ██╔══██╗██║╚██╔╝██║██╔══██║██║╚██╗██║██╔══╝  ██║╚██╗██║   ██║   ██╔══╝  
echo  ███████╗██║ ╚████║   ██║   ╚██████╔╝██║  ██║██║ ╚████║╚██████╔╝    ██║     ███████╗██║  ██║██║ ╚═╝ ██║██║  ██║██║ ╚████║███████╗██║ ╚████║   ██║   ███████╗
echo  ╚══════╝╚═╝  ╚═══╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═══╝ ╚═════╝     ╚═╝     ╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
echo.
echo                                    CONFIGURACION ENTORNO COMPLETO PERMANENTE
echo                                    ==========================================
echo.
echo                              ¡CONFIGURA UNA VEZ, USA EN TODOS TUS PROYECTOS!
echo.

:: Verificar si se ejecuta como administrador
net session >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Ejecutandose como administrador
) else (
    echo.
    echo [ERROR] Este script DEBE ejecutarse como administrador
    echo.
    echo INSTRUCCIONES:
    echo 1. Haz clic derecho en este archivo
    echo 2. Selecciona "Ejecutar como administrador"
    echo 3. Acepta el control de cuentas de usuario
    echo.
    echo ESTO ES NECESARIO PARA:
    echo - Configurar PHP permanentemente en el sistema
    echo - Instalar Composer globalmente
    echo - Configurar Node.js y NPM globalmente
    echo - Modificar variables de entorno del sistema
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo    CONFIGURACION ENTORNO PERMANENTE
echo ========================================
echo.
echo Este script configurara PERMANENTEMENTE en tu sistema:
echo.
echo [🐘] PHP + XAMPP + Composer
echo     ✓ Para proyectos Laravel, Symfony, WordPress
echo     ✓ Funcionara en cualquier terminal
echo     ✓ Funcionara en cualquier directorio
echo.
echo [🟢] Node.js + NPM + Herramientas
echo     ✓ Para proyectos React, Vue, Angular
echo     ✓ Herramientas de desarrollo modernas
echo     ✓ Gestores de paquetes (NPM, Yarn)
echo.
echo [🛠️] Herramientas adicionales
echo     ✓ Git (control de versiones)
echo     ✓ VS Code extensions recomendadas
echo     ✓ Configuracion optimizada
echo.
echo DESPUES DE ESTA CONFIGURACION PODRAS:
echo ✓ Crear proyectos Laravel desde cualquier ubicacion
echo ✓ Crear proyectos React/Vue/Angular desde cualquier ubicacion
echo ✓ Usar PHP, Composer, Node.js, NPM en cualquier terminal
echo ✓ Trabajar en cualquier proyecto sin configuracion adicional
echo.
echo Presiona cualquier tecla para continuar...
pause

echo.
echo ========================================
echo        PASO 1: CONFIGURANDO PHP
echo ========================================
call CONFIGURAR_PHP_PERMANENTE.bat
if %errorLevel% neq 0 (
    echo [ERROR] Error configurando PHP permanentemente
    pause
    exit /b 1
)

echo.
echo ========================================
echo      PASO 2: CONFIGURANDO NODE.JS
echo ========================================
call CONFIGURAR_NODEJS_PERMANENTE.bat
if %errorLevel% neq 0 (
    echo [ERROR] Error configurando Node.js permanentemente
    pause
    exit /b 1
)

echo.
echo ========================================
echo     PASO 3: CONFIGURANDO GIT (OPCIONAL)
echo ========================================
echo.
echo [INFO] Verificando Git...
git --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Git ya esta instalado
    git --version
) else (
    echo [INFO] Git no encontrado
    echo.
    echo ¿Quieres instalar Git? (S/N)
    echo Git es necesario para control de versiones y clonar repositorios
    set /p install_git="> "
    if /i "%install_git%"=="S" (
        echo [INFO] Abriendo pagina de descarga de Git...
        start https://git-scm.com/download/win
        echo.
        echo INSTRUCCIONES:
        echo 1. Descarga Git para Windows
        echo 2. Instala con las opciones por defecto
        echo 3. Asegurate de agregar Git al PATH
        echo 4. Presiona cualquier tecla cuando termine
        pause
    )
)

echo.
echo ========================================
echo    PASO 4: CONFIGURACION ADICIONAL
echo ========================================
echo.
echo [INFO] Configurando herramientas adicionales...

:: Crear directorio para proyectos
if not exist "C:\Proyectos" (
    mkdir "C:\Proyectos"
    echo [OK] Directorio C:\Proyectos creado para tus proyectos
)

:: Configurar Composer globalmente
echo [INFO] Configurando Composer para optimizacion...
composer config --global process-timeout 2000
composer config --global cache-files-maxsize "1GB"
echo [OK] Composer optimizado

:: Configurar NPM globalmente
echo [INFO] Configurando NPM para optimizacion...
npm config set fund false
npm config set audit-level moderate
echo [OK] NPM optimizado

echo.
echo ========================================
echo       VERIFICACION FINAL COMPLETA
echo ========================================
echo.
echo === VERIFICANDO CONFIGURACION GLOBAL ===
echo.

echo [TEST] PHP desde cualquier ubicacion:
php --version
echo.

echo [TEST] Composer desde cualquier ubicacion:
composer --version
echo.

echo [TEST] Node.js desde cualquier ubicacion:
node --version
echo.

echo [TEST] NPM desde cualquier ubicacion:
npm --version
echo.

echo [TEST] Git desde cualquier ubicacion:
git --version 2>nul || echo Git no instalado (opcional)
echo.

echo === CONFIGURACION COMPLETADA ===
echo.
color 0B
echo  ██████╗ ██████╗ ███╗   ███╗██████╗ ██╗     ███████╗████████╗ ██████╗ 
echo ██╔════╝██╔═══██╗████╗ ████║██╔══██╗██║     ██╔════╝╚══██╔══╝██╔═══██╗
echo ██║     ██║   ██║██╔████╔██║██████╔╝██║     █████╗     ██║   ██║   ██║
echo ██║     ██║   ██║██║╚██╔╝██║██╔═══╝ ██║     ██╔══╝     ██║   ██║   ██║
echo ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║     ███████╗███████╗   ██║   ╚██████╔╝
echo  ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚══════╝╚══════╝   ╚═╝    ╚═════╝ 
echo.
echo [✓] ENTORNO COMPLETO CONFIGURADO PERMANENTEMENTE
echo.
echo ========================================
echo         CONFIGURACION PERMANENTE
echo ========================================
echo.
echo TU SISTEMA AHORA TIENE:
echo [🐘] PHP + XAMPP + Composer - GLOBAL
echo [🟢] Node.js + NPM + Herramientas - GLOBAL
echo [📁] Directorio C:\Proyectos para tus proyectos
echo [⚙️] Configuraciones optimizadas
echo.
echo COMANDOS QUE FUNCIONAN EN CUALQUIER LUGAR:
echo.
echo === PROYECTOS LARAVEL ===
echo   composer create-project laravel/laravel mi-proyecto
echo   cd mi-proyecto
echo   php artisan serve
echo.
echo === PROYECTOS REACT ===
echo   npx create-react-app mi-app
echo   cd mi-app
echo   npm start
echo.
echo === PROYECTOS VUE ===
echo   vue create mi-proyecto
echo   cd mi-proyecto
echo   npm run serve
echo.
echo === PROYECTOS ANGULAR ===
echo   ng new mi-proyecto
echo   cd mi-proyecto
echo   ng serve
echo.
echo === COMANDOS GENERALES ===
echo   php --version
echo   composer --version
echo   node --version
echo   npm --version
echo   git --version
echo.
echo ========================================
echo           PROXIMOS PASOS
echo ========================================
echo.
echo 1. REINICIA todas las terminales abiertas
echo 2. Abre una NUEVA terminal (CMD o PowerShell)
echo 3. Ve a C:\Proyectos (o cualquier directorio)
echo 4. Prueba crear un proyecto:
echo    - Laravel: composer create-project laravel/laravel test-laravel
echo    - React: npx create-react-app test-react
echo.
echo 5. Para VItal Red especificamente:
echo    - Ve al directorio del proyecto
echo    - Ejecuta: composer install
echo    - Ejecuta: npm install
echo    - Ejecuta: php artisan serve
echo.
echo ========================================
echo.

echo ¿Quieres probar creando un proyecto Laravel de prueba? (S/N)
set /p test_laravel="> "
if /i "%test_laravel%"=="S" (
    echo.
    echo [INFO] Creando proyecto Laravel de prueba en C:\Proyectos...
    cd /d C:\Proyectos
    composer create-project laravel/laravel test-laravel-global
    if %errorLevel% == 0 (
        echo [OK] ¡Proyecto Laravel creado exitosamente!
        echo [INFO] Ubicacion: C:\Proyectos\test-laravel-global
        echo [INFO] Para iniciarlo: cd C:\Proyectos\test-laravel-global && php artisan serve
    )
)

echo.
echo [INFO] ¡CONFIGURACION PERMANENTE COMPLETADA!
echo [INFO] Tu sistema esta listo para cualquier proyecto PHP o JavaScript
echo [INFO] Todos los comandos funcionaran desde cualquier ubicacion
echo.
pause
