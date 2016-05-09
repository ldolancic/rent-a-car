<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarTrackingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_trackings', function (Blueprint $table) {
            $table->increments('id');
            // nullable so we can track a car that is not currently rented
            // in case car is not currently rented we track it by car_id only
            $table->integer('rent_id')->unsigned()->nullable();
            $table->integer('car_id')->unsigned();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });

        Schema::table('car_trackings', function (Blueprint $table) {
            $table->foreign('rent_id')->references('id')->on('rents');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('car_trackings');
    }
}
