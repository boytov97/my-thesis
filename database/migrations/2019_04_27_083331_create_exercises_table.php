<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('exe_category_id')->unsigned();
            $table->foreign('exe_category_id')->references('id')->on('exe_categories');
            $table->integer('priority')->index();
            $table->string('part_one')->nullable();
            $table->string('answer');
            $table->string('part_two');
            $table->boolean('transition')->default(0);
            $table->boolean('active')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercises');
    }
}
