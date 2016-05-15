<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConquistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conquistas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('village_id')->nullable();
            $table->string('unix_timestamp')->nullable();
            $table->string('new_owner')->nullable();
            $table->string('old_owner')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conquistas');
    }
}
