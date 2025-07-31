<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('notifications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('mairie_id');
        $table->string('from_hopital')->nullable();
        $table->text('message');
        $table->timestamps();

        $table->foreign('mairie_id')->references('id')->on('mairies')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
