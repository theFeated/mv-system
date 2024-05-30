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
        Schema::create('externalFunds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('researchID');
            $table->unsignedBigInteger('agencyID');
            $table->decimal('total_budget', 8, 2);
            $table->decimal('budget_utilized', 8, 2);
            $table->text('purpose');
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('researchID')->references('id')->on('research')->onDelete('cascade');
            $table->foreign('agencyID')->references('id')->on('agency')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('externalFunds');
    }
};
