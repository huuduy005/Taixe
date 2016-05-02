<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Shared\Constants;
use App\Http\Requests\TintucRequest;
use App\Tintuc;
use Illuminate\Support\Facades\Session;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Debugbar;

class TintucsController extends Controller
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
            $tintucs = Tintuc::orderBy('updated_at', 'DESC')->paginate(Constants::$paging_number);
        } else {
            Session::put('search_val', $keyword);

            $tintucs_query = Tintuc::where('tieude', 'like', '%'.$keyword.'%')->orderBy('updated_at', 'DESC');

            flash("flash_message1", sprintf(Constants::$number_result_search, count($tintucs_query->get())));

            $tintucs = $tintucs_query->paginate(Constants::$paging_number);
        }
        return view('admin.tintucs.index', compact('tintucs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tintucs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TintucRequest|\Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TintucRequest $request)
    {
        $tintuc = new Tintuc($request->all());

        $tintuc->save();

        flash('flash_message1', sprintf(Constants::$msg_insert_successfully, Constants::$tbl_tintuc));

        return redirect('admin/tintucs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tintuc $tintuc
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function edit(Tintuc $tintuc)
    {

        return view("admin.tintucs.edit", compact('tintuc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TintucRequest|\Illuminate\Http\Request $request
     * @param Tintuc $tintuc
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TintucRequest $request, Tintuc $tintuc)
    {

        $tintuc->tieude = $request->tieude;
        $tintuc->noidung = $request->noidung;

        $tintuc->save();

        flash('flash_message1', sprintf(Constants::$msg_edit_successfully, Constants::$tbl_tintuc));

        return redirect("admin/tintucs");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tintuc $tintuc
     * @return \Illuminate\Http\Response
     * @throws \Exception
     * @internal param int $id
     */

    public function destroy(Tintuc $tintuc)
    {
        $tintuc->delete();
        flash('flash_message1', sprintf(Constants::$msg_delete_successfully, Constants::$tbl_tintuc));
        return redirect("admin/tintucs");
    }
}
