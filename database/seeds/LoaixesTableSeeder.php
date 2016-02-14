<?php

use Illuminate\Database\Seeder;

class LoaixesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loaixes')->delete();
        DB::table('loaixes')->insert([
            ['tenLX' => 'Xe khách'],
            ['tenLX' => 'Xe taxi'],
            ['tenLX' => 'Xe tải'],
        ]);
    }
}
