<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Declarant;
use App\Models\Hopital;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoletDeclaration>
 */
class VoletDeclarationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'num_volet' => 'VL' . now()->format('YmdHis') . Str::random(5), // Unique number for the declaration
            'date_naissance' => $this->faker->date(),
            'heure_naissance' => $this->faker->time(),
            'date_declaration' => $this->faker->date(),
            'prenom_enfant' => $this->faker->firstName(),
            'nom_enfant' => $this->faker->lastName(),
            'sexe' => $this->faker->randomElement(['M', 'F']),
            'nbreEnfantAccouchement' => $this->faker->numberBetween(1, 3),

            'prenom_pere' => $this->faker->firstNameMale(),
            'nom_pere' => $this->faker->lastName(),
            'age_pere' => $this->faker->numberBetween(25, 60),
            'domicile_pere' => $this->faker->address(),
            'ethnie_pere' => $this->faker->word(),
            'situation_matrimonial_pere' => $this->faker->randomElement(['Marié', 'Celibataire', 'Divorcé']),
            'niveau_instruction_pere' => $this->faker->randomElement(['Aucun', 'Primaire', 'Secondaire', 'Universitaire']),
            'profession_pere' => $this->faker->jobTitle(),

            'prenom_mere' => $this->faker->firstNameFemale(),
            'nom_mere' => $this->faker->lastName(),
            'age_mere' => $this->faker->numberBetween(20, 45),
            'domicile_mere' => $this->faker->address(),
            'ethnie_mere' => $this->faker->word(),
            'situation_matrimonial_mere' => $this->faker->randomElement(['Marié', 'Celibataire', 'Divorcé']),
            'niveau_instruction_mere' => $this->faker->randomElement(['Aucun', 'Primaire', 'Secondaire', 'Universitaire']),
            'profession_mere' => $this->faker->jobTitle(),
            'nbreEINouvNee' => $this->faker->numberBetween(1, 5),

            'id_declarant' => Declarant::query()->inRandomOrder()->value('id_declarant') ?? Declarant::factory(),
            'id_hopital' => Hopital::inRandomOrder()->limit(1)->first()?->id ?? Hopital::factory()->create()->id,

        ];
    }
}