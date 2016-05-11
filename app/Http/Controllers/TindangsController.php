<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Shared\Constants;
use App\Loaitin;
use App\Taixe;
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
        if (Auth::user()->admin) return redirect("/admin");
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

        /**
         * Phân loại tin đăng cho user
         * Tài xế: Tìm khách
         * Khách : Tìm xe
         * Hoặc : dịch vụ
         */
        if (Request::get('rd_loaitin') == "tinthuong") {
            if (Auth::user()->is('hanhkhach')) {
                $loaitin_id = Loaitin::where('tenLT', Constants::$tin_tim_xe)->first()->id;
            } else {
                $loaitin_id = Loaitin::where('tenLT', Constants::$tin_tim_khach)->first()->id;
            }
        } else {
            $loaitin_id = Loaitin::where('tenLT', Constants::$tin_dich_vu)->first()->id;
        }
        $tindang->loaitin_id = $loaitin_id;
        $tindang->khoihanh = $this->convertToCarbon();

        $tindang->fill(Request::all());

        // Tách dấu chấm ra khỏi chuỗi để lưu lại giá vé trong db
        $giave = $tindang->giave;
        $giave = str_replace('.', '', $giave);
        $tindang->giave = $giave;


        /**
         * Trừ tiền vào tài khoản của user
         * Cập nhật trừ : 1/2 Số lần đăng tin
         */
        $price = $tindang->loaitin->giatien;
        if (Auth::user()->soduTK - $price < 0) {
            flash('flash_message1', 'Tài khoản của bạn không đủ để đăng tin!', 'important');

            return redirect('/dashboard');
        }
        Auth::user()->tindangs()->save($tindang);
        $tindang->save();
        Auth::user()->soduTK -= $price;
        Auth::user()->sotiendachi += $price;
        Auth::user()->save();

        flash('flash_message1', 'Bạn đã đăng tin thành công!');

        return redirect('/dashboard');
    }

    public function show(Tindang $tindang)
    {
        // Eager loading for tin dang
        $tindang = Tindang::with('user')->find($tindang->id);

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
        $giave = str_replace('.', '', Request::get('giave'));

        $tindang->update(Request::all());

        $tindang->giave = $giave;

        $tindang->khoihanh = $this->convertToCarbon();

        $tindang->save();

        flash('flash_message1', 'Bạn đã sửa tin đăng thành công!');

        return redirect('/dashboard');
    }

    /**
     * Convert to a Carbon to use for statistic of giokhoihanh + ngaykhoihanh
     * @return static
     */
    protected function convertToCarbon()
    {
        $time = Request::get('giokhoihanh');
        $date = Request::get('ngaykhoihanh');
        $datetime = $date . " " . $time;
        $khoihanh = Carbon::createFromFormat("d/m/Y g:i A", $datetime);
        return $khoihanh;
    }

}
