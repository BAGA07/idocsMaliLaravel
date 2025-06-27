<?php

namespace Database\Factories;
use App\Models\Commune;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Officier>
 */
class OfficierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'profession' => $this->faker->jobTitle(),
            'id_commune' => Commune::inRandomOrder()->first()?->id ?? Commune::factory(),
        ];
    }
}
