<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Declarant>
 */
class DeclarantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_declarant' => $this->faker->lastName(),
            'prenom_declarant' => $this->faker->firstName(),
            'age_declarant' => $this->faker->numberBetween(18, 60),
            'profession_declarant' => $this->faker->jobTitle(),
            'domicile_declarant' => $this->faker->address(),
            'numero_declaration' => $this->faker->unique()->numberBetween(1000, 9999),
            'date_declaration' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
