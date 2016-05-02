@extends('layouts.app')
@section('content')
    @include('flash')
    @if(isset($tindangs))
        @foreach($tindangs as $tindang)
            @if($tindang->loaitin->tenLT != \App\Http\Controllers\Shared\Constants::$tin_dich_vu)
                <table class="list_trangchu table table-responsive table{{$tindang->id}}">
                    <tr>
                        <td width="250">
                            <table cellpadding="15">
                                @if($tindang->user->is('hanhkhach'))
                                    <tr>
                                        <td colspan="2">
                                            &nbsp;
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td rowspan="4" width="100">
                                        <div class="img_avatar">
                                            @if($tindang->user->is('hanhkhach'))
                                                <img src="{{asset('images/passager.jpg')}}" width="60"
                                                     height="60"
                                                     class="img-responsive img-rounded img1 ">
                                            @else
                                                <img src="{{asset('images/cab.jpg')}}" width="60" height="60"
                                                     class="img-responsive img-rounded img1 ">
                                            @endif
                                        </div>
                                    </td>
                                    <td width="80"><strong>Họ tên: </strong></td>
                                    <td class="value_hoten">{{ $tindang->user->hoten }}</td>
                                </tr>
                                <tr>
                                    <td><strong>SĐT: </strong></td>
                                    <td class="value_sdt">{{ $tindang->user->SDT }}</td>
                                </tr>
                                <tr>
                                    @if($tindang->user->is('hanhkhach') || $tindang->user->is('admin'))
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    @else
                                        <td><strong>Loại xe: </strong></td>
                                        <td> {{ $tindang->user->taixe->loaixe->tenLX }} </td>
                                    @endif
                                </tr>
                                <tr>
                                    @if($tindang->user->taixe != null)
                                        @include('partials.script_style.star_rating_new')
                                    @endif
                                </tr>
                            </table>
                        </td>
                        <td width="500" align="center">
                            <p class="value_lotrinh text-center"><i>{{$tindang->noidi}}
                                    - {{ $tindang->thanhphonoidi }} <font color="red">
                                        - </font> {{$tindang->noiden}}
                                    - {{ $tindang->thanhphonoiden }}</i></p>
                            <p class="value_giokhoihanh"><font
                                        color="blue">{{ $tindang->giokhoihanh }}  {{ $tindang->ngaykhoihanh }}</font>
                            </p>
                            <a href="/tindangs/{{ $tindang->id }}"
                               class="chitiet_dixe border_radius">>Xem thông tin chi tiết ...</a>
                        </td>
                        <td width="253">
                            @include('partials.option_tindang', ['tindang' => $tindang])
                            <p>&nbsp;</p>
                            <div class="col-sm-4" style="padding-top: 7px">Giá vé:</div>
                            <div class="col-sm-7">
                                <p class="value_giave text-center"><font color="red" face="verdana">
                                        @if($tindang->giave == 0)
                                            <i>Thỏa thuận</i></font>
                                    @else
                                        <i>{{ number_format($tindang->giave,0, ",", ".") }}đ</i></font>
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">Ngày đăng:</div>
                                <div class="col-sm-7">{{ $tindang->ngaydang }}</div>
                            </div>
                        </td>
                    </tr>
                </table>
            @endif
        @endforeach
    @endif
    <div class="text-right">
        {!! $tindangs->render() !!}
    </div>

    @include('partials.script_style.option_tindang'){{-- style and script for option tindang --}}
@stop