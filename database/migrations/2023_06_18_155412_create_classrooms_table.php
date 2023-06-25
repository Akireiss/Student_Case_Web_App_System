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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('grade_level_id');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('grade_level_id')->references('id')->on('grade_level');
            $table->tinyInteger('status')->default('0')->comment('0:active | 1:inactive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
