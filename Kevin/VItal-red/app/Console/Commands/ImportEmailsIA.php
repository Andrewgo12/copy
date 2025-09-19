<?php

namespace App\Console\Commands;

use App\Services\EmailIAImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportEmailsIA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ia:import-emails 
                            {path? : Ruta al directorio del sistema de IA}
                            {--auto : Usar ruta automática del proyecto}
                            {--force : Forzar reimportación de emails existentes}
                            {--limit=100 : Límite de emails a procesar}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar emails procesados desde el sistema de IA Python';

    protected $importService;

    public function __construct(EmailIAImportService $importService)
    {
        parent::__construct();
        $this->importService = $importService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🤖 Iniciando importación de emails desde sistema de IA...');

        try {
            // Determinar la ruta del sistema de IA
            $iaPath = $this->getIAPath();
            
            if (!$iaPath) {
                $this->error('❌ No se pudo determinar la ruta del sistema de IA');
                return 1;
            }

            $this->info("📂 Usando directorio: {$iaPath}");

            // Verificar que el directorio existe
            if (!is_dir($iaPath)) {
                $this->error("❌ Directorio no encontrado: {$iaPath}");
                return 1;
            }

            // Mostrar estadísticas antes de la importación
            $this->showPreImportStats();

            // Ejecutar la importación
            $this->info('🔄 Procesando emails...');
            
            $results = $this->importService->importFromIASystem($iaPath);

            // Mostrar resultados
            $this->showResults($results);

            // Mostrar estadísticas después de la importación
            $this->showPostImportStats();

            $this->info('✅ Importación completada exitosamente');
            return 0;

        } catch (\Exception $e) {
            $this->error("❌ Error durante la importación: {$e->getMessage()}");
            Log::error('Error en comando de importación IA', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
    }

    /**
     * Determinar la ruta del sistema de IA
     */
    private function getIAPath(): ?string
    {
        // Si se especifica --auto, usar la ruta del proyecto
        if ($this->option('auto')) {
            return base_path('ia');
        }

        // Si se proporciona un argumento de ruta
        if ($this->argument('path')) {
            return $this->argument('path');
        }

        // Intentar detectar automáticamente
        $possiblePaths = [
            base_path('ia'),
            base_path('../ia'),
            getcwd() . '/ia',
        ];

        foreach ($possiblePaths as $path) {
            if (is_dir($path) && is_dir($path . '/Json')) {
                $this->info("🔍 Detectado automáticamente: {$path}");
                return $path;
            }
        }

        // Si no se encuentra, preguntar al usuario
        return $this->ask('📁 Ingrese la ruta completa al directorio del sistema de IA');
    }

    /**
     * Mostrar estadísticas antes de la importación
     */
    private function showPreImportStats()
    {
        $stats = $this->importService->getImportStats();
        
        $this->info('📊 Estadísticas actuales:');
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Total emails en BD', $stats['total_emails']],
                ['Emails médicos válidos', $stats['medical_emails']],
                ['Pendientes de importar', $stats['pending_import']],
                ['Emails urgentes', $stats['urgent_emails']],
            ]
        );
    }

    /**
     * Mostrar resultados de la importación
     */
    private function showResults(array $results)
    {
        $this->info('📈 Resultados de la importación:');
        
        $this->table(
            ['Métrica', 'Cantidad'],
            [
                ['Total procesados', $results['total_processed']],
                ['Importados exitosamente', $results['imported']],
                ['Omitidos (ya existían)', $results['skipped']],
                ['Errores', $results['errors']],
            ]
        );

        // Mostrar detalles de errores si los hay
        if ($results['errors'] > 0) {
            $this->warn('⚠️  Se encontraron errores durante la importación:');
            
            $errorDetails = array_filter($results['details'], function($detail) {
                return !$detail['success'] && isset($detail['error']);
            });

            foreach (array_slice($errorDetails, 0, 5) as $error) {
                $this->line("   • {$error['email_id']}: {$error['error']}");
            }

            if (count($errorDetails) > 5) {
                $remaining = count($errorDetails) - 5;
                $this->line("   ... y {$remaining} errores más (ver logs para detalles)");
            }
        }

        // Mostrar algunos emails importados exitosamente
        if ($results['imported'] > 0) {
            $this->info('✅ Algunos emails importados exitosamente:');
            
            $successDetails = array_filter($results['details'], function($detail) {
                return $detail['success'];
            });

            foreach (array_slice($successDetails, 0, 3) as $success) {
                $medicalFlag = isset($success['is_medical']) && $success['is_medical'] ? ' 🏥' : '';
                $this->line("   • {$success['email_id']}{$medicalFlag}");
            }
        }
    }

    /**
     * Mostrar estadísticas después de la importación
     */
    private function showPostImportStats()
    {
        $stats = $this->importService->getImportStats();
        
        $this->info('📊 Estadísticas actualizadas:');
        $this->table(
            ['Métrica', 'Valor'],
            [
                ['Total emails en BD', $stats['total_emails']],
                ['Emails médicos válidos', $stats['medical_emails']],
                ['Pendientes de importar', $stats['pending_import']],
                ['Emails urgentes', $stats['urgent_emails']],
            ]
        );

        // Mostrar distribución por especialidad
        if (!empty($stats['by_specialty'])) {
            $this->info('🏥 Distribución por especialidad:');
            $specialtyData = [];
            foreach ($stats['by_specialty'] as $specialty => $count) {
                $specialtyData[] = [ucfirst($specialty), $count];
            }
            $this->table(['Especialidad', 'Cantidad'], $specialtyData);
        }

        // Mostrar distribución por estado
        if (!empty($stats['by_status'])) {
            $this->info('📋 Distribución por estado:');
            $statusData = [];
            foreach ($stats['by_status'] as $status => $count) {
                $statusData[] = [ucfirst($status), $count];
            }
            $this->table(['Estado', 'Cantidad'], $statusData);
        }
    }
}
