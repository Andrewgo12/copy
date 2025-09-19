<?php

namespace App\Http\Controllers;

use App\Models\SolicitudReferencia;
use App\Models\NotificacionInterna;
use App\Models\EmailMedico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class SolicitudReferenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Bandeja de casos médicos - Vista principal para médicos evaluadores
     */
    public function bandejaCasos(Request $request)
    {
        $this->authorize('viewAny', SolicitudReferencia::class);

        $query = SolicitudReferencia::with(['medicoEvaluador', 'usuarioCreador'])
                                   ->orderBy('fecha_recepcion', 'desc');

        // Filtros
        if ($request->filled('estado')) {
            $query->where('estado_solicitud', $request->estado);
        }

        if ($request->filled('prioridad')) {
            $query->where('nivel_prioridad', $request->prioridad);
        }

        if ($request->filled('especialidad')) {
            $query->where('especialidad_solicitada', $request->especialidad);
        }

        if ($request->filled('urgencia')) {
            $query->where('urgencia_medica', $request->urgencia);
        }

        if ($request->filled('medico')) {
            $query->where('medico_evaluador_id', $request->medico);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('paciente_nombre', 'like', "%{$search}%")
                  ->orWhere('numero_solicitud', 'like', "%{$search}%")
                  ->orWhere('institucion_remitente', 'like', "%{$search}%")
                  ->orWhere('diagnostico_presuntivo', 'like', "%{$search}%");
            });
        }

        // Solo mostrar solicitudes asignadas al médico si no es admin
        if (auth()->user()->role === 'medico') {
            $query->where(function($q) {
                $q->where('medico_evaluador_id', auth()->id())
                  ->orWhere('estado_solicitud', 'nueva'); // Puede tomar casos nuevos
            });
        }

        $solicitudes = $query->paginate(20);

        // Estadísticas rápidas
        $stats = [
            'nuevas' => SolicitudReferencia::nuevas()->count(),
            'en_revision' => SolicitudReferencia::enRevision()->count(),
            'urgentes' => SolicitudReferencia::urgentes()->count(),
            'vencidas' => SolicitudReferencia::where('estado_solicitud', 'nueva')
                                           ->where('fecha_recepcion', '<', now()->subHours(24))
                                           ->count(),
        ];

        // Médicos evaluadores para filtro
        $medicos = User::where('role', 'medico')->where('is_active', true)->get();

        // Especialidades disponibles
        $especialidades = SolicitudReferencia::distinct()
                                           ->pluck('especialidad_solicitada')
                                           ->filter()
                                           ->sort()
                                           ->values();

        return Inertia::render('medico/bandeja-casos', [
            'solicitudes' => $solicitudes,
            'stats' => $stats,
            'medicos' => $medicos,
            'especialidades' => $especialidades,
            'filters' => $request->only(['estado', 'prioridad', 'especialidad', 'urgencia', 'medico', 'search'])
        ]);
    }

    /**
     * Detalle de caso clínico - Formulario de priorización y decisión
     */
    public function detalleCaso(SolicitudReferencia $solicitud)
    {
        $this->authorize('view', $solicitud);

        $solicitud->load(['medicoEvaluador', 'usuarioCreador', 'emailMedico', 'notificaciones']);

        // Si el médico toma el caso, asignárselo automáticamente
        if (auth()->user()->role === 'medico' && !$solicitud->medico_evaluador_id) {
            $solicitud->asignarMedico(auth()->user());
        }

        return Inertia::render('medico/detalle-caso', [
            'solicitud' => $solicitud,
            'canEdit' => auth()->user()->can('update', $solicitud),
            'canDecide' => auth()->user()->can('decide', $solicitud),
        ]);
    }

    /**
     * Tomar decisión sobre una solicitud
     */
    public function tomarDecision(Request $request, SolicitudReferencia $solicitud)
    {
        $this->authorize('decide', $solicitud);

        $request->validate([
            'decision' => 'required|in:aceptada,rechazada',
            'motivo' => 'required|string|max:1000',
            'observaciones' => 'nullable|string|max:2000',
            'prioridad' => 'sometimes|in:alta,media,baja'
        ]);

        try {
            DB::beginTransaction();

            // Actualizar prioridad si se proporciona
            if ($request->filled('prioridad')) {
                $solicitud->update(['nivel_prioridad' => $request->prioridad]);
            }

            // Tomar decisión
            $solicitud->tomarDecision(
                $request->decision,
                $request->motivo,
                $request->observaciones,
                auth()->user()
            );

            // Enviar notificación interna
            if ($request->decision === 'aceptada') {
                $notificacion = NotificacionInterna::solicitudAceptada($solicitud, auth()->user());
            } else {
                $notificacion = NotificacionInterna::solicitudRechazada($solicitud, auth()->user(), $request->motivo);
            }

            $notificacion->enviar();

            DB::commit();

            Log::info("Decisión tomada en solicitud {$solicitud->numero_solicitud}", [
                'decision' => $request->decision,
                'medico' => auth()->user()->name,
                'motivo' => $request->motivo
            ]);

            return response()->json([
                'success' => true,
                'message' => "Decisión registrada exitosamente: {$request->decision}",
                'solicitud' => $solicitud->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al tomar decisión en solicitud {$solicitud->numero_solicitud}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la decisión: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Solicitar información adicional
     */
    public function solicitarInformacion(Request $request, SolicitudReferencia $solicitud)
    {
        $this->authorize('update', $solicitud);

        $request->validate([
            'informacion' => 'required|string|max:1000'
        ]);

        try {
            DB::beginTransaction();

            $solicitud->solicitarInformacion($request->informacion, auth()->user());

            // Crear notificación
            $notificacion = NotificacionInterna::informacionSolicitada(
                $solicitud, 
                auth()->user(), 
                $request->informacion
            );
            $notificacion->enviar();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Información adicional solicitada exitosamente',
                'solicitud' => $solicitud->fresh()
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al solicitar información en solicitud {$solicitud->numero_solicitud}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al solicitar información: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Asignar médico evaluador
     */
    public function asignarMedico(Request $request, SolicitudReferencia $solicitud)
    {
        $this->authorize('assign', $solicitud);

        $request->validate([
            'medico_id' => 'required|exists:users,id'
        ]);

        $medico = User::findOrFail($request->medico_id);

        if ($medico->role !== 'medico' || !$medico->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'El usuario seleccionado no es un médico activo'
            ], 400);
        }

        try {
            $solicitud->asignarMedico($medico);

            return response()->json([
                'success' => true,
                'message' => "Solicitud asignada a {$medico->name}",
                'solicitud' => $solicitud->fresh(['medicoEvaluador'])
            ]);

        } catch (\Exception $e) {
            Log::error("Error al asignar médico en solicitud {$solicitud->numero_solicitud}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al asignar médico: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Crear solicitud desde email médico
     */
    public function crearDesdeEmail(EmailMedico $email)
    {
        $this->authorize('create', SolicitudReferencia::class);

        if ($email->imported_to_registro) {
            return response()->json([
                'success' => false,
                'message' => 'Este email ya fue procesado como registro médico'
            ], 400);
        }

        try {
            DB::beginTransaction();

            $solicitud = SolicitudReferencia::create([
                'numero_solicitud' => SolicitudReferencia::generarNumeroSolicitud(),
                'email_unique_id' => $email->unique_id,
                
                // Datos del paciente
                'paciente_nombre' => $email->patient_name,
                'paciente_edad' => $email->patient_age,
                'paciente_genero' => $email->patient_gender,
                'paciente_identificacion' => $email->patient_id_number,
                
                // Información médica
                'diagnostico_presuntivo' => $email->diagnosis ?: $email->medical_condition,
                'motivo_referencia' => $email->symptoms ?: 'Referencia médica',
                'sintomas_actuales' => $email->symptoms,
                'antecedentes_medicos' => $email->medical_history,
                'medicamentos_actuales' => $email->medications,
                'signos_vitales' => json_decode($email->vital_signs, true),
                
                // Información de remisión
                'institucion_remitente' => $email->institution_sender,
                'medico_remitente' => $email->doctor_sender,
                'email_remitente' => $email->from_email,
                'especialidad_solicitada' => $email->specialty_detected ?: $email->specialty_requested,
                'fecha_solicitud' => $email->date_sent,
                
                // Priorización automática basada en IA
                'nivel_prioridad' => $this->determinarPrioridad($email),
                'urgencia_medica' => $this->determinarUrgencia($email),
                
                // Datos de IA
                'procesado_por_ia' => true,
                'confianza_ia' => $email->ia_confidence_score,
                'datos_extraidos_ia' => $email->extracted_data_json,
                'fecha_procesamiento_ia' => $email->processed_at,
                
                // Adjuntos
                'tiene_adjuntos' => $email->has_attachments,
                'nombres_adjuntos' => $email->attachment_names,
                
                // Auditoría
                'fecha_recepcion' => now(),
                'usuario_creador_id' => auth()->id(),
            ]);

            // Si es urgente, crear notificación inmediata
            if ($solicitud->urgencia_medica === 'urgente' || $solicitud->urgencia_medica === 'critica') {
                $notificacion = NotificacionInterna::nuevaSolicitudUrgente($solicitud);
                $notificacion->enviar();
            }

            // Marcar email como procesado
            $email->update([
                'imported_to_registro' => true,
                'processing_status' => 'imported'
            ]);

            DB::commit();

            Log::info("Solicitud creada desde email {$email->unique_id}", [
                'solicitud_id' => $solicitud->id,
                'numero_solicitud' => $solicitud->numero_solicitud
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitud de referencia creada exitosamente',
                'solicitud' => $solicitud
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al crear solicitud desde email {$email->unique_id}: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Error al crear solicitud: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Determinar prioridad basada en datos del email
     */
    private function determinarPrioridad(EmailMedico $email): string
    {
        // Lógica de priorización basada en IA y palabras clave
        $urgencyLevel = strtolower($email->urgency_level ?? '');
        $confidence = $email->ia_confidence_score ?? 0;

        if (in_array($urgencyLevel, ['urgente', 'crítica', 'critica']) || $confidence > 0.9) {
            return 'alta';
        }

        if (in_array($urgencyLevel, ['alta']) || $confidence > 0.7) {
            return 'media';
        }

        return 'baja';
    }

    /**
     * Determinar urgencia médica basada en datos del email
     */
    private function determinarUrgencia(EmailMedico $email): string
    {
        $urgencyLevel = strtolower($email->urgency_level ?? '');
        
        if (in_array($urgencyLevel, ['crítica', 'critica'])) {
            return 'critica';
        }

        if ($urgencyLevel === 'urgente') {
            return 'urgente';
        }

        return 'normal';
    }
}
