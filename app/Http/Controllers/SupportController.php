<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Loaixe;
use App\Taixe;
use App\Thanhpho;
use App\Tindang;
use App\Tintuc;
use App\User;
use Carbon\Carbon;
use Debugbar;
use Illuminate\Support\Facades\Auth;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    #region ajax for admin page
    // Add money for user
    public function addMoney()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $amount = Request::get('amount');
            $temp = User::find($id);

            $temp->soduTK += $amount;

            $temp->save();
            return $temp->soduTK;
        }
    }

    // Lock user account
    public function lock()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = User::find($id);

            $temp->status = false;

            $temp->save();
        }
    }

    // Unlock user account
    public function unlock()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = User::find($id);

            $temp->status = true;

            $temp->save();
        }
    }

    // Show Tindang
    public function showTindang()
    {

        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = Tindang::find($id);

            $temp->status = true;

            $temp->save();
        }
    }

    // Hide tin dang
    public function hideTindang()
    {
        if (Request::ajax()) {

            $id = Request::get('id');

            $temp = Tindang::find($id);

            $temp->status = false;

            $temp->save();
        }
    }

    // Show Tindang
    public function showTintuc()
    {

        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = Tintuc::find($id);

            $temp->status = true;

            $temp->save();

            return $temp;
        }
    }

    // Hide tin dang
    public function hideTintuc()
    {
        if (Request::ajax()) {

            $id = Request::get('id');

            $temp = Tintuc::find($id);

            $temp->status = false;

            $temp->save();

            return $temp;
        }
    }

    // Hide tin dang
    public function hotTintuc()
    {
        if (Request::ajax()) {

            $id = Request::get('id');

            $val = Request::get('value');

            $temp = Tintuc::find($id);

            $temp->hot = $val=='true' ? 1 : 0;

            $temp->save();
        }
    }

    /* end ajax for admin page */
    #endregion

    //for check status of user
    public function check_auth()
    {
        if (Request::ajax()) {
            $email = Request::get('email');

            $temp = User::where('email', $email)->first();

            if (!is_null($temp)) {
                if (!$temp->status) {
                    return "failed";
                }
            }
            return "success";
        }
    }

    // Use for updating star rating
    public function starRating()
    {
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
    }
    public function trogiup()
    {
        if (Request::ajax()) {
            $loaitins = Loaitin::all();

            foreach ($loaitins as $loaitin) {
                $loaitin->giatien = number_format($loaitin->giatien, 0, ',', '.');
            }


            return $loaitins;
        }

    }


    public function loaixe()
    {
        if (Request::ajax()) {
            $loaixes = Loaixe::all();

            return $loaixes;
        }
    }

    public function update_taikhoan()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $name = Request::get('name');
            $sdt = Request::get('sdt');
            $bienso = Request::get('bienso');
            $loaixe_id = Request::get('loaixe');

            $user = User::find($id);
            $user->hoten = $name;
            $user->SDT = $sdt;

            if (!Auth::user()->is('hanhkhach')) {
                $user->taixe->bienso = $bienso;
                $user->taixe->loaixe_id = $loaixe_id;
                $user->taixe->save();
            }
            $user->save();
            flash("flash_message1", "Cập nhật tài khoản thành công!");
        }
    }

    public function deleteTindang()
    {
        if (Request::ajax()) {
            $id = Request::get('id_xoa');


            $tindang = Tindang::where('id', '=', $id)->first();

            $tindang->status = false;
            $tindang->save();


            return "delete-successfully";
        }
    }

    public function deleteTinluu()
    {
        if (Request::ajax()) {
            $id = Request::get('id_xoa');

            Auth::user()->save_tindangs()->detach($id);

            return "delete-successfully";
        }
    }

    public function update_tindang()
    {
        if (Request::ajax()) {
            $id = Request::get('id_xoa');

            $temp = Tindang::find($id);
            $price = $temp->loaitin()->first()->giatien / 2;

            if (Auth::user()->soduTK - $price < 0) {
                flash('flash_message1', 'Tài khoản của bạn không đủ để làm mới', "important");
                return;
            }

            $temp->ngaydang = Carbon::now('Asia/Ho_Chi_Minh');
            $temp->save();

            Auth::user()->soduTK -= $price;
            Auth::user()->save();

            flash("flash_message1", "Làm mới thành công!");
        }
    }
}
