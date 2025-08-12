<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Twilio\Rest\Api\V2010\Account\Usage\Record\YesterdayList;

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
            'last_login_at' => Carbon::now()->subDays(2),
            'id_mairie' => 1,
            'role' => 'manager',
        ]);
        User::create([
            'nom' => 'Officier',
            'prenom' => 'Test',
            'adresse' => '123 Rue du Manager, Bamako',
            'telephone' => '+223 12345678',
            'email' => 'officier@test.com',
            'password' => Hash::make('password'),
            'id_mairie' => 1,
            'role' => 'officier',
            'last_login_at' => Carbon::now()->subDays(5),
        ]);
        User::create([
            'nom' => 'Agent',
            'prenom' => 'Hopital',
            'adresse' => '123 Rue du Manager, Bamako',
            'telephone' => '+223 12345678',
            'email' => 'hopital@test.com',
            'password' => Hash::make('password'),
            'last_login_at' => now(),
            'id_hopital' => 1,
            'role' => 'agent_hopital',
        ]);
        User::create([
            'nom' => 'Agent',
            'prenom' => 'Mairie',
            'adresse' => '123 Rue du Manager, Bamako',
            'telephone' => '+223 12345678',
            'email' => 'mairie@test.com',
            'password' => Hash::make('password'),
            'id_mairie' => 1,
            'role' => 'agent_mairie',
            'last_login_at' => Carbon::now()->subDays(10),
        ]);

        $this->command->info('Manager de test créé avec succès !');
        $this->command->info('Email: manager@test.com');
        $this->command->info('Mot de passe: password');
    }
}
