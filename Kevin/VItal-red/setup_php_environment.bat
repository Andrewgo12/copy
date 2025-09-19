@echo off
echo ========================================
echo    CONFIGURACION AUTOMATICA PHP
echo    VItal Red - Hospital Universitario
echo ========================================
echo.

:: Verificar si se ejecuta como administrador
net session >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Ejecutandose como administrador
) else (
    echo [ERROR] Este script necesita ejecutarse como administrador
    echo.
    echo Haz clic derecho en el archivo y selecciona "Ejecutar como administrador"
    pause
    exit /b 1
)

echo.
echo [1/8] Verificando si PHP ya esta instalado...
php --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] PHP ya esta instalado y funcionando
    php --version
    goto :check_composer
) else (
    echo [INFO] PHP no encontrado, procediendo con la instalacion...
)

echo.
echo [2/8] Verificando si XAMPP esta instalado...
if exist "C:\xampp\php\php.exe" (
    echo [OK] XAMPP encontrado en C:\xampp
    goto :configure_path
) else (
    echo [INFO] XAMPP no encontrado, descargando...
    goto :download_xampp
)

:download_xampp
echo.
echo [3/8] Descargando XAMPP...
echo [INFO] Abriendo navegador para descargar XAMPP...
echo [INFO] Descarga XAMPP desde: https://www.apachefriends.org/download.html
echo [INFO] Instala en C:\xampp (ruta por defecto)
start https://www.apachefriends.org/download.html

echo.
echo Presiona cualquier tecla DESPUES de instalar XAMPP...
pause

if exist "C:\xampp\php\php.exe" (
    echo [OK] XAMPP instalado correctamente
) else (
    echo [ERROR] XAMPP no se instalo correctamente
    echo Verifica que se instalo en C:\xampp
    pause
    exit /b 1
)

:configure_path
echo.
echo [4/8] Configurando PATH del sistema...

:: Verificar si PHP ya esta en el PATH
echo %PATH% | findstr /i "xampp\php" >nul
if %errorLevel% == 0 (
    echo [OK] PHP ya esta en el PATH del sistema
) else (
    echo [INFO] Agregando PHP al PATH del sistema...
    
    :: Agregar PHP al PATH del sistema
    for /f "tokens=2*" %%a in ('reg query "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v PATH 2^>nul') do set "SYSTEM_PATH=%%b"
    
    :: Verificar si ya existe la ruta
    echo %SYSTEM_PATH% | findstr /i "xampp\php" >nul
    if %errorLevel% == 0 (
        echo [OK] PHP ya esta en el PATH del registro
    ) else (
        echo [INFO] Agregando C:\xampp\php al PATH...
        reg add "HKLM\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v PATH /t REG_EXPAND_SZ /d "%SYSTEM_PATH%;C:\xampp\php" /f >nul
        if %errorLevel% == 0 (
            echo [OK] PATH actualizado correctamente
        ) else (
            echo [ERROR] No se pudo actualizar el PATH
        )
    )
)

:: Actualizar PATH para la sesion actual
set "PATH=%PATH%;C:\xampp\php"

echo.
echo [5/8] Verificando PHP...
C:\xampp\php\php.exe --version
if %errorLevel% == 0 (
    echo [OK] PHP funcionando correctamente
) else (
    echo [ERROR] PHP no funciona correctamente
    pause
    exit /b 1
)

:check_composer
echo.
echo [6/8] Verificando Composer...
composer --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Composer ya esta instalado
    composer --version
) else (
    echo [INFO] Descargando e instalando Composer...
    goto :install_composer
)
goto :configure_project

:install_composer
echo.
echo [INFO] Descargando Composer...
powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/installer' -OutFile 'composer-setup.php'"
if exist "composer-setup.php" (
    echo [OK] Composer descargado
    echo [INFO] Instalando Composer...
    C:\xampp\php\php.exe composer-setup.php --install-dir=C:\xampp\php --filename=composer.phar
    
    :: Crear bat para composer
    echo @echo off > C:\xampp\php\composer.bat
    echo C:\xampp\php\php.exe C:\xampp\php\composer.phar %%* >> C:\xampp\php\composer.bat
    
    del composer-setup.php
    echo [OK] Composer instalado correctamente
) else (
    echo [ERROR] No se pudo descargar Composer
    echo [INFO] Descarga manual desde: https://getcomposer.org/download/
    start https://getcomposer.org/download/
    pause
)

:configure_project
echo.
echo [7/8] Configurando proyecto VItal Red...

:: Verificar que estamos en el directorio correcto
if not exist "artisan" (
    echo [ERROR] No se encontro el archivo artisan
    echo [INFO] Asegurate de ejecutar este script desde el directorio del proyecto VItal-red
    pause
    exit /b 1
)

echo [INFO] Instalando dependencias de Laravel...
composer install
if %errorLevel% == 0 (
    echo [OK] Dependencias de Laravel instaladas
) else (
    echo [ERROR] Error instalando dependencias de Laravel
)

echo.
echo [INFO] Configurando archivo .env...
if not exist ".env" (
    if exist ".env.example" (
        copy ".env.example" ".env"
        echo [OK] Archivo .env creado desde .env.example
    ) else (
        echo [ERROR] No se encontro .env.example
    )
) else (
    echo [OK] Archivo .env ya existe
)

echo.
echo [INFO] Generando clave de aplicacion...
php artisan key:generate
if %errorLevel% == 0 (
    echo [OK] Clave de aplicacion generada
) else (
    echo [ERROR] Error generando clave de aplicacion
)

echo.
echo [8/8] Verificacion final...
echo.
echo === VERIFICACION DE COMPONENTES ===
echo.

echo Verificando PHP:
php --version
echo.

echo Verificando Composer:
composer --version
echo.

echo Verificando Laravel:
php artisan --version
echo.

echo === CONFIGURACION COMPLETADA ===
echo.
echo [OK] Entorno PHP configurado correctamente
echo.
echo PROXIMOS PASOS:
echo 1. Configura tu base de datos en el archivo .env
echo 2. Ejecuta: php artisan migrate
echo 3. Ejecuta: php artisan db:seed
echo 4. Ejecuta: php artisan serve
echo 5. Abre: http://localhost:8000
echo.
echo COMANDOS UTILES:
echo - Iniciar servidor: php artisan serve
echo - Ver rutas: php artisan route:list
echo - Limpiar cache: php artisan cache:clear
echo.

pause
