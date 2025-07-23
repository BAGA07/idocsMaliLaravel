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
    {//testetsetest
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();

            // Demandeur
            $table->string('nom_complet')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();

            // Type de document demandé
            $table->string('type_document')->default('Copie intégrale');

            // Informations sur la personne concernée
            $table->string('nom_enfant')->nullable();
            $table->string('prenom_enfant')->nullable();
            $table->date('date_evenement')->nullable();
            $table->string('lieu_evenement')->nullable();

            // Informations sur le volet de naissance
            $table->string('numero_volet_naissance')->nullable();
            $table->unsignedBigInteger('id_volet')->nullable();
            $table->foreign('id_volet')->references('id_volet')->on('volet_declarations')->onDelete('cascade');

            // Champs annexes
            $table->text('informations_complementaires')->nullable();
            $table->string('justificatif')->nullable(); // stocker le nom ou chemin du fichier justificatif
            $table->text('remarque_mairie')->nullable();
            $table->text('message_hopital')->nullable();

            // Statut de la demande
            $table->enum('statut', ['En attente', 'En cours de traitement', 'Validé', 'Rejeté'])->default('En attente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
