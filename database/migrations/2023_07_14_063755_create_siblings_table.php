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
        Schema::create('siblings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id')->nullable();;
            $table->string('sibling_name')->nullable();
            $table->string('sibling_age')->nullable();
            $table->string('sibling_grade_section')->nullable();



            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siblings');
    }
};
