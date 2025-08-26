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
        Schema::create('acte_naissance', function (Blueprint $table) {
    $table->id();

            $table->integer('num_acte')->unique();
            $table->date('date_naissance_enfant');
            $table->string('lieu_naissance_enfant');
            $table->time('heure_naissance');
            $table->string('sexe_enfant');
            $table->string('nom');
            $table->string('prenom');

            // Informations du père
            $table->string('nom_pere');
            $table->string('prenom_pere');
            $table->string('profession_pere');
            $table->string('domicile_pere');

            // Informations de la mère
            $table->string('nom_mere');
            $table->string('prenom_mere');
            $table->string('profession_mere');
            $table->string('domicile_mere');

            // Liaisons avec les autres entités
            $table->foreignId('id_officier')->constrained('officier_etat_civil')->onDelete('cascade');
            $table->unsignedBigInteger('id_declarant');
            $table->foreign('id_declarant')->references('id_declarant')->on('declarants')->onDelete('cascade');
            $table->foreignId('id_commune')->constrained('communes')->onDelete('cascade');
            $table->foreignId('id_demande')->constrained('demandes')->onDelete('cascade');
    //         $table->foreignId('id_volet')
    //   ->nullable()
    //   ->constrained('volet_declarations', 'id_volet')
    //   ->onDelete('set null');
            $table->string('original_num_acte')->nullable();
            $table->date('date_enregistrement_acte');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acte_naissance');
    }
};
