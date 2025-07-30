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
            // Vérifier et ajouter les colonnes manquantes
            if (!Schema::hasColumn('acte_naissance', 'nina')) {
                $table->string('nina')->nullable();
            }
            if (!Schema::hasColumn('acte_naissance', 'region')) {
                $table->string('region')->nullable()->after('nina');
            }
            if (!Schema::hasColumn('acte_naissance', 'cercle')) {
                $table->string('cercle')->nullable()->after('region');
            }
            if (!Schema::hasColumn('acte_naissance', 'arrondissement')) {
                $table->string('arrondissement')->nullable()->after('cercle');
            }
            if (!Schema::hasColumn('acte_naissance', 'centre')) {
                $table->string('centre')->nullable()->after('arrondissement');
            }
            if (!Schema::hasColumn('acte_naissance', 'qualite_officier')) {
                $table->string('qualite_officier')->nullable()->after('centre');
            }
            if (!Schema::hasColumn('acte_naissance', 'date_etablissement')) {
                $table->date('date_etablissement')->nullable()->after('qualite_officier');
            }
            if (!Schema::hasColumn('acte_naissance', 'date_delivrance')) {
                $table->date('date_delivrance')->nullable()->after('date_etablissement');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropColumn([
                'nina',
                'region',
                'cercle',
                'arrondissement',
                'centre',
                'qualite_officier',
                'date_etablissement',
                'date_delivrance'
            ]);
        });
    }
};
