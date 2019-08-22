<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->increments('id');
            $table->string('zoom');
            $table->string('lat');
            $table->string('lng');
            $table->text('address')->nullable();
            $table->timestamps();
        });

        DB::table('feedback')->insert(
            array(
                'zoom' => 15,
                'lat' => '42.873608',
                'lng' => '74.605287'
            )
        );
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
