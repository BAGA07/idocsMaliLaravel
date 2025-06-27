<?php

namespace Database\Seeders;

use App\Models\Officier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                Officier::factory()->count(10)->create();
        
    }
}
