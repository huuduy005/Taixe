<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\Loaixe;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;
use Illuminate\Support\Facades\Session;
use Request;

class LoaixesController extends Controller
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
            $loaixes = $this->getAllLoaixe();
        } else {
            Session::put('search_val', $keyword);

            $loaixes_query = Loaixe::where('tenLX', 'like', '%' . $keyword . '%');

            flash("flash_message1", sprintf(Constants::$number_result_search, count($loaixes_query->get())));

            $loaixes = $loaixes_query->paginate(Constants::$paging_number);
        }
        return view('admin.loaixes.index', compact('loaixes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $loaixe = new Loaixe();
        $loaixe->tenLX = Request::get('txt_tenLX');
        $loaixe->save();

        $paging_redirect = intval(count(Loaixe::all()) / Constants::$paging_number + 1);

        flash("flash_message1", sprintf(Constants::$msg_insert_successfully, Constants::$tbl_loaixe));

        return redirect("admin/loaixes?page=" . $paging_redirect);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Loaixe $loaixe)
    {
        $loaixes = $this->getAllLoaixe();


        return view('admin.loaixes.index', compact('loaixes', 'loaixe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loaixe $loaixe)
    {
        $loaixe->tenLX = Request::get('txt_tenLX');

        $loaixe->save();

        flash("flash_message1", sprintf(Constants::$msg_edit_successfully, Constants::$tbl_loaixe));

        return redirect("/admin/loaixes");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Loaixe $loaixe
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */
    public function destroy(Loaixe $loaixe)
    {
        if (count($loaixe->taixes) == 0) {
            $loaixe->delete();

            flash("flash_message1", sprintf(Constants::$msg_delete_successfully, Constants::$tbl_loaixe));
        }else{
            flash(Constants::$flash_error, Constants::$error_related_delete, "error");
        }
        return redirect("admin/loaixes");
    }

    /**
     * Get all loaixe
     * @return mixed
     *
     */
    protected function getAllLoaixe()
    {
        $loaixes = Loaixe::paginate(Constants::$paging_number);
        return $loaixes;
    }
}
