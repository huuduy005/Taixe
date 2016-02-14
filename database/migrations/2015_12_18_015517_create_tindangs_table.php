<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTindangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tieude');
            $table->text('noidung');
            $table->string('noidi');
            $table->string('thanhphonoidi');
            $table->string('lotrinhhientai', 100);
            $table->timestamp('TG_capnhatlotrinh');
            $table->string('noiden');
            $table->string('thanhphonoiden');
            $table->integer('giave')->unsigned();
            $table->string('giokhoihanh');
            $table->string('ngaykhoihanh');
            $table->boolean('status')->default(true);
            $table->timestamp('ngaydang')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->integer('loaitin_id')->unsigned();
            $table->foreign('loaitin_id')->references('id')->on('loaitins')->onDelete('cascade');

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
        Schema::drop('tindangs');
    }
}
