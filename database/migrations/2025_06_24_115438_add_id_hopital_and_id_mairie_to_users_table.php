<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Assure-toi que la colonne existe et est nullable
            if (!Schema::hasColumn('users', 'id_hopital')) {
                $table->unsignedBigInteger('id_hopital')->nullable()->after('role');
            }
              if (!Schema::hasColumn('users', 'id_mairie')) {
                $table->unsignedBigInteger('id_mairie')->nullable()->after('id_hopital');
            }

            // Ajoute la clé étrangère proprement (en supposant que hopitals.id est la bonne clé)
            $table->foreign('id_hopital')
                ->references('id')  // corriger ici si le champ s'appelle bien 'id' et non 'id_hopital'
                ->on('hopitals')   // vérifie l'orthographe de ta table
                ->onDelete('set null');
            $table->foreign('id_mairie')
                ->references('id')  // corriger ici si le champ s'appelle bien 'id' et non 'id_hopital'
                ->on('mairie')   // vérifie l'orthographe de ta table
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_hopital']);
            $table->dropColumn('id_hopital');
            $table->dropForeign(['id_mairie']);
            $table->dropColumn('id_mairie');
        });
    }
};