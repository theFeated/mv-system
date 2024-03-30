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
        Schema::create('research', function (Blueprint $table) {
            $table->string('researchID')->primary();
            $table->foreign('collegeID')->references('collegeID')->on('college')->onDelete('cascade');
            $table->foreign('researcherID')->references('researcherID')->on('researchers')->onDelete('cascade');
            $table->foreign('agencyID')->references('agencyID')->on('agencies')->onDelete('cascade');
            $table->string('status');
            $table->string('researchTitle');
            $table->string('researchType');
            $table->year('year');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_2');
            $table->string('link_3')->nullable();
            $table->string('extension')->nullable();
            $table->boolean('internalFund')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
