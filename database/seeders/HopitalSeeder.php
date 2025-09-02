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
            ['nom_hopital' => 'CHU Gabriel Touré','email'=>'atest@gmail.com','id_commune' => 1],
            ['nom_hopital' => 'CSREF de Sogoniko','email'=>'btest@gmail.com', 'id_commune' => 2],
            ['nom_hopital' => 'Hôpital du Mali', 'email'=>'ctest@gmail.com','id_commune' => 3],
            ['nom_hopital' => 'CSCOM de Lafiabougou','email'=>'dtest@gmail.com', 'id_commune' => 4],
            ['nom_hopital' => 'Hôpital Point G','email'=>'etest@gmail.com','id_commune' => 5],
        ];

        foreach ($hopitaux as $hopital) {
            Hopital::create($hopital);
        }
    }
}
