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
             $table->string('chemin_justificatif')->nullable()->after('nombre_copie'); // Ajoute la colonne chemin_justificatif
            $table->string('type_justificatif')->nullable()->after('chemin_justificatif'); // Ajoute la colonne type_justificatif
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('demandes', function (Blueprint $table) {
                // C'est ici que vous définissez comment annuler l'opération
            $table->dropColumn('chemin_justificatif'); // Supprime la colonne chemin_justificatif en cas de rollback
            $table->dropColumn('type_justificatif'); // Supprime la colonne type_justificatif en cas de rollback
        });
    }
};
