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
    { //testetsetest
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('email')->nullable();
            $table->string('telephone');
            $table->string('type_document');
            $table->string('numero_volet_naissance');
            $table->unsignedBigInteger('id_volet')->nullable();
            $table->foreign('id_volet')->references('id_volet')->on('volet_declarations')->onDelete('cascade');
            $table->integer('nombre_copie');
            $table->integer('num_acte')->nullable();
            // Champs annexes
            $table->text('informations_complementaires')->nullable();
            $table->string('justificatif')->nullable();
            $table->string('num_suivi')->unique()->nullable();
            //$table->string('justificatif')->nullable(); // stocker le nom ou chemin du fichier justificatif
            $table->text('remarque_mairie')->nullable();
            $table->text('message_hopital')->nullable();
            // $table->integer('nombre_copie');
            // $table->integer('num_acte');
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