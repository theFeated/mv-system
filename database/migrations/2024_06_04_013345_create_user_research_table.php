<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserResearchTable extends Migration
{
    public function up()
    {
        Schema::create('user_research', function (Blueprint $table) {
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('researchID');

            $table->primary(['userID', 'researchID']);

            $table->foreign('userID')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('researchID')
                  ->references('id')
                  ->on('research')
                  ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('user_research');
    }
}
