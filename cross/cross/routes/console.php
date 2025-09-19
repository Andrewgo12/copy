<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('cross:info', function () {
    $this->info('Sistema CROSS - Laravel Application');
    $this->line('Database: PostgreSQL');
    $this->line('Tables: 146');
    $this->line('Schemas: profiles, schema2');
})->purpose('Display CROSS system information');

Artisan::command('cross:legacy', function () {
    $this->info('Sistemas Legacy Organizados:');
    $this->line('⭐ CROSSHUV - Sistema Principal');
    $this->line('🏗️ CROSS7 - Sistema Base');
    $this->line('📦 CROSS7Fuentes - Código Fuente');
    $this->line('🛠️ CROSS7WORK - Entorno Desarrollo');
})->purpose('Display legacy systems information');