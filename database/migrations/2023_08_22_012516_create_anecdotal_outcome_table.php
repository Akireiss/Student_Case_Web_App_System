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
        Schema::create('anecdotal_outcome', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anecdotal_id');
            $table->unsignedBigInteger('actions_id');
            $table->string('outcome');
            $table->mediumText('outcome_remarks');

            $table->foreign('anecdotal_id')->references('id')->on('anecdotal')
                ->onDelete('cascade');
            $table->foreign('actions_id')->references('id')->on('actions')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anecdotal_outcome');
    }
};
