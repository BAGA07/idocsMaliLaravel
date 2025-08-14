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
            ['nom_mairie' => 'Mairie de Djelibougou', 'quartier' => 'Djelibougou', 'id_commune' => 1, 'email' => 'djelibougou@gmail.com'],
            ['nom_mairie' => 'Mairie de Medina Coura', 'quartier' => 'Medina Coura', 'id_commune' => 2, 'email' => 'medine@gmail.com'],
            ['nom_mairie' => 'Mairie de Badialan', 'quartier' => 'Badialan', 'id_commune' => 3],
            ['nom_mairie' => 'Mairie de Lafiabougou', 'quartier' => 'Lafiabougou', 'id_commune' => 4, 'email' => 'lafiabougou@gmail.com'],
            ['nom_mairie' => 'Mairie de Badalabougou', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'email' => 'badalabougou@gmail.com'],
        ];

        foreach ($mairies as $mairie) {
            Mairie::firstOrCreate([
                'nom_mairie' => $mairie['nom_mairie'],
            ], $mairie);
        }
    }
}