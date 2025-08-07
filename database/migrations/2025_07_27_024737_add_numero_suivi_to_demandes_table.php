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
        Schema::table('demandes', function (Blueprint $table) {
         // Ajoute la colonne numero_suivi, de type chaîne, nullable, et unique (pour l'unicité)
            $table->string('numero_suivi')->unique()->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demandes', function (Blueprint $table) {
           // Pour annuler la migration, supprime la colonne
            $table->dropColumn('numero_suivi');
        });
    }
};
