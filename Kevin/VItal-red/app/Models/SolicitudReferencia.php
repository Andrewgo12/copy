<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SolicitudReferencia extends Model
{
    protected $table = 'solicitudes_referencia';

    protected $fillable = [
        // Identificación de la solicitud
        'numero_solicitud',
        'email_unique_id',
        
        // Información del paciente
        'paciente_nombre',
        'paciente_edad',
        'paciente_genero',
        'paciente_identificacion',
        'paciente_telefono',
        'paciente_direccion',
        
        // Información médica
        'diagnostico_presuntivo',
        'motivo_referencia',
        'sintomas_actuales',
        'antecedentes_medicos',
        'medicamentos_actuales',
        'signos_vitales',
        'examenes_realizados',
        
        // Información de remisión
        'institucion_remitente',
        'medico_remitente',
        'telefono_remitente',
        'email_remitente',
        'especialidad_solicitada',
        'servicio_solicitado',
        'fecha_solicitud',
        
        // Priorización y estado
        'nivel_prioridad', // alta, media, baja
        'clasificacion_triage', // I, II, III, IV, V
        'estado_solicitud', // nueva, en_revision, aceptada, rechazada, pendiente_info
        'urgencia_medica', // urgente, critica, normal
        
        // Decisión médica
        'decision_final', // aceptada, rechazada, pendiente
        'motivo_decision',
        'observaciones_medico',
        'fecha_decision',
        'medico_evaluador_id',
        
        // Notificaciones y seguimiento
        'notificacion_enviada',
        'fecha_notificacion',
        'requiere_informacion_adicional',
        'informacion_solicitada',
        
        // Archivos adjuntos
        'tiene_adjuntos',
        'nombres_adjuntos',
        'rutas_adjuntos',
        
        // Datos de procesamiento IA
        'procesado_por_ia',
        'confianza_ia',
        'datos_extraidos_ia',
        'fecha_procesamiento_ia',
        
        // Auditoría
        'fecha_recepcion',
        'tiempo_respuesta_horas',
        'usuario_creador_id',
        'historial_cambios',
    ];

    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_decision' => 'datetime',
        'fecha_notificacion' => 'datetime',
        'fecha_recepcion' => 'datetime',
        'fecha_procesamiento_ia' => 'datetime',
        'procesado_por_ia' => 'boolean',
        'notificacion_enviada' => 'boolean',
        'requiere_informacion_adicional' => 'boolean',
        'tiene_adjuntos' => 'boolean',
        'nombres_adjuntos' => 'array',
        'rutas_adjuntos' => 'array',
        'signos_vitales' => 'array',
        'datos_extraidos_ia' => 'array',
        'historial_cambios' => 'array',
        'confianza_ia' => 'decimal:2',
        'tiempo_respuesta_horas' => 'decimal:2',
    ];

    /**
     * Relación con el email médico que generó esta solicitud
     */
    public function emailMedico(): BelongsTo
    {
        return $this->belongsTo(EmailMedico::class, 'email_unique_id', 'unique_id');
    }

    /**
     * Relación con el médico evaluador
     */
    public function medicoEvaluador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medico_evaluador_id');
    }

    /**
     * Relación con el usuario que creó la solicitud
     */
    public function usuarioCreador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_creador_id');
    }

    /**
     * Relación con las notificaciones enviadas
     */
    public function notificaciones(): HasMany
    {
        return $this->hasMany(NotificacionInterna::class);
    }

    /**
     * Scope para solicitudes nuevas
     */
    public function scopeNuevas($query)
    {
        return $query->where('estado_solicitud', 'nueva');
    }

    /**
     * Scope para solicitudes en revisión
     */
    public function scopeEnRevision($query)
    {
        return $query->where('estado_solicitud', 'en_revision');
    }

    /**
     * Scope para solicitudes urgentes
     */
    public function scopeUrgentes($query)
    {
        return $query->whereIn('urgencia_medica', ['urgente', 'critica'])
                    ->orWhere('nivel_prioridad', 'alta');
    }

    /**
     * Scope por especialidad
     */
    public function scopePorEspecialidad($query, $especialidad)
    {
        return $query->where('especialidad_solicitada', $especialidad);
    }

    /**
     * Scope por estado
     */
    public function scopePorEstado($query, $estado)
    {
        return $query->where('estado_solicitud', $estado);
    }

    /**
     * Scope por médico evaluador
     */
    public function scopePorMedico($query, $medicoId)
    {
        return $query->where('medico_evaluador_id', $medicoId);
    }

    /**
     * Accessor para obtener el estado legible
     */
    public function getEstadoLegibleAttribute()
    {
        $estados = [
            'nueva' => 'Nueva',
            'en_revision' => 'En Revisión',
            'aceptada' => 'Aceptada',
            'rechazada' => 'Rechazada',
            'pendiente_info' => 'Pendiente Información'
        ];

        return $estados[$this->estado_solicitud] ?? 'Desconocido';
    }

    /**
     * Accessor para obtener la prioridad con color
     */
    public function getPrioridadColorAttribute()
    {
        $colores = [
            'alta' => 'red',
            'media' => 'yellow',
            'baja' => 'green'
        ];

        return $colores[$this->nivel_prioridad] ?? 'gray';
    }

    /**
     * Accessor para verificar si está vencida (más de 24 horas sin respuesta)
     */
    public function getEsVencidaAttribute()
    {
        if ($this->estado_solicitud === 'nueva' || $this->estado_solicitud === 'en_revision') {
            return $this->fecha_recepcion->diffInHours(now()) > 24;
        }
        return false;
    }

    /**
     * Método para asignar médico evaluador
     */
    public function asignarMedico(User $medico)
    {
        $this->update([
            'medico_evaluador_id' => $medico->id,
            'estado_solicitud' => 'en_revision'
        ]);

        $this->registrarCambio('Asignado a médico evaluador', $medico->name);
    }

    /**
     * Método para tomar decisión
     */
    public function tomarDecision(string $decision, string $motivo, ?string $observaciones = null, User $medico = null)
    {
        $this->update([
            'decision_final' => $decision,
            'motivo_decision' => $motivo,
            'observaciones_medico' => $observaciones,
            'fecha_decision' => now(),
            'estado_solicitud' => $decision,
            'medico_evaluador_id' => $medico?->id ?? $this->medico_evaluador_id,
            'tiempo_respuesta_horas' => $this->fecha_recepcion->diffInHours(now(), true)
        ]);

        $this->registrarCambio("Decisión tomada: {$decision}", $motivo);
    }

    /**
     * Método para solicitar información adicional
     */
    public function solicitarInformacion(string $informacion, User $medico)
    {
        $this->update([
            'requiere_informacion_adicional' => true,
            'informacion_solicitada' => $informacion,
            'estado_solicitud' => 'pendiente_info',
            'medico_evaluador_id' => $medico->id
        ]);

        $this->registrarCambio('Información adicional solicitada', $informacion);
    }

    /**
     * Método para registrar cambios en el historial
     */
    private function registrarCambio(string $accion, string $detalle)
    {
        $historial = $this->historial_cambios ?? [];
        $historial[] = [
            'fecha' => now()->toISOString(),
            'accion' => $accion,
            'detalle' => $detalle,
            'usuario_id' => auth()->id(),
            'usuario_nombre' => auth()->user()?->name
        ];

        $this->update(['historial_cambios' => $historial]);
    }

    /**
     * Método para enviar notificación interna
     */
    public function enviarNotificacion(string $tipo, string $mensaje, ?User $destinatario = null)
    {
        // Crear notificación interna
        $notificacion = $this->notificaciones()->create([
            'tipo' => $tipo,
            'mensaje' => $mensaje,
            'destinatario_id' => $destinatario?->id,
            'enviada' => false
        ]);

        // Marcar como notificación enviada
        if (!$this->notificacion_enviada) {
            $this->update([
                'notificacion_enviada' => true,
                'fecha_notificacion' => now()
            ]);
        }

        return $notificacion;
    }

    /**
     * Método para generar número de solicitud único
     */
    public static function generarNumeroSolicitud()
    {
        $fecha = now()->format('Ymd');
        $ultimo = static::whereDate('created_at', today())
                       ->orderBy('id', 'desc')
                       ->first();
        
        $secuencial = $ultimo ? (intval(substr($ultimo->numero_solicitud, -4)) + 1) : 1;
        
        return "REF-{$fecha}-" . str_pad($secuencial, 4, '0', STR_PAD_LEFT);
    }
}
