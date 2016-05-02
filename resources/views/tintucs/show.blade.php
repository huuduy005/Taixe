@extends('layouts.app')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="container-edit">
        @if(isset($tintuc))
            <div class="col-sm-6">
                <h2 class="tintuc_tieude">{{ $tintuc->tieude }}</h2>
                <div class="tintuc_ngay">{{ $tintuc->updated_at }}</div>
                <article class="tintuc_noidung">
                    {!! $tintuc->noidung !!}
                </article>
            </div>
            <div class="col-sm-6">

            </div>
        @endif
    </div>
@endsection

@section('script')

@endsection






