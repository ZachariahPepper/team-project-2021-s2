<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenceTable extends Migration
{

    public function up()
    {
        Schema::create('evidence', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->string('url');
            $table->string('description')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evidence');
    }
}
