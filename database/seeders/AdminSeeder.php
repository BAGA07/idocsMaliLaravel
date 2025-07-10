<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@idocs.ml'],
            [
                'prenom' => 'Super',
                'nom' => 'Admin',
                'adresse' => '',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}