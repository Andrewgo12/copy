<?php

use App\Models\EmailMedico;
use App\Models\RegistroMedico;
use App\Services\EmailIAImportService;

describe('EmailIAImportService', function () {
    beforeEach(function () {
        $this->service = new EmailIAImportService();
    });

    it('can get import stats', function () {
        // Crear datos de prueba
        EmailMedico::factory()->count(10)->create();
        EmailMedico::factory()->count(5)->valid()->create();
        EmailMedico::factory()->count(3)->urgent()->create();
        EmailMedico::factory()->count(2)->create([
            'specialty_detected' => 'cardiología'
        ]);

        $stats = $this->service->getImportStats();

        expect($stats)->toHaveKeys([
            'total_emails',
            'medical_emails', 
            'pending_import',
            'urgent_emails',
            'by_specialty',
            'by_status'
        ]);

        expect($stats['total_emails'])->toBeGreaterThan(0);
        expect($stats['by_specialty'])->toBeArray();
        expect($stats['by_status'])->toBeArray();
    });

    it('can handle empty database', function () {
        $stats = $this->service->getImportStats();

        expect($stats['total_emails'])->toBe(0);
        expect($stats['medical_emails'])->toBe(0);
        expect($stats['pending_import'])->toBe(0);
        expect($stats['urgent_emails'])->toBe(0);
    });

    it('calculates medical emails correctly', function () {
        // Crear emails válidos
        EmailMedico::factory()->count(3)->create([
            'validation_status' => 'valid',
            'ia_confidence_score' => 0.8
        ]);

        // Crear emails inválidos
        EmailMedico::factory()->count(2)->create([
            'validation_status' => 'invalid',
            'ia_confidence_score' => 0.3
        ]);

        $stats = $this->service->getImportStats();

        expect($stats['total_emails'])->toBe(5);
        expect($stats['medical_emails'])->toBe(3);
    });

    it('calculates pending import correctly', function () {
        // Crear emails válidos no importados
        EmailMedico::factory()->count(4)->create([
            'validation_status' => 'valid',
            'ia_confidence_score' => 0.8,
            'imported_to_registro' => false
        ]);

        // Crear emails válidos ya importados
        EmailMedico::factory()->count(2)->create([
            'validation_status' => 'valid',
            'ia_confidence_score' => 0.8,
            'imported_to_registro' => true
        ]);

        $stats = $this->service->getImportStats();

        expect($stats['medical_emails'])->toBe(6);
        expect($stats['pending_import'])->toBe(4);
    });

    it('counts urgent emails correctly', function () {
        EmailMedico::factory()->count(2)->create([
            'urgency_level' => 'urgente'
        ]);

        EmailMedico::factory()->count(1)->create([
            'urgency_level' => 'crítica'
        ]);

        EmailMedico::factory()->count(3)->create([
            'urgency_level' => 'media'
        ]);

        $stats = $this->service->getImportStats();

        expect($stats['urgent_emails'])->toBe(3); // urgente + crítica
    });

    it('groups by specialty correctly', function () {
        EmailMedico::factory()->count(3)->create([
            'specialty_detected' => 'cardiología'
        ]);

        EmailMedico::factory()->count(2)->create([
            'specialty_detected' => 'neurología'
        ]);

        EmailMedico::factory()->count(1)->create([
            'specialty_detected' => null
        ]);

        $stats = $this->service->getImportStats();

        expect($stats['by_specialty'])->toHaveKey('cardiología');
        expect($stats['by_specialty'])->toHaveKey('neurología');
        expect($stats['by_specialty']['cardiología'])->toBe(3);
        expect($stats['by_specialty']['neurología'])->toBe(2);
    });

    it('groups by status correctly', function () {
        EmailMedico::factory()->count(3)->create([
            'processing_status' => 'validated'
        ]);

        EmailMedico::factory()->count(2)->create([
            'processing_status' => 'pending'
        ]);

        EmailMedico::factory()->count(1)->create([
            'processing_status' => 'imported'
        ]);

        $stats = $this->service->getImportStats();

        expect($stats['by_status'])->toHaveKey('validated');
        expect($stats['by_status'])->toHaveKey('pending');
        expect($stats['by_status'])->toHaveKey('imported');
        expect($stats['by_status']['validated'])->toBe(3);
        expect($stats['by_status']['pending'])->toBe(2);
        expect($stats['by_status']['imported'])->toBe(1);
    });
});
