@echo off
echo ========================================
echo   CONFIGURACION AUTOMATICA NODE.JS
echo   VItal Red - Hospital Universitario
echo ========================================
echo.

echo [1/6] Verificando Node.js...
node --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Node.js ya esta instalado
    node --version
) else (
    echo [INFO] Node.js no encontrado, descargando...
    goto :download_nodejs
)
goto :check_npm

:download_nodejs
echo.
echo [INFO] Abriendo navegador para descargar Node.js...
echo [INFO] Descarga Node.js LTS desde: https://nodejs.org/
start https://nodejs.org/
echo.
echo Presiona cualquier tecla DESPUES de instalar Node.js...
pause

node --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Node.js instalado correctamente
    node --version
) else (
    echo [ERROR] Node.js no se instalo correctamente
    echo [INFO] Reinicia el Command Prompt despues de instalar Node.js
    pause
    exit /b 1
)

:check_npm
echo.
echo [2/6] Verificando NPM...
npm --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] NPM funcionando correctamente
    npm --version
) else (
    echo [ERROR] NPM no funciona correctamente
    pause
    exit /b 1
)

echo.
echo [3/6] Verificando archivo package.json...
if exist "package.json" (
    echo [OK] package.json encontrado
) else (
    echo [ERROR] package.json no encontrado
    echo [INFO] Asegurate de estar en el directorio correcto del proyecto
    pause
    exit /b 1
)

echo.
echo [4/6] Instalando dependencias de Node.js...
echo [INFO] Esto puede tomar varios minutos...
npm install
if %errorLevel% == 0 (
    echo [OK] Dependencias de Node.js instaladas correctamente
) else (
    echo [ERROR] Error instalando dependencias de Node.js
    echo [INFO] Intentando limpiar cache y reinstalar...
    npm cache clean --force
    rmdir /s /q node_modules 2>nul
    npm install
)

echo.
echo [5/6] Verificando dependencias criticas...
echo.
echo Verificando React:
npm list react --depth=0
echo.
echo Verificando Vite:
npm list vite --depth=0
echo.
echo Verificando TypeScript:
npm list typescript --depth=0

echo.
echo [6/6] Compilando assets para desarrollo...
echo [INFO] Compilando assets de React/TypeScript...
npm run build
if %errorLevel% == 0 (
    echo [OK] Assets compilados correctamente
) else (
    echo [WARNING] Error compilando assets, pero el proyecto deberia funcionar
    echo [INFO] Puedes usar 'npm run dev' para desarrollo
)

echo.
echo === CONFIGURACION NODE.JS COMPLETADA ===
echo.
echo [OK] Entorno Node.js configurado correctamente
echo.
echo COMANDOS UTILES PARA DESARROLLO:
echo - Compilar para desarrollo: npm run dev
echo - Compilar para produccion: npm run build
echo - Modo watch (auto-compilar): npm run dev
echo.
echo PROXIMOS PASOS:
echo 1. Abre una nueva terminal
echo 2. Ejecuta: npm run dev (para desarrollo)
echo 3. En otra terminal ejecuta: php artisan serve
echo 4. Abre: http://localhost:8000
echo.

pause
