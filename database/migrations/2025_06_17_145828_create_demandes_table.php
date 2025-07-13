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
            // Partie du la demande de copie
            $table->id();
            $table->string('nom_complet')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->unsignedBigInteger('id_volet')->nullable();
            $table->foreign('id_volet')->references('id_volet')->on('volet_declarations')->onDelete('cascade');

            $table->unsignedBigInteger('id_hopital')->nullable();
            $table->foreign('id_hopital')->references('id')->on('hopitals')->onDelete('set null');

           /*  $table->unsignedBigInteger('id_mairie')->nullable();
            $table->foreign('id_mairie')->references('id')->on('mairie')->onDelete('set null');
 */
            $table->string('type_document')->default('Copie intégrale');

            $table->enum('statut', ['En attente', 'En cours de traitement', 'Validé', 'Rejeté'])->default('En attente');

            $table->text('message_hopital')->nullable(); // message auto ou personnalisé de l'hôpital
            $table->text('remarque_mairie')->nullable(); // remarque mairie après traitement

            $table->unsignedBigInteger('traité_par')->nullable(); // agent mairie
            $table->foreign('traité_par')->references('id')->on('users')->onDelete('set null');
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