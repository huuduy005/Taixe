@if(isset($tindang_taixes))
    @foreach($tindang_taixes as $tindang)
        <table class="list_trangchu table table-responsive table{{$tindang->id}}">
            <tr>
                <td width="250">
                    <table class="table-responsive">
                        <tr>
                            <td rowspan="4" width="100">
                                <div class="img_avatar">
                                    <img src="images/cab.jpg" width="60" height="60" class="img-responsive img-rounded img1">
                                </div>
                            </td>
                            <td width="80"><strong>Họ tên: </strong></td>
                            <td class="value_hoten">{!! link_to_action('TindangusersController@byUser', $tindang->hoten, $tindang->user_id) !!}</td>
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
                            @include('partials.script_style.star_rating')
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
                        <div class="col-sm-7">{{ date_format(date_create($tindang->ngaydang), 'H:i:s - d/m/Y') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    @endforeach
@endif
