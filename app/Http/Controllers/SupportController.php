<?php

namespace App\Http\Controllers;

use App\Loaitin;
use App\Loaixe;
use App\Taixe;
use App\Thanhpho;
use App\Tindang;
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

    public function lock()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = User::find($id);

            $temp->status = false;

            $temp->save();
        }
    }

    public function unlock()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = User::find($id);

            $temp->status = true;

            $temp->save();
        }
    }

    public function display()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = Tindang::find($id);

            $temp->status = false;

            $temp->save();
        }
    }

    public function undisplay()
    {
        if (Request::ajax()) {
            $id = Request::get('id');
            $temp = Tindang::find($id);

            $temp->status = true;

            $temp->save();
        }
    }


    public function insert($model)
    {
        if (Request::ajax()) {
            $tenTP = Request::get("tenTP");
            switch ($model) {
                case 'thanhpho':
                    $temp = Thanhpho::create(['tenTP' => $tenTP]);


                    $count = Thanhpho::all()->count();

                    return ["insert-successfully", $temp, $count];
                    break;

                case 'loaixe':
                    $temp = Loaixe::create(['tenLX' => $tenTP]);

                    $count = Loaixe::all()->count();

                    return ["insert-successfully", $temp, $count];
                    break;

                case 'loaitin':

                    $tenLT = Request::get("tenLT");
                    $giatien = Request::get("giatien");


                    $temp = Loaitin::create(['tenLT' => $tenLT, 'giatien' => $giatien]);

                    $count = Loaitin::all()->count();

                    $temp1 = Loaitin::find($temp['id']);

                    return ["insert-successfully", $temp1, $count];
                    break;
            }
        }

    }

    public function delete($model)
    {
        if (Request::ajax()) {
            $id = Request::get("id_xoa");
            switch ($model) {
                case 'thanhpho':
                    Thanhpho::where('id', '=', $id)->delete();

                    return "delete-successfully";
                    break;

                case 'loaixe':
                    $loaixe = Loaixe::where('id', '=', $id)->first();

                    if ($loaixe->taixes->isEmpty()) {

                        $loaixe->delete();
                        return "delete-successfully";
                    }
                    break;

                case 'loaitin':
                    $loaitin = Loaitin::where('id', '=', $id)->first();

                    if ($loaitin->tindangs->isEmpty()) {

                        $loaitin->delete();
                        return "delete-successfully";
                    }

                    break;

                case 'tindang':
                    Tindang::where('id', '=', $id)->delete();

                    return "delete-successfully";
                    break;

                case 'user':
                    $user = User::where('id', '=', $id)->first();

                    if ($user->rate_taixes->isEmpty() && $user->tindangs->isEmpty() && $user->save_tindangs->isEmpty()) {

                        $user->delete();
                        return "delete-successfully";
                    }

                    break;
            }
        }
    }


    public function delete_chosen($model)
    {
        if (Request::ajax()) {
            $ids = Request::get("id_xoachon");

            switch ($model) {
                case 'thanhpho':
                    foreach ($ids as $id) {
                        Thanhpho::where('id', '=', $id)->delete();
                    }

                    return "delete-successfully";
                    break;

                case 'loaixe':
                    foreach ($ids as $id) {
                        Loaixe::where('id', '=', $id)->delete();
                    }

                    return "delete-successfully";
                    break;

                case 'loaitin':
                    foreach ($ids as $id) {
                        Loaitin::where('id', '=', $id)->delete();
                    }

                    return "delete-successfully";
                    break;

                case 'tindang':
                    foreach ($ids as $id) {
                        Tindang::where('id', '=', $id)->delete();
                    }

                    return "delete-successfully";
                    break;

                case 'user':
                    $check = true;
                    foreach ($ids as $id) {
                        $user = User::where('id', '=', $id)->first();

                        if ($user->rate_taixes->isEmpty() && $user->tindangs->isEmpty() && $user->save_tindangs->isEmpty()) {
                            $user->delete();
                        } else {
                            $check = false;
                        }
                    }

                    if ($check) return "delete-successfully";
                    break;
            }
        }
    }


    public function find($model)
    {
        if (Request::ajax()) {
            $tenTP = Request::get("tenTP");
            switch ($model) {
                case 'thanhpho':
                    $temp = Thanhpho::where('tenTP', 'like', '%' . $tenTP . '%')->get();

                    if (count($temp) == 0) {
                        return ["null-data", null];
                    }

                    return ["find-successfully", $temp];
                    break;
                case 'loaixe':
                    $temp = Loaixe::where('tenLX', 'like', '%' . $tenTP . '%')->get();

                    if (count($temp) == 0) {
                        return ["null-data", null];
                    }

                    return ["find-successfully", $temp];
                    break;

                case 'loaitin':
                    $temp = Loaitin::where('tenLT', 'like', '%' . $tenTP . '%')->get();

                    if (count($temp) == 0) {
                        return ["null-data", null];
                    }

                    return ["find-successfully", $temp];
                    break;
            }
        }
    }


    public function edit($model)
    {
        if (Request::ajax()) {
            $id = Request::get("id_sua");
            $new_tenTP = Request::get("new_tp");

            switch ($model) {
                case 'thanhpho':
                    $temp = Thanhpho::find($id);
                    $temp->tenTP = $new_tenTP;
                    $temp->save();

                    return ["edit-successfully", $temp->tenTP];
                    break;

                case 'loaixe':
                    $temp = Loaixe::find($id);
                    $temp->tenLX = $new_tenTP;
                    $temp->save();

                    return ["edit-successfully", $temp->tenLX];
                    break;

                case 'loaitin':
                    $new_tien = Request::get("price");

                    $temp = Loaitin::find($id);
                    $temp->tenLT = $new_tenTP;
                    $temp->giatien = $new_tien;
                    $temp->save();

                    return ["edit-successfully", $temp->tenLT, $temp->giatien];
                    break;
            }
        }
    }

    public function cancel_update($model)
    {
        if (Request::ajax()) {
            $id = Request::get('id');

            switch ($model) {
                case 'thanhpho':
                    $temp = Thanhpho::find($id);

                    return $temp->tenTP;
                    break;
                case 'loaixe':
                    $temp = Loaixe::find($id);

                    return $temp->tenLX;
                    break;

                case 'loaitin':
                    $temp = Loaitin::find($id);

                    return [$temp->tenLT, $temp->giatien];
                    break;
                    break;
            }
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
