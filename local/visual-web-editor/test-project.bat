@echo off
echo ========================================
echo Visual Web Editor - Test Script
echo ========================================

echo.
echo 1. Testing file structure...
if exist "backend\src\server.js" (
    echo ✓ Backend server file exists
) else (
    echo ✗ Backend server file missing
)

if exist "frontend\src\App.jsx" (
    echo ✓ Frontend app file exists
) else (
    echo ✗ Frontend app file missing
)

if exist "backend\package.json" (
    echo ✓ Backend package.json exists
) else (
    echo ✗ Backend package.json missing
)

if exist "frontend\package.json" (
    echo ✓ Frontend package.json exists
) else (
    echo ✗ Frontend package.json missing
)

echo.
echo 2. Testing Node.js installation...
node --version
if %errorlevel% equ 0 (
    echo ✓ Node.js is installed
) else (
    echo ✗ Node.js is not installed or not in PATH
)

echo.
echo 3. Testing npm installation...
npm --version
if %errorlevel% equ 0 (
    echo ✓ npm is installed
) else (
    echo ✗ npm is not installed or not in PATH
)

echo.
echo 4. Testing backend dependencies...
cd backend
if exist "node_modules" (
    echo ✓ Backend node_modules exists
) else (
    echo ✗ Backend node_modules missing - run 'npm install'
)
cd ..

echo.
echo 5. Testing frontend dependencies...
cd frontend
if exist "node_modules" (
    echo ✓ Frontend node_modules exists
) else (
    echo ✗ Frontend node_modules missing - run 'npm install'
)
cd ..

echo.
echo 6. Testing environment files...
if exist "backend\.env" (
    echo ✓ Backend .env exists
) else (
    echo ✗ Backend .env missing - copy from .env.example
)

if exist "frontend\.env" (
    echo ✓ Frontend .env exists
) else (
    echo ✗ Frontend .env missing - copy from .env.example
)

echo.
echo ========================================
echo Test completed!
echo ========================================
echo.
echo To start the project manually:
echo 1. Open terminal in 'backend' folder and run: npm start
echo 2. Open another terminal in 'frontend' folder and run: npm start
echo 3. Open browser to http://localhost:3002
echo.
pause
