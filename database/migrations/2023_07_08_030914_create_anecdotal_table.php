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
            $table->unsignedBigInteger('offense_id');
            $table->string('gravity');
            $table->mediumText('short_description')->nullable();
            $table->mediumText('observation');
            $table->mediumText('desired');
            $table->mediumText('outcome');
            $table->string('letter')->nullable();
            $table->tinyInteger('case_status')->default('0')->comment('0:pending | 1: accept | 2: inprogress | 3: closed');

            $table->tinyInteger('status')->default('0')->comment('0:active | 1:inactive');
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('offense_id')->references('id')->on('offenses')->onDelete('cascade');

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
