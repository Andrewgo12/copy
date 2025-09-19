<?php

namespace App\Services;

use App\Models\EmailMedico;
use App\Models\RegistroMedico;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EmailIAImportService
{
    /**
     * Importar emails procesados desde el sistema de IA Python
     */
    public function importFromIASystem(string $iaBasePath): array
    {
        $results = [
            'total_processed' => 0,
            'imported' => 0,
            'skipped' => 0,
            'errors' => 0,
            'details' => []
        ];

        try {
            // Buscar archivos JSON procesados
            $jsonPath = $iaBasePath . '/Json';
            $professionalPath = $iaBasePath . '/Professional_Email_Records';
            
            if (!is_dir($jsonPath)) {
                throw new \Exception("Directorio de IA no encontrado: {$jsonPath}");
            }

            // Procesar emails regulares
            $regularEmails = $this->processRegularEmails($jsonPath);
            $results['total_processed'] += count($regularEmails);
            
            // Procesar emails médicos profesionales
            $professionalEmails = $this->processProfessionalEmails($professionalPath);
            $results['total_processed'] += count($professionalEmails);
            
            // Combinar todos los emails
            $allEmails = array_merge($regularEmails, $professionalEmails);
            
            foreach ($allEmails as $emailData) {
                try {
                    $result = $this->importSingleEmail($emailData);
                    
                    if ($result['success']) {
                        $results['imported']++;
                    } else {
                        $results['skipped']++;
                    }
                    
                    $results['details'][] = $result;
                    
                } catch (\Exception $e) {
                    $results['errors']++;
                    $results['details'][] = [
                        'success' => false,
                        'email_id' => $emailData['unique_id'] ?? 'unknown',
                        'error' => $e->getMessage()
                    ];
                    
                    Log::error("Error importando email: " . $e->getMessage(), [
                        'email_data' => $emailData
                    ]);
                }
            }
            
        } catch (\Exception $e) {
            Log::error("Error en importación masiva: " . $e->getMessage());
            throw $e;
        }

        return $results;
    }

    /**
     * Procesar emails regulares del directorio Json
     */
    private function processRegularEmails(string $jsonPath): array
    {
        $emails = [];
        
        if (!is_dir($jsonPath)) {
            return $emails;
        }
        
        $directories = glob($jsonPath . '/email_*', GLOB_ONLYDIR);
        
        foreach ($directories as $dir) {
            $emailDataFile = $dir . '/email_data.json';
            
            if (file_exists($emailDataFile)) {
                $data = json_decode(file_get_contents($emailDataFile), true);
                if ($data) {
                    $emails[] = $this->normalizeEmailData($data, 'regular');
                }
            }
        }
        
        return $emails;
    }

    /**
     * Procesar emails médicos profesionales
     */
    private function processProfessionalEmails(string $professionalPath): array
    {
        $emails = [];
        
        if (!is_dir($professionalPath)) {
            return $emails;
        }
        
        $directories = glob($professionalPath . '/test_email_*', GLOB_ONLYDIR);
        
        foreach ($directories as $dir) {
            $emailDataFile = $dir . '/comprehensive_email_record.json';
            
            if (file_exists($emailDataFile)) {
                $data = json_decode(file_get_contents($emailDataFile), true);
                if ($data) {
                    $emails[] = $this->normalizeEmailData($data, 'professional');
                }
            }
        }
        
        return $emails;
    }

    /**
     * Normalizar datos de email según el tipo
     */
    private function normalizeEmailData(array $data, string $type): array
    {
        if ($type === 'professional') {
            return $this->normalizeProfessionalEmail($data);
        } else {
            return $this->normalizeRegularEmail($data);
        }
    }

    /**
     * Normalizar email profesional (médico)
     */
    private function normalizeProfessionalEmail(array $data): array
    {
        $content = $data['content_analysis']['body_content']['plain_text_content'] ?? '';
        
        return [
            'unique_id' => $data['document_identification']['unique_identifier'],
            'message_id' => $data['communication_metadata']['message_identification']['message_id'] ?? null,
            'subject' => $data['content_analysis']['subject_information']['subject_line'] ?? '',
            'from_name' => $data['communication_metadata']['participant_information']['sender_details'][0]['display_name'] ?? '',
            'from_email' => $data['communication_metadata']['participant_information']['sender_details'][0]['email_address'] ?? '',
            'to_email' => $data['communication_metadata']['participant_information']['primary_recipients'][0]['email_address'] ?? '',
            'date_sent' => $this->parseDate($data['communication_metadata']['temporal_information']['sent_datetime'] ?? null),
            'date_received' => $this->parseDate($data['communication_metadata']['temporal_information']['received_datetime'] ?? null),
            'body_content' => $content,
            'raw_content' => $content,
            'urgency_level' => $data['communication_metadata']['priority_and_sensitivity']['priority_level'] ?? 'normal',
            'has_attachments' => $data['attachment_information']['attachment_summary']['has_attachments'] ?? false,
            'attachment_count' => $data['attachment_information']['attachment_summary']['total_attachment_count'] ?? 0,
            'email_size_bytes' => $data['content_analysis']['content_structure']['message_size_bytes'] ?? 0,
            'language_detected' => $data['content_analysis']['body_content']['detected_language'] ?? 'spanish',
            'processing_status' => 'extracted',
            'ia_confidence_score' => 0.95, // Alta confianza para emails profesionales
            'quality_score' => 0.90,
            'validation_status' => 'valid',
            'processed_at' => now(),
            'metadata_json' => $data,
            'type' => 'professional'
        ];
    }

    /**
     * Normalizar email regular
     */
    private function normalizeRegularEmail(array $data): array
    {
        $metadata = $data['metadata'] ?? [];
        $content = $data['content'] ?? [];
        
        return [
            'unique_id' => $data['email_info']['unique_id'],
            'message_id' => $metadata['message_id'] ?? null,
            'subject' => $metadata['subject'] ?? '',
            'from_name' => $metadata['from'][0]['name'] ?? '',
            'from_email' => $metadata['from'][0]['email'] ?? '',
            'to_email' => $metadata['to'][0]['email'] ?? '',
            'date_sent' => $this->parseDate($metadata['date'] ?? null),
            'date_received' => $this->parseDate($metadata['received_date'] ?? null),
            'body_content' => $content['body']['text'] ?? '',
            'html_content' => $content['body']['html'] ?? '',
            'raw_content' => $content['raw_content'] ?? '',
            'has_attachments' => $metadata['has_attachments'] ?? false,
            'attachment_count' => $metadata['attachment_count'] ?? 0,
            'attachment_names' => $metadata['attachment_names'] ?? [],
            'email_size_bytes' => $metadata['size'] ?? 0,
            'processing_status' => 'extracted',
            'ia_confidence_score' => 0.70, // Confianza media para emails regulares
            'quality_score' => 0.75,
            'validation_status' => 'pending',
            'processed_at' => now(),
            'metadata_json' => $data,
            'type' => 'regular'
        ];
    }

    /**
     * Importar un email individual
     */
    private function importSingleEmail(array $emailData): array
    {
        try {
            // Verificar si ya existe
            $existing = EmailMedico::where('unique_id', $emailData['unique_id'])->first();
            
            if ($existing) {
                return [
                    'success' => false,
                    'email_id' => $emailData['unique_id'],
                    'reason' => 'already_exists'
                ];
            }

            // Extraer datos médicos si es un email profesional
            if ($emailData['type'] === 'professional') {
                $emailData = array_merge($emailData, $this->extractMedicalData($emailData));
            }

            // Crear el registro
            $email = EmailMedico::create($emailData);

            // Si es un email médico válido, crear registro médico automáticamente
            if ($email->is_medical_email && $emailData['type'] === 'professional') {
                $this->createRegistroMedicoFromEmail($email);
            }

            return [
                'success' => true,
                'email_id' => $emailData['unique_id'],
                'created_id' => $email->id,
                'is_medical' => $email->is_medical_email
            ];

        } catch (\Exception $e) {
            Log::error("Error importando email individual: " . $e->getMessage(), [
                'email_data' => $emailData
            ]);
            
            throw $e;
        }
    }

    /**
     * Extraer datos médicos del contenido del email
     */
    private function extractMedicalData(array $emailData): array
    {
        $content = $emailData['body_content'] ?? '';
        $medicalData = [];

        // Extraer nombre del paciente
        if (preg_match('/paciente\s+([A-Za-záéíóúñ\s]+)/i', $content, $matches)) {
            $medicalData['patient_name'] = trim($matches[1]);
        }

        // Extraer edad
        if (preg_match('/(\d+)\s+años/i', $content, $matches)) {
            $medicalData['patient_age'] = (int)$matches[1];
        }

        // Extraer género
        if (preg_match('/(femenina|masculino|mujer|hombre)/i', $content, $matches)) {
            $gender = strtolower($matches[1]);
            $medicalData['patient_gender'] = in_array($gender, ['femenina', 'mujer']) ? 'F' : 'M';
        }

        // Extraer institución remitente
        if (preg_match('/Hospital\s+([A-Za-záéíóúñ\s]+)/i', $content, $matches)) {
            $medicalData['institution_sender'] = trim($matches[1]);
        }

        // Extraer doctor
        if (preg_match('/Dr\.\s+([A-Za-záéíóúñ\s]+)/i', $content, $matches)) {
            $medicalData['doctor_sender'] = trim($matches[1]);
        }

        // Extraer especialidad solicitada
        $specialties = ['cardiología', 'neurología', 'ginecología', 'ortopedia', 'pediatría'];
        foreach ($specialties as $specialty) {
            if (stripos($content, $specialty) !== false) {
                $medicalData['specialty_requested'] = $specialty;
                $medicalData['specialty_detected'] = $specialty;
                break;
            }
        }

        // Extraer condición médica
        if (preg_match('/MOTIVO DE CONSULTA:\s*([^\n]+)/i', $content, $matches)) {
            $medicalData['medical_condition'] = trim($matches[1]);
        }

        // Extraer antecedentes
        if (preg_match('/ANTECEDENTES:\s*(.*?)(?=SIGNOS VITALES|$)/is', $content, $matches)) {
            $medicalData['medical_history'] = trim($matches[1]);
        }

        // Extraer signos vitales
        $vitals = [];
        if (preg_match('/Presión arterial:\s*(\d+)\/(\d+)/i', $content, $matches)) {
            $vitals['systolic_bp'] = (int)$matches[1];
            $vitals['diastolic_bp'] = (int)$matches[2];
        }
        if (preg_match('/Frecuencia cardíaca:\s*(\d+)/i', $content, $matches)) {
            $vitals['heart_rate'] = (int)$matches[1];
        }
        if (preg_match('/Temperatura:\s*([\d.]+)/i', $content, $matches)) {
            $vitals['temperature'] = (float)$matches[1];
        }
        if (preg_match('/Saturación.*?(\d+)%/i', $content, $matches)) {
            $vitals['oxygen_saturation'] = (int)$matches[1];
        }
        
        if (!empty($vitals)) {
            $medicalData['vital_signs'] = json_encode($vitals);
        }

        // Extraer medicamentos
        if (preg_match('/MEDICAMENTOS.*?:(.*?)(?=Requiere|Cordialmente|$)/is', $content, $matches)) {
            $medicalData['medications'] = trim($matches[1]);
        }

        return $medicalData;
    }

    /**
     * Crear registro médico desde email
     */
    private function createRegistroMedicoFromEmail(EmailMedico $email): ?RegistroMedico
    {
        try {
            $data = $email->getDataForRegistroMedico();
            
            $registro = RegistroMedico::create($data);
            
            $email->markAsImported($registro->id);
            
            Log::info("Registro médico creado automáticamente desde email", [
                'email_id' => $email->unique_id,
                'registro_id' => $registro->id
            ]);
            
            return $registro;
            
        } catch (\Exception $e) {
            Log::error("Error creando registro médico desde email: " . $e->getMessage(), [
                'email_id' => $email->unique_id
            ]);
            
            return null;
        }
    }

    /**
     * Parsear fecha desde string
     */
    private function parseDate(?string $dateString): ?Carbon
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            return Carbon::parse($dateString);
        } catch (\Exception $e) {
            Log::warning("No se pudo parsear fecha: {$dateString}");
            return null;
        }
    }

    /**
     * Obtener estadísticas de importación
     */
    public function getImportStats(): array
    {
        return [
            'total_emails' => EmailMedico::count(),
            'medical_emails' => EmailMedico::medicosValidos()->count(),
            'pending_import' => EmailMedico::where('imported_to_registro', false)
                                          ->medicosValidos()
                                          ->count(),
            'urgent_emails' => EmailMedico::urgentes()->count(),
            'by_specialty' => EmailMedico::selectRaw('specialty_detected, COUNT(*) as count')
                                        ->whereNotNull('specialty_detected')
                                        ->groupBy('specialty_detected')
                                        ->get()
                                        ->pluck('count', 'specialty_detected')
                                        ->toArray(),
            'by_status' => EmailMedico::selectRaw('processing_status, COUNT(*) as count')
                                     ->groupBy('processing_status')
                                     ->get()
                                     ->pluck('count', 'processing_status')
                                     ->toArray(),
        ];
    }
}
