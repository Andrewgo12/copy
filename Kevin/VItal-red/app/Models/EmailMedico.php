<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class EmailMedico extends Model
{
    protected $table = 'emails_medicos';

    protected $fillable = [
        // Identificación del email
        'unique_id',
        'message_id',
        'thread_id',
        
        // Metadatos del email
        'subject',
        'from_name',
        'from_email',
        'to_email',
        'date_sent',
        'date_received',
        
        // Contenido
        'body_content',
        'html_content',
        'raw_content',
        
        // Información médica extraída
        'patient_name',
        'patient_age',
        'patient_gender',
        'patient_id_number',
        'institution_sender',
        'doctor_sender',
        'specialty_requested',
        'urgency_level',
        'medical_condition',
        'symptoms',
        'vital_signs',
        'medications',
        'medical_history',
        'diagnosis',
        
        // Adjuntos
        'has_attachments',
        'attachment_count',
        'attachment_names',
        'attachment_paths',
        
        // Estado de procesamiento
        'processing_status',
        'ia_confidence_score',
        'quality_score',
        'validation_status',
        'processed_at',
        'imported_to_registro',
        
        // Datos técnicos
        'email_size_bytes',
        'language_detected',
        'medical_keywords_found',
        'specialty_detected',
        
        // Relaciones
        'registro_medico_id',
        'user_id',
        
        // JSON fields para datos complejos
        'metadata_json',
        'extracted_data_json',
        'attachments_json',
        'processing_log_json',
    ];

    protected $casts = [
        'date_sent' => 'datetime',
        'date_received' => 'datetime',
        'processed_at' => 'datetime',
        'has_attachments' => 'boolean',
        'imported_to_registro' => 'boolean',
        'attachment_count' => 'integer',
        'email_size_bytes' => 'integer',
        'ia_confidence_score' => 'decimal:2',
        'quality_score' => 'decimal:2',
        'metadata_json' => 'array',
        'extracted_data_json' => 'array',
        'attachments_json' => 'array',
        'processing_log_json' => 'array',
        'attachment_names' => 'array',
        'attachment_paths' => 'array',
        'medical_keywords_found' => 'array',
    ];

    /**
     * Relación con el registro médico generado
     */
    public function registroMedico(): HasOne
    {
        return $this->hasOne(RegistroMedico::class, 'email_unique_id', 'unique_id');
    }

    /**
     * Relación con el usuario que procesó el email
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope para emails no procesados
     */
    public function scopeNoProcesados($query)
    {
        return $query->where('processing_status', 'pending')
                    ->orWhere('processing_status', 'extracted');
    }

    /**
     * Scope para emails médicos válidos
     */
    public function scopeMedicosValidos($query)
    {
        return $query->where('validation_status', 'valid')
                    ->where('ia_confidence_score', '>=', 0.7);
    }

    /**
     * Scope para emails urgentes
     */
    public function scopeUrgentes($query)
    {
        return $query->whereIn('urgency_level', ['urgente', 'alta', 'crítica']);
    }

    /**
     * Scope por especialidad
     */
    public function scopePorEspecialidad($query, $especialidad)
    {
        return $query->where('specialty_detected', $especialidad)
                    ->orWhere('specialty_requested', $especialidad);
    }

    /**
     * Accessor para obtener el nombre completo del paciente
     */
    public function getPatientFullNameAttribute()
    {
        return $this->patient_name;
    }

    /**
     * Accessor para verificar si es un email médico válido
     */
    public function getIsMedicalEmailAttribute()
    {
        return $this->ia_confidence_score >= 0.7 && 
               $this->validation_status === 'valid' &&
               !empty($this->patient_name);
    }

    /**
     * Accessor para obtener el estado de procesamiento legible
     */
    public function getProcessingStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Pendiente',
            'processing' => 'Procesando',
            'extracted' => 'Datos extraídos',
            'validated' => 'Validado',
            'imported' => 'Importado',
            'error' => 'Error',
            'rejected' => 'Rechazado'
        ];

        return $statuses[$this->processing_status] ?? 'Desconocido';
    }

    /**
     * Método para marcar como importado a registro médico
     */
    public function markAsImported($registroMedicoId)
    {
        $this->update([
            'imported_to_registro' => true,
            'registro_medico_id' => $registroMedicoId,
            'processing_status' => 'imported'
        ]);
    }

    /**
     * Método para obtener datos estructurados para importación
     */
    public function getDataForRegistroMedico()
    {
        return [
            // Información personal
            'nombre' => $this->extractFirstName(),
            'apellidos' => $this->extractLastName(),
            'edad' => $this->patient_age,
            'sexo' => $this->patient_gender,
            'numero_identificacion' => $this->patient_id_number,
            
            // Datos sociodemográficos
            'institucion_remitente' => $this->institution_sender,
            
            // Datos clínicos
            'motivo_consulta' => $this->medical_condition,
            'enfermedad_actual' => $this->symptoms,
            'antecedentes' => $this->medical_history,
            'diagnostico_principal' => $this->diagnosis,
            'tratamiento' => $this->medications,
            
            // Signos vitales (extraer de vital_signs JSON)
            'frecuencia_cardiaca' => $this->extractVitalSign('heart_rate'),
            'temperatura' => $this->extractVitalSign('temperature'),
            'tension_sistolica' => $this->extractVitalSign('systolic_bp'),
            'tension_diastolica' => $this->extractVitalSign('diastolic_bp'),
            'saturacion_oxigeno' => $this->extractVitalSign('oxygen_saturation'),
            
            // Datos de remisión
            'especialidad_solicitada' => $this->specialty_requested,
            'motivo_remision' => $this->medical_condition,
            'clasificacion_triage' => $this->urgency_level,
            
            // Campos de control
            'email_unique_id' => $this->unique_id,
            'email_procesado_ia' => true,
            'fuente_datos' => 'email_ia',
            'confianza_extraccion' => $this->ia_confidence_score,
            'estado' => 'pendiente_revision',
            'fecha_envio' => $this->date_sent,
        ];
    }

    /**
     * Extraer primer nombre del nombre completo
     */
    private function extractFirstName()
    {
        if (empty($this->patient_name)) return null;
        
        $parts = explode(' ', trim($this->patient_name));
        return $parts[0] ?? null;
    }

    /**
     * Extraer apellidos del nombre completo
     */
    private function extractLastName()
    {
        if (empty($this->patient_name)) return null;
        
        $parts = explode(' ', trim($this->patient_name));
        array_shift($parts); // Remover primer nombre
        return implode(' ', $parts) ?: null;
    }

    /**
     * Extraer signo vital específico del JSON
     */
    private function extractVitalSign($type)
    {
        if (empty($this->vital_signs)) return null;
        
        // Si vital_signs es JSON, decodificar
        $vitals = is_string($this->vital_signs) ? 
                 json_decode($this->vital_signs, true) : 
                 $this->vital_signs;
        
        if (!is_array($vitals)) return null;
        
        return $vitals[$type] ?? null;
    }
}
