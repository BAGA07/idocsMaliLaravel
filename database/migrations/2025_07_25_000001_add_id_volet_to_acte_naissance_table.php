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
            $table->unsignedBigInteger('id_volet')->nullable()->after('id_declarant');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropColumn('id_volet');
        });
    }
}; 