<?php

namespace App\Http\Controllers;

use App\Http\Requests\DangtinRequest;
use App\Http\Requests;
use App\Loaitin;
use App\Loaixe;
use App\Tindang;
use App\User;
use App\User_save_tindang;

use Carbon\Carbon;
use Faker\Provider\DateTime;
use Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Debugbar;
class TindangsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function ajax_save_tindang()
    {
        if(Request::ajax()){
            if(isset($_REQUEST['act'])){
                if($_REQUEST['act'] == "luu"){
                    $tindang_id = Request::get('tindang_id');

                    $check = false;
                    foreach(Auth::user()->save_tindangs as $item){
                        if($item['id'] == $tindang_id){
                            $check = true;
                        }
                    }

                    if($check){
                        return "error";
                    }

                    Auth::user()->save_tindangs()->attach($tindang_id);

                }

                if($_REQUEST['act'] == "capnhat"){
                    $tindang_id = Request::get('tindang_id');
                    $lotrinh = Request::get('lotrinh');

                    $temp = Tindang::find($tindang_id);


                    $temp->lotrinhhientai = $lotrinh;
                    $temp->TG_capnhatlotrinh = carbon::now('Asia/Ho_Chi_Minh');
                    $temp->save();


                    return "success";
                }
            }
        }
    }

    public function create()
    {

        return view('tindangs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request before manipulate data in here against DangtinRequest;

        $tindang = new Tindang();

        $tindang->fill(Request::all());

        $price = $tindang->loaitin->giatien;

        if(Auth::user()->soduTK - $price < 0){
            flash('flash_message1', 'Tài khoản của bạn không đủ để đăng tin!', 'important');

            return redirect('/dashboard');
        }

        Auth::user()->tindangs()->save($tindang);
        Auth::user()->soduTK -= $price;
        Auth::user()->save();

        flash('flash_message1', 'Bạn đã thêm mới tin đăng thành công!');

        return redirect('/dashboard');
    }


    public function show(Tindang $tindang)
    {
        $taixe = $tindang->user->taixe;

        if(is_null($taixe)){
            return view('tindangs.chitiet', compact('tindang'));
        }else{
            return view('tindangs.chitiet', compact('tindang', 'taixe'));
        }


    }

    public function edit(Tindang $tindang)
    {
        return view('tindangs.edit', compact('tindang'));
    }

    public function update(Tindang $tindang, Request $request)
    {
        $tindang->update(Request::all());

        flash('flash_message1', 'Bạn đã sửa tin đăng thành công!');

        return redirect('/dashboard');
    }
}
