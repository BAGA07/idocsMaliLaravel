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
            ['nom_mairie' => 'Mairie de Bamako Coura', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'latitude' => 12.6390, 'longitude' => -7.9911],
            ['nom_mairie' => 'Mairie de Kati', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'latitude' => 12.7441, 'longitude' => -8.0653],
            ['nom_mairie' => 'Mairie de Mopti', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'latitude' => 14.4906, 'longitude' => -4.1947],
            ['nom_mairie' => 'Mairie de Kayes', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'latitude' => 14.4469, 'longitude' => -11.4399],
            ['nom_mairie' => 'Mairie de Tombouctou', 'quartier' => 'Badalabougou', 'id_commune' => 5, 'latitude' => 16.7752, 'longitude' => -3.0094],
        ];

        foreach ($mairies as $mairie) {
            Mairie::firstOrCreate([
                'nom_mairie' => $mairie['nom_mairie'],
            ], $mairie);
        }
    }
}