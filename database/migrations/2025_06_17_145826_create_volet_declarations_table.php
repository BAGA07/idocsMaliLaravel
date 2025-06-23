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
        Schema::create('volet_declarations', function (Blueprint $table) {
            $table->id('id_volet');
            $table->date('date_naissance');
            $table->time('heure_naissance');
            $table->date('date_declaration');
            $table->string('prenom_enfant', 100);
            $table->string('nom_enfant', 100);
            $table->enum('sexe', ['M', 'F']);
            $table->integer('nbreEnfantAccouchement');

            $table->string('prenom_pere', 100);
            $table->string('nom_pere', 100);
            $table->integer('age_pere');
            $table->string('domicile_pere', 100);
            $table->string('ethnie_pere', 100);
            $table->enum('situation_matrimonial_pere', ['Marié', 'Celibataire', 'Divorcé']);
            $table->string('niveau_instruction_pere', 100);
            $table->string('profession_pere', 100);

            $table->string('prenom_mere', 100);
            $table->string('nom_mere', 100);
            $table->integer('age_mere');
            $table->string('domicile_mere', 100);
            $table->string('ethnie_mere', 100);
            $table->enum('situation_matrimonial_mere', ['Marié', 'Celibataire', 'Divorcé']);
            $table->string('niveau_instruction_mere', 100);
            $table->string('profession_mere', 100);
            $table->integer('nbreEINouvNee');

            $table->unsignedBigInteger('id_declarant');
            $table->unsignedBigInteger('id_hopital');

            $table->foreign('id_declarant')->references('id_declarant')->on('declarants')->onDelete('cascade');
            $table->foreign('id_hopital')->references('id')->on('hopitals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('volet_declarations');
    }
};
