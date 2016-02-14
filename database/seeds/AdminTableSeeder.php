<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $users = [
            ['email' => 'toantam@gmail.com', 'password' => bcrypt('toantam'), 'admin' => true, 'hoten' => 'Admin', 'SDT'=> '0987491230']
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
