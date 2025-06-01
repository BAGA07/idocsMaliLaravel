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
        Schema::create('naissance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pere')->nullable()->constrained('personnes');
            $table->foreignId('id_mere')->nullable()->constrained('personnes');
            $table->date('date_naissance')->nullable();
            $table->date_heure('heure_naissance')->required();
            $table->string('sexe')->nullable();
            $table->string('etat_civil')->nullable(); // 'ne', 'mort-né', 'vivant'
            $table->string('nom_enfant')->nullable();
            $table->string('prenom_enfant')->nullable();
            $table->string('nom_pere')->nullable();
            $table->string('prenom_pere')->nullable();
            $table->string('nom_mere')->nullable();
            $table->string('prenom_mere')->nullable();
            $table->string('profession_pere')->nullable();
            $table->string('profession_mere')->nullable();
            $table->date('date_declaration')->nullable();
            $table->string('nom_officier_etat_civil')->nullable(); // Nom de l'officier d'état civil qui a enregistré l'acte
            $table->string('prenom_officier_etat_civil')->nullable();
            $table->string('profession_officier_etat_civil')->nullable(); // Profession de l'officier d'état civil ex: 'officier d'état civil', 'maire', etc.
            $table->date('date_enregistrement')->nullable(); //
            $table->string('numero_acte')->nullable(); // Numéro de l'acte de naissance 
            $table->string('numero_registre')->nullable();
            $table->string('numero_livre')->nullable();
            $table->string('numero_page')->nullable();
            $table->string('numero_extrait')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('numero_copie')->nullable();
            $table->string('numero_ordre')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('commune')->nullable();
            $table->string('ville')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('naissance');
    }
};
