<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionGrade6Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_grade_6', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ques_id')->unsigned();
            $table->foreign('ques_id')->references('id')->on('questions');
            $table->text('option');
            $table->text('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_grade_6');
    }
}
