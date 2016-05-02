<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$user = App\User::where('email', 'toantam@gmail.com')->first();
$loaitin = App\Loaitin::where('tenLT', 'Tìm xe')->first();
$loaixe = App\Loaixe::first();

$taixe = new App\Taixe();
$taixe->loaixe_id = $loaixe->id;
$user->taixe()->save($taixe);

$factory->define(App\Tindang::class, function (Faker\Generator $faker) {
    $user = App\User::where('email', 'toantam@gmail.com')->first();
    $loaitin = App\Loaitin::where('tenLT', 'Tìm xe')->first();
    return [
        'tieude' => $faker->sentence,
        'noidung' => $faker->paragraph,
        'thanhphonoidi' => $faker->city,
        'thanhphonoiden' => $faker->city,
        'noidi' => $faker->streetName,
        'noiden' => $faker->streetName,
        'giokhoihanh' => $faker->dateTime,
        'ngaykhoihanh' => $faker->dateTime,
        'loaitin_id' => $loaitin->id,
        'giave' => $faker->numberBetween(0, 10000000),
        'user_id' => $user->id,
    ];
});
