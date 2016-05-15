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
            $table->timestamps();

            $table->string('id')->nullable();
            $table->string('name')->nullable();
            $table->string('tag')->nullable();
            $table->string('members')->nullable();
            $table->string('villages')->nullable();
            $table->string('points')->nullable();
            $table->string('all_points')->nullable();
            $table->string('rank')->nullable();
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
