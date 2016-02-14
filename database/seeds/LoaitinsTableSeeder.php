<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoaitinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loaitins')->delete();
        DB::table('loaitins')->insert([
        ['tenLT' => 'Tìm khách', 'giatien' => 2000],
        ['tenLT' => 'Tìm xe',  'giatien' => 1500],
        ['tenLT' => 'Rao vặt',  'giatien' => 1000]
         ]);
    }
}
