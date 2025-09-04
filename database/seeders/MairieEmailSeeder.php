<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mairie;

class MairieEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mairies = Mairie::all();

        foreach ($mairies as $mairie) {
            if (empty($mairie->email)) {
                $mairie->email = 'mairie.' . strtolower(str_replace(' ', '', $mairie->nom_mairie)) . '@idocs-mali.ml';
                $mairie->save();
            }
        }

        $this->command->info('Emails ajoutés aux mairies');
    }
}
