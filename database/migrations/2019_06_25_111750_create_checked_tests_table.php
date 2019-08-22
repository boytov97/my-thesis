<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckedTestsTable extends Migration
{
    public function up()
    {
        Schema::create('checked_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('test_id');
            $table->json('user_answers');
            $table->json('common_result');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checked_tests');
    }
}
