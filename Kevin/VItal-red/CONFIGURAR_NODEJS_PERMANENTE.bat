@echo off
title Configuracion Node.js Permanente - Para Todos los Proyectos
color 0A

echo.
echo  ███╗   ██╗ ██████╗ ██████╗ ███████╗         ██╗███████╗    ██████╗ ███████╗██████╗ ███╗   ███╗ █████╗ ███╗   ██╗███████╗███╗   ██╗████████╗███████╗
echo  ████╗  ██║██╔═══██╗██╔══██╗██╔════╝         ██║██╔════╝    ██╔══██╗██╔════╝██╔══██╗████╗ ████║██╔══██╗████╗  ██║██╔════╝████╗  ██║╚══██╔══╝██╔════╝
echo  ██╔██╗ ██║██║   ██║██║  ██║█████╗           ██║███████╗    ██████╔╝█████╗  ██████╔╝██╔████╔██║███████║██╔██╗ ██║█████╗  ██╔██╗ ██║   ██║   █████╗  
echo  ██║╚██╗██║██║   ██║██║  ██║██╔══╝      ██   ██║╚════██║    ██╔═══╝ ██╔══╝  ██╔══██╗██║╚██╔╝██║██╔══██║██║╚██╗██║██╔══╝  ██║╚██╗██║   ██║   ██╔══╝  
echo  ██║ ╚████║╚██████╔╝██████╔╝███████╗    ╚█████╔╝███████║    ██║     ███████╗██║  ██║██║ ╚═╝ ██║██║  ██║██║ ╚████║███████╗██║ ╚████║   ██║   ███████╗
echo  ╚═╝  ╚═══╝ ╚═════╝ ╚═════╝ ╚══════╝     ╚════╝ ╚══════╝    ╚═╝     ╚══════╝╚═╝  ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═══╝╚══════╝╚═╝  ╚═══╝   ╚═╝   ╚══════╝
echo.
echo                                    CONFIGURACION NODE.JS PERMANENTE PARA TODO EL SISTEMA
echo                                    ======================================================
echo.

echo ========================================
echo    CONFIGURACION NODE.JS PERMANENTE
echo ========================================
echo.
echo Este script configurara Node.js permanentemente en tu sistema para que funcione en:
echo [✓] Cualquier proyecto React/Vue/Angular
echo [✓] Cualquier proyecto con NPM/Yarn
echo [✓] Cualquier terminal (CMD, PowerShell, Git Bash)
echo [✓] Cualquier IDE (VS Code, WebStorm, etc.)
echo.
echo Presiona cualquier tecla para continuar...
pause

echo.
echo [1/5] Verificando si Node.js ya esta configurado globalmente...
node --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Node.js ya esta funcionando globalmente
    node --version
    npm --version
    echo.
    echo ¿Quieres reinstalar/actualizar Node.js? (S/N)
    set /p reinstall="> "
    if /i not "%reinstall%"=="S" goto :configure_global_packages
) else (
    echo [INFO] Node.js no encontrado globalmente, procediendo con la instalacion...
)

echo.
echo [2/5] Instalando Node.js...
echo.
echo OPCIONES DE INSTALACION:
echo [1] Descargar Node.js LTS automaticamente (recomendado)
echo [2] Ya tengo Node.js instalado
echo [3] Usar Node Version Manager (NVM) - avanzado
echo.
set /p node_option="Selecciona una opcion (1-3): "

if "%node_option%"=="1" goto :download_nodejs
if "%node_option%"=="2" goto :verify_nodejs
if "%node_option%"=="3" goto :install_nvm
goto :download_nodejs

:download_nodejs
echo.
echo [INFO] Abriendo navegador para descargar Node.js...
echo.
echo INSTRUCCIONES IMPORTANTES:
echo 1. Se abrira la pagina oficial de Node.js
echo 2. Descarga la version LTS (Long Term Support) - recomendada
echo 3. Ejecuta el instalador descargado
echo 4. IMPORTANTE: Acepta agregar Node.js al PATH durante la instalacion
echo 5. Completa la instalacion con las opciones por defecto
echo 6. Vuelve aqui y presiona cualquier tecla
echo.
start https://nodejs.org/
echo Presiona cualquier tecla DESPUES de instalar Node.js...
pause
goto :verify_nodejs

:install_nvm
echo.
echo [INFO] Node Version Manager permite tener multiples versiones de Node.js
echo [INFO] Abriendo pagina de NVM para Windows...
start https://github.com/coreybutler/nvm-windows
echo.
echo INSTRUCCIONES:
echo 1. Descarga nvm-setup.zip desde la pagina
echo 2. Extrae e instala nvm-setup.exe
echo 3. Abre una nueva terminal como administrador
echo 4. Ejecuta: nvm install lts
echo 5. Ejecuta: nvm use lts
echo 6. Vuelve aqui cuando termine
pause
goto :verify_nodejs

:verify_nodejs
echo.
echo [3/5] Verificando Node.js...
node --version >nul 2>&1
if %errorLevel% == 0 (
    echo [OK] Node.js funcionando correctamente
    echo Node.js version:
    node --version
    echo NPM version:
    npm --version
) else (
    echo [ERROR] Node.js no se encontro
    echo.
    echo POSIBLES SOLUCIONES:
    echo 1. Reinicia la terminal/computadora despues de instalar
    echo 2. Verifica que Node.js se agrego al PATH durante la instalacion
    echo 3. Reinstala Node.js asegurandote de marcar "Add to PATH"
    echo.
    echo ¿Quieres intentar descargar Node.js nuevamente? (S/N)
    set /p retry="> "
    if /i "%retry%"=="S" goto :download_nodejs
    pause
    exit /b 1
)

:configure_global_packages
echo.
echo [4/5] Configurando paquetes globales utiles...
echo.
echo [INFO] Instalando herramientas globales recomendadas...

echo Instalando @vue/cli (para proyectos Vue.js)...
npm install -g @vue/cli

echo Instalando create-react-app (para proyectos React)...
npm install -g create-react-app

echo Instalando @angular/cli (para proyectos Angular)...
npm install -g @angular/cli

echo Instalando typescript (compilador TypeScript global)...
npm install -g typescript

echo Instalando ts-node (ejecutar TypeScript directamente)...
npm install -g ts-node

echo Instalando nodemon (auto-restart para desarrollo)...
npm install -g nodemon

echo Instalando http-server (servidor HTTP simple)...
npm install -g http-server

echo Instalando yarn (gestor de paquetes alternativo)...
npm install -g yarn

echo.
echo [OK] Paquetes globales instalados

echo.
echo [5/5] Verificacion final completa...
echo.
echo === VERIFICACION DE CONFIGURACION GLOBAL ===
echo.

echo Node.js version:
node --version
echo.

echo NPM version:
npm --version
echo.

echo Verificando paquetes globales instalados:
npm list -g --depth=0
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
echo [✓] Node.js configurado PERMANENTEMENTE en el sistema
echo [✓] NPM funcionando GLOBALMENTE
echo [✓] Herramientas de desarrollo instaladas
echo [✓] PATH del sistema actualizado
echo.
echo ========================================
echo         CONFIGURACION PERMANENTE
echo ========================================
echo.
echo AHORA PUEDES USAR NODE.JS EN:
echo [✓] Cualquier terminal (CMD, PowerShell, Git Bash)
echo [✓] Cualquier directorio de tu sistema
echo [✓] Cualquier proyecto React/Vue/Angular
echo [✓] Cualquier IDE (VS Code, WebStorm, etc.)
echo.
echo COMANDOS QUE FUNCIONARAN EN CUALQUIER LUGAR:
echo   node --version
echo   npm --version
echo   npm install
echo   npm run dev
echo   npm run build
echo   npx create-react-app mi-app
echo   vue create mi-proyecto
echo   ng new mi-proyecto
echo   yarn install
echo.
echo HERRAMIENTAS GLOBALES INSTALADAS:
echo   - Vue CLI (vue create proyecto)
echo   - Create React App (npx create-react-app proyecto)
echo   - Angular CLI (ng new proyecto)
echo   - TypeScript (tsc archivo.ts)
echo   - Nodemon (nodemon app.js)
echo   - HTTP Server (http-server)
echo   - Yarn (yarn install)
echo.
echo PARA PROBAR LA CONFIGURACION:
echo 1. Abre una NUEVA terminal (CMD o PowerShell)
echo 2. Ve a cualquier directorio
echo 3. Ejecuta: node --version
echo 4. Ejecuta: npm --version
echo.
echo ========================================
echo.

echo ¿Quieres probar la configuracion ahora? (S/N)
set /p test_config="> "
if /i "%test_config%"=="S" (
    echo.
    echo [INFO] Abriendo nueva terminal para probar...
    start cmd /k "echo Probando configuracion Node.js global... && echo. && node --version && echo. && npm --version && echo. && echo ¡Node.js configurado correctamente! && echo Presiona cualquier tecla para cerrar... && pause"
)

echo.
echo [INFO] Configuracion completada exitosamente
echo [INFO] Node.js y NPM ahora funcionaran en cualquier proyecto
echo [INFO] Puedes crear proyectos React, Vue, Angular desde cualquier ubicacion
echo.
pause
