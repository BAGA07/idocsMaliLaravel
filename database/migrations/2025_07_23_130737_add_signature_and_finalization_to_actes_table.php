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
            $table->longText('signature_image')->nullable()->after('id_officier');
            $table->timestamp('signed_at')->nullable()->after('signature_image');
            $table->unsignedBigInteger('finalized_by_officier_id')->nullable()->after('signed_at');
            $table->boolean('finalized')->default(false)->after('finalized_by_officier_id');
            $table->boolean('cachet_applique')->default(false)->after('finalized');

            // Si users ou officiers est la table cible, adapter la clé étrangère
            $table->foreign('finalized_by_officier_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('acte_naissance', function (Blueprint $table) {
            $table->dropForeign(['finalized_by_officier_id']);
            $table->dropColumn(['signature_image', 'signed_at', 'finalized_by_officier_id', 'finalized', 'cachet_applique']);
        });
    }
};
