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
        Schema::create('emails_medicos', function (Blueprint $table) {
            $table->id();
            
            // Identificación del email
            $table->string('unique_id')->unique()->index();
            $table->string('message_id')->nullable();
            $table->string('thread_id')->nullable();
            
            // Metadatos del email
            $table->text('subject')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email')->nullable();
            $table->string('to_email')->nullable();
            $table->timestamp('date_sent')->nullable();
            $table->timestamp('date_received')->nullable();
            
            // Contenido
            $table->longText('body_content')->nullable();
            $table->longText('html_content')->nullable();
            $table->longText('raw_content')->nullable();
            
            // Información médica extraída
            $table->string('patient_name')->nullable();
            $table->integer('patient_age')->nullable();
            $table->string('patient_gender')->nullable();
            $table->string('patient_id_number')->nullable();
            $table->string('institution_sender')->nullable();
            $table->string('doctor_sender')->nullable();
            $table->string('specialty_requested')->nullable();
            $table->string('urgency_level')->nullable();
            $table->text('medical_condition')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('vital_signs')->nullable();
            $table->text('medications')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('diagnosis')->nullable();
            
            // Adjuntos
            $table->boolean('has_attachments')->default(false);
            $table->integer('attachment_count')->default(0);
            $table->json('attachment_names')->nullable();
            $table->json('attachment_paths')->nullable();
            
            // Estado de procesamiento
            $table->string('processing_status')->default('pending');
            $table->decimal('ia_confidence_score', 5, 2)->nullable();
            $table->decimal('quality_score', 5, 2)->nullable();
            $table->string('validation_status')->default('pending');
            $table->timestamp('processed_at')->nullable();
            $table->boolean('imported_to_registro')->default(false);
            
            // Datos técnicos
            $table->bigInteger('email_size_bytes')->nullable();
            $table->string('language_detected')->nullable();
            $table->json('medical_keywords_found')->nullable();
            $table->string('specialty_detected')->nullable();
            
            // Relaciones
            $table->foreignId('registro_medico_id')->nullable()->constrained('registros_medicos')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            
            // JSON fields para datos complejos
            $table->json('metadata_json')->nullable();
            $table->json('extracted_data_json')->nullable();
            $table->json('attachments_json')->nullable();
            $table->json('processing_log_json')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index(['processing_status', 'validation_status']);
            $table->index(['urgency_level', 'date_sent']);
            $table->index(['specialty_detected', 'specialty_requested']);
            $table->index(['imported_to_registro', 'processed_at']);
            $table->index('patient_name');
            $table->index('from_email');
            $table->index('date_sent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails_medicos');
    }
};
