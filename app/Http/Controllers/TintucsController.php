<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Shared\Constants;
use App\Http\Requests\TintucRequest;
use App\Tintuc;
use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TintucsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tintucs = Tintuc::where('status', true)->orderBy('updated_at', 'DESC')->paginate(Constants::$paging_number);

        return view('tintucs.index', compact('tintucs'));
    }

    /**
     * Display the specified resource.
     *
     * @param Tintuc $tintuc
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show(Tintuc $tintuc)
    {
        return view('tintucs.show', compact('tintuc'));
    }



}
