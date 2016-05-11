@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <style>
        .form-control {
            font-size: 13px;
        }

        a {
            color: #555;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
            background: #83BE54;
            color: white;
        }

        .nav-tabs > li {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .nav-tabs {
            margin-bottom: 3px;
        }

        .nav-tabs > li > a {
            margin-right: 0px;
        }
    </style>
@endsection

@section('content')

    @include('flash')
    <div class="row">
        <div class="info_account">
            @if(Auth::user()->admin)
                <div class="row text-center"><h3>TÀI KHOẢN ADMIN</h3></div>
            @elseif(Auth::user()->hanhkhach)
                <div class="row text-center"><h3>TÀI KHOẢN HÀNH KHÁCH</h3></div>
            @else
                <div class="row text-center"><h3>TÀI KHOẢN TÀI XẾ</h3></div>
            @endif
            <hr>
            <div class="row col-sm-offset-1">
                <div class="col-sm-2">
                    <img width="60%" src="{{asset("images/purse.png")}}" class="img img-responsive">
                    <font color="red" size="5"
                          style="font-weight: bold">{{ number_format(Auth::user()->soduTK, null, ',', '.' )}} đ</font>
                </div>
                <div class="col-sm-5">
                    <div class="row  form-group">
                        <div class="col-sm-3"><b>Email: </b></div>
                        <div class="col-sm-5">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3 lbl_form_control"><b>Họ và tên :</b></div>
                        <div class="col-sm-5 account_name">{{ Auth::user()->hoten }}</div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-3 lbl_form_control"><b>SDT :</b></div>
                        <div class="col-sm-5 account_sdt">{{ Auth::user()->SDT }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    {{-- */ $taixe =  Auth::user()->taixe;/* --}}
                    @unless(Auth::user()->hanhkhach)
                        <div class="row form-group">
                            <div class="col-sm-3 lbl_form_control"><b>Biển số :</b></div>
                            <div class="col-sm-5 account_bienso">{{ $taixe->bienso }}</div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3 lbl_form_control"><b>Loại xe :</b></div>
                            <div class="col-sm-5 account_loaixe">{{ $taixe->loaixe->tenLX }}</div>
                        </div>
                    @endunless
                </div>
                <div class="col-sm-1 text-right">
                    <a href="#" data-placement="bottom" data-toggle="tooltip" title="Cập nhật thông tin cá nhân"
                       class="capnhat_taikhoan">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"
                              style="font-size: 25px; color: #337ab7"></span>
                    </a>
                    <div class="confirm_update">
                        <a href="#" data-placement="left" data-toggle="tooltip" title="Đồng ý" class="capnhat_ok">
                            <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"
                                  style="font-size: 30px; color: #337ab7"></span>
                        </a>
                        <br>
                        <a href="#" data-placement="left" data-toggle="tooltip" title="Hủy" class="capnhat_cancel">
                            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"
                                  style="font-size: 30px; color: #337ab7"></span>
                        </a>
                    </div>
                </div>
            </div>
            @unless(Auth::user()->hanhkhach)
                <hr>
                <div class="row col-sm-offset-1">
                    <div class="col-sm-5">
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <br/>
                                <b>Điểm đánh giá :</b>
                            </div>
                            <div class="col-sm-6">
                                <input value="{{ $taixe->ratepoint }}" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" data-show-caption="false" readonly="true">
                                <font color="#aaa">
                                 <span>{{ $taixe->ratepoint }} / 5 điểm - {{ $taixe->ratecount }} </span> lượt bầu
                                </font>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6"><b>
                                    Số tiền đã chi :
                                </b></div>
                            <div class="col-sm-6">
                                <i> {{ Auth::user()->sotiendachi }}</i> đ
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6"><b>
                                    Đã đăng :
                                </b></div>
                            <div class="col-sm-6">
                                <i> {{ $so_chuyen_da_chay + $so_chuyen_sap_chay + $so_chuyen_da_huy }}</i>&nbsp;&nbsp;chuyến
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row"><br></div>
                        <div class="row form-group">
                            <div class="col-sm-3"><b>
                                    Đã chạy :
                                </b></div>
                            <div class="col-sm-6">
                                    <i>{{ $so_chuyen_da_chay }} </i>&nbsp;&nbsp;chuyến
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3"><b>
                                    Đã hủy :
                                </b></div>
                            <div class="col-sm-6">
                                <i>{{ $so_chuyen_da_huy }} </i>&nbsp;&nbsp;chuyến
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-3"><b>
                                    Sắp chạy :
                                </b></div>
                            <div class="col-sm-6">
                                <i> {{ $so_chuyen_sap_chay }} </i>&nbsp;&nbsp;chuyến
                            </div>
                        </div>
                    </div>
                </div>
            @endunless
        </div>
    </div>

    <br><br>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation"
            @unless(Request::input('loaitin_id'))
            class="active"
                @endunless
        ><a href="#bai_dang" aria-controls="bai_dang" role="tab" data-toggle="tab">Danh sách tin đã đăng</a></li>
        <li role="presentation"><a href="#bai_dichvu" aria-controls="bai_dang" role="tab" data-toggle="tab">Danh sách
                tin dịch vụ đã đăng</a></li>
        <li role="presentation"
            @if(Request::input('loaitin_id'))
            class="active"
                @endunless
        ><a href="#bai_luu" aria-controls="bai_dang" role="tab" data-toggle="tab">Danh sách tin đã lưu</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane @unless(Request::input('loaitin_id'))
                active
        @endunless" id="bai_dang">
            <div class="row">
                <div class="container-fluid">
                    <div class="list_content_timkhach">
                        @if($tindangs->count() == 0)
                            <h4 class="text-center" style="margin-top: 30px">Bạn chưa đăng tin!</h4>
                        @endif
                        @if(isset($tindangs))
                            @foreach($tindangs as $tindang)
                                <table class="list_trangchu table table-responsive table{{$tindang->id}}">
                                    <tr>
                                        <td width="250">
                                            <table cellpadding="15">
                                                @if(Auth::user()->is('hanhkhach'))
                                                    <tr>
                                                        <td colspan="2">
                                                            &nbsp;
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td rowspan="4" width="100">
                                                        <div class="img_avatar">
                                                            @if(Auth::user()->is('hanhkhach'))
                                                                <img src="images/passager.jpg" width="60"
                                                                     height="60"
                                                                     class="img-responsive img-rounded img1 ">
                                                            @else
                                                                <img src="images/cab.jpg" width="60" height="60"
                                                                     class="img-responsive img-rounded img1 ">
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td width="80"><strong>Họ tên: </strong></td>
                                                    <td class="value_hoten">{{ $tindang->hoten }}</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>SĐT: </strong></td>
                                                    <td class="value_sdt">{{ $tindang->SDT }}</td>
                                                </tr>
                                                <tr>
                                                    @if(Auth::user()->is('hanhkhach') || Auth::user()->is('admin'))
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                    @else
                                                        <td><strong>Loại xe: </strong></td>
                                                        <td>{{ $taixe->loaixe->tenLX }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        @if(!Auth::user()->is('hanhkhach'))
                                                            <input value="{{ $taixe->ratepoint }}"
                                                                   id="rating{{ $tindang->id }}" type="number"
                                                                   class="rating rating{{ $taixe->id }}" min=0 max=5
                                                                   step=0.5 data-size="xs"
                                                                   data-show-caption="false">
                                                            <font color="#aaa"><span
                                                                        class="ratinglabel{{ $taixe->id }}">{{ $taixe->ratepoint }}
                                                                    / 5 điểm - {{ $taixe->ratecount }}
                                                                    lượt bầu</span></font>
                                                            <script>
                                                                $('#rating{{ $tindang->id }}').on('rating.change', function (event, value, caption) {
                                                                    @if(Auth::user()->taixe['id'] == $taixe->id)
                                                                        sweetAlert("Không thành công", "Bạn không thể đánh giá tài khoản của mình!", "error");
                                                                    @endif
                                                                })
                                                            </script>
                                                        @endif
                                                    </td>
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
                                            @include('partials.option_tindang')
                                            <p>&nbsp;</p>
                                            @unless(Auth::user()->is("hanhkhach"))
                                                <div class="col-sm-4" style="padding-top: 7px">Giá vé:</div>
                                                <div class="col-sm-7">
                                                    <p class="value_giave text-center"><font color="red"
                                                                                             face="verdana">
                                                            @if($tindang->giave == 0)
                                                                <i>Thỏa thuận</i></font>
                                                        @else
                                                            <i>{{ number_format($tindang->giave,0, ",", ".") }}
                                                                đ</i></font>
                                                        @endif
                                                    </p>
                                                </div>
                                                @else
                                                    <p>&nbsp;</p>
                                                    @endunless

                                                    <div class="row">
                                                        <div class="col-sm-4">Ngày đăng:</div>
                                                        <div class="col-sm-7">{{ date_format(date_create($tindang->ngaydang), 'H:i:s - m/d/Y') }}</div>
                                                    </div>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-right"> {!! $tindangs->render() !!}</div>
        </div>


        <div role="tabpanel" class="tab-pane @if(Request::input('loaitin_id')) active @endif" id="bai_luu">
            <div class="row">
                <div class="container-fluid">
                    <div class="list_content_timkhach">
                        @include('partials.type_of_tinluu')

                        @if($tindang_saves->count() == 0)
                            <h4 class="text-center caption-info">Bạn chưa lưu tin
                                <script> $('.caption-info').append($('.typeOfTinLuu option:selected').text())</script>
                                !
                            </h4>
                        @endif

                        @if(isset($tindang_saves))
                            @foreach($tindang_saves as $tindang)
                                @unless($tindang->status)
                                    <style>
                                        .table{{$tindang->id}} .chitiet_dixe {
                                            display: none;
                                        }

                                        .table{{$tindang->id}} :hover {
                                            background: white;
                                        }

                                        .table{{$tindang->id}} .color-blue, .table{{$tindang->id}}          {
                                            color: #bbb !important;
                                        }

                                        .table{{$tindang->id}} .tintuc_tieude {
                                            pointer-events: none;
                                            color: #bbb !important;
                                        }

                                        .table{{$tindang->id}} .value_giave font, .table{{$tindang->id}} .disable_color font {
                                            color: #bbb !important;
                                        }

                                    </style>
                                @endunless

                                @if(isset($has_tin_dv))
                                    @if($has_tin_dv)
                                        @include('partials.dichvu_child', ['tinluu' => true])
                                    @else
                                        <table class="list_trangchu table table-responsive table{{$tindang->id}}">
                                            <tr>
                                                <td width="300">
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
                                                                        <img src="images/passager.jpg" width="60"
                                                                             height="60"
                                                                             class="img-responsive img-rounded img1 ">
                                                                    @else
                                                                        <img src="images/cab.jpg" width="60" height="60"
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
                                                        {{-- */ $taixe1 =  $tindang->user->taixe; /*--}}
                                                        <tr>
                                                            @if($tindang->user->is('hanhkhach') || $tindang->user->is('admin'))
                                                                <td>&nbsp;</td>
                                                                <td>&nbsp;</td>
                                                            @else
                                                                <td><strong>Loại xe: </strong></td>
                                                                <td>{{ $taixe1->loaixe->tenLX }}</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                @if(!$tindang->user->is('hanhkhach'))
                                                                    <input value="{{ $taixe1->ratepoint }}"
                                                                           id="rating{{ $tindang->id }}" type="number"
                                                                           class="rating rating{{ $taixe1->id }}" min=0
                                                                           max=5 step=0.5 data-size="xs"
                                                                           data-show-caption="false">
                                                                    <font color="#aaa">
                                                                    <span class="ratinglabel{{ $taixe1->id }}">{{ $taixe1->ratepoint }}
                                                                        / 5 điểm - {{ $taixe1->ratecount }} </span> lượt
                                                                        bầu
                                                                    </font>
                                                                    @include('partials.star_rating', ['tindang'=> $tindang, 'taixe' => $taixe1])
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td width="500" align="center">
                                                    <p class="value_lotrinh text-center"><i>{{$tindang->noidi}}
                                                            - {{ $tindang->thanhphonoidi }} <font
                                                                    class="color-blue">
                                                                - </font> {{$tindang->noiden}}
                                                            - {{ $tindang->thanhphonoiden }}</i></p>
                                                    <p class="value_giokhoihanh"><font
                                                                class="color-blue">{{ $tindang->giokhoihanh }}  {{ $tindang->ngaykhoihanh }}</font>
                                                    </p>
                                                    <a href="/tindangs/{{ $tindang->id }}"
                                                       class="chitiet_dixe border_radius">>Xem thông tin chi tiết
                                                        ...</a>
                                                </td>
                                                <td width="253">
                                                    @include('partials.option_tindang_luu')
                                                    @unless($tindang->status)
                                                        <p class="text-center"><font color="red" size="4">Bài
                                                                đăng đã bị xóa</font></p>
                                                    @endunless
                                                    @unless($tindang->user->is("hanhkhach"))
                                                        <div class="col-sm-4" style="padding-top: 7px">Giá vé:
                                                        </div>
                                                        <div class="col-sm-7">
                                                            <p class="value_giave text-center"><font color="red"
                                                                                                     face="verdana">
                                                                    @if($tindang->giave == 0)
                                                                        <i>Thỏa thuận</i></font>
                                                                @else
                                                                    <i>{{ number_format($tindang->giave,0, ",", ".") }}
                                                                        đ</i></font>
                                                                @endif
                                                            </p>
                                                        </div>
                                                        @else
                                                            @if($tindang->status)
                                                                <p>&nbsp;</p>
                                                            @endif
                                                            @endunless
                                                            <div class="row">
                                                                <div class="col-sm-4">Ngày đăng:</div>
                                                                <div class="col-sm-7">{{ $tindang->ngaydang }}</div>
                                                            </div>
                                                </td>
                                            </tr>
                                        </table>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-right"> {!! $tindang_saves->render() !!}</div>
        </div>

        <div role="tabpanel" class="tab-pane" id="bai_dichvu">
            <br><br>
            @if($tin_dichvus->count() == 0)
                <h4 class="text-center" style="margin-top: 30px">Bạn chưa đăng tin dịch vụ!</h4>
            @endif
            @include('partials.dichvu')
            <div class="text-right">{{ $tin_dichvus->render() }}</div>
        </div>


    </div>

    <style>
        .color-blue {
            color: blue;;
        }

        .container-edit {
            margin-left: 0px;
        }
    </style>
    @include('partials.script_style.option_tindang')
@endsection

@section("script")
    <script type="text/javascript" src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(".select2").select2();

        $('.confirm_update').hide();
        $('.capnhat_taikhoan').click(function () {
            $(".lbl_form_control").addClass("form-control-static");
            $('.account_name').html("<input type=text class='form-control txt_name  input-sm' value='" + $('.account_name').text() + "'>");
            $('.account_sdt').html("<input type=text class='form-control txt_sdt  input-sm' value='" + $('.account_sdt').text() + "'>");

            @unless(Auth::user()->hanhkhach)
            $('.account_bienso').html("<input type=text class='form-control txt_bienso  input-sm' value='" + $('.account_bienso').text() + "'>");
            $.get('/loaixe',
                    function (data) {
                        str = "";
                        $.each(data, function (key, value) {
                            if (value['tenLX'] == $('.account_loaixe').text()) {
                                str = str + "<option value=" + value['id'] + " selected> " + value['tenLX'] + " </option>";
                            } else {
                                str = str + "<option value=" + value['id'] + " > " + value['tenLX'] + " </option>";
                            }
                        })

                        $('.account_loaixe').html("<select class='sl_loaixe form-control input-sm select2'>" +
                                str
                                + "</select>");
                    }
            );
            @endunless

            $(this).hide();
            $('.confirm_update').show();
        });

        $('.capnhat_ok').on('click', function () {
            name = $('.txt_name').val();
            sdt = $('.txt_sdt').val();
            bienso = $('.txt_bienso').val();
            loaixe = $('.sl_loaixe').val();
            id = "{{ Auth::user()->id }}";

            $.get('/update_taikhoan',
                    {name: name, sdt: sdt, bienso: bienso, loaixe: loaixe, id: id},
                    function (data) {
                        window.location.replace("{{ Request::url() }}");
                    })
        });

        $('.capnhat_cancel').on('click', function () {
            window.location.replace("{{ Request::url() }}");
        });

    </script>
@endsection