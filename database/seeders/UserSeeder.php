<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Seeds default admin and technician users for development & testing.
 */
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@autostitch.test'],
            [
                'name' => 'Admin Bengkel',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'teknisi@autostitch.test'],
            [
                'name' => 'Teknisi Bengkel',
                'password' => 'password',
                'role' => 'technician',
            ]
        );
    }
}
