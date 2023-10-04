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
        Schema::create('anecdotal_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anecdotal_id');
            $table->string('images')->nullable();

            $table->foreign('anecdotal_id')
                ->references('id')
                ->on('anecdotal')
                ->onDelete('cascade');

            $table->timestamps(false);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anecdotal_images');
    }
};
