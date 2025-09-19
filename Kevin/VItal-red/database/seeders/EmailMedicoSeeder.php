<?php

namespace Database\Seeders;

use App\Models\EmailMedico;
use App\Models\RegistroMedico;
use App\Models\User;
use Illuminate\Database\Seeder;

class EmailMedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener usuarios administradores y médicos
        $adminUsers = User::where('role', 'admin')->get();
        $medicoUsers = User::where('role', 'medico')->get();
        $allUsers = $adminUsers->merge($medicoUsers);

        if ($allUsers->isEmpty()) {
            $this->command->warn('No hay usuarios disponibles. Creando usuarios de prueba...');
            
            // Crear usuarios de prueba si no existen
            $admin = User::factory()->create([
                'name' => 'Admin IA',
                'email' => 'admin.ia@hospital.com',
                'role' => 'admin',
                'is_active' => true,
            ]);

            $medico = User::factory()->create([
                'name' => 'Dr. Médico IA',
                'email' => 'medico.ia@hospital.com',
                'role' => 'medico',
                'is_active' => true,
            ]);

            $allUsers = collect([$admin, $medico]);
        }

        $this->command->info('Creando emails médicos de prueba...');

        // 1. Crear emails médicos válidos sin importar (20)
        $this->command->info('- Emails médicos válidos pendientes de importar...');
        EmailMedico::factory()
            ->count(20)
            ->valid()
            ->create([
                'user_id' => $allUsers->random()->id,
                'imported_to_registro' => false,
            ]);

        // 2. Crear emails urgentes (5)
        $this->command->info('- Emails médicos urgentes...');
        EmailMedico::factory()
            ->count(5)
            ->urgent()
            ->create([
                'user_id' => $allUsers->random()->id,
                'imported_to_registro' => false,
            ]);

        // 3. Crear emails ya importados con registros médicos (15)
        $this->command->info('- Emails ya importados con registros médicos...');
        for ($i = 0; $i < 15; $i++) {
            $user = $allUsers->random();
            
            // Crear email médico
            $email = EmailMedico::factory()
                ->valid()
                ->create([
                    'user_id' => $user->id,
                    'imported_to_registro' => true,
                    'processing_status' => 'imported',
                ]);

            // Crear registro médico asociado
            $registro = RegistroMedico::factory()
                ->fromIA()
                ->create([
                    'user_id' => $user->id,
                    'email_unique_id' => $email->unique_id,
                    'email_procesado_ia' => true,
                    'fuente_datos' => 'email_ia',
                    'confianza_extraccion' => $email->ia_confidence_score,
                ]);

            // Actualizar email con ID del registro
            $email->update(['registro_medico_id' => $registro->id]);
        }

        // 4. Crear emails en diferentes estados de procesamiento (10)
        $this->command->info('- Emails en diferentes estados...');
        $statuses = ['pending', 'processing', 'extracted', 'error'];
        foreach ($statuses as $status) {
            EmailMedico::factory()
                ->count(2)
                ->create([
                    'processing_status' => $status,
                    'validation_status' => 'pending',
                    'user_id' => $allUsers->random()->id,
                    'imported_to_registro' => false,
                ]);
        }

        // 5. Crear emails inválidos (5)
        $this->command->info('- Emails inválidos...');
        EmailMedico::factory()
            ->count(5)
            ->create([
                'validation_status' => 'invalid',
                'processing_status' => 'validated',
                'ia_confidence_score' => fake()->randomFloat(2, 0.1, 0.6),
                'patient_name' => null,
                'medical_condition' => null,
                'user_id' => $allUsers->random()->id,
                'imported_to_registro' => false,
            ]);

        // 6. Crear emails que necesitan revisión (3)
        $this->command->info('- Emails que necesitan revisión...');
        EmailMedico::factory()
            ->count(3)
            ->create([
                'validation_status' => 'needs_review',
                'processing_status' => 'extracted',
                'ia_confidence_score' => fake()->randomFloat(2, 0.6, 0.8),
                'user_id' => $allUsers->random()->id,
                'imported_to_registro' => false,
            ]);

        // 7. Crear algunos emails por especialidad específica
        $this->command->info('- Emails por especialidades específicas...');
        $specialties = [
            'cardiología' => 3,
            'neurología' => 3,
            'ginecología' => 2,
            'ortopedia' => 2,
            'pediatría' => 2,
        ];

        foreach ($specialties as $specialty => $count) {
            EmailMedico::factory()
                ->count($count)
                ->valid()
                ->create([
                    'specialty_detected' => $specialty,
                    'specialty_requested' => $specialty,
                    'user_id' => $allUsers->random()->id,
                    'imported_to_registro' => false,
                ]);
        }

        $totalEmails = EmailMedico::count();
        $validEmails = EmailMedico::where('validation_status', 'valid')->count();
        $importedEmails = EmailMedico::where('imported_to_registro', true)->count();
        $urgentEmails = EmailMedico::whereIn('urgency_level', ['urgente', 'crítica'])->count();

        $this->command->info("✅ Seeder completado:");
        $this->command->info("   - Total emails creados: {$totalEmails}");
        $this->command->info("   - Emails médicos válidos: {$validEmails}");
        $this->command->info("   - Emails ya importados: {$importedEmails}");
        $this->command->info("   - Emails urgentes: {$urgentEmails}");
        $this->command->info("   - Emails pendientes de importar: " . ($validEmails - $importedEmails));
    }
}
