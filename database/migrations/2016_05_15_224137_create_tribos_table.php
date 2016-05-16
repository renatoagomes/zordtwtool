<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTribosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tribos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('tag')->nullable();
            $table->integer('members')->nullable();
            $table->integer('villages')->nullable();
            $table->integer('points')->nullable();
            $table->integer('all_points')->nullable();
            $table->integer('rank')->nullable();

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
        Schema::drop('tribos');
    }
}
