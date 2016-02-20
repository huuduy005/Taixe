<div style="margin-top: 3px"></div>
@if(isset($tin_dichvus))
    @foreach($tin_dichvus as $tin_dichvu)
        <table class="list_trangchu  table table-responsive table{{$tin_dichvu->id}}">
            <tr>
                <td width="250">
                    <table  class="table-responsive">
                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" width="100">
                                <div class="img_avatar">
                                    @if($tin_dichvu->hanhkhach)
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
                            <td class="value_hoten">{{ $tin_dichvu->hoten }}</td>
                        </tr>

                        <tr>
                            <td><strong>SĐT: </strong></td>
                            <td class="value_sdt">{{ $tin_dichvu->SDT }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td width="500" align="center">
                    <div class="row">
                       <font color="blue" style="font-weight: bold" size="4">{{$tin_dichvu->tieude}}</font>
                    </div>
                    <div class="row">
                        <div class="col-sm-12" style="height: 30px; width: 500px;white-space: nowrap; word-break: break-word; overflow: hidden; text-overflow: ellipsis">
                            {{$tin_dichvu->noidung}}
                        </div>
                    </div>
                    <br>
                    <a href="/tindangs/{{ $tin_dichvu->id }}" class="chitiet_dixe border_radius">>Xem thông tin chi tiết ...</a>
                </td>
                <td width="253">
                    @include('partials.option_tindang', ['tindang' => $tin_dichvu])
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-sm-4">Ngày đăng:</div>
                        <div class="col-sm-7">{{ date_format(date_create($tin_dichvu->ngaydang), 'H:i:s - m/d/Y')}}</div>
                    </div>
                </td>
            </tr>
        </table>
    @endforeach
@endif