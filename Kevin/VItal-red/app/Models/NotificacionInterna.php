<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificacionInterna extends Model
{
    protected $table = 'notificaciones_internas';

    protected $fillable = [
        'solicitud_referencia_id',
        'tipo',
        'titulo',
        'mensaje',
        'destinatario_id',
        'remitente_id',
        'prioridad',
        'enviada',
        'leida',
        'fecha_envio',
        'fecha_lectura',
        'canal_notificacion', // sistema, email, sms
        'datos_adicionales',
        'accion_requerida',
        'url_accion',
    ];

    protected $casts = [
        'enviada' => 'boolean',
        'leida' => 'boolean',
        'fecha_envio' => 'datetime',
        'fecha_lectura' => 'datetime',
        'datos_adicionales' => 'array',
    ];

    /**
     * Relación con la solicitud de referencia
     */
    public function solicitudReferencia(): BelongsTo
    {
        return $this->belongsTo(SolicitudReferencia::class);
    }

    /**
     * Relación con el destinatario
     */
    public function destinatario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'destinatario_id');
    }

    /**
     * Relación con el remitente
     */
    public function remitente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'remitente_id');
    }

    /**
     * Scope para notificaciones no leídas
     */
    public function scopeNoLeidas($query)
    {
        return $query->where('leida', false);
    }

    /**
     * Scope para notificaciones por usuario
     */
    public function scopePorUsuario($query, $usuarioId)
    {
        return $query->where('destinatario_id', $usuarioId);
    }

    /**
     * Scope para notificaciones urgentes
     */
    public function scopeUrgentes($query)
    {
        return $query->where('prioridad', 'alta');
    }

    /**
     * Método para marcar como leída
     */
    public function marcarComoLeida()
    {
        $this->update([
            'leida' => true,
            'fecha_lectura' => now()
        ]);
    }

    /**
     * Método para enviar notificación
     */
    public function enviar()
    {
        $this->update([
            'enviada' => true,
            'fecha_envio' => now()
        ]);

        // Aquí se podría integrar con servicios de email, SMS, etc.
        // Por ahora solo marcamos como enviada en el sistema
    }

    /**
     * Método estático para crear notificación de solicitud aceptada
     */
    public static function solicitudAceptada(SolicitudReferencia $solicitud, User $medico)
    {
        return static::create([
            'solicitud_referencia_id' => $solicitud->id,
            'tipo' => 'solicitud_aceptada',
            'titulo' => 'Solicitud de Referencia Aceptada',
            'mensaje' => "La solicitud {$solicitud->numero_solicitud} para {$solicitud->paciente_nombre} ha sido aceptada por {$medico->name}.",
            'destinatario_id' => null, // Notificación general
            'remitente_id' => $medico->id,
            'prioridad' => $solicitud->nivel_prioridad === 'alta' ? 'alta' : 'media',
            'canal_notificacion' => 'sistema',
            'accion_requerida' => 'Preparar recepción del paciente',
            'url_accion' => "/admin/solicitudes/{$solicitud->id}",
            'datos_adicionales' => [
                'paciente' => $solicitud->paciente_nombre,
                'especialidad' => $solicitud->especialidad_solicitada,
                'urgencia' => $solicitud->urgencia_medica
            ]
        ]);
    }

    /**
     * Método estático para crear notificación de solicitud rechazada
     */
    public static function solicitudRechazada(SolicitudReferencia $solicitud, User $medico, string $motivo)
    {
        return static::create([
            'solicitud_referencia_id' => $solicitud->id,
            'tipo' => 'solicitud_rechazada',
            'titulo' => 'Solicitud de Referencia Rechazada',
            'mensaje' => "La solicitud {$solicitud->numero_solicitud} para {$solicitud->paciente_nombre} ha sido rechazada. Motivo: {$motivo}",
            'destinatario_id' => null,
            'remitente_id' => $medico->id,
            'prioridad' => 'media',
            'canal_notificacion' => 'sistema',
            'accion_requerida' => 'Informar a institución remitente',
            'url_accion' => "/admin/solicitudes/{$solicitud->id}",
            'datos_adicionales' => [
                'paciente' => $solicitud->paciente_nombre,
                'motivo_rechazo' => $motivo,
                'institucion_remitente' => $solicitud->institucion_remitente
            ]
        ]);
    }

    /**
     * Método estático para crear notificación de nueva solicitud urgente
     */
    public static function nuevaSolicitudUrgente(SolicitudReferencia $solicitud)
    {
        return static::create([
            'solicitud_referencia_id' => $solicitud->id,
            'tipo' => 'nueva_solicitud_urgente',
            'titulo' => 'Nueva Solicitud Urgente',
            'mensaje' => "Nueva solicitud urgente recibida: {$solicitud->numero_solicitud} para {$solicitud->paciente_nombre}. Requiere evaluación inmediata.",
            'destinatario_id' => null, // Todos los médicos evaluadores
            'prioridad' => 'alta',
            'canal_notificacion' => 'sistema',
            'accion_requerida' => 'Evaluar solicitud urgente',
            'url_accion' => "/admin/solicitudes/{$solicitud->id}",
            'datos_adicionales' => [
                'paciente' => $solicitud->paciente_nombre,
                'diagnostico' => $solicitud->diagnostico_presuntivo,
                'institucion_remitente' => $solicitud->institucion_remitente,
                'urgencia' => $solicitud->urgencia_medica
            ]
        ]);
    }

    /**
     * Método estático para crear notificación de información adicional solicitada
     */
    public static function informacionSolicitada(SolicitudReferencia $solicitud, User $medico, string $informacion)
    {
        return static::create([
            'solicitud_referencia_id' => $solicitud->id,
            'tipo' => 'informacion_solicitada',
            'titulo' => 'Información Adicional Solicitada',
            'mensaje' => "Se ha solicitado información adicional para la solicitud {$solicitud->numero_solicitud}: {$informacion}",
            'destinatario_id' => null,
            'remitente_id' => $medico->id,
            'prioridad' => 'media',
            'canal_notificacion' => 'sistema',
            'accion_requerida' => 'Contactar institución remitente',
            'url_accion' => "/admin/solicitudes/{$solicitud->id}",
            'datos_adicionales' => [
                'paciente' => $solicitud->paciente_nombre,
                'informacion_solicitada' => $informacion,
                'institucion_remitente' => $solicitud->institucion_remitente,
                'contacto_remitente' => $solicitud->telefono_remitente
            ]
        ]);
    }
}
