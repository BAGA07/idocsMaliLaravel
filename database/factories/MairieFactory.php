<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Commune;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mairie>
 */
class MairieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        
            return [
            'nom_mairie' => 'Mairie de ' . $this->faker->city(),
            'quartier' => $this->faker->streetName(),
            'id_commune' => Commune::inRandomOrder()->first()?->id ?? Commune::factory(), // Assure que ça lie à une commune existante
        ];

        
    }
}
