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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->string('nom_complet');
            $table->string('email');
            $table->string('telephone');
            $table->string('type_document');
            $table->string('numero_volet_naissance');
            $table->unsignedBigInteger('id_volet')->nullable();
              $table->foreign('id_volet')->references('id_volet')->on('volet_declarations')->onDelete('cascade');
            $table->enum('statut', ['En attente', 'Validé', 'Rejeté'])->default('En attente');
            $table->text('informations_complementaires')->nullable();
            $table->string('justificatif')->nullable();
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