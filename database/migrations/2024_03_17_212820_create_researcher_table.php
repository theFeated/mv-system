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
        Schema::create('researcher', function (Blueprint $table) {
            $table->string('researcherID')->primary();
            $table->foreign('collegeID')->references('collegeID')->on('college')->onDelete('cascade');
            $table->string('researcherName');
            $table->string('email');
            $table->string('contactNum');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('researcher');
    }
};
