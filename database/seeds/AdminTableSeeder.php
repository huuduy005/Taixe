<?php

use App\Http\Controllers\Shared\Constants;
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
            ['email' => Constants::$admin_email, 'password' => bcrypt('admin'), 'admin' => true, 'hoten' => 'Admin', 'SDT'=> '0987491230'],
            /*['email' => 'toantam@gmail.com', 'password' => bcrypt('123456'), 'hoten' => 'Toàn Tam', 'SDT'=> '0987491230']*/
        ];
        foreach($users as $user){
            DB::table('users')->insert($user);
        }
    }
}
