<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\Constants;
use App\Loaitin;
use App\Tindang;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Debugbar;
use Symfony\Component\Debug\Debug;

class DashboardsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function user()
    {
        /**
         * If admin is redirect to homepage
         */
        if (Auth::user()->is('admin')) {
            return redirect('/admin');
        }

        $result = $this->typeOfTinluu();

        $tindang_saves = $result[0];
        $has_tin_dv = $result[1];

        $tin_dichvus = $this->tinDichvusOfUser();

        $tindangs = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->join('loaitins', 'loaitins.id', '=', 'tindangs.loaitin_id')
            ->orderBy('ngaydang', 'desc')
            ->where('users.id', '=', Auth::user()->id)
            ->where('tindangs.status', '=', true)
            ->where('loaitins.tenLT', '<>', Constants::$tin_dich_vu)
            ->paginate(5);

        // Thống kê ở đây
        if (!Auth::user()->hanhkhach) {
            $dichvu_id = Loaitin::where('tenLT', Constants::$tin_dich_vu)->first()->id;

            $so_chuyen_da_chay = Auth::user()->tindangs()
                                ->where('status', true)
                                ->where('loaitin_id', '<>', $dichvu_id)
                                ->where('khoihanh', '<', Carbon::now())
                                ->count();

            $so_chuyen_sap_chay = Auth::user()->tindangs()
                                  ->where('status', true)
                                  ->where('loaitin_id', '<>', $dichvu_id)
                                  ->where('khoihanh', '>=', Carbon::now())
                                  ->count();

            $so_chuyen_da_huy = Auth::user()->tindangs()
                                ->where('status', false)
                                ->count();

            return view('dashboard', compact('tindangs', 'tindang_saves', 'tin_dichvus', 'has_tin_dv', 'so_chuyen_da_chay', 'so_chuyen_sap_chay', 'so_chuyen_da_huy'));
        }
        return view('dashboard', compact('tindangs', 'tindang_saves', 'tin_dichvus', 'has_tin_dv'));
    }

    protected function typeOfTinluu()
    {
        $has_tin_dv = false;

        if (isset($_REQUEST['loaitin_id'])) {
            $loaitin_id = $_REQUEST['loaitin_id'];
            $tindang_saves = Auth::user()->save_tindangs()
                ->where('loaitin_id', $loaitin_id)
                ->orderBy('ngaydang', 'desc')
                ->paginate(5);

            if (Loaitin::find($loaitin_id)->tenLT == "Dịch vụ") {
                $has_tin_dv = true;
            }
            return [$tindang_saves, $has_tin_dv];
        }

        $loaitin_id = Loaitin::first()->id;
        $tindang_saves = Auth::user()->save_tindangs()
            ->where('loaitin_id', $loaitin_id)
            ->orderBy('ngaydang', 'desc')
            ->paginate(5);

        return [$tindang_saves, $has_tin_dv];
    }

    /**
     * @return mixed
     */
    protected function tinDichvusOfUser()
    {
        $tin_dichvus = Loaitin::where("tenLT", "Dịch vụ")->first()
            ->tindangs()->with('user.taixe.loaixe')->where('user_id', Auth::user()->id)
            ->orderBy("ngaydang", "desc")
            ->where('status', true)
            ->paginate(5);
        return $tin_dichvus;
    }
}
