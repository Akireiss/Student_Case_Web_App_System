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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classroom_id');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->integer('gender')->comment('0:male, 1:female');
            $table->string('lrn')->nullable();
            $table->integer('department')->comment('0: HS | 1: SH');
            $table->tinyInteger('status')->default('0')->comment('0:active | 1:inactive');

            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
