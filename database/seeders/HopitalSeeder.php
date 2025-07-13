<?php

namespace Database\Seeders;

use App\Models\Hopital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HopitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hopitaux = [
            ['nom_hopital' => 'CHU Gabriel Touré', 'id_commune' => 1],
            ['nom_hopital' => 'CSREF de Sogoniko', 'id_commune' => 2],
            ['nom_hopital' => 'Hôpital du Mali', 'id_commune' => 3],
            ['nom_hopital' => 'CSCOM de Lafiabougou', 'id_commune' => 4],
            ['nom_hopital' => 'Hôpital Point G', 'id_commune' => 5],
            ['nom_hopital' => 'Hôpital Gabriel Touré', 'id_commune' => 4, 'latitude' => 12.6485, 'longitude' => -7.9864],
            ['nom_hopital' => 'Hôpital du Mali', 'id_commune' => 4, 'latitude' => 12.6725, 'longitude' => -8.0554],
            ['nom_hopital' => 'Hôpital Point G', 'id_commune' => 4, 'latitude' => 12.6476, 'longitude' => -7.9851],
            ['nom_hopital' => 'Hôpital de Sikasso', 'id_commune' => 4, 'latitude' => 11.3183, 'longitude' => -5.6775],
            ['nom_hopital' => 'Hôpital régional de Ségou', 'id_commune' => 4, 'latitude' => 13.4407, 'longitude' => -6.2642],
        ];

        foreach ($hopitaux as $hopital) {
            Hopital::create($hopital);
        }
    }
}