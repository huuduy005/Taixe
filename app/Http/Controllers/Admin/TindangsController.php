<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\Tindang;
use Illuminate\Foundation\Auth\User;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TindangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keyword = Request::get('keyword');

        if ($keyword == null) {
            $tindangs = Tindang::with('user')->paginate(Constants::$paging_number);
        } else {
            Session::put('search_val', $keyword);

            $user_id = User::where('hoten', 'like', '%' . $keyword . '%')->select('id')->get()->toArray();

            $array_id = array_column($user_id, 'id');

            $tindangs_query = Tindang::with('user')->where('tieude', 'like', '%' . $keyword . '%')
                ->orWhereIn('user_id', $array_id);

            flash("flash_message1", sprintf(Constants::$number_result_search, count($tindangs_query->get())));

            $tindangs = $tindangs_query->paginate(Constants::$paging_number);
        }
        return view('admin.tindangs.index', compact('tindangs'));
    }


    public function destroy(Tindang $tindang)
    {
        if (count($tindang->save_users) == 0) {
            $tindang->delete();
        }else{
            flash(Constants::$flash_error, Constants::$error_related_delete, "error");
        }
        return redirect("admin/tindangs");
    }
}
