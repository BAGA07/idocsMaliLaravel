<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            // Supprimer la contrainte d'unicité simple sur num_acte
            $table->dropUnique(['num_acte']);
            
            // Ajouter une contrainte d'unicité composite sur num_acte et type
            // Cela permet d'avoir le même numéro d'acte mais avec des types différents
            $table->unique(['num_acte', 'type'], 'unique_num_acte_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            // Supprimer la contrainte composite
            $table->dropUnique('unique_num_acte_type');
            
            // Remettre la contrainte d'unicité simple sur num_acte
            $table->unique('num_acte');
        });
    }
};
