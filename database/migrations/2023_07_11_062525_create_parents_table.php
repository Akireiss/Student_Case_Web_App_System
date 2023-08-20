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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');
            $table->string('parent_type');
            $table->string('parent_name');
            $table->string('parent_age');
            $table->string('parent_occupation');
            $table->string('parent_contact');
            $table->string('parent_office_contact')->nullable();
            $table->string('parent_birth_place')->nullable();
            $table->string('parent_work_address')->nullable();
            $table->string('parent_monthly_income');

            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent');
    }
};
