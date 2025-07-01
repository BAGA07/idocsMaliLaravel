<?php

namespace Database\Seeders;

use App\Models\Hopital;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // Dans un fichier seeder
        // $this->call([

        // ]);

        $this->call([
            CommuneSeeder::class,
            HopitalSeeder::class
        ]);
        $this->call([
            //UserSeeder::class,
            //PersonneSeeder::class,
            /* VoletDeclarationSeeder::class,
        HopitalSeeder::class,
        ActeSeeder::class,
        OfficierSeeder::class,
        PieceJointeSeeder::class,
        MairieSeeder::class,
        DemandeSeeder::class,
        DeclarantSeeder::class,
        CommuneSeeder::class, */]); //



    }
}