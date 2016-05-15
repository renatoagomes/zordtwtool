<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVilasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vilas', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->integer('x');
            $table->integer('y');
            $table->integer('points')->nullable();
            $table->integer('rank')->nullable();

            //FK para players (player que owna a aldeia)
            $table->integer('player_id')->unsigned()->nullable();
            $table->foreign('player_id')
                ->references('id')
                ->on('players');

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
        Schema::drop('vilas');
    }
}
