@echo off
title Configuracion PHP Permanente - Para Todos los Proyectos
color 0A

echo.
echo  ██████╗ ██╗  ██╗██████╗     ██████╗ ███████╗██████╗ ███╗   ███╗ █████╗ ███╗   ██╗███████╗███╗   ██╗████████╗███████╗
echo  ██╔══██╗██║  ██║██╔══██╗    ██╔══██╗██╔════╝██╔══██╗████╗ ████║██╔══██╗████╗  ██║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
echo  ██████╔╝███████║██████╔╝    ██████╔╝█████╗  ██████╔╝██╔████╔██║███████║██╔██╗ ██║█████╗  ██╔██╗ ██║   ██║   █████╗  
echo  ██╔═══╝ ██╔══██║██╔═══╝     ██╔═══╝ ██╔══╝  ██╔══██╗██║╚██╔╝██║██╔══██║██║╚██╗██║██╔══╝  ██║╚██╗██║   ██║   ██╔══╝  
echo  ██║     ██║  ██║██║         ██║     ███████╗██║  ██║██║ ╚═╝ ██║██║  ██║██║ ╚████║███████╗██║ ╚████║   ██║   ███████╗
echo  ╚═╝     ╚═╝  ╚═╝╚═╝         ╚═╝     ╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
echo.
echo                           CONFIGURACION PHP PERMANENTE PARA TODO EL SISTEMA
echo                           ===================================================
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
    echo - Agregar PHP al PATH del sistema permanentemente
    echo - Instalar Composer globalmente
    echo - Configurar variables de entorno
    echo.
    pause
    exit /b 1
)

echo.
echo ========================================
echo    CONFIGURACION PHP PERMANENTE
echo ========================================
echo.
echo Este script configurara PHP permanentemente en tu sistema para que funcione en:
echo [✓] Cualquier proyecto Laravel
echo [✓] Cualquier proyecto PHP
echo [✓] Cualquier terminal (CMD, PowerShell, Git Bash)
echo [✓] Cualquier IDE (VS Code, PhpStorm, etc.)
echo.
echo Presiona cualquier tecla para continuar...
pause

echo.
echo [1/7] Verificando si PHP ya esta configurado globalmente...
php --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] PHP ya esta funcionando globalmente
    php --version
    echo.
    echo ¿Quieres reinstalar/actualizar PHP? (S/N)
    set /p reinstall="> "
    if /i not "%reinstall%"=="S" goto :check_composer
) else (
    echo [INFO] PHP no encontrado globalmente, procediendo con la instalacion...
)

echo.
echo [2/7] Verificando/Instalando XAMPP...
if exist "C:\xampp\php\php.exe" (
    echo [OK] XAMPP encontrado en C:\xampp
) else (
    echo [INFO] XAMPP no encontrado, necesitas instalarlo...
    echo.
    echo OPCIONES:
    echo [1] Descargar XAMPP automaticamente (recomendado)
    echo [2] Ya tengo XAMPP instalado en otra ubicacion
    echo [3] Instalar PHP standalone (avanzado)
    echo.
    set /p xampp_option="Selecciona una opcion (1-3): "
    
    if "%xampp_option%"=="1" goto :download_xampp
    if "%xampp_option%"=="2" goto :custom_xampp
    if "%xampp_option%"=="3" goto :standalone_php
    goto :download_xampp
)
goto :configure_path

:download_xampp
echo.
echo [INFO] Abriendo navegador para descargar XAMPP...
echo.
echo INSTRUCCIONES IMPORTANTES:
echo 1. Se abrira la pagina de descarga de XAMPP
echo 2. Descarga la version mas reciente para Windows
echo 3. Ejecuta el instalador
echo 4. IMPORTANTE: Instala en C:\xampp (ruta por defecto)
echo 5. Selecciona al menos: Apache, MySQL, PHP, phpMyAdmin
echo 6. Completa la instalacion
echo 7. Vuelve aqui y presiona cualquier tecla
echo.
start https://www.apachefriends.org/download.html
echo Presiona cualquier tecla DESPUES de instalar XAMPP...
pause

if exist "C:\xampp\php\php.exe" (
    echo [OK] XAMPP instalado correctamente en C:\xampp
) else (
    echo [ERROR] XAMPP no se encontro en C:\xampp
    echo Verifica que se instalo correctamente en esa ubicacion
    pause
    exit /b 1
)
goto :configure_path

:custom_xampp
echo.
echo [INFO] Ingresa la ruta donde esta instalado XAMPP:
echo Ejemplo: C:\xampp o D:\xampp
set /p xampp_path="Ruta de XAMPP: "

if exist "%xampp_path%\php\php.exe" (
    echo [OK] PHP encontrado en %xampp_path%\php
    set "PHP_PATH=%xampp_path%\php"
) else (
    echo [ERROR] No se encontro PHP en %xampp_path%\php
    echo Verifica la ruta e intentalo de nuevo
    pause
    exit /b 1
)
goto :configure_custom_path

:standalone_php
echo.
echo [INFO] Configuracion PHP standalone...
echo Esta opcion es para usuarios avanzados
echo Se recomienda usar XAMPP para facilidad de uso
echo.
echo ¿Estas seguro? (S/N)
set /p confirm=""> "
if /i not "%confirm%"=="S" goto :download_xampp

echo [INFO] Descargando PHP standalone...
echo [INFO] Abriendo pagina de descarga...
start https://windows.php.net/download/
echo.
echo INSTRUCCIONES:
echo 1. Descarga "Thread Safe" version
echo 2. Extrae en C:\php
echo 3. Configura php.ini manualmente
echo 4. Vuelve aqui cuando termine
pause

if exist "C:\php\php.exe" (
    set "PHP_PATH=C:\php"
    echo [OK] PHP standalone encontrado
) else (
    echo [ERROR] PHP no encontrado en C:\php
    pause
    exit /b 1
)
goto :configure_custom_path

:configure_path
set "PHP_PATH=C:\xampp\php"

:configure_custom_path
echo.
echo [3/7] Configurando PATH del sistema permanentemente...

:: Obtener PATH actual del sistema
for /f "tokens=2*" %%a in ('reg query "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v PATH 2^>nul') do set "SYSTEM_PATH=%%b"

:: Verificar si PHP ya esta en el PATH
echo %SYSTEM_PATH% | findstr /i "%PHP_PATH%" >nul
if %errorLevel% == 0 (
    echo [OK] PHP ya esta en el PATH del sistema
) else (
    echo [INFO] Agregando %PHP_PATH% al PATH del sistema...
    
    :: Agregar PHP al PATH del sistema permanentemente
    reg add "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v PATH /t REG_EXPAND_SZ /d "%SYSTEM_PATH%;%PHP_PATH%" /f >nul
    if %errorLevel% == 0 (
        echo [OK] PHP agregado al PATH permanentemente
    ) else (
        echo [ERROR] No se pudo agregar PHP al PATH
        echo Verifica que tienes permisos de administrador
        pause
        exit /b 1
    )
)

:: Actualizar PATH para la sesion actual
set "PATH=%PATH%;%PHP_PATH%"

echo.
echo [4/7] Verificando PHP...
"%PHP_PATH%\php.exe" --version
if %errorLevel% == 0 (
    echo [OK] PHP funcionando correctamente
) else (
    echo [ERROR] PHP no funciona correctamente
    pause
    exit /b 1
)

:check_composer
echo.
echo [5/7] Verificando/Instalando Composer globalmente...
composer --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Composer ya esta instalado globalmente
    composer --version
) else (
    echo [INFO] Instalando Composer globalmente...
    goto :install_composer_global
)
goto :configure_extensions

:install_composer_global
echo.
echo [INFO] Descargando Composer...
powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/installer' -OutFile 'composer-setup.php'"
if exist "composer-setup.php" (
    echo [OK] Composer descargado
    
    echo [INFO] Instalando Composer globalmente...
    "%PHP_PATH%\php.exe" composer-setup.php --install-dir="%PHP_PATH%" --filename=composer.phar
    
    :: Crear bat global para composer
    echo @echo off > "%PHP_PATH%\composer.bat"
    echo "%PHP_PATH%\php.exe" "%PHP_PATH%\composer.phar" %%* >> "%PHP_PATH%\composer.bat"
    
    del composer-setup.php
    echo [OK] Composer instalado globalmente
) else (
    echo [ERROR] No se pudo descargar Composer
    echo [INFO] Instalacion manual desde: https://getcomposer.org/download/
    start https://getcomposer.org/download/
    pause
)

:configure_extensions
echo.
echo [6/7] Configurando extensiones PHP necesarias...

:: Verificar si php.ini existe
if exist "%PHP_PATH%\php.ini" (
    echo [OK] php.ini encontrado
) else (
    if exist "%PHP_PATH%\php.ini-development" (
        echo [INFO] Creando php.ini desde php.ini-development...
        copy "%PHP_PATH%\php.ini-development" "%PHP_PATH%\php.ini"
        echo [OK] php.ini creado
    ) else (
        echo [WARNING] php.ini no encontrado, algunas extensiones pueden no funcionar
    )
)

:: Habilitar extensiones necesarias
if exist "%PHP_PATH%\php.ini" (
    echo [INFO] Habilitando extensiones necesarias...
    
    :: Crear script temporal para habilitar extensiones
    echo $phpini = Get-Content "%PHP_PATH%\php.ini" > enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=curl', 'extension=curl' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=fileinfo', 'extension=fileinfo' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=gd', 'extension=gd' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=mbstring', 'extension=mbstring' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=openssl', 'extension=openssl' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=pdo_mysql', 'extension=pdo_mysql' >> enable_extensions.ps1
    echo $phpini = $phpini -replace ';extension=zip', 'extension=zip' >> enable_extensions.ps1
    echo Set-Content "%PHP_PATH%\php.ini" $phpini >> enable_extensions.ps1
    
    powershell -ExecutionPolicy Bypass -File enable_extensions.ps1
    del enable_extensions.ps1
    
    echo [OK] Extensiones habilitadas
)

echo.
echo [7/7] Verificacion final completa...
echo.
echo === VERIFICACION DE CONFIGURACION GLOBAL ===
echo.

echo Verificando PHP desde cualquier ubicacion:
php --version
echo.

echo Verificando Composer desde cualquier ubicacion:
composer --version
echo.

echo Verificando extensiones criticas:
php -m | findstr curl
php -m | findstr pdo_mysql
php -m | findstr mbstring
php -m | findstr openssl
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
echo [✓] PHP configurado PERMANENTEMENTE en el sistema
echo [✓] Composer instalado GLOBALMENTE
echo [✓] Extensiones necesarias habilitadas
echo [✓] PATH del sistema actualizado
echo.
echo ========================================
echo         CONFIGURACION PERMANENTE
echo ========================================
echo.
echo AHORA PUEDES USAR PHP EN:
echo [✓] Cualquier terminal (CMD, PowerShell, Git Bash)
echo [✓] Cualquier directorio de tu sistema
echo [✓] Cualquier proyecto Laravel/PHP
echo [✓] Cualquier IDE (VS Code, PhpStorm, etc.)
echo.
echo COMANDOS QUE FUNCIONARAN EN CUALQUIER LUGAR:
echo   php --version
echo   composer --version
echo   php artisan serve (en proyectos Laravel)
echo   composer install
echo   composer create-project laravel/laravel mi-proyecto
echo.
echo PARA PROBAR LA CONFIGURACION:
echo 1. Abre una NUEVA terminal (CMD o PowerShell)
echo 2. Ve a cualquier directorio
echo 3. Ejecuta: php --version
echo 4. Ejecuta: composer --version
echo.
echo ¡REINICIA todas las terminales abiertas para que tomen la nueva configuracion!
echo.
echo ========================================
echo.

echo ¿Quieres probar la configuracion ahora? (S/N)
set /p test_config="> "
if /i "%test_config%"=="S" (
    echo.
    echo [INFO] Abriendo nueva terminal para probar...
    start cmd /k "echo Probando configuracion PHP global... && echo. && php --version && echo. && composer --version && echo. && echo ¡PHP configurado correctamente! && echo Presiona cualquier tecla para cerrar... && pause"
)

echo.
echo [INFO] Configuracion completada exitosamente
echo [INFO] Reinicia todas las terminales para aplicar cambios
echo [INFO] PHP y Composer ahora funcionaran en cualquier proyecto
echo.
pause
