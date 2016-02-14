<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/dashboard', 'DashboardsController@user');


    Route::get('/', 'PagesController@trangchu');
    Route::get('/timxe', 'PagesController@timxe');
    Route::get('/timkhach', 'PagesController@timkhach');


    Route::get('/dangtin', 'TindangsController@create');
    Route::post('/dangtin', 'TindangsController@store');

    //route for trogiup (ajax)
    Route::get('/trogiup', 'SupportController@trogiup');
    Route::get('/loaixe', 'SupportController@loaixe');
    Route::get('/update_taikhoan', 'SupportController@update_taikhoan');
    Route::get('/delete_tindang', 'SupportController@delete_tindang');
    Route::get('/update_tindang', 'SupportController@update_tindang');
    Route::get('/cancel_update/{model}', 'SupportController@cancel_update');

    Route::get('/insert/{model}', 'SupportController@insert');
    Route::get('/delete/{model}', 'SupportController@delete');
    Route::get('/delete_chosen/{model}', 'SupportController@delete_chosen');
    Route::get('/edit/{model}', 'SupportController@edit');
    Route::get('/find/{model}', 'SupportController@find');

    Route::get('/taikhoans/congtien', 'supportController@addMoney');
    Route::get('/taikhoans/khoa', 'supportController@lock');
    Route::get('/taikhoans/mokhoa', 'supportController@unlock');

    Route::get('/tindangs/an', 'supportController@display');
    Route::get('/tindangs/hien', 'supportController@undisplay');

    //route for check if status of user is true
    Route::get('/check_auth', 'supportController@check_auth');

    //route for remember tindang
    Route::get('/tindangs/ajax',  'TindangsController@ajax_save_tindang');

    Route::get('/tindangs/{tindang}', 'TindangsController@show');

    Route::get('/tindangs/{tindang}/sua', 'TindangsController@edit');
    Route::patch('/tindangs/{tindang}', 'TindangsController@update');

    Route::group(['prefix' => 'admin', 'middleware'=>['auth', 'admin']], function(){
        Route::get('/', 'AdminController@thanhpho');

        Route::get('/thanhphos', 'AdminController@thanhpho');

        Route::get('/loaixes', 'AdminController@loaixe');
        Route::get('/loaitins', 'AdminController@loaitin');
        Route::get('/taikhoans', 'AdminController@taikhoan');
        Route::get('/tindangs', 'AdminController@tindang');
    });
});

