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
            //Address Here
            $table->string('religion');
            $table->string('mother_tongue');
            $table->boolean('4ps');

            $table->string('living_with');
            //Parent are currently: here
            $table->string('guardian_name');
            $table->string('relationship');
            $table->string('guardian_contact');
            $table->string('occupation')->nullable();
            $table->string('guardian_age')->nullable();
            //Guardian address here
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






            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');

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
