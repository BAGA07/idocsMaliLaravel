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
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->string('num_acte', 100)->change(); // Augmenter la taille pour accepter le format officiel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->integer('num_acte')->change(); // Revenir au type original
        });
    }
};
