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
                'statut' => fake()->randomElement(['En attente', 'En cours de traitement', 'Validé', 'Rejeté']),
                'message_hopital' => fake()->optional()->sentence(),
                'remarque_mairie' => fake()->optional()->sentence(),
                'nombre_copie'=>rand(0, 5),
                                'num_acte'=>rand(1, 5),
// 'id_volet' => $volet->id_volet, 
//ce que j'ai commente dans la migrations
        'id_volet' => fake()->randomElement($volet),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
