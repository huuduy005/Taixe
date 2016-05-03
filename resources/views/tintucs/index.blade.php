@extends('layouts.app')

@section('css')
    <style>
        .a_tieude:hover {
            color: #5ca038;
        }

        .a_tieude {
            font-weight: normal;
            font-size: 18px;
        }

        .g {
            margin-top: 0;
            margin-bottom: 23px;
        }

        h3.r {
            display: block;
            overflow: hidden;
            text-overflow: ellipsis;
            -webkit-text-overflow: ellipsis;
            white-space: nowrap;
            margin: 0;
            padding: 0;
        }

        .div_content_tintuc {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            height: 20px;
            font-size: 13px;
        }
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
                                        {!! $tintuc->noidung !!}}
                                    </div>
                                    ...................................
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






