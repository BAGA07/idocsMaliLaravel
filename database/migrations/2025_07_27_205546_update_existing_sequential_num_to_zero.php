<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mettre à jour tous les enregistrements existants où sequential_num est NULL
        DB::table('acte_naissance')
            ->whereNull('sequential_num')
            ->update(['sequential_num' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pas de rollback nécessaire car on ne peut pas distinguer les valeurs originales
    }
};
