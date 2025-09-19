<?php

namespace Database\Factories;

use App\Models\EmailMedico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmailMedico>
 */
class EmailMedicoFactory extends Factory
{
    protected $model = EmailMedico::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $specialties = ['cardiología', 'neurología', 'ginecología', 'ortopedia', 'pediatría', 'medicina interna'];
        $urgencyLevels = ['baja', 'media', 'alta', 'urgente', 'crítica'];
        $processingStatuses = ['pending', 'processing', 'extracted', 'validated', 'imported', 'error'];
        $validationStatuses = ['pending', 'valid', 'invalid', 'needs_review'];

        return [
            'unique_id' => 'email_' . $this->faker->unique()->randomNumber(8) . '_' . time(),
            'message_id' => '<' . $this->faker->uuid() . '@hospital.com>',
            'thread_id' => $this->faker->uuid(),
            
            // Metadatos del email
            'subject' => $this->faker->randomElement([
                'Referencia médica urgente - Paciente con dolor torácico',
                'Solicitud de interconsulta - Neurología',
                'Remisión paciente pediátrico',
                'Caso ginecológico para evaluación',
                'Referencia ortopédica - Fractura compleja'
            ]),
            'from_name' => 'Dr. ' . $this->faker->name(),
            'from_email' => $this->faker->email(),
            'to_email' => 'referencia@hospitaluniversitario.com',
            'date_sent' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'date_received' => $this->faker->dateTimeBetween('-30 days', 'now'),
            
            // Contenido
            'body_content' => $this->generateMedicalEmailContent(),
            'html_content' => null,
            'raw_content' => $this->generateMedicalEmailContent(),
            
            // Información médica extraída
            'patient_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'patient_age' => $this->faker->numberBetween(1, 90),
            'patient_gender' => $this->faker->randomElement(['M', 'F']),
            'patient_id_number' => $this->faker->numerify('##########'),
            'institution_sender' => $this->faker->randomElement([
                'Hospital San José',
                'Clínica del Norte',
                'Centro Médico La Esperanza',
                'Hospital Regional'
            ]),
            'doctor_sender' => 'Dr. ' . $this->faker->name(),
            'specialty_requested' => $this->faker->randomElement($specialties),
            'specialty_detected' => $this->faker->randomElement($specialties),
            'urgency_level' => $this->faker->randomElement($urgencyLevels),
            'medical_condition' => $this->faker->randomElement([
                'Dolor torácico agudo',
                'Cefalea persistente',
                'Fractura de fémur',
                'Sangrado vaginal anormal',
                'Fiebre de origen desconocido'
            ]),
            'symptoms' => $this->faker->randomElement([
                'Dolor, disnea, sudoración',
                'Cefalea intensa, náuseas, vómito',
                'Dolor intenso, limitación funcional',
                'Sangrado abundante, dolor pélvico',
                'Fiebre alta, malestar general'
            ]),
            'vital_signs' => json_encode([
                'heart_rate' => $this->faker->numberBetween(60, 120),
                'temperature' => $this->faker->randomFloat(1, 36.0, 39.5),
                'systolic_bp' => $this->faker->numberBetween(90, 180),
                'diastolic_bp' => $this->faker->numberBetween(60, 110),
                'oxygen_saturation' => $this->faker->numberBetween(85, 100)
            ]),
            'medications' => $this->faker->randomElement([
                'Acetaminofén 500mg c/8h',
                'Ibuprofeno 400mg c/12h',
                'Omeprazol 20mg c/24h',
                'Losartán 50mg c/24h'
            ]),
            'medical_history' => $this->faker->randomElement([
                'Hipertensión arterial',
                'Diabetes mellitus tipo 2',
                'Sin antecedentes relevantes',
                'Cirugía previa de vesícula'
            ]),
            'diagnosis' => $this->faker->randomElement([
                'Síndrome coronario agudo a descartar',
                'Cefalea tensional vs migraña',
                'Fractura de fémur proximal',
                'Metrorragia disfuncional',
                'Síndrome febril en estudio'
            ]),
            
            // Adjuntos
            'has_attachments' => $this->faker->boolean(70),
            'attachment_count' => $this->faker->numberBetween(0, 3),
            'attachment_names' => $this->faker->boolean(70) ? [
                'epicrisis.pdf',
                'laboratorios.jpg'
            ] : [],
            'attachment_paths' => [],
            
            // Estado de procesamiento
            'processing_status' => $this->faker->randomElement($processingStatuses),
            'ia_confidence_score' => $this->faker->randomFloat(2, 0.5, 1.0),
            'quality_score' => $this->faker->randomFloat(2, 0.6, 1.0),
            'validation_status' => $this->faker->randomElement($validationStatuses),
            'processed_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'imported_to_registro' => $this->faker->boolean(30),
            
            // Datos técnicos
            'email_size_bytes' => $this->faker->numberBetween(1024, 1048576), // 1KB - 1MB
            'language_detected' => 'spanish',
            'medical_keywords_found' => [
                'paciente', 'diagnóstico', 'tratamiento', 'referencia'
            ],
            
            // Relaciones
            'registro_medico_id' => null,
            'user_id' => null,
            
            // JSON fields
            'metadata_json' => [
                'source' => 'factory',
                'generated_at' => now()->toISOString()
            ],
            'extracted_data_json' => [],
            'attachments_json' => [],
            'processing_log_json' => [
                [
                    'action' => 'created',
                    'timestamp' => now()->toISOString(),
                    'source' => 'factory'
                ]
            ],
        ];
    }

    /**
     * Generar contenido médico realista para el email
     */
    private function generateMedicalEmailContent(): string
    {
        $templates = [
            "Estimados colegas,\n\nRemito paciente {patient_name} de {patient_age} años de edad, género {gender}, con cuadro de {condition}.\n\nAntecedentes: {history}\nExamen físico: {symptoms}\nSignos vitales: PA {bp}, FC {hr}, Temp {temp}°C\n\nDiagnóstico presuntivo: {diagnosis}\n\nSolicito evaluación por {specialty} para manejo especializado.\n\nAtentamente,\nDr. {doctor}",
            
            "Buenos días,\n\nPaciente {patient_name}, {patient_age} años, {gender}, consulta por {condition}.\n\nCuadro clínico: {symptoms}\nSignos vitales estables\nMedicación actual: {medications}\n\nRequiere interconsulta con {specialty} para continuar manejo.\n\nGracias por su atención.\nDr. {doctor}",
            
            "Cordial saludo,\n\nRemito caso de {patient_name} ({patient_age} años) con {diagnosis}.\n\nPaciente presenta {symptoms}. Antecedentes de {history}.\n\nSe solicita evaluación urgente por {specialty}.\n\nAdjunto epicrisis y paraclínicos.\n\nDr. {doctor}"
        ];

        $template = $this->faker->randomElement($templates);
        
        return str_replace([
            '{patient_name}', '{patient_age}', '{gender}', '{condition}',
            '{history}', '{symptoms}', '{bp}', '{hr}', '{temp}',
            '{diagnosis}', '{specialty}', '{doctor}', '{medications}'
        ], [
            $this->faker->firstName() . ' ' . $this->faker->lastName(),
            $this->faker->numberBetween(1, 90),
            $this->faker->randomElement(['masculino', 'femenino']),
            $this->faker->randomElement(['dolor torácico', 'cefalea', 'fiebre', 'dolor abdominal']),
            $this->faker->randomElement(['HTA', 'DM2', 'sin antecedentes', 'cirugía previa']),
            $this->faker->randomElement(['dolor intenso', 'malestar general', 'náuseas', 'disnea']),
            $this->faker->numberBetween(90, 180) . '/' . $this->faker->numberBetween(60, 110),
            $this->faker->numberBetween(60, 120),
            $this->faker->randomFloat(1, 36.0, 39.5),
            $this->faker->randomElement(['síndrome coronario agudo', 'cefalea tensional', 'gastroenteritis']),
            $this->faker->randomElement(['cardiología', 'neurología', 'medicina interna']),
            $this->faker->name(),
            $this->faker->randomElement(['acetaminofén', 'ibuprofeno', 'omeprazol'])
        ], $template);
    }

    /**
     * Estado para emails médicos válidos
     */
    public function valid(): static
    {
        return $this->state(fn (array $attributes) => [
            'validation_status' => 'valid',
            'processing_status' => 'validated',
            'ia_confidence_score' => $this->faker->randomFloat(2, 0.8, 1.0),
        ]);
    }

    /**
     * Estado para emails urgentes
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'urgency_level' => $this->faker->randomElement(['urgente', 'crítica']),
            'processing_status' => 'validated',
            'validation_status' => 'valid',
        ]);
    }

    /**
     * Estado para emails ya importados
     */
    public function imported(): static
    {
        return $this->state(fn (array $attributes) => [
            'imported_to_registro' => true,
            'processing_status' => 'imported',
            'validation_status' => 'valid',
            'registro_medico_id' => \App\Models\RegistroMedico::factory(),
        ]);
    }

    /**
     * Estado para emails con usuario asignado
     */
    public function withUser(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => User::factory(),
        ]);
    }
}
