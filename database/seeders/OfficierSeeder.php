<?php

namespace Database\Seeders;

use App\Models\Officier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Officier::factory()->count(10)->create();
        $officiers = [
            ['nom' => 'Mamadi ', 'prenom' => 'Kone','profession'=>'Officier etat civil', 'id_commune' => 1],
            ['nom' => 'Issiaka', 'prenom' => 'Kanté','profession'=>'Officier etat civil',  'id_commune' => 2],];

  foreach ($officiers as $officier) {
            Officier::firstOrCreate([
                'nom' => $officier['nom'],
            ], $officier);
        }

    }
}
