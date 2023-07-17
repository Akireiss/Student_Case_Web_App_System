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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('barangay_id');
            $table->unsignedBigInteger('municipal_id');
            $table->unsignedBigInteger('province_id');
            $table->foreign('barangay_id')->references('id')->on('barangay')->onDelete('cascade');
            $table->foreign('municipal_id')->references('id')->on('municipal')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('province')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('parents')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
