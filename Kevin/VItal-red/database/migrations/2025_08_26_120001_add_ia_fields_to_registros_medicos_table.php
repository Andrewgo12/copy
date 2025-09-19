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
        Schema::table('registros_medicos', function (Blueprint $table) {
            // Campos para integración con IA
            $table->string('email_unique_id')->nullable()->index();
            $table->boolean('email_procesado_ia')->default(false);
            $table->string('fuente_datos')->default('manual'); // manual, email_ia, upload_ia
            $table->decimal('confianza_extraccion', 5, 2)->nullable();
            
            // Índices adicionales
            $table->index(['email_procesado_ia', 'fuente_datos']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registros_medicos', function (Blueprint $table) {
            $table->dropIndex(['email_procesado_ia', 'fuente_datos']);
            $table->dropColumn([
                'email_unique_id',
                'email_procesado_ia', 
                'fuente_datos',
                'confianza_extraccion'
            ]);
        });
    }
};
