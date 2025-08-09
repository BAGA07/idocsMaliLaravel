<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
<<<<<<<< HEAD:database/migrations/2025_08_09_081723_add_is_virtuelle_to_acte_naissance_table.php
    public function up(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->boolean('is_virtuelle')->default(false)->after('statut');
        });
    }
========
    public function up()
{
    Schema::table('notifications', function (Blueprint $table) {
        $table->boolean('is_read')->default(false);
    });
}

>>>>>>>> main:database/migrations/2025_07_29_001030_add_is_read_to_notifications_table.php

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<<< HEAD:database/migrations/2025_08_09_081723_add_is_virtuelle_to_acte_naissance_table.php
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropColumn('is_virtuelle');
========
        Schema::table('notifications', function (Blueprint $table) {
            //
>>>>>>>> main:database/migrations/2025_07_29_001030_add_is_read_to_notifications_table.php
        });
    }
};
