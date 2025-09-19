<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Sistema CROSS API',
        'framework' => 'Laravel ' . app()->version(),
        'database' => 'PostgreSQL',
        'tables' => 146,
        'status' => 'active'
    ]);
});

// System routes
Route::prefix('api')->group(function () {
    Route::get('/system/info', [SystemController::class, 'getSystemInfo']);
    Route::get('/system/stats', [SystemController::class, 'getStats']);
    Route::get('/tables', [SystemController::class, 'getAllTables']);
    Route::get('/{schema}/{table}', [SystemController::class, 'getTableData']);
});

// Legacy system routes
Route::prefix('legacy')->group(function () {
    Route::get('/', function () {
        return response()->json([
            'message' => 'Sistemas Legacy CROSS',
            'systems' => [
                'CROSSHUV' => 'Sistema Principal',
                'CROSS7' => 'Sistema Base',
                'CROSS7Fuentes' => 'Código Fuente',
                'CROSS7WORK' => 'Entorno Desarrollo'
            ]
        ]);
    });
});

// Health check
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now(),
        'database' => 'connected'
    ]);
});