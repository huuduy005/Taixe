<div style="margin-top: 3px"></div>
@if(isset($tindang_hanhkhaches))
    @foreach($tindang_hanhkhaches as $hanhkhach)
        <table class="list_trangchu  table table-responsive table{{$hanhkhach->id}}">
            <tr>
                <td width="350">
                    <table  class="table-responsive">
                        <tr>
                            <td colspan="2">
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td rowspan="4" width="100">
                                <div class="img_avatar">
                                    <img src="images/passager.jpg" width="60" height="60" class="img-responsive img-rounded img1 ">
                                </div>
                            </td>
                            <td width="80"><strong>Họ tên: </strong></td>
                            <td class="value_hoten">{!! link_to_action('TindangusersController@byUser', $hanhkhach->hoten, $hanhkhach->user_id) !!}</td>
                        </tr>

                        <tr>
                            <td><strong>SĐT: </strong></td>
                            <td class="value_sdt">{{ $hanhkhach->SDT }}</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </td>
                <td align="center">
                    <p class="value_lotrinh text-center">{{ $hanhkhach->noidi }} - {{ $hanhkhach->thanhphonoidi }} <font color="red" size="5">→</font> {{ $hanhkhach->noiden }} - {{ $hanhkhach->thanhphonoiden }}</p>
                    <p class="value_giokhoihanh">
                        <font color="blue">{{ $hanhkhach->giokhoihanh }}  {{ $hanhkhach->ngaykhoihanh }}</font>
                    </p>
                    <a href="/tindangs/{{ $hanhkhach->id }}" class="chitiet_dixe border_radius">>Xem thông tin chi tiết ...</a>
                </td>
                <td width="250">
                    @include('partials.option_tindang', ['tindang' => $hanhkhach])
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <div class="row">
                        <div class="col-sm-12 tindang_ngaydang text-right">Ngày đăng: {{ date_format(date_create($hanhkhach->ngaydang), 'H:i:s - m/d/Y')}}</div>
                    </div>
                </td>
            </tr>
        </table>
    @endforeach
@endif
