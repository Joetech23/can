<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('fasttrack:admin {email} {name}', function (string $email, string $name) {
    $password = $this->secret('Password (min 12 characters)');

    if (strlen((string) $password) < 12) {
        $this->error('Password must be at least 12 characters.');

        return 1;
    }

    User::updateOrCreate(['email' => $email], ['name' => $name, 'password' => $password]);
    $this->info("Staff login ready for $email.");
})->purpose('Create or reset a CRM staff login');
