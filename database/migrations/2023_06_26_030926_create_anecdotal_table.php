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
        Schema::create('anecdotal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->integer('grave_offense');
            $table->integer('minor_offense');
            $table->string('gravity');
            $table->mediumText('short_description');
            $table->mediumText('obervation');
            $table->mediumText('desired');
            $table->mediumText('outcome');
            $table->integer('letter');
            $table->tinyInteger('status')->default('0')->comment('0:active | 1:inactive');

            $table->foreign('student_id')->references('id')->on('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anecdotal');
    }
};
