<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Loaitin;
use App\Loaixe;
use App\Thanhpho;
use App\Tindang;
use App\User;
use Debugbar;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
    public function tindang()
    {
        $tindangs = Tindang::paginate(20);

        return view('admin.tindangs.tindang', compact('tindangs'));
    }

    public function loaixe()
    {
        $loaixes = Loaixe::all();

        return view('admin.loaixes.loaixe', compact('loaixes'));
    }

    public function thanhpho()
    {

        $thanhphos = Thanhpho::all();

        return view('admin.thanhphos.thanhpho', compact('thanhphos'));
    }

    public function loaitin()
    {
        $loaitins = Loaitin::all();

        return view('admin.loaitins.loaitin', compact('loaitins'));
    }

    public function taikhoan()
    {

        $taikhoans = User::where('email', '<>', 'toantam@gmail.com')->paginate(20);

        return view('admin.taikhoans.taikhoan', compact('taikhoans'));
    }



}
