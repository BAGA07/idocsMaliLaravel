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
        Schema::create('declarants', function (Blueprint $table) {
            $table->id('id_declarant');
            $table->string('nom_declarant', 100);
            $table->string('prenom_declarant', 100);
            $table->integer('age_declarant');
            $table->string('profession_declarant', 100);
           // $table->string('ethnie_declarant', 100)->nullable();
            $table->string('domicile_declarant', 255);
            $table->integer('numero_declaration');
            $table->dateTime('date_declaration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('declarants');
    }
};
