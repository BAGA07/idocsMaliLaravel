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
        Schema::table('declarants', function (Blueprint $table) {
            $table->string('telephone')->nullable()->after('ethnie_declarant');
            $table->string('email')->nullable()->after('telephone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('declarants', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'email']);
        });
    }
};
