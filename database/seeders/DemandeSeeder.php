<?php

namespace Database\Seeders;

use App\Models\Demande;
use App\Models\VoletDeclaration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DemandeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupère tous les volets existants
        $volets = VoletDeclaration::all();

        if ($volets->isEmpty()) {
            $this->command->warn('Aucun volet de déclaration trouvé. Veuillez d\'abord insérer des volets.');
            return;
        }

        // Générer 10 fausses demandes
        foreach (range(1, 10) as $i) {
            $volet = $volets->random();

            Demande::create([
                'nom_complet' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'telephone' => '+223 6' . rand(1000000, 9999999),
                'type_document' => fake()->randomElement(['Extrait de naissance', 'Copie intégrale']),
                'numero_volet_naissance' => $volet->num_volet,
                'id_volet' => $volet->id_volet,
                'statut' => fake()->randomElement(['En attente', 'Validé', 'Rejeté']),
                'informations_complementaires' => fake()->optional()->sentence(),
                'justificatif' => fake()->optional()->word() . '.pdf',
            ]);
        }
    }
}
