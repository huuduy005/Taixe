<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\Http\Requests\ThanhphoRequest;
use App\Thanhpho;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Request;

class ThanhphosController extends Controller
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
            $thanhphos = $this->getAllThanhpho();
        } else {
            Session::put('search_val', $keyword);

            $thanhphos_query = Thanhpho::where('tenTP', 'like', '%' .$keyword . '%');

            flash("flash_message1", sprintf(Constants::$number_result_search, count($thanhphos_query->get())));

            $thanhphos = $thanhphos_query->paginate(Constants::$paging_number);
        }

        return view('admin.thanhphos.index', compact('thanhphos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param ThanhphoRequest|Request $request
     * @return Response
     */
    public function store(ThanhphoRequest $request)
    {

        $thanhpho = new Thanhpho();
        $thanhpho->tenTP = Request::get('txt_tenTP');

        $thanhpho->save();

        $paging_redirect = intval(count(Thanhpho::all()) / Constants::$paging_number + 1);

        flash("flash_message1", sprintf(Constants::$msg_insert_successfully, Constants::$tbl_thanhpho));

        return redirect("admin/thanhphos?page=" . $paging_redirect);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit(Thanhpho $thanhpho)
    {
        $thanhphos = $this->getAllThanhpho();

        return view('admin.thanhphos.index', compact('thanhphos', 'thanhpho'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ThanhphoRequest $request
     * @param Thanhpho $thanhpho
     * @return Response
     * @internal param $ \Illuminate\Http\
     * Request  $request
     * @internal param int $id
     */
    public function update(ThanhphoRequest $request, Thanhpho $thanhpho)
    {
        $thanhpho->tenTP = Request::get('txt_tenTP');

        $thanhpho->save();

        flash("flash_message1", sprintf(Constants::$msg_edit_successfully, Constants::$tbl_thanhpho));

        return redirect("/admin/thanhphos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy(Thanhpho $thanhpho)
    {
        $thanhpho->delete();
        flash("flash_message1", sprintf(Constants::$msg_delete_successfully, Constants::$tbl_thanhpho));
        return redirect("admin/thanhphos");
    }

    /**
     * @return mixed
     */
    protected function getAllThanhpho()
    {
        $thanhphos = Thanhpho::paginate(Constants::$paging_number);
        return $thanhphos;
    }
}
