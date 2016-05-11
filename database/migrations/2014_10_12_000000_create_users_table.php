<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('hoten', 60);
            $table->string('SDT', 12);
            $table->string('avatar', 100);
            $table->boolean('admin')->default(false);
            $table->boolean('hanhkhach')->default(false);
            $table->double('soduTK')->default('50000')->nullable()->unsigned();
            $table->double('sotiendachi')->unsigned();
            $table->boolean('status')->default(true);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
