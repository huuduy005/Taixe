<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Loaitin;
use App\Taixe;
use App\Tindang;
use App\User_rate_taixe;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Request;
use Debugbar;
class PagesController extends Controller
{
    public function dichvu()
    {
        $tin_dichvus = $this->tinDichvuList();

        return view('pages.dichvu', compact('tin_dichvus'));

    }
    public function trangchu()
    {
        $tindang_taixes = $this->tinTimxeList();

        $tindang_hanhkhaches = $this->tinTimkhachList();

        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){

            // use for filtering data followed search bar
            $tindang_taixes = $tindang_taixes
                ->where("thanhphonoidi", "=", request('thanhphonoidi'))
                ->where("thanhphonoiden", "=", request('thanhphonoiden'))
                ->where("ngaykhoihanh", "=", request('ngaykhoihanh'));
            $count_taixe = $tindang_taixes->count();

            $tindang_taixes = $tindang_taixes->paginate(8);

            $tindang_hanhkhaches = $tindang_hanhkhaches
                ->where("thanhphonoidi", "=",  request('thanhphonoidi'))
                ->where("thanhphonoiden", "=", request('thanhphonoiden'))
                ->where("ngaykhoihanh", "=", request('ngaykhoihanh'));

            $count_hanhkhach = $tindang_hanhkhaches->count();

            $tindang_hanhkhaches = $tindang_hanhkhaches->paginate(2);

            if( ($count_hanhkhach + $count_taixe ) == 0){
                flash("flash_message1", "Không có dữ liệu mà bạn cần tìm!" , "important");
            }else{
                flash("flash_message1", "Kết quả 	&nbsp;: &nbsp;	&nbsp;<i>" . $count_taixe ."</i> &nbsp; tin tìm khách &nbsp;- &nbsp; <i>". $count_hanhkhach."</i> &nbsp; tin tìm xe" , "important");
            }
        } else{
            $tindang_taixes = $tindang_taixes->paginate(8);
            $tindang_hanhkhaches = $tindang_hanhkhaches->paginate(2);
        }


        return view('pages.trangchu', compact('tindang_taixes', 'tindang_hanhkhaches'));
    }

    public function timxe()
    {
        $tindang_taixes = $this->tinTimxeList();

        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){

            // use for filtering data followed search bar
            $tindang_taixes = $tindang_taixes
                ->where("thanhphonoidi", "=", request('thanhphonoidi'))
                ->where("thanhphonoiden", "=", request('thanhphonoiden'))
                ->where("ngaykhoihanh", "=", request('ngaykhoihanh'));
            $count_taixe = $tindang_taixes->count();

            $tindang_taixes = $tindang_taixes->paginate(10);


            if( ( $count_taixe ) == 0){
                flash("flash_message1", "Không có dữ liệu mà bạn cần tìm!" , "important");
            }else{
                flash("flash_message1", "Kết quả 	&nbsp;: &nbsp;	&nbsp;<i>" . $count_taixe ."</i>  &nbsp; tin tìm khách" , "important");
            }
        } else{
            $tindang_taixes = $tindang_taixes->paginate(10);
        }

        return view('pages.timxe', compact('tindang_taixes'));
    }

    public function timkhach()
    {
        $tindang_hanhkhaches = $this->tinTimkhachList();
        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){

            $tindang_hanhkhaches = $tindang_hanhkhaches
                ->where("thanhphonoidi", "=",  request('thanhphonoidi'))
                ->where("thanhphonoiden", "=", request('thanhphonoiden'))
                ->where("ngaykhoihanh", "=", request('ngaykhoihanh'));

            $count_hanhkhach = $tindang_hanhkhaches->count();

            $tindang_hanhkhaches = $tindang_hanhkhaches->paginate(10);

            if( ($count_hanhkhach ) == 0){
                flash("flash_message1", "Không có dữ liệu mà bạn cần tìm!" , "important");
            }else{
                flash("flash_message1", "Kết quả 	&nbsp;: &nbsp;	&nbsp; <i>". $count_hanhkhach."</i> &nbsp; tin tìm xe" , "important");
            }
        } else{
            $tindang_hanhkhaches = $tindang_hanhkhaches->paginate(10);
        }

        return view('pages.timkhach', compact('tindang_hanhkhaches'));
    }

    protected function tinDichvuList()
    {
        $tin_dichvus = Loaitin::where("tenLT", "Dịch vụ")->first()
            ->tindangs()->with('user.taixe.loaixe')
            ->orderBy("ngaydang", "desc")
            ->paginate(5);
        return $tin_dichvus;
    }


    protected function tinTimkhachList()
    {
        $tindang_hanhkhaches = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->join('loaitins', 'loaitins.id', '=', 'tindangs.loaitin_id')
            ->where('loaitins.tenLT', '=', "Tìm khách")
            ->where('tindangs.status', '=', true)
            ->orderBy("ngaydang", "desc");
        return $tindang_hanhkhaches;
    }

    protected function tinTimxeList()
    {
        $order_by = "ngaydang";
        $sort = "desc";
        if(Input::get('sort') == 'giatangdan'){
            $order_by = "giave";
            $sort = "asc";
        } elseif(Input::get('sort') == 'giagiamdan') {
            $order_by = "giave";
        }

        $tindang_taixes = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT', 'loaixes.tenLX', 'taixes.id as taixe_id', 'taixes.ratepoint', 'taixes.ratecount')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->join('taixes', 'users.id', '=', 'taixes.user_id')
            ->join('loaixes', 'taixes.loaixe_id', '=', 'loaixes.id')
            ->join('loaitins', 'loaitins.id', '=', 'tindangs.loaitin_id')
            ->where('loaitins.tenLT', '=', "Tìm xe")
            ->where('tindangs.status', '=', true)
            ->orderBy($order_by, $sort);
        return $tindang_taixes;
    }


}
