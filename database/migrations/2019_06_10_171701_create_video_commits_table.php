<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCommitsTable extends Migration
{
    public function up()
    {
        Schema::create('video_commits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->integer('video_id');
            $table->integer('user_id');
            $table->string('getter_name')->nullable();
            $table->text('text');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('video_commits');
    }
}
