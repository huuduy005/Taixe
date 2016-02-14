<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taixes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bienso', 20);
            $table->float('ratepoint')->default(0);
            $table->integer('ratecount')->default(0);
            $table->integer('loaixe_id')->unsigned();
            $table->foreign('loaixe_id')->references('id')->on('loaixes')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('taixes');
    }
}

