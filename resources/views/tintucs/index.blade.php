@extends('layouts.app')

@section('css')
    <style>

    </style>
@endsection

@section('content')
    <div class="container-edit">
        <div class="col-sm-6">
            @if(isset($tintucs))
                @foreach($tintucs as $tintuc)
                    <div class="g"><!--m-->
                        <div class="rc" data-hveid="33">
                            <h3 class="r">
                                <a class="tintuc_tieude a_tieude"
                                   href="{{url('/tintucs', $tintuc->id)}}">{{$tintuc->tieude}}</a>
                            </h3>
                            <div class="s">
                                <font style="font-size: 12px">{{ date_format(date_create($tintuc->updated_at), 'H:i - d/m/Y')}}</font>
                                    <div class="div_content_tintuc">
                                        {!! Str::words($tintuc->noidung, 15, ".....")!!}
                                    </div>
                            </div>
                        </div><!--n-->
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-sm-6">

        </div>
    </div>
@endsection

@section('script')

@endsection






