<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->unsigned();
            $table->string('name');
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
        });

        Schema::table('car_photos', function (Blueprint $table) {
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
        Schema::drop('car_photos');
    }
}
