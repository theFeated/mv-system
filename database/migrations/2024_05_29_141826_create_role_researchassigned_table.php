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
        Schema::create('role_researchassigned', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('roleID');
            $table->unsignedBigInteger('researcherID');
            $table->unsignedBigInteger('researchID');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('roleID')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('researcherID')->references('id')->on('researcher')->onDelete('cascade');
            $table->foreign('researchID')->references('id')->on('research')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_researchassigned');
    }
};
