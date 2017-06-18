<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBottleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bottles', function (Blueprint $table) {
        $table->increments('id');
        $table->string('message');
        $table->string('nickname');
        $table->string('lat');
        $table->string('lng');
        $table->string('public');
        $table->integer('user_id')->index();
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
        Schema::dropIfExists('bottle');
    }
}
