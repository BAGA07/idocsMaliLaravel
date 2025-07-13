<?php

namespace Database\Seeders;

use App\Models\Hopital;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use StructureSeeder;

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
            HopitalSeeder::class,
            CommuneSeeder::class,
            VoletDeclarationSeeder::class,
            DemandeSeeder::class,
            MairieSeeder::class,
        ]);
    }
}
