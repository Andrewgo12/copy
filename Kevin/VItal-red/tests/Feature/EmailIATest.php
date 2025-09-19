<?php

use App\Models\EmailMedico;
use App\Models\RegistroMedico;
use App\Models\User;
use App\Services\EmailIAImportService;

beforeEach(function () {
    $this->admin = User::factory()->create([
        'role' => 'admin',
        'is_active' => true,
    ]);

    $this->medico = User::factory()->create([
        'role' => 'medico',
        'is_active' => true,
    ]);
});

describe('EmailIA Dashboard', function () {
    it('can access dashboard as admin', function () {
        $response = $this->actingAs($this->admin)
            ->get('/admin/ia/dashboard');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('admin/ia-dashboard'));
    });

    it('can access dashboard as medico', function () {
        $response = $this->actingAs($this->medico)
            ->get('/admin/ia/dashboard');

        $response->assertStatus(200);
    });

    it('cannot access dashboard as guest', function () {
        $response = $this->get('/admin/ia/dashboard');

        $response->assertRedirect('/login');
    });
});

describe('EmailIA List', function () {
    it('can view emails list as admin', function () {
        EmailMedico::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)
            ->get('/admin/ia/emails');

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('admin/emails-ia'));
    });

    it('can filter emails by status', function () {
        EmailMedico::factory()->create(['processing_status' => 'validated']);
        EmailMedico::factory()->create(['processing_status' => 'pending']);

        $response = $this->actingAs($this->admin)
            ->get('/admin/ia/emails?status=validated');

        $response->assertStatus(200);
    });

    it('can search emails by patient name', function () {
        EmailMedico::factory()->create(['patient_name' => 'Juan Pérez']);
        EmailMedico::factory()->create(['patient_name' => 'María García']);

        $response = $this->actingAs($this->admin)
            ->get('/admin/ia/emails?search=Juan');

        $response->assertStatus(200);
    });
});

describe('EmailIA Detail', function () {
    it('can view email detail', function () {
        $email = EmailMedico::factory()->create();

        $response = $this->actingAs($this->admin)
            ->get("/admin/ia/emails/{$email->id}");

        $response->assertStatus(200);
        $response->assertInertia(fn ($page) => $page->component('admin/email-ia-detail'));
    });
});

describe('EmailIA Validation', function () {
    it('can validate email as admin', function () {
        $email = EmailMedico::factory()->create([
            'validation_status' => 'pending'
        ]);

        $response = $this->actingAs($this->admin)
            ->post("/admin/ia/emails/{$email->id}/validate", [
                'validation_status' => 'valid',
                'notes' => 'Email médico válido'
            ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $email->refresh();
        expect($email->validation_status)->toBe('valid');
    });

    it('can validate email as medico', function () {
        $email = EmailMedico::factory()->create([
            'validation_status' => 'pending'
        ]);

        $response = $this->actingAs($this->medico)
            ->post("/admin/ia/emails/{$email->id}/validate", [
                'validation_status' => 'valid',
                'notes' => 'Validado por médico'
            ]);

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    });

    it('requires valid validation status', function () {
        $email = EmailMedico::factory()->create();

        $response = $this->actingAs($this->admin)
            ->post("/admin/ia/emails/{$email->id}/validate", [
                'validation_status' => 'invalid_status'
            ]);

        $response->assertStatus(422);
    });
});

describe('EmailIA Create Registro', function () {
    it('can create registro from valid email', function () {
        $email = EmailMedico::factory()->valid()->create([
            'imported_to_registro' => false,
            'patient_name' => 'Juan Pérez',
            'patient_age' => 45,
            'medical_condition' => 'Dolor torácico'
        ]);

        $response = $this->actingAs($this->admin)
            ->post("/admin/ia/emails/{$email->id}/create-registro");

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);

        $email->refresh();
        expect($email->imported_to_registro)->toBeTrue();
        expect($email->registro_medico_id)->not->toBeNull();

        $registro = RegistroMedico::find($email->registro_medico_id);
        expect($registro)->not->toBeNull();
        expect($registro->email_procesado_ia)->toBeTrue();
        expect($registro->fuente_datos)->toBe('email_ia');
    });

    it('cannot create registro from already imported email', function () {
        $email = EmailMedico::factory()->create([
            'imported_to_registro' => true
        ]);

        $response = $this->actingAs($this->admin)
            ->post("/admin/ia/emails/{$email->id}/create-registro");

        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
    });

    it('cannot create registro from invalid email', function () {
        $email = EmailMedico::factory()->create([
            'validation_status' => 'invalid',
            'imported_to_registro' => false
        ]);

        $response = $this->actingAs($this->admin)
            ->post("/admin/ia/emails/{$email->id}/create-registro");

        $response->assertStatus(400);
        $response->assertJson(['success' => false]);
    });
});

describe('EmailIA Import', function () {
    it('can trigger auto import as admin', function () {
        $response = $this->actingAs($this->admin)
            ->post('/admin/ia/auto-import');

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    });

    it('cannot trigger import as medico', function () {
        $response = $this->actingAs($this->medico)
            ->post('/admin/ia/auto-import');

        $response->assertStatus(403);
    });

    it('can import with custom path as admin', function () {
        $response = $this->actingAs($this->admin)
            ->post('/admin/ia/import', [
                'ia_path' => './ia'
            ]);

        // Puede fallar si no existe el directorio, pero debe validar correctamente
        $response->assertStatus(200);
    });

    it('requires ia_path for custom import', function () {
        $response = $this->actingAs($this->admin)
            ->post('/admin/ia/import', []);

        $response->assertStatus(422);
    });
});

describe('EmailIA Process Pending', function () {
    it('can process pending emails as admin', function () {
        EmailMedico::factory()->count(3)->valid()->create([
            'imported_to_registro' => false
        ]);

        $response = $this->actingAs($this->admin)
            ->post('/admin/ia/process-pending');

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
    });

    it('cannot process pending as medico', function () {
        $response = $this->actingAs($this->medico)
            ->post('/admin/ia/process-pending');

        $response->assertStatus(403);
    });
});

describe('EmailIA Stats', function () {
    it('can get stats as admin', function () {
        EmailMedico::factory()->count(5)->create();
        EmailMedico::factory()->count(3)->valid()->create();
        EmailMedico::factory()->count(2)->urgent()->create();

        $response = $this->actingAs($this->admin)
            ->get('/admin/ia/stats');

        $response->assertStatus(200);
        $response->assertJson(['success' => true]);
        $response->assertJsonStructure([
            'success',
            'stats' => [
                'total_emails',
                'medical_emails',
                'pending_import',
                'urgent_emails',
                'by_specialty',
                'by_status'
            ]
        ]);
    });
});
