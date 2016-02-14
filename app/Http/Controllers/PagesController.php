<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
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
    public function __construct()
    {
        $order_by = "ngaydang";
        $sort = "desc";
        if(Input::get('sort') == 'giatangdan'){
            $order_by = "giave";
            $sort = "asc";
        } elseif(Input::get('sort') == 'giagiamdan') {
            $order_by = "giave";
        }

        $this->taixes = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT', 'loaixes.tenLX', 'taixes.id as taixe_id', 'taixes.ratepoint', 'taixes.ratecount')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->join('taixes', 'users.id', '=', 'taixes.user_id')
            ->join('loaixes', 'taixes.loaixe_id', '=', 'loaixes.id')
            ->where('tindangs.status', '=', true)
            ->orderBy($order_by, $sort);

        $this->hanhkhaches = DB::table('tindangs')
            ->select('tindangs.*', 'users.hoten', 'users.SDT')
            ->join('users', 'tindangs.user_id', '=', 'users.id')
            ->where('users.hanhkhach', '=', true)
            ->where('tindangs.status', '=', true)
            ->orderBy("ngaydang", "desc");

    }

    private $taixes;

    private $hanhkhaches;


    public function trangchu()
    {
        // Use for updating star rates
        if(Request::ajax()){
            $taixe_id =  Request::get('tindang_taixe_id');
            $point = request("point");

            $check = false;
            foreach(Auth::user()->rate_taixes as $item)
                if( $taixe_id == $item['id']) {
                    $check = true;
                }

            if($check){
                $temp = Taixe::find($taixe_id);
                return ["error", $temp];
            }

            Auth::user()->rate_taixes()->attach($taixe_id);

            $temp = Taixe::find($taixe_id);

            $temp["ratecount"] = $temp["ratecount"] + 1;
            $temp["ratepoint"] = ( $temp["ratepoint"] * ( $temp["ratecount"] - 1) + $point )/ $temp["ratecount"];

            // 2 precision of float number
            $temp['ratepoint'] = round($temp['ratepoint'], 2);

            $temp->save();


            return $temp;
        };

        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){

            // use for filtering data followed search bar
            $tindang_taixes = $this->taixes
                ->where("thanhphonoidi", "=", request('thanhphonoidi'))
                ->where("thanhphonoiden", "=", request('thanhphonoiden'))
                ->where("ngaykhoihanh", "=", request('ngaykhoihanh'));
            $count_taixe = $tindang_taixes->count();

            $tindang_taixes = $tindang_taixes->paginate(8);

            $tindang_hanhkhaches = $this->hanhkhaches
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
            $tindang_taixes = $this->taixes->paginate(8);
            $tindang_hanhkhaches = $this->hanhkhaches->paginate(2);
        }

        //Debugbar::info($tindang_taixes->toArray());

        return view('pages.trangchu', compact('tindang_taixes', 'tindang_hanhkhaches'));
    }

    public function timxe()
    {

        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){

            // use for filtering data followed search bar
            $tindang_taixes = $this->taixes
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
            $tindang_taixes = $this->taixes->paginate(10);
        }

        return view('pages.timxe', compact('tindang_taixes'));
    }

    public function timkhach()
    {
        if(isset ( $_REQUEST['thanhphonoidi']) && isset ( $_REQUEST['thanhphonoiden']) && isset ( $_REQUEST['ngaykhoihanh'])){


            $tindang_hanhkhaches = $this->hanhkhaches
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
            $tindang_hanhkhaches = $this->hanhkhaches->paginate(10);
        }

        return view('pages.timkhach', compact('tindang_hanhkhaches'));
    }

}
