<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('points')->nullable();
            $table->integer('rank')->nullable();

            //FK para tribos (tribo que o player pertence)
            $table->integer('tribo_id')->unsigned()->nullable();
            $table->foreign('tribo_id')
                ->references('id')
                ->on('tribos');

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
        Schema::drop('players');
    }
}
