<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hopital>
 */
class HopitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom_hopital' => $this->faker->company . ' Hospital',
            'id_commune' => $this->faker->numberBetween(1, 100),
            
        ];
    }
}
