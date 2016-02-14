@extends('layouts.app')
@section('content')
    @if(isset($tindang))
        <div class="col-md-1 text-right" style="position: fixed">
            @if(Auth::check())
                @if(Auth::user()->id == $tindang->user->id)
                    @if(isset($taixe))
                        <a href="#" title="Cập nhật lộ trình" class="capnhat_lotrinh">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                  style="font-size: 25px; color: #337ab7"></span>
                        </a>
                        <br><br>

                        <script>
                            $('.capnhat_lotrinh').click(function () {
                                swal({
                                            title: "Cập nhật!",
                                            text: "Nhập vị trí cập nhật:",
                                            type: "input",
                                            showCancelButton: true,
                                            closeOnConfirm: false,
                                            confirmButtonText: "Đồng ý",
                                            cancelButtonText: "Hủy",
                                            animation: "slide-from-top",
                                            showLoaderOnConfirm: true,
                                            inputPlaceholder: "Nhập vị trí mà bạn muốn cập nhật"
                                        },
                                        function (inputValue) {
                                            if (inputValue === false) return false;
                                            if (inputValue === "") {
                                                swal.showInputError("Bạn cần phải nhập vị trí!");
                                                return false
                                            }
                                            setTimeout(function () {
                                                $.get('/tindangs/ajax',
                                                        {
                                                            tindang_id: "{{ $tindang->id }}",
                                                            lotrinh: inputValue,
                                                            act: "capnhat"
                                                        },
                                                        function (data) {
                                                            $('.lotrinhhientai').text(inputValue);
                                                            $('.tg_lotrinh').text("({{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('H:i  -   d/m/Y')}})");
                                                            sweetAlert("Thành công", "Bạn đã cập nhật thành công!", "success");
                                                        });
                                            }, 1000);
                                        });
                            });
                        </script>
                    @endif
                @else
                    <a href="#" class="save-tindang" title="Lưu tin đăng">
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"
                              style="font-size: 25px; color: #337ab7"></span>
                    </a>
                @endif
                <script>
                    $('.save-tindang').click(function () {
                        {{ $check = false }}
                        @foreach(Auth::user()->save_tindangs as $item)
                            @if($tindang->id == $item['id'])
                            {{ $check = true }}
                            @endif
                        @endforeach

                        @if($check)
                            sweetAlert("Không thành công", "Bạn đã lưu tin này rồi", "error");
                        @else
                                $.get('/tindangs/ajax',
                                {tindang_id: "{{ $tindang->id }}", act: "luu"},
                                function (data) {
                                    if (data == 'error') {
                                        sweetAlert("Không thành công", "Bạn đã lưu tin này rồi", "error");
                                    } else {
                                        sweetAlert("Thành công", "Bạn đã lưu tin!", "success");
                                    }
                                });
                        @endif
                    })
                </script>
            @endif
        </div>
        <div class="container-fluid row col-sm-offset-1">
            <div class="col-sm-11">
                <div class="row">
                    &nbsp;
                </div>
                <div class="row">
                    @if(isset($taixe))
                        <div class="col-md-1" style="margin-top: 2%"><img src="../images/cab.jpg"
                                                                          class="img-responsive img-rounded img1 ">
                        </div>
                    @else
                        <div class="col-md-1"><img src="../images/passager.jpg"
                                                   class="img-responsive img-rounded img1 "></div>
                    @endif
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-sm-2"><b>Họ tên:</b></div>
                            <div class="col-sm-5"><b>{{ $tindang->user->hoten }} </b></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2"><b>SĐT :</b></div>
                            <div class="col-sm-5"><b>{{ $tindang->user->SDT }} </b></div>
                        </div>

                        @if(isset($taixe))
                            <div class="row">
                                <div class="col-sm-2"><b>Loại xe:</b></div>
                                <div class="col-sm-5"><b>{{ $taixe->loaixe->tenLX }} </b></div>
                            </div>
                            <div class="row">
                                <div style="width: 29%; float: left">
                                    <input value="{{ $taixe->ratepoint }}" id="rating{{ $tindang->id }}" type="number" class="rating rating{{ $taixe->id }}" min=0 max=5 step=0.5 data-size="xs" data-show-caption="false">
                                </div>
                                <div class="col-sm-4" style="padding-top: 10px;">
                                    <font color="#aaa">
                                        <span class="ratinglabel{{ $taixe->id }}">{{ $taixe->ratepoint }} / 5 điểm - {{ $taixe->ratecount }} lượt bầu</span>
                                    </font>
                                </div>
                                @include('partials.star_rating')
                            </div>
                        @endif
                    </div>

                </div>

                <hr>
                <div class="row">
                    <div class="col-md-12" style="font-size:16px"><font
                                color="green"><b>{{ $tindang->tieude }}</b></font></div>
                </div>
                <div class="row">
                    <div class="col-md-12" style="font-size:12px"><i>{{ $tindang->ngaydang}}</i></div>
                    <div class="col-md-12">&nbsp;</div>
                </div>

                @if(isset($taixe))
                    <div class="row">
                        <div class="col-md-2 text-left"><font color="orange"><b>{{ $tindang->giokhoihanh }}</b></font>
                        </div>
                        <div class="col-md-8" style="text-align:center">{{ $tindang->ngaykhoihanh }}</div>
                        <div class="col-md-2 text-right">
                            <font color="red">
                                <b>
                                    @if($tindang->giave == 0)
                                        Thỏa thuận
                                    @else
                                        {{ $tindang->giave }}đ
                                    @endif
                                </b>
                            </font>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <img src="../images/lotrinh.JPG" class="img-responsive text-right">
                    </div>

                    <div class="row">
                        <div class="col-md-2"><b>{{ $tindang->thanhphonoidi }}</b></div>
                        <div class="col-md-8" style="text-align:center">
                            <b style="color:green;" class="lotrinhhientai">
                                @if($tindang->lotrinhhientai != "" && $tindang->lotrinhhientai != null)
                                    {{ $tindang->lotrinhhientai }}
                                @endif
                            </b><br>
                            <font color="#aaa" class="tg_lotrinh">
                                @if($tindang->lotrinhhientai != "" && $tindang->lotrinhhientai != null)
                                    ( {{ date_format(date_create($tindang->TG_capnhatlotrinh), 'H:i - m/d/Y')}} )
                                @endif
                            </font>

                        </div>
                        <div class="col-md-2" align="right"><b>{{ $tindang->thanhphonoiden }}</b></div>
                    </div>
                    <br>
                    <br>
                @endif
                <div class="row">
                    <div class="col-sm-1"><b>Lộ trình:</b></div>
                    <div class="col-sm-11" style="font-size: 15px; font-weight: bold"> {{ $tindang->noidi }}
                        - {{ $tindang->thanhphonoidi }} --> {{ $tindang->noiden }}- {{ $tindang->thanhphonoiden }}</div>

                    <div class="col-md-12">&nbsp;</div>
                </div>

                @unless(isset($taixe))
                    <div class="row">
                        <div class="col-sm-3"><b>Giờ khởi hành mong muốn:</b></div>
                        <div class="col-sm-2">{{ $tindang->giokhoihanh }}</div>
                        <div class="col-sm-2"><b>Ngày khởi hành:</b></div>
                        <div class="col-sm-2">{{ $tindang->ngaykhoihanh }}</div>

                        <div class="col-md-12">&nbsp;</div>
                    </div>
                @endunless

                <div class="row">
                    <div class="col-sm-12"><b>Nội dung:</b></div>
                    <br/>
                    <br/>
                    <div class="col-sm-12"> {{ $tindang->noidung }}</div>

                    <div class="col-md-12">&nbsp;</div>
                </div>

                <div class="fb-comments" data-href="{{ Request::url() }}" data-width="100%" data-numposts="5" data-order-by="reverse_time"></div>

            </div>
        </div>
    @endif

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=1162849360405408";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
@stop