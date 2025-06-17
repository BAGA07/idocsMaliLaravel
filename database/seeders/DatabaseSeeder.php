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
        $this->call([
            HopitalSeeder::class,
        ]);

        $this->call([
            CommuneSeeder::class,
        ]);


        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
}
