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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->nullable();
            $table->string('m_name');
            $table->string('suffix')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('age');
            $table->string('sex');
            $table->date('birthdate');
            $table->string('contact');
            $table->unsignedBigInteger('barangay_id');
            $table->unsignedBigInteger('municipal_id');
            $table->unsignedBigInteger('province_id');
            $table->string('birth_place');
            $table->string('religion');
            $table->string('mother_tongue');
            $table->boolean('4ps');
            $table->string('birth_order');
            $table->string('no_of_siblings');


            $table->string('living_with');
            //Parent are currently: here
            $table->string('guardian_name');
            $table->string('guardian_relationship');
            $table->string('guardian_contact');
            $table->string('guardian_occupation')->nullable();
            $table->string('guardian_age')->nullable();
            $table->string('guardian_address')->nullable();
            //Education Background
            //Award Here
            $table->string('favorite_subject');
            $table->string('difficult_subject')->nullable();
            $table->string('school_organization')->nullable();
            $table->string('graduation_plan');
            //Additional info here
            $table->decimal('height')->nullable();
            $table->decimal('weight')->nullable();
            $table->decimal('bmi')->nullable();
            $table->string('disability');
            $table->string('food_allergy');
            $table->string('status')->default('0');




            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->foreign('barangay_id')->references('id')->on('barangay')->onDelete('cascade');
            $table->foreign('municipal_id')->references('id')->on('municipal')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('province')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
