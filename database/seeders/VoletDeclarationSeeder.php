<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VoletDeclaration;
use App\Models\Declarant;
use App\Models\Hopital;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VoletDeclarationSeeder extends Seeder
{
    public function run(): void
    {
        $sexeOptions = ['Masculin', 'Féminin'];
        $ethnies = ['Bambara', 'Peulh', 'Sénoufo', 'Dogon', 'Soninké'];
        $situations = ['Marié', 'Celibataire', 'Divorcé'];
        $niveaux = ['Aucun', 'Primaire', 'Secondaire', 'Supérieur'];
        $professions = ['Cultivateur', 'Commerçant', 'Fonctionnaire', 'Artisan', 'Infirmier', 'Professeur'];

        $prenomsGarçons = ['Moussa', 'Ibrahim', 'Oumar', 'Abdoulaye', 'Seydou'];
        $prenomsFilles = ['Aminata', 'Fatoumata', 'Awa', 'Kadidia', 'Saran'];
        $nomsFamille = ['Traoré', 'Diarra', 'Koné', 'Doumbia', 'Camara'];

        $hopitalIds = Hopital::pluck('id')->toArray();
        $declarantIds = Declarant::pluck('id_declarant')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $sexe = $sexeOptions[array_rand($sexeOptions)];
            $prenom_enfant = $sexe === 'M'
                ? $prenomsGarçons[array_rand($prenomsGarçons)]
                : $prenomsFilles[array_rand($prenomsFilles)];
            $nom_enfant = $nomsFamille[array_rand($nomsFamille)];

            $date_naissance = Carbon::now()->subDays(rand(0, 365));
            $heure_naissance = Carbon::createFromTime(rand(0, 23), rand(0, 59));

            VoletDeclaration::create([
                'num_volet'                     => 'VD-' . strtoupper(Str::random(6)),
                'date_naissance'               => $date_naissance->toDateString(),
                'heure_naissance'              => $heure_naissance->format('H:i'),
                'date_declaration'             => $date_naissance->copy()->addDays(rand(1, 5))->toDateString(),

                'prenom_enfant'                => $prenom_enfant,
                'nom_enfant'                   => $nom_enfant,
                'sexe'                         => $sexe,
                'nbreEnfantAccouchement'       => rand(1, 3),

                'prenom_pere'                  => ['Mamadou', 'Boubacar', 'Modibo'][array_rand(['Mamadou', 'Boubacar', 'Modibo'])],
                'nom_pere'                     => $nomsFamille[array_rand($nomsFamille)],
                'age_pere'                     => rand(25, 50),
                'domicile_pere'                => 'Bamako',
                'ethnie_pere'                  => $ethnies[array_rand($ethnies)],
                'situation_matrimonial_pere'   => $situations[array_rand($situations)],
                'niveau_instruction_pere'      => $niveaux[array_rand($niveaux)],
                'profession_pere'              => $professions[array_rand($professions)],

                'prenom_mere'                  => ['Aminata', 'Mariama', 'Fanta'][array_rand(['Aminata', 'Mariama', 'Fanta'])],
                'nom_mere'                     => $nomsFamille[array_rand($nomsFamille)],
                'age_mere'                     => rand(18, 40),
                'domicile_mere'                => 'Bamako',
                'ethnie_mere'                  => $ethnies[array_rand($ethnies)],
                'situation_matrimonial_mere'   => $situations[array_rand($situations)],
                'niveau_instruction_mere'      => $niveaux[array_rand($niveaux)],
                'profession_mere'              => $professions[array_rand($professions)],

                'nbreEINouvNee'                => rand(1, 3),

                'id_declarant' => $declarantIds[array_rand($declarantIds)],
                'id_hopital' => $hopitalIds[array_rand($hopitalIds)],
                'token' => (string) Str::uuid(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}