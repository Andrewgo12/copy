<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// System API routes
Route::prefix('system')->group(function () {
    Route::get('/info', [SystemController::class, 'getSystemInfo']);
    Route::get('/stats', [SystemController::class, 'getStats']);
});

// Database API routes
Route::prefix('database')->group(function () {
    Route::get('/tables', [SystemController::class, 'getAllTables']);
    Route::get('/{schema}/{table}', [SystemController::class, 'getTableData']);
});

// CROSS modules API routes
Route::prefix('cross')->group(function () {
    // Clientes
    Route::apiResource('clientes', App\Http\Controllers\ClienteController::class);
    
    // Personal
    Route::apiResource('personal', App\Http\Controllers\PersonalController::class);
    
    // Órdenes
    Route::apiResource('ordenes', App\Http\Controllers\OrdenController::class);
    
    // Organizaciones
    Route::apiResource('organizaciones', App\Http\Controllers\OrganizacionController::class);
});

// Legacy systems API
Route::prefix('legacy')->group(function () {
    Route::get('/systems', function () {
        return response()->json([
            'CROSSHUV' => [
                'name' => 'Sistema Principal CROSSHUV',
                'priority' => 'MÁXIMA',
                'modules' => 10,
                'status' => 'organized'
            ],
            'CROSS7' => [
                'name' => 'Sistema Base CROSS7',
                'priority' => 'Alta',
                'modules' => 3,
                'status' => 'organized'
            ]
        ]);
    });
});