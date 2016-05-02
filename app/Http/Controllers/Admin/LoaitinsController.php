<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\Loaitin;
use Illuminate\Support\Facades\Session;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoaitinsController extends Controller
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
            $loaitins = $this->getAllLoaitin();
        } else {
            Session::put('search_val', $keyword);

            $loaitins_query = Loaitin::where('tenLT', 'like', '%'.$keyword.'%');

            flash("flash_message1", sprintf(Constants::$number_result_search, count($loaitins_query->get())));

            $loaitins = $loaitins_query->paginate(Constants::$paging_number);
        }
        return view('admin.loaitins.index', compact('loaitins'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loaitin = new Loaitin();
        $loaitin->tenLT = Request::get('txt_tenLT');
        $loaitin->giatien = Request::get('txt_giatien');

        $loaitin->save();

        $paging_redirect = intval(count(Loaitin::all()) / Constants::$paging_number + 1);

        flash("flash_message1", sprintf(Constants::$msg_insert_successfully, Constants::$tbl_loaitin));

        return redirect("admin/loaitins?page=" . $paging_redirect);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Loaitin $loaitin
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Loaitin $loaitin)
    {
        $loaitins = $this->getAllLoaitin();


        return view('admin.loaitins.index', compact('loaitins', 'loaitin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request|Request $request
     * @param Loaitin $loaitin
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(Request $request, Loaitin $loaitin)
    {
        $loaitin->tenLT = Request::get('txt_tenLT');
        $loaitin->giatien = Request::get('txt_giatien');

        $loaitin->save();

        flash("flash_message1", sprintf(Constants::$msg_edit_successfully, Constants::$tbl_loaitin));

        return redirect("/admin/loaitins");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Loaitin $loaitin
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Loaitin $loaitin)
    {
        if(count($loaitin->tindangs) == 0){
            $loaitin->delete();
            flash("flash_message1", sprintf(Constants::$msg_delete_successfully, Constants::$tbl_loaitin));
        }else{
            flash(Constants::$flash_error, Constants::$error_related_delete, "error");
        }

        return redirect("admin/loaitins");
    }

    /**
     * @return mixed
     */
    protected function getAllLoaitin()
    {
        $loaitins = Loaitin::paginate(Constants::$paging_number);
        return $loaitins;
    }
}
