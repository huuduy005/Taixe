<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\User;
use Illuminate\Http\Response;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TaikhoansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $keyword = Request::get('keyword');

        if ($keyword == null) {
            $taikhoans = User::where('email', '<>', Constants::$admin_email)->paginate(Constants::$paging_number);
        } else {
            Session::put('search_val', $keyword);

            $taikhoans_query = User::where('email', 'like', '%' . $keyword . '%')
                ->where('email', '<>', Constants::$admin_email);

            flash("flash_message1", sprintf(Constants::$number_result_search, count($taikhoans_query->get())));

            $taikhoans = $taikhoans_query->paginate(Constants::$paging_number);
        }
        return view('admin.taikhoans.index', compact('taikhoans'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        if (count($user->save_tindangs) + count($user->rate_taixes) + count($user->tindangs) == 0) {
            $user->delete();
            flash("flash_message1", sprintf(Constants::$msg_delete_successfully, Constants::$tbl_taikhoan));
        }else{
            flash(Constants::$flash_error, Constants::$error_related_delete, "error");
        }
        return redirect("admin/taikhoans");
    }
}
