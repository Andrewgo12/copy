<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_referencia', function (Blueprint $table) {
            $table->id();
            
            // Identificación de la solicitud
            $table->string('numero_solicitud')->unique();
            $table->string('email_unique_id')->nullable()->index();
            
            // Información del paciente
            $table->string('paciente_nombre');
            $table->integer('paciente_edad')->nullable();
            $table->enum('paciente_genero', ['M', 'F', 'Otro'])->nullable();
            $table->string('paciente_identificacion')->nullable();
            $table->string('paciente_telefono')->nullable();
            $table->text('paciente_direccion')->nullable();
            
            // Información médica
            $table->text('diagnostico_presuntivo');
            $table->text('motivo_referencia');
            $table->text('sintomas_actuales')->nullable();
            $table->text('antecedentes_medicos')->nullable();
            $table->text('medicamentos_actuales')->nullable();
            $table->json('signos_vitales')->nullable();
            $table->text('examenes_realizados')->nullable();
            
            // Información de remisión
            $table->string('institucion_remitente');
            $table->string('medico_remitente');
            $table->string('telefono_remitente')->nullable();
            $table->string('email_remitente')->nullable();
            $table->string('especialidad_solicitada');
            $table->string('servicio_solicitado')->default('Consulta externa');
            $table->datetime('fecha_solicitud');
            
            // Priorización y estado
            $table->enum('nivel_prioridad', ['alta', 'media', 'baja'])->default('media');
            $table->enum('clasificacion_triage', ['I', 'II', 'III', 'IV', 'V'])->nullable();
            $table->enum('estado_solicitud', ['nueva', 'en_revision', 'aceptada', 'rechazada', 'pendiente_info'])->default('nueva');
            $table->enum('urgencia_medica', ['urgente', 'critica', 'normal'])->default('normal');
            
            // Decisión médica
            $table->enum('decision_final', ['aceptada', 'rechazada', 'pendiente'])->default('pendiente');
            $table->text('motivo_decision')->nullable();
            $table->text('observaciones_medico')->nullable();
            $table->datetime('fecha_decision')->nullable();
            $table->foreignId('medico_evaluador_id')->nullable()->constrained('users');
            
            // Notificaciones y seguimiento
            $table->boolean('notificacion_enviada')->default(false);
            $table->datetime('fecha_notificacion')->nullable();
            $table->boolean('requiere_informacion_adicional')->default(false);
            $table->text('informacion_solicitada')->nullable();
            
            // Archivos adjuntos
            $table->boolean('tiene_adjuntos')->default(false);
            $table->json('nombres_adjuntos')->nullable();
            $table->json('rutas_adjuntos')->nullable();
            
            // Datos de procesamiento IA
            $table->boolean('procesado_por_ia')->default(false);
            $table->decimal('confianza_ia', 3, 2)->nullable();
            $table->json('datos_extraidos_ia')->nullable();
            $table->datetime('fecha_procesamiento_ia')->nullable();
            
            // Auditoría
            $table->datetime('fecha_recepcion')->default(now());
            $table->decimal('tiempo_respuesta_horas', 8, 2)->nullable();
            $table->foreignId('usuario_creador_id')->nullable()->constrained('users');
            $table->json('historial_cambios')->nullable();
            
            $table->timestamps();
            
            // Índices para optimizar consultas
            $table->index(['estado_solicitud', 'fecha_recepcion']);
            $table->index(['especialidad_solicitada', 'nivel_prioridad']);
            $table->index(['urgencia_medica', 'fecha_solicitud']);
            $table->index(['medico_evaluador_id', 'estado_solicitud']);
            $table->index('fecha_solicitud');
            $table->index('decision_final');
            
            // Relación con emails médicos
            $table->foreign('email_unique_id')->references('unique_id')->on('emails_medicos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_referencia');
    }
};
