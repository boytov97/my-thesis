<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckedExerciseTable extends Migration
{
    public function up()
    {
        Schema::create('checked_exercise', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('exercise_id');
            $table->json('user_answers');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checked_exercise');
    }
}
