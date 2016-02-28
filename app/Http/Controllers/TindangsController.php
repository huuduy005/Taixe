<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Loaitin;
use App\Tindang;
use App\User;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Support\Facades\Auth;
use Request;

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

    public function ajaxSaveTindang()
    {
        if (Request::ajax()) {
            if (isset($_REQUEST['act'])) {
                if ($_REQUEST['act'] == "luu") {
                    $tindang_id = Request::get('tindang_id');

                    $check = false;
                    foreach (Auth::user()->save_tindangs as $item) {
                        if ($item['id'] == $tindang_id) {
                            $check = true;
                        }
                    }

                    if ($check) {
                        return "error";
                    }

                    Auth::user()->save_tindangs()->attach($tindang_id);

                }

                if ($_REQUEST['act'] == "capnhat") {
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
     * @param \Illuminate\Http\Request|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request before manipulate data in here against DangtinRequest;

        $tindang = new Tindang();


        if(Request::get('rd_loaitin') == "tinthuong"){
            if (Auth::user()->is('hanhkhach')) {
                $loaitin_id = Loaitin::where('tenLT', "Tìm khách")->first()->id;
            } else {
                $loaitin_id = Loaitin::where('tenLT', "Tìm xe")->first()->id;
            }
        } else{
            $loaitin_id = Loaitin::where('tenLT', "Dịch vụ")->first()->id;
        }

        $tindang->loaitin_id = $loaitin_id;

        $tindang->fill(Request::all());

        $giave = $tindang->giave;

        $giave = str_replace('.', '', $giave);

        $tindang->giave = $giave;

        $price = $tindang->loaitin->giatien;

        if (Auth::user()->soduTK - $price < 0) {
            flash('flash_message1', 'Tài khoản của bạn không đủ để đăng tin!', 'important');

            return redirect('/dashboard');
        }

        Auth::user()->tindangs()->save($tindang);
        $tindang->save();
        Auth::user()->soduTK -= $price;
        Auth::user()->save();

        flash('flash_message1', 'Bạn đã thêm mới tin đăng thành công!');

        return redirect('/dashboard');
    }

    public function show(Tindang $tindang)
    {
        $taixe = $tindang->user->taixe;
        if (is_null($taixe)) {
            return view('tindangs.chitiet', compact('tindang'));
        } else {
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
