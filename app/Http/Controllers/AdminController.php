<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Loaixe;
use App\Thanhpho;
use App\Tindang;
use App\User;
use Illuminate\Support\Facades\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DebugBar;

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
        if(Request::ajax()){

            //use for delete
            if(Request::get("xoa")){
                $id = Request::get("id_xoa");

                User::where('id', '=', $id)->delete();

                return "delete-successfully";
            }


            //use for delete for range
            if(Request::get("xoachon")){
                $ids = Request::get("id_xoachon");


                foreach($ids as $id){
                    User::where('id', '=', $id)->delete();
                }

                return "delete-successfully";
            }

        }

        $taikhoans = User::where('email','<>', 'toantam@gmail.com')->paginate(20);

        return view('admin.taikhoans.taikhoan', compact('taikhoans'));
    }
}
