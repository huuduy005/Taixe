<?php


function flash($key = null, $message = null, $important = null){
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0){
        return $flash;
    }

    return $flash->message($key, $message, $important);
}