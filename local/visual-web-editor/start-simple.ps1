Write-Host "Starting Visual Web Editor..." -ForegroundColor Green

# Start backend in new window
Write-Host "Starting backend server..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\backend'; npm start"

# Wait 3 seconds
Start-Sleep -Seconds 3

# Start frontend in new window  
Write-Host "Starting frontend application..." -ForegroundColor Yellow
Start-Process powershell -ArgumentList "-NoExit", "-Command", "cd '$PWD\frontend'; npm start"

# Wait 5 seconds for services to start
Start-Sleep -Seconds 5

# Open browser
Write-Host "Opening browser..." -ForegroundColor Green
Start-Process "http://localhost:3002"

Write-Host ""
Write-Host "Visual Web Editor is starting!" -ForegroundColor Green
Write-Host "Frontend: http://localhost:3002" -ForegroundColor Cyan
Write-Host "Backend: http://localhost:3001" -ForegroundColor Cyan
Write-Host ""
Write-Host "Press Enter to continue..."
Read-Host
