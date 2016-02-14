@if(isset($tindang_taixes))
    @foreach($tindang_taixes as $tindang)
        <table class="list_trangchu table table-responsive table{{$tindang->id}}">
            <tr>
                <td width="250">
                    <table class="table-responsive">
                        <tr>
                            <td rowspan="4" width="100">
                                <div class="img_avatar">
                                    <img src="images/cab.jpg" width="60" height="60" class="img-responsive img-rounded img1 ">
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
                            <td><strong>Loại xe: </strong></td>
                            <td>{{ $tindang->tenLX }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input value="{{ $tindang->ratepoint }}" id="rating{{ $tindang->id }}" type="number" class="rating rating{{ $tindang->taixe_id }}" min=0 max=5 step=0.5 data-size="xs" data-show-caption="false">
                                <font color="#aaa">
                                    <span class="ratinglabel{{ $tindang->taixe_id }}">{{ $tindang->ratepoint }} / 5 điểm - {{ $tindang->ratecount }} </span> lượt bầu
                                </font>
                                <script>
                                        $('#rating{{ $tindang->id }}').on('rating.change', function (event, value, caption) {
                                            @if(Auth::check())
                                                  @if(Auth::user()->taixe['id'] == $tindang->taixe_id)
                                                      sweetAlert("Không thành công", "Bạn không thể đánh giá tài khoản của mình!", "error");
                                            $('.rating{{ $tindang->taixe_id }}').rating('reset');
                                            @else
                                                {{ $check = false }}
                                                 @foreach(Auth::user()->rate_taixes as $item)
                                                    @if( $tindang->taixe_id == $item['id'])
                                                        {{ $check = true}}
                                                    @endif
                                                @endforeach

                                                @if($check)
                                                    sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                                            $('.rating{{ $tindang->taixe_id }}').rating('reset');
                                            @else
                                              $.get('/',
                                                    {
                                                        tindang_taixe_id: "{{ $tindang->taixe_id }}",
                                                        point: value
                                                    },
                                                    function (data) {
                                                        if (data[0] == 'error') {
                                                            sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                                                            $('.rating{{ $tindang->taixe_id }}').rating('update', data[1]["ratepoint"]);
                                                        } else {
                                                            $('.ratinglabel{{ $tindang->taixe_id }}').text(data["ratepoint"] + "/ 5 điểm - " + data["ratecount"]+ " lượt bầu");
                                                            $('.rating{{ $tindang->taixe_id }}').rating('update', data["ratepoint"]);
                                                        }
                                                    })
                                            @endif
                                        @endif
                                    @else
                                        sweetAlert("Không thành công", "Bạn phải đăng nhập thì mới được đánh giá!", "error");
                                            $('.rating{{ $tindang->taixe_id }}').rating('reset');
                                            @endif

                                        })
                                </script>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="500" align="center">
                    <p class="value_lotrinh text-center"><i>{{$tindang->noidi}} - {{ $tindang->thanhphonoidi }} <font color="red">-</font> {{$tindang->noiden}} - {{ $tindang->thanhphonoiden }}</i></p>
                    <p class="value_giokhoihanh">
                        <font color="blue">{{ $tindang->giokhoihanh }} - {{ $tindang->ngaykhoihanh }}</font>
                    </p>
                    <a href="/tindangs/{{$tindang->id}}" class="chitiet_dixe border_radius">>Xem thông tin chi tiết ...</a>
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
                        <div class="col-sm-7">{{ date_format(date_create($tindang->ngaydang), 'H:i:s - m/d/Y') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    @endforeach
@endif
