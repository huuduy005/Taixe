<?php

namespace App\Http\Controllers;

use App\Tindang;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Debugbar;
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
        if(Auth::user()->is('admin')){
            return redirect('/admin');
        }

        $tindang_saves = Auth::user()->save_tindangs()
            ->orderBy('created_at', 'desc')
            ->paginate(5);


        $tin_dichvus = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->join('loaitins', 'loaitins.id', '=', 'tindangs.loaitin_id')
            ->where('users.id', '=', Auth::user()->id)
            ->where('loaitins.tenLT', '=', "Dịch vụ")
            ->where('tindangs.status', '=', true)
            ->orderBy("ngaydang", "desc")
            ->paginate(5);


        $tindangs = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT')
            ->join('users', 'tindangs.user_id', '=',  'users.id')
            ->join('loaitins', 'loaitins.id', '=', 'tindangs.loaitin_id')
            ->orderBy('ngaydang', 'desc')
            ->where('users.id', '=', Auth::user()->id)
            ->where('tindangs.status', '=', true)
            ->where('loaitins.tenLT', '<>', "Dịch vụ")
            ->paginate(5);


        return view('dashboard', compact('tindangs', 'tindang_saves', 'tin_dichvus'));
    }
}
