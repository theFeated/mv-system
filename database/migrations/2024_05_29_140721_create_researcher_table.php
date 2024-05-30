<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('researcher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collegeID');
            $table->string('researcherName');
            $table->string('email')->unique();
            $table->string('contactNum');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collegeID')->references('id')->on('college')->onDelete('cascade');
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
