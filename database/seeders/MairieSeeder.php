<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mairie;

class MairieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mairies = [
            ['nom_mairie' => 'Mairie de Djelibougou', 'quartier' => 'Djelibougou', 'id_commune' => 1],
            ['nom_mairie' => 'Mairie de Medina Coura', 'quartier' => 'Medina Coura', 'id_commune' => 2],
            ['nom_mairie' => 'Mairie de Badialan', 'quartier' => 'Badialan', 'id_commune' => 3],
            ['nom_mairie' => 'Mairie de Lafiabougou', 'quartier' => 'Lafiabougou', 'id_commune' => 4],
            ['nom_mairie' => 'Mairie de Badalabougou', 'quartier' => 'Badalabougou', 'id_commune' => 5],
        ];

        foreach ($mairies as $mairie) {
            Mairie::firstOrCreate([
                'nom_mairie' => $mairie['nom_mairie'],
            ], $mairie);
        }
    }
}
