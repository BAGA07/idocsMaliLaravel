<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Declarant;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DeclarantSeeder extends Seeder
{
    public function run(): void
    {
        $prenoms = ['Mamadou', 'Aminata', 'Boubacar', 'Fatoumata', 'Oumar', 'Kadidia', 'Ibrahim', 'Mariama'];
        $noms = ['Traoré', 'Diarra', 'Coulibaly', 'Koné', 'Diallo', 'Camara'];
        $professions = ['Commerçant', 'Agriculteur', 'Enseignant', 'Fonctionnaire', 'Artisan', 'Etudiant'];
        $domiciles = ['Bamako', 'Sikasso', 'Kayes', 'Koulikoro', 'Mopti', 'Gao'];

        for ($i = 0; $i < 30; $i++) {
            $prenom = $prenoms[array_rand($prenoms)];
            $nom = $noms[array_rand($noms)];
            $age = rand(18, 60);
            $profession = $professions[array_rand($professions)];
            $domicile = $domiciles[array_rand($domiciles)];
            $numero_declaration = rand(1000, 9999);
            $date_declaration = Carbon::now()->subDays(rand(0, 365))->subHours(rand(0, 23))->subMinutes(rand(0, 59));

            Declarant::create([
                'nom_declarant' => $nom,
                'prenom_declarant' => $prenom,
                'age_declarant' => $age,
                'profession_declarant' => $profession,
                'domicile_declarant' => $domicile,
                'numero_declaration' => $numero_declaration,
                'date_declaration' => $date_declaration,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
