@if(isset($tin_dichvus))
    @foreach($tin_dichvus as $tindang)
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
                            <td class="value_hoten">{!! link_to_action('TindangusersController@byUser', $tindang->user->hoten, $tindang->user_id) !!}</td>
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
                    <div class="row td2_tindang">
                        <font color="blue" style="font-weight: bold"
                              size="4">{{$tindang->tieude}}</font>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 td2_tindang" style="height: 20px;">
                            {!!  $tindang->noidung !!}}
                        </div>
                        <div class="col-sm-12 text-left">
                        ............................
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