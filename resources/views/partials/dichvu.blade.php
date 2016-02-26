@if(isset($tin_dichvus))
    @foreach($tin_dichvus as $tindang)
        <table class="list_trangchu table table-responsive table{{$tindang->id}}">
            <tr>
                <td width="300">
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
                        {{--*/$taixe1 =  $tindang->user->taixe/*--}}
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
                    <div class="row">
                        <font color="blue" style="font-weight: bold"
                              size="4">{{$tindang->tieude}}</font>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"
                             style="height: 30px; width: 500px;white-space: nowrap; word-break: break-word; overflow: hidden; text-overflow: ellipsis">
                            {{$tindang->noidung}}
                        </div>
                    </div>
                    <br>
                    <a href="/tindangs/{{ $tindang->id }}" class="chitiet_dixe border_radius">>Xem
                        thông tin chi tiết
                        ...</a>
                </td>
                </td>
                <td width="253">
                    @include('partials.option_tindang')

                    @unless($tindang->status)
                        <p class="text-center"><font color="red" size="4">Bài
                                đăng đã bị xóa</font></p>
                    @endunless
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-sm-4">Ngày đăng:</div>
                        <div class="col-sm-7">{{ $tindang->ngaydang }}</div>
                    </div>
                </td>
            </tr>
        </table>
    @endforeach
@endif