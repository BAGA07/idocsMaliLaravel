<?php

namespace Database\Seeders;

use App\Models\Commune;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communes = [
            ['nom_commune' => 'Commune I', 'region' => 'Bamako', 'cercle' => 'Bamako'],
            ['nom_commune' => 'Commune II', 'region' => 'Bamako', 'cercle' => 'Bamako'],
            ['nom_commune' => 'Commune III', 'region' => 'Bamako', 'cercle' => 'Bamako'],
            ['nom_commune' => 'Commune IV', 'region' => 'Bamako', 'cercle' => 'Bamako'],
            ['nom_commune' => 'Commune V', 'region' => 'Bamako', 'cercle' => 'Bamako'],
            ['nom_commune' => 'Commune VI', 'region' => 'Bamako', 'cercle' => 'Bamako'],
        ];

        foreach ($communes as $commune) {
            Commune::create($commune);
        }
    }
}
