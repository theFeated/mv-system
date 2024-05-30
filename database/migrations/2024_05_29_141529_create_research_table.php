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
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collegeID')->nullable();
            $table->unsignedBigInteger('researcherID')->nullable();
            $table->unsignedBigInteger('agencyID')->nullable();
            $table->string('status')->nullable();
            $table->string('researchTitle')->nullable();
            $table->string('researchType')->nullable();
            $table->date('startDate')->nullable();
            $table->date('endDate')->nullable();
            $table->string('link_1')->nullable();
            $table->string('link_2')->nullable();
            $table->string('link_3')->nullable();
            $table->string('extension')->nullable();
            $table->boolean('isInternalFund')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collegeID')->references('id')->on('college')->onDelete('set null');
            $table->foreign('researcherID')->references('id')->on('researcher')->onDelete('set null');
            $table->foreign('agencyID')->references('id')->on('agency')->onDelete('set null');
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
