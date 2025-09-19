<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // Redirigir automáticamente al login para aplicación médica
    return redirect()->route('login');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    // Redirección basada en rol desde dashboard
    Route::get('dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'administrador') {
            return app(App\Http\Controllers\Admin\DashboardController::class)->index(request());
        } else {
            // Médicos van directamente a Bandeja de Casos
            return redirect()->route('medico.bandeja-casos');
        }
    })->name('dashboard');

    // Rutas para Administrador
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'index'])->name('usuarios');
        Route::post('usuarios', [App\Http\Controllers\Admin\UsuarioController::class, 'store'])->name('usuarios.store');
        Route::put('usuarios/{usuario}', [App\Http\Controllers\Admin\UsuarioController::class, 'update'])->name('usuarios.update');
        Route::patch('usuarios/{usuario}/toggle-status', [App\Http\Controllers\Admin\UsuarioController::class, 'toggleStatus'])->name('usuarios.toggle-status');
        Route::delete('usuarios/{usuario}', [App\Http\Controllers\Admin\UsuarioController::class, 'destroy'])->name('usuarios.destroy');

        Route::get('supervision', function () {
            return Inertia::render('admin/supervision');
        })->name('supervision');

        // Rutas para dashboard de administrador
        Route::get('buscar-registros', [App\Http\Controllers\Admin\DashboardController::class, 'buscarRegistros'])->name('buscar-registros');
        Route::get('descargar-historia/{registro}', [App\Http\Controllers\Admin\DashboardController::class, 'descargarHistoria'])->name('descargar-historia');

        // Rutas para integración con IA
        Route::prefix('ia')->name('ia.')->group(function () {
            Route::get('dashboard', [App\Http\Controllers\EmailIAController::class, 'dashboard'])->name('dashboard');
            Route::get('emails', [App\Http\Controllers\EmailIAController::class, 'index'])->name('emails');
            Route::get('emails/{email}', [App\Http\Controllers\EmailIAController::class, 'show'])->name('emails.show');
            Route::post('import', [App\Http\Controllers\EmailIAController::class, 'importFromIA'])->name('import');
            Route::post('auto-import', [App\Http\Controllers\EmailIAController::class, 'autoImport'])->name('auto-import');
            Route::post('emails/{email}/create-registro', [App\Http\Controllers\EmailIAController::class, 'createRegistroMedico'])->name('emails.create-registro');
            Route::post('emails/{email}/validate', [App\Http\Controllers\EmailIAController::class, 'validateEmail'])->name('emails.validate');
            Route::post('emails/{email}/create-solicitud', [App\Http\Controllers\SolicitudReferenciaController::class, 'crearDesdeEmail'])->name('emails.create-solicitud');
            Route::post('process-pending', [App\Http\Controllers\EmailIAController::class, 'processPendingEmails'])->name('process-pending');
            Route::get('stats', [App\Http\Controllers\EmailIAController::class, 'getStats'])->name('stats');
        });

        // Rutas para Gestión de Solicitudes de Referencia (Admin)
        Route::prefix('solicitudes')->name('solicitudes.')->group(function () {
            Route::get('/', [App\Http\Controllers\SolicitudReferenciaController::class, 'bandejaCasos'])->name('index');
            Route::get('{solicitud}', [App\Http\Controllers\SolicitudReferenciaController::class, 'detalleCaso'])->name('show');
            Route::post('{solicitud}/asignar-medico', [App\Http\Controllers\SolicitudReferenciaController::class, 'asignarMedico'])->name('asignar-medico');
        });
    });

    // Rutas para Médico
    Route::middleware('medico')->prefix('medico')->name('medico.')->group(function () {
        Route::get('ingresar-registro', [App\Http\Controllers\Medico\MedicoController::class, 'ingresarRegistro'])->name('ingresar-registro');
        Route::post('ingresar-registro', [App\Http\Controllers\Medico\MedicoController::class, 'storeRegistro'])->name('ingresar-registro.store');
        Route::get('consulta-pacientes', [App\Http\Controllers\Medico\MedicoController::class, 'consultaPacientes'])->name('consulta-pacientes');
        Route::get('buscar-pacientes', [App\Http\Controllers\Medico\MedicoController::class, 'buscarPacientes'])->name('buscar-pacientes');
        Route::get('descargar-historia/{registro}', [App\Http\Controllers\Medico\MedicoController::class, 'descargarHistoria'])->name('descargar-historia');

        // Rutas para Bandeja de Casos (Solicitudes de Referencia)
        Route::get('bandeja-casos', [App\Http\Controllers\SolicitudReferenciaController::class, 'bandejaCasos'])->name('bandeja-casos');
        Route::get('solicitudes/{solicitud}', [App\Http\Controllers\SolicitudReferenciaController::class, 'detalleCaso'])->name('solicitudes.show');
        Route::post('solicitudes/{solicitud}/decision', [App\Http\Controllers\SolicitudReferenciaController::class, 'tomarDecision'])->name('solicitudes.decision');
        Route::post('solicitudes/{solicitud}/solicitar-informacion', [App\Http\Controllers\SolicitudReferenciaController::class, 'solicitarInformacion'])->name('solicitudes.solicitar-info');
        Route::post('solicitudes/{solicitud}/asignar-medico', [App\Http\Controllers\SolicitudReferenciaController::class, 'asignarMedico'])->name('solicitudes.asignar-medico');

        // Rutas para IA
        Route::post('ai/extract-patient-data', [App\Http\Controllers\AIController::class, 'extractPatientData'])->name('ai.extract-patient-data');
        Route::post('ai/test-text-extraction', [App\Http\Controllers\AIController::class, 'testTextExtraction'])->name('ai.test-text-extraction');
        Route::post('ai/test-gemini', [App\Http\Controllers\AIController::class, 'testGeminiAPI'])->name('ai.test-gemini');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
