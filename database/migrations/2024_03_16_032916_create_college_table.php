<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollegeTable extends Migration
{
    public function up(): void
    {
        Schema::create('college', function (Blueprint $table) {
            $table->string('collegeID')->primary();
            $table->string('collegeName');
            $table->string('collegeDean');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE college MODIFY collegeID VARCHAR(10) NOT NULL;");
        DB::statement("ALTER TABLE college ADD collegeID_num BIGINT UNSIGNED NOT NULL AUTO_INCREMENT AFTER collegeID;");
        DB::statement("ALTER TABLE college ADD PRIMARY KEY (collegeID, collegeID_num);");
        DB::statement("ALTER TABLE college MODIFY collegeID VARCHAR(10) NOT NULL DEFAULT '';");
    }

    public function down(): void
    {
        Schema::dropIfExists('college');
    }
}