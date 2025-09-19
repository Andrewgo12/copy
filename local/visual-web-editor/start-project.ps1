# Visual Web Editor - PowerShell Startup Script

Write-Host "Starting Visual Web Editor..." -ForegroundColor Green
Write-Host "=================================" -ForegroundColor Green

# Function to check if port is in use
function Test-Port {
    param([int]$Port)
    try {
        $connection = New-Object System.Net.Sockets.TcpClient
        $connection.Connect("localhost", $Port)
        $connection.Close()
        return $true
    }
    catch {
        return $false
    }
}

# Check if ports are available
Write-Host "Checking ports..." -ForegroundColor Yellow
if (Test-Port 3001) {
    Write-Host "WARNING: Port 3001 is already in use" -ForegroundColor Red
} else {
    Write-Host "OK: Port 3001 is available" -ForegroundColor Green
}

if (Test-Port 3002) {
    Write-Host "WARNING: Port 3002 is already in use" -ForegroundColor Red
} else {
    Write-Host "OK: Port 3002 is available" -ForegroundColor Green
}

# Start backend
Write-Host "Starting backend server..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\backend'; npm start" -WindowStyle Normal

# Wait a bit for backend to start
Start-Sleep -Seconds 3

# Start frontend
Write-Host "Starting frontend application..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\frontend'; npm start" -WindowStyle Normal

# Wait for services to start
Write-Host "Waiting for services to start..." -ForegroundColor Yellow
Start-Sleep -Seconds 5

# Check if services are running
Write-Host "Checking service status..." -ForegroundColor Yellow

try {
    $backendResponse = Invoke-WebRequest -Uri "http://localhost:3001/api/health" -TimeoutSec 5 -ErrorAction Stop
    Write-Host "SUCCESS: Backend is running on http://localhost:3001" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Backend is not responding on http://localhost:3001" -ForegroundColor Red
}

try {
    $frontendResponse = Invoke-WebRequest -Uri "http://localhost:3002" -TimeoutSec 5 -ErrorAction Stop
    Write-Host "SUCCESS: Frontend is running on http://localhost:3002" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Frontend is not responding on http://localhost:3002" -ForegroundColor Red
}

Write-Host ""
Write-Host "Opening browser..." -ForegroundColor Green
Start-Process "http://localhost:3002"

Write-Host ""
Write-Host "Visual Web Editor is starting!" -ForegroundColor Green
Write-Host "Frontend: http://localhost:3002" -ForegroundColor Cyan
Write-Host "Backend API: http://localhost:3001" -ForegroundColor Cyan
Write-Host "Health Check: http://localhost:3001/api/health" -ForegroundColor Cyan
Write-Host ""
Write-Host "Press any key to exit..." -ForegroundColor Yellow
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
