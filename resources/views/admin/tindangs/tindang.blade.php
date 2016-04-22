@extends('admin.layouts.app')

@section('content')
    <h2 class="text-center">QUẢN LÝ TIN ĐĂNG</h2>
    <hr>
    <button class="btn btn-primary button-chontatca" style="margin-left: 10%">Chọn tất cả</button>
    <button class="btn btn-danger button-xoachon" >Xóa ô chọn</button>
    <button class="btn btn-primary button-huychon">Huỷ chọn</button>
    <hr>

    <div class="row" style="margin-left: 15.5%">
        <div class="col-sm-2"><b>Tiêu đề</b></div>
        <div class="col-sm-3">
            <b style="padding-left: 20%">Ngày đăng</b>
        </div>
        <div class="col-sm-3">
            <b>Họ tên người đăng tin</b>
        </div>
        <div class="col-sm-4">
            <b>Thao tác</b>
        </div>
    </div>

    <hr>
    <div id="anchor-list">
    </div>
    @foreach($tindangs as $value)
        <div class="row col-sm-offset-1 row{{ $value['id'] }}" id-data="{{ $value['id'] }}">
            <input type="checkbox"  class="col-sm-1 checkbox" name="check_tp">
            <div class="col-sm-2">{{ $value['tieude']}}</div>
            <div class="col-sm-3 tenTP{{ $value['id'] }}">
                {{ $value['ngaydang'] }}
            </div>
            <div class="col-sm-2 sodu{{ $value['id'] }}">
                {{ $value->user['hoten'] }}
            </div>
            <div class="col-sm-3">
                @if($value['status'])
                <button class="btn btn-primary button-an" name-an="{{ $value['tieude'] }}"  id-an="{{ $value['id'] }}">Ẩn</button>
                @else
                <button class="btn btn-primary button-hien" name-hien="{{ $value['tieude'] }}"  id-hien="{{ $value['id'] }}">Hiện</button>
                @endif
                <button class="btn btn-danger button-xoa" name-xoa="{{ $value['tieude'] }}" id-xoa="{{ $value['id'] }}">Xóa</button>
            </div>
        </div>
        <hr class="row{{ $value['id'] }}">
    @endforeach
    <button class="btn btn-danger button-xoachon" style="margin-left: 18%">Xóa chọn</button>
    <button class="btn btn-primary button-huychon">Huỷ chọn</button>
    <style>
        label{
            font-size: 15px;
            font-weight: bold;
        }

        .button-luu, .button-xoachon, .button-huychon{
            display: none;
        }


    </style>

    <script>

        $(document).on('click', '.button-an', function(){
            $this = $(this);
            id_khoa = $(this).attr("id-an");
            name = $(this).attr("name-an");
            swal({   title: "Ẩn tin đăng có tiêu đề <br/><font color='red'>" + name + "</font> ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function(){
                        $.get('/tindangs/an',
                                {id: id_khoa},
                                function(data){
                                    $this.replaceWith("<button class='btn btn-primary button-hien' name-hien='"+ name +"'  id-hien='" + id_khoa + "'>Hiện</button>");
                                    swal( name, "Ẩn thành công "+ name , "success");
                                }
                        )
                    });
        })

        $(document).on('click', '.button-hien', function(){
            $this = $(this);
            id_khoa = $(this).attr("id-hien");
            name = $(this).attr("name-hien");
            swal({   title: "Hiện tin đăng có tiêu đề <br/><font color='red'>" + name + "</font> ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function(){
                        $.get('/tindangs/hien',
                                {id: id_khoa},
                                function(data){
                                    $this.replaceWith("<button class='btn btn-primary button-an' name-an='"+ name +"'  id-an='" + id_khoa + "'>Ẩn</button>");
                                    swal( name, "Hiện thành công "+ name , "success");
                                }
                        )
                    });
        })

        $('.button-chontatca').click(function(){
            $('.button-xoachon').show();
            $('.button-huychon').show();
        });

        $(document).on('change','.checkbox',function(){
            $('.button-xoachon').show();
            $('.button-huychon').show();

        });

        $('.button-huychon').click(function(){
            checkbox =  $('.checkbox');
            for(i = 0; i < checkbox.length; i++){
                checkbox[i].checked = false;
            }
        });

        $('.button-chontatca').click(function(){
            checkbox =  $('.checkbox');

            for(i = 0; i < checkbox.length; i++){
                checkbox[i].checked = true;
            }
        });


        $(document).on('click', '.button-xoachon', function () {
            checkbox = $('.checkbox');
            var array = [];
            j = 0;
            for (i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    temp = $(checkbox[i].closest('div .row')).attr("id-data");
                    array[j++] = temp;
                }
            }

            swal({
                        title: "Bạn có thực sự muốn xóa  ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false
                    },
                    function () {
                        if (array.length == 0) {
                            sweetAlert("Có lỗi", "Bạn phải tích vào 1 hoặc nhiều ô để xóa chọn", "error");
                        } else
                            $.get('/delete_chosen/tindang',
                                    {id_xoachon: array},
                                    function (data) {
                                        if (data == 'delete-successfully') {
                                            for (i = 0; i < checkbox.length; i++) {
                                                if (checkbox[i].checked) {
                                                    temp = $(checkbox[i].closest('div .row')).attr("id-data");
                                                    $(checkbox[i].closest('div .row')).hide();
                                                    $('.row' + temp).hide();
                                                }
                                            }
                                            swal("Thông báo", "Xóa thành công ", "success");
                                        }
                                    }
                            )
                    });
        });


        $(document).on('click', '.button-xoa', function () {
            id = $(this).attr("id-xoa");
            name = $(this).attr("name-xoa");
            swal({
                        title: "Xóa tin đăng có tiêu đề <br/><font color='red'>" + name + "</font> ?" ,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function () {
                        $.get('/delete/tindang',
                                {id_xoa: id},
                                function (data) {
                                    if (data == 'delete-successfully') {
                                        $(".row" + id).hide();
                                        swal(name, "Xóa thành công" + name, "success");
                                    }
                                }
                        )
                    });
        })
    </script>
@stop
