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
        ];

        foreach ($hopitaux as $hopital) {
            Hopital::create($hopital);
        }
    }
}
