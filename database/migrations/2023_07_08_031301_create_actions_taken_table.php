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
        Schema::create('actions_taken', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anecdotal_id');
            $table->string('actions');

            $table->foreign('anecdotal_id')->references('id')->on('anecdotal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions_taken');
    }
};
