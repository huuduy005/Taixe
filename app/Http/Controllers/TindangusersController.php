<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\Constants;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;

class TindangusersController extends Controller
{
    public function byUser(User $user)
    {
        $tindangs = $user->tindangs()->with('user.taixe.loaixe')->with('loaitin')
                         ->where('status', true)
                         ->orderby('ngaydang', 'DESC')
                         ->paginate(Constants::$paging_number);

       //dd($user->toArray());
       //dd($tindangs->toArray());

        return view("tindang_users.byUser", compact('tindangs'));
    }
}
