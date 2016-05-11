<?php

use App\Http\Controllers\Shared\Constants;

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/dashboard', 'DashboardsController@user');


    Route::get('/', 'PagesController@trangchu');
    Route::get('/timxe', 'PagesController@timxe');
    Route::get('/timkhach', 'PagesController@timkhach');
    Route::get('/dichvu', 'PagesController@dichvu');


    Route::get('/dangtin', 'TindangsController@create');
    Route::post('/dangtin', 'TindangsController@store');
    Route::get('/tindangs/{tindang}', 'TindangsController@show');

    Route::get('/tindangs/{tindang}/sua', 'TindangsController@edit');
    Route::patch('/tindangs/{tindang}', 'TindangsController@update');

    Route::get('/tindangs/user/{user}', 'TindangusersController@byUser');

    // for tintuc
    Route::get('/tintucs', 'TintucsController@index');
    Route::get('/tintucs/{tintuc}', 'TintucsController@show');

    //route for trogiup (ajax)
    Route::get('/trogiup', 'SupportController@trogiup');
    // Ajax fetch loai xe for update tài xế
    Route::get('/loaixe', 'SupportController@loaixe');

    Route::get('/update_taikhoan', 'SupportController@update_taikhoan');
    Route::get('/delete_tindang', 'SupportController@deleteTindang');
    Route::get('/delete_tinluu', 'SupportController@deleteTinluu');
    Route::get('/update_tindang', 'SupportController@update_tindang');
    Route::get('/cancel_update/{model}', 'SupportController@cancel_update');
    Route::get('/rating', 'SupportController@starRating');


    //route for check if status of user is true
    Route::get('/check_auth', 'SupportController@check_auth');

    //route for remember tindang
    Route::get('/save_tindang/ajax', 'TindangsController@ajaxSaveTindang');

    #region Ajax for admin
    Route::get('/taikhoans/congtien', 'SupportController@addMoney');

    #region Ajax route for taikhoan admin
    Route::get('/taikhoans/khoa', 'SupportController@lock');
    Route::get('/taikhoans/mokhoa', 'SupportController@unlock');
    #endregion

    #region Ajax for tindang admin
    Route::get('/tindangs_admin/an', 'SupportController@hideTindang');
    Route::get('/tindangs_admin/hien', 'SupportController@showTindang');
    #endregion

    #region Ajax for tindang admin
    Route::get('/tintucs_admin/an', 'SupportController@hideTintuc');
    Route::get('/tintucs_admin/hien', 'SupportController@showTintuc');
    Route::get('/tintucs_admin/hot', 'SupportController@hotTintuc');
    #endregion

    #endregion



    #region All route for admin prefix
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
        // Routes default for admin page
        Route::get('/', 'Admin\TintucsController@index');

        #region routes for tin tuc
        Route::get('/tintucs', 'Admin\TintucsController@index');
        Route::get('/tintucs/themmoi', 'Admin\TintucsController@create');
        Route::post('/tintucs', 'Admin\TintucsController@store');
        Route::get('/tintucs/{tintuc}', 'Admin\TintucsController@show');
        Route::get('/tintucs/{tintuc}/sua', 'Admin\TintucsController@edit');
        Route::patch('/tintucs/{tintuc}', 'Admin\TintucsController@update');
        Route::get('/tintucs/xoa/{tintuc}', 'Admin\TintucsController@destroy');
        #endregion

        #region routes for thanh pho
        Route::get('/thanhphos', 'Admin\ThanhphosController@index');
        Route::get('/thanhphos/themmoi', 'Admin\ThanhphosController@create');
        Route::post('/thanhphos', 'Admin\ThanhphosController@store');
        Route::get('/thanhphos/{thanhpho}', 'Admin\ThanhphosController@show');
        Route::get('/thanhphos/{thanhpho}/sua', 'Admin\ThanhphosController@edit');
        Route::patch('/thanhphos/{thanhpho}', 'Admin\ThanhphosController@update');
        Route::get('/thanhphos/xoa/{thanhpho}', 'Admin\ThanhphosController@destroy');
        #endregion

        #region routes for loai xe
        Route::get('/loaixes', 'Admin\LoaixesController@index');
        Route::get('/loaixes/themmoi', 'Admin\LoaixesController@create');
        Route::post('/loaixes', 'Admin\LoaixesController@store');
        Route::get('/loaixes/{loaixe}', 'Admin\LoaixesController@show');
        Route::get('/loaixes/{loaixe}/sua', 'Admin\LoaixesController@edit');
        Route::patch('/loaixes/{loaixe}', 'Admin\LoaixesController@update');
        Route::get('/loaixes/xoa/{loaixe}', 'Admin\LoaixesController@destroy');
        #endregion

        #region routes for loai tin
        Route::get('/loaitins', 'Admin\LoaitinsController@index');
        Route::get('/loaitins/themmoi', 'Admin\LoaitinsController@create');
        Route::post('/loaitins', 'Admin\LoaitinsController@store');
        Route::get('/loaitins/{loaitin}', 'Admin\LoaitinsController@show');
        Route::get('/loaitins/{loaitin}/sua', 'Admin\LoaitinsController@edit');
        Route::patch('/loaitins/{loaitin}', 'Admin\LoaitinsController@update');
        Route::get('/loaitins/xoa/{loaitin}', 'Admin\LoaitinsController@destroy');
        #endregion

        #region routes for tai khoan
        Route::get('/taikhoans', 'Admin\TaikhoansController@index');
        Route::get('/taikhoans/themmoi', 'Admin\TaikhoansController@create');
        Route::post('/taikhoans', 'Admin\TaikhoansController@store');
        Route::get('/taikhoans/{user}', 'Admin\TaikhoansController@show');
        Route::get('/taikhoans/{user}/sua', 'Admin\TaikhoansController@edit');
        Route::patch('/taikhoans/{user}', 'Admin\TaikhoansController@update');
        Route::get('/taikhoans/xoa/{user}', 'Admin\TaikhoansController@destroy');
        #endregion

        #region routes for tin dang
        Route::get('/tindangs', 'Admin\TindangsController@index');
        Route::get('/tindangs/themmoi', 'Admin\TindangsController@create');
        Route::post('/tindangs', 'Admin\TindangsController@store');
        Route::get('/tindangs/{tindang}', 'Admin\TindangsController@show');
        Route::get('/tindangs/{tindang}/sua', 'Admin\TindangsController@edit');
        Route::patch('/tindangs/{tindang}', 'Admin\TindangsController@update');
        Route::get('/tindangs/xoa/{tindang}', 'Admin\TindangsController@destroy');
        #endregion

    });
    #endregion
});

