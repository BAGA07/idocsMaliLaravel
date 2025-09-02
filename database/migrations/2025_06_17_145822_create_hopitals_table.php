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
        Schema::create('hopitals', function (Blueprint $table) {
            $table->id();
            $table->string('nom_hopital');
            $table->string('email')->nullable();
            $table->foreignId('id_commune')->constrained('communes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hopitals');
    }
};
