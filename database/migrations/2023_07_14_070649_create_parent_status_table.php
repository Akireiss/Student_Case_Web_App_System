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
        Schema::create('parent_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('profile_id');

            $table->string('parent_status');
            $table->foreign('profile_id')->references('id')->on('profile')->onDelete('cascade');
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_status');
    }
};
