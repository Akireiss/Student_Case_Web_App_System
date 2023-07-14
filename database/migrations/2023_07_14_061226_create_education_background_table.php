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
        Schema::create('education_background', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('profile_id');
            $table->string('school_name');
            $table->string('school_year');
            $table->string('grade_section');

            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_bg');
    }
};
