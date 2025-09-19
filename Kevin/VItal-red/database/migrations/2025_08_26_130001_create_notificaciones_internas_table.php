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
        Schema::create('notificaciones_internas', function (Blueprint $table) {
            $table->id();
            
            // Relación con solicitud
            $table->foreignId('solicitud_referencia_id')->constrained('solicitudes_referencia')->onDelete('cascade');
            
            // Información de la notificación
            $table->string('tipo'); // solicitud_aceptada, solicitud_rechazada, nueva_solicitud_urgente, etc.
            $table->string('titulo');
            $table->text('mensaje');
            
            // Destinatarios
            $table->foreignId('destinatario_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('remitente_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Configuración
            $table->enum('prioridad', ['alta', 'media', 'baja'])->default('media');
            $table->boolean('enviada')->default(false);
            $table->boolean('leida')->default(false);
            $table->datetime('fecha_envio')->nullable();
            $table->datetime('fecha_lectura')->nullable();
            
            // Canal y acciones
            $table->enum('canal_notificacion', ['sistema', 'email', 'sms'])->default('sistema');
            $table->string('accion_requerida')->nullable();
            $table->string('url_accion')->nullable();
            $table->json('datos_adicionales')->nullable();
            
            $table->timestamps();
            
            // Índices
            $table->index(['destinatario_id', 'leida']);
            $table->index(['tipo', 'prioridad']);
            $table->index('fecha_envio');
            $table->index(['enviada', 'fecha_envio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificaciones_internas');
    }
};
