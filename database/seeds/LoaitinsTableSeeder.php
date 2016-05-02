<?php

use App\Http\Controllers\Shared\Constants;
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
        ['tenLT' => Constants::$tin_tim_khach, 'giatien' => 2000],
        ['tenLT' => Constants::$tin_tim_xe,  'giatien' => 1500],
        ['tenLT' => Constants::$tin_dich_vu,  'giatien' => 2000]
         ]);
    }
}
