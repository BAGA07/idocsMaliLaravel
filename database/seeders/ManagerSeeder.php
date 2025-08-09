<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nom' => 'Manager',
            'prenom' => 'Test',
            'adresse' => '123 Rue du Manager, Bamako',
            'telephone' => '+223 12345678',
            'email' => 'manager@test.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
        ]);

        $this->command->info('Manager de test créé avec succès !');
        $this->command->info('Email: manager@test.com');
        $this->command->info('Mot de passe: password');
    }
} 