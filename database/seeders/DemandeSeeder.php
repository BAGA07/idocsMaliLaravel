<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Demande;
use App\Models\VoletDeclaration;
use App\Models\Hopital;
use App\Models\User;
use Illuminate\Support\Str;

class DemandeSeeder extends Seeder
{
    public function run(): void
    {
        $volets = VoletDeclaration::pluck('id_volet')->toArray();
        $hopitaux = Hopital::pluck('id')->toArray();
        $agentsMairie = User::where('role', 'agent_mairie')->pluck('id')->toArray();

        if (empty($volets) || empty($hopitaux)) {
            $this->command->warn('Aucun volet ou hôpital disponible. Assurez-vous que les volets de déclaration et les hôpitaux existent.');
            return;
        }

        foreach (range(1, 20) as $i) {
            Demande::create([
                'nom_complet' => fake()->name(),
                'nom_enfant' => fake()->name(),
                'prenom_enfant' => fake()->name(),
                'email' => fake()->safeEmail(),
                'telephone' => '+2236' . rand(1000000, 9999999),

                'type_document' => fake()->randomElement(['Extrait de naissance', 'Copie intégrale']),
                'statut' => fake()->randomElement(['En attente', 'En cours de traitement', 'Validé', 'Rejeté']),
                'message_hopital' => fake()->optional()->sentence(),
                'remarque_mairie' => fake()->optional()->sentence(),
                
        'id_volet' => fake()->randomElement($volets),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
