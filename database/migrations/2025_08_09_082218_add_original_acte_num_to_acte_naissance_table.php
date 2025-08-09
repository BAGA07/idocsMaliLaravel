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
            $table->string('original_acte_num')->nullable()->after('is_virtuelle');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropColumn('original_acte_num');
        });
    }
};
