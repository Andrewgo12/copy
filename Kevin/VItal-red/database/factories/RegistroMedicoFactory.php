<?php

namespace Database\Factories;

use App\Models\RegistroMedico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegistroMedico>
 */
class RegistroMedicoFactory extends Factory
{
    protected $model = RegistroMedico::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $especialidades = ['cardiología', 'neurología', 'ginecología', 'ortopedia', 'pediatría', 'medicina interna'];
        $aseguradores = ['EPS Sanitas', 'Compensar', 'Nueva EPS', 'Famisanar', 'Coomeva'];
        $departamentos = ['Cundinamarca', 'Antioquia', 'Valle del Cauca', 'Atlántico', 'Santander'];
        $municipios = ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Bucaramanga'];

        return [
            // Información personal
            'nombre' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'tipo_identificacion' => $this->faker->randomElement(['CC', 'TI', 'CE', 'PP']),
            'numero_identificacion' => $this->faker->numerify('##########'),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-90 years', '-1 year'),
            'edad' => $this->faker->numberBetween(1, 90),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'telefono' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'direccion' => $this->faker->address(),

            // Datos sociodemográficos
            'asegurador' => $this->faker->randomElement($aseguradores),
            'tipo_afiliacion' => $this->faker->randomElement(['Contributivo', 'Subsidiado', 'Particular']),
            'departamento_residencia' => $this->faker->randomElement($departamentos),
            'municipio_residencia' => $this->faker->randomElement($municipios),
            'zona_residencia' => $this->faker->randomElement(['Urbana', 'Rural']),
            'grupo_poblacional' => $this->faker->randomElement(['Ninguno', 'Indígena', 'Afrodescendiente', 'ROM']),

            // Datos clínicos
            'motivo_consulta' => $this->faker->randomElement([
                'Dolor torácico',
                'Cefalea persistente',
                'Dolor abdominal',
                'Fiebre',
                'Disnea'
            ]),
            'enfermedad_actual' => $this->faker->paragraph(3),
            'antecedentes' => $this->faker->randomElement([
                'Hipertensión arterial',
                'Diabetes mellitus tipo 2',
                'Sin antecedentes relevantes',
                'Cirugía previa'
            ]),
            'revision_sistemas' => $this->faker->paragraph(2),
            'examen_fisico' => $this->faker->paragraph(2),

            // Signos vitales
            'frecuencia_cardiaca' => $this->faker->numberBetween(60, 120),
            'frecuencia_respiratoria' => $this->faker->numberBetween(12, 24),
            'temperatura' => $this->faker->randomFloat(1, 36.0, 39.5),
            'tension_sistolica' => $this->faker->numberBetween(90, 180),
            'tension_diastolica' => $this->faker->numberBetween(60, 110),
            'saturacion_oxigeno' => $this->faker->numberBetween(85, 100),
            'glucometria' => $this->faker->numberBetween(70, 200),

            // Diagnósticos y tratamiento
            'diagnostico_principal' => $this->faker->randomElement([
                'Síndrome coronario agudo',
                'Cefalea tensional',
                'Gastroenteritis aguda',
                'Infección respiratoria',
                'Hipertensión arterial'
            ]),
            'diagnosticos_secundarios' => $this->faker->randomElement([
                'Diabetes mellitus',
                'Obesidad',
                'Dislipidemia',
                null
            ]),
            'tratamiento' => $this->faker->paragraph(2),
            'medicamentos' => $this->faker->randomElement([
                'Acetaminofén 500mg c/8h, Omeprazol 20mg c/24h',
                'Ibuprofeno 400mg c/12h, Losartán 50mg c/24h',
                'Metformina 850mg c/12h, Atorvastatina 20mg c/24h'
            ]),

            // Datos de remisión
            'especialidad_solicitada' => $this->faker->randomElement($especialidades),
            'motivo_remision' => $this->faker->paragraph(1),
            'clasificacion_triage' => $this->faker->randomElement(['I', 'II', 'III', 'IV', 'V']),
            'servicio_solicitado' => $this->faker->randomElement([
                'Consulta externa',
                'Hospitalización',
                'Urgencias',
                'Cirugía'
            ]),
            'fecha_ingreso' => $this->faker->dateTimeBetween('-30 days', 'now'),

            // Campos de control
            'estado' => $this->faker->randomElement(['pendiente_revision', 'en_proceso', 'completado', 'rechazado']),
            'fecha_envio' => $this->faker->dateTimeBetween('-30 days', 'now'),

            // Campos para integración con IA (por defecto manual)
            'email_unique_id' => null,
            'email_procesado_ia' => false,
            'fuente_datos' => 'manual',
            'confianza_extraccion' => null,

            // Relación con usuario
            'user_id' => User::factory(),
        ];
    }

    /**
     * Estado para registros creados desde IA
     */
    public function fromIA(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_unique_id' => 'email_' . $this->faker->unique()->randomNumber(8) . '_' . time(),
            'email_procesado_ia' => true,
            'fuente_datos' => 'email_ia',
            'confianza_extraccion' => $this->faker->randomFloat(2, 0.7, 1.0),
            'estado' => 'pendiente_revision',
        ]);
    }

    /**
     * Estado para registros urgentes
     */
    public function urgent(): static
    {
        return $this->state(fn (array $attributes) => [
            'clasificacion_triage' => $this->faker->randomElement(['I', 'II']),
            'motivo_consulta' => $this->faker->randomElement([
                'Dolor torácico agudo',
                'Disnea severa',
                'Alteración del estado de conciencia'
            ]),
            'estado' => 'en_proceso',
        ]);
    }

    /**
     * Estado para registros pediátricos
     */
    public function pediatric(): static
    {
        return $this->state(fn (array $attributes) => [
            'edad' => $this->faker->numberBetween(0, 17),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-17 years', 'now'),
            'especialidad_solicitada' => 'pediatría',
            'tipo_identificacion' => $this->faker->randomElement(['TI', 'RC']),
        ]);
    }

    /**
     * Estado para registros geriátricos
     */
    public function geriatric(): static
    {
        return $this->state(fn (array $attributes) => [
            'edad' => $this->faker->numberBetween(65, 90),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-90 years', '-65 years'),
            'antecedentes' => 'Hipertensión arterial, Diabetes mellitus tipo 2, Dislipidemia',
            'medicamentos' => 'Losartán 50mg c/24h, Metformina 850mg c/12h, Atorvastatina 20mg c/24h',
        ]);
    }

    /**
     * Estado para registros completados
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'completado',
            'fecha_envio' => $this->faker->dateTimeBetween('-7 days', 'now'),
        ]);
    }

    /**
     * Estado para registros con usuario específico
     */
    public function withUser(User $user): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $user->id,
        ]);
    }
}
