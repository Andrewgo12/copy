<?php

namespace App\Http\Controllers;

use App\Models\EmailMedico;
use App\Models\RegistroMedico;
use App\Services\EmailIAImportService;
use App\Http\Requests\EmailIA\ImportEmailsRequest;
use App\Http\Requests\EmailIA\ValidateEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class EmailIAController extends Controller
{
    protected $importService;

    public function __construct(EmailIAImportService $importService)
    {
        $this->importService = $importService;
        $this->middleware('auth');
    }

    /**
     * Dashboard de monitoreo de IA
     */
    public function dashboard()
    {
        $this->authorize('viewAny', EmailMedico::class);
        $stats = $this->importService->getImportStats();

        $recentEmails = EmailMedico::with('registroMedico')
                                  ->orderBy('processed_at', 'desc')
                                  ->limit(10)
                                  ->get();

        $urgentEmails = EmailMedico::urgentes()
                                  ->where('imported_to_registro', false)
                                  ->orderBy('date_sent', 'desc')
                                  ->limit(5)
                                  ->get();

        return Inertia::render('admin/ia-dashboard', [
            'stats' => $stats,
            'recentEmails' => $recentEmails,
            'urgentEmails' => $urgentEmails
        ]);
    }

    /**
     * Listar emails procesados por IA
     */
    public function index(Request $request)
    {
        $query = EmailMedico::with('registroMedico', 'user');

        // Filtros
        if ($request->filled('status')) {
            $query->where('processing_status', $request->status);
        }

        if ($request->filled('urgency')) {
            $query->where('urgency_level', $request->urgency);
        }

        if ($request->filled('specialty')) {
            $query->where('specialty_detected', $request->specialty);
        }

        if ($request->filled('imported')) {
            $query->where('imported_to_registro', $request->boolean('imported'));
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%")
                  ->orWhere('from_email', 'like', "%{$search}%")
                  ->orWhere('doctor_sender', 'like', "%{$search}%");
            });
        }

        $emails = $query->orderBy('date_sent', 'desc')
                       ->paginate(20)
                       ->withQueryString();

        return Inertia::render('admin/emails-ia', [
            'emails' => $emails,
            'filters' => $request->only(['status', 'urgency', 'specialty', 'imported', 'search'])
        ]);
    }

    /**
     * Ver detalles de un email procesado
     */
    public function show(EmailMedico $email)
    {
        $email->load('registroMedico', 'user');

        return Inertia::render('admin/email-ia-detail', [
            'email' => $email
        ]);
    }

    /**
     * Importar emails desde el sistema de IA
     */
    public function importFromIA(ImportEmailsRequest $request)
    {
        try {
            $iaPath = $request->ia_path;

            // Verificar que el directorio existe
            if (!is_dir($iaPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Directorio de IA no encontrado: ' . $iaPath
                ], 400);
            }

            $results = $this->importService->importFromIASystem($iaPath);

            Log::info('Importación de emails IA completada', $results);

            return response()->json([
                'success' => true,
                'message' => "Importación completada. {$results['imported']} emails importados.",
                'results' => $results
            ]);

        } catch (\Exception $e) {
            Log::error('Error en importación de IA: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error en la importación: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear registro médico desde email
     */
    public function createRegistroMedico(EmailMedico $email)
    {
        try {
            if ($email->imported_to_registro) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este email ya tiene un registro médico asociado'
                ], 400);
            }

            if (!$email->is_medical_email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Este email no contiene datos médicos válidos'
                ], 400);
            }

            $data = $email->getDataForRegistroMedico();
            $data['user_id'] = auth()->id();

            $registro = RegistroMedico::create($data);
            $email->markAsImported($registro->id);

            Log::info('Registro médico creado desde email IA', [
                'email_id' => $email->unique_id,
                'registro_id' => $registro->id,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Registro médico creado exitosamente',
                'registro_id' => $registro->id
            ]);

        } catch (\Exception $e) {
            Log::error('Error creando registro desde email: ' . $e->getMessage(), [
                'email_id' => $email->unique_id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error creando el registro médico: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validar email médico
     */
    public function validateEmail(EmailMedico $email, ValidateEmailRequest $request)
    {
        try {
            $email->update([
                'validation_status' => $request->validation_status,
                'user_id' => auth()->id()
            ]);

            // Agregar nota al log de procesamiento
            $log = $email->processing_log_json ?? [];
            $log[] = [
                'action' => 'validation',
                'status' => $request->validation_status,
                'notes' => $request->notes,
                'user_id' => auth()->id(),
                'timestamp' => now()->toISOString()
            ];

            $email->update(['processing_log_json' => $log]);

            Log::info('Email validado', [
                'email_id' => $email->unique_id,
                'status' => $request->validation_status,
                'user_id' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Email validado exitosamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error validando email: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error validando el email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener estadísticas para el dashboard
     */
    public function getStats()
    {
        try {
            $stats = $this->importService->getImportStats();

            return response()->json([
                'success' => true,
                'stats' => $stats
            ]);

        } catch (\Exception $e) {
            Log::error('Error obteniendo estadísticas: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error obteniendo estadísticas'
            ], 500);
        }
    }

    /**
     * Procesar emails pendientes en lote
     */
    public function processPendingEmails()
    {
        try {
            $pendingEmails = EmailMedico::where('processing_status', 'extracted')
                                       ->where('validation_status', 'valid')
                                       ->where('imported_to_registro', false)
                                       ->medicosValidos()
                                       ->limit(50)
                                       ->get();

            $processed = 0;
            $errors = 0;

            foreach ($pendingEmails as $email) {
                try {
                    $data = $email->getDataForRegistroMedico();
                    $data['user_id'] = auth()->id();

                    $registro = RegistroMedico::create($data);
                    $email->markAsImported($registro->id);

                    $processed++;

                } catch (\Exception $e) {
                    $errors++;
                    Log::error('Error procesando email en lote: ' . $e->getMessage(), [
                        'email_id' => $email->unique_id
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Procesamiento completado. {$processed} emails procesados, {$errors} errores.",
                'processed' => $processed,
                'errors' => $errors
            ]);

        } catch (\Exception $e) {
            Log::error('Error en procesamiento en lote: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error en el procesamiento en lote: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ejecutar importación automática desde directorio configurado
     */
    public function autoImport()
    {
        try {
            // Usar la ruta configurada del sistema de IA
            $iaPath = base_path('ia'); // Asumiendo que está en la raíz del proyecto

            if (!is_dir($iaPath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Directorio de IA no configurado correctamente'
                ], 400);
            }

            $results = $this->importService->importFromIASystem($iaPath);

            return response()->json([
                'success' => true,
                'message' => "Importación automática completada. {$results['imported']} emails importados.",
                'results' => $results
            ]);

        } catch (\Exception $e) {
            Log::error('Error en importación automática: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error en la importación automática: ' . $e->getMessage()
            ], 500);
        }
    }
}
