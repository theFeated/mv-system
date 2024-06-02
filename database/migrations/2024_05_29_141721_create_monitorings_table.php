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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('researchID');
            $table->integer('progress')->nullable();
            $table->string('status')->nullable();
            $table->text('remarks')->nullable();
            $table->string('monitoringPersonnel')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('researchID')->references('id')->on('research')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
