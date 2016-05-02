<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ThanhphosTableSeeder::class);
        $this->call(AdminTableSeeder::class);
        $this->call(LoaixesTableSeeder::class);
        $this->call(LoaitinsTableSeeder::class);

        /*factory(App\Tindang::class, 50)->create();*/

        Model::reguard();
    }
}
