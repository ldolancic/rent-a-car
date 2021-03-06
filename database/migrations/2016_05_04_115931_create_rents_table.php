<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->date('starting_time');
            $table->date('ending_time');
            $table->double('price');
            $table->string('status')->default('pending'); // pending, canceled, confirmed, in_progress, finished
            $table->boolean('additional_driver')->default(false);
            $table->boolean('baby_seat')->default(false);
            $table->boolean('child_seat')->default(false);
            $table->boolean('full_protection')->default(false);
            $table->timestamps();
        });

        Schema::table('rents', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::drop('rents');
    }
}
