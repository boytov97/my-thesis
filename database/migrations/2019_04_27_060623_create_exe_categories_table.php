<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExeCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('exe_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grammar_id')->unsigned();
            $table->foreign('grammar_id')->references('id')->on('grammars');
            $table->string('title');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exe_categories');
    }
}
