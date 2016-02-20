@extends('admin.layouts.app')

@section('content')
    <h1 class="text-center">Quản lý tài khoản</h1>
    <hr>
    <button class="btn btn-primary button-chontatca" style="margin-left: 10%">Chọn tất cả</button>
    <button class="btn btn-danger button-xoachon" >Xóa ô chọn</button>
    <button class="btn btn-primary button-huychon">Huỷ chọn</button>
    <hr>

    <div class="row" style="margin-left: 15.5%">
        <div class="col-sm-2"><b>STT</b></div>
        <div class="col-sm-3">
            <b>Email</b>
        </div>
        <div class="col-sm-3">
            <b>Số dư tài khoản</b>
        </div>
        <div class="col-sm-4">
            <b>Thao tác</b>
        </div>
    </div>

    <hr>
    <div id="anchor-list">
    </div>
    @foreach($taikhoans as $item => $value)
        <div class="row col-sm-offset-1 row{{ $value['id'] }}" id-data="{{ $value['id'] }}">
            <input type="checkbox"  class="col-sm-1 checkbox" name="check_tp">
            <div class="col-sm-1">{{ $item + 1}}</div>
            <div class="col-sm-4 tenTP{{ $value['id'] }}">
                {{ $value['email'] }}
            </div>
            <div class="col-sm-2 sodu{{ $value['id'] }}">
                {{ $value['soduTK'] }}đ
            </div>
            <div class="col-sm-3">
                <button class="btn btn-primary button-cong" name-cong="{{ $value['email'] }}"  id-cong="{{ $value['id'] }}">Cộng tiền</button>
                @if($value['status'])
                <button class="btn btn-primary button-khoa" name-khoa="{{ $value['email'] }}"  id-khoa="{{ $value['id'] }}">Khóa</button>
                @else
                <button class="btn btn-primary button-mokhoa" name-mokhoa="{{ $value['email'] }}"  id-mokhoa="{{ $value['id'] }}">Mở khóa</button>
                @endif
                <button class="btn btn-danger button-xoa" name-xoa="{{ $value['email'] }}" id-xoa="{{ $value['id'] }}">Xóa</button>
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

        $(document).on('click', '.button-mokhoa', function(){
            $this = $(this);
            id_khoa = $(this).attr("id-mokhoa");
            name = $(this).attr("name-mokhoa");
            swal({   title: "Bạn có thực sự muốn mở khóa tài khoản <br/><font color='red'>" + name + "</font> ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function(){
                        $.get('/taikhoans/mokhoa',
                                {id: id_khoa},
                                function(data){
                                    $this.replaceWith('<button class="btn btn-primary button-khoa" name-khoa="'+ name +'"  id-khoa="'+ id_khoa +'">Khóa</button>');
                                    swal( name, "Khóa thành công "+ name , "success");
                                }
                        )
                    });
        })

        $(document).on('click', '.button-khoa', function(){
            $this = $(this);
            id_khoa = $(this).attr("id-khoa");
            name = $(this).attr("name-khoa");
            swal({   title: "Bạn có thực sự muốn khóa tài khoản <br/><font color='red'>" + name + "</font> ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function(){
                        $.get('/taikhoans/khoa',
                                {id: id_khoa},
                                function(data){
                                    $this.replaceWith('<button class="btn btn-primary button-mokhoa" name-mokhoa="'+ name +'"  id-mokhoa="'+ id_khoa +'">Mở khóa</button>');
                                    swal( name, "Khóa thành công "+ name , "success");
                                }
                        )
                    });
        })

        $('.button-cong').on('click', function () {
            taikhoan_id = $(this).attr('id-cong');
            taikhoan = $(this).attr('name-cong');
            swal({
                        title: "Tài khoản: <font color='red'>" + taikhoan + "</font>",
                        text: "Nhập số tiền cộng thêm:",
                        type: "input",
                        showCancelButton: true,
                        closeOnConfirm: false,
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        animation: "slide-from-top",
                        inputPlaceholder: "Nhập số tiền",
                        html: true,
                        showLoaderOnConfirm: true,
                    },
                    function (inputValue) {
                        if (inputValue === false) return false;
                        var intRegex = /[0-9 -()+]+$/;
                        if(inputValue.match(intRegex) == null)
                        {
                            sweetAlert("Thông báo", "Bạn phải nhập đúng định dạng số!", "error");
                            return false;
                        }
                        setTimeout(function () {
                            $.get('/taikhoans/congtien',
                                    {
                                        id : taikhoan_id,
                                        amount: inputValue,
                                    },
                                    function (data) {
                                        if(data != null && data != ""){
                                            sweetAlert("Thành công", "Bạn đã cộng tiền thành công!", "success");
                                            $('.sodu'+ taikhoan_id).text(data + 'đ');
                                        }
                                    });
                        }, 1000);

                    })
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

        $(document).on('click','.button-xoachon', function(){
            checkbox =  $('.checkbox');
            var array = [];
            j=0;
            for(i = 0; i < checkbox.length; i++){
                if(checkbox[i].checked){
                    temp = $(checkbox[i].closest('div .row')).attr("id-data");
                    array[j++] = temp;
                }
            }

            swal({   title: "Bạn có thực sự muốn xóa chọn ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                    },
                    function(){
                        if(array.length == 0){
                            sweetAlert("Có lỗi", "Bạn phải tích vào 1 hoặc nhiều ô để xóa chọn", "error");
                        } else
                            $.get('/delete_chosen/user',
                                    {id_xoachon: array, xoachon: true},
                                    function(data){
                                        if(data == 'delete-successfully'){
                                            for(i = 0; i < checkbox.length; i++){
                                                if(checkbox[i].checked){
                                                    temp = $(checkbox[i].closest('div .row')).attr("id-data");
                                                    $(checkbox[i].closest('div .row')).hide();
                                                    $('.row'+temp).hide();
                                                }
                                            }
                                            swal( "Thông báo", "Xóa thành công ", "success");
                                            return;
                                        }

                                        swal( "Thông báo", "Tồn tại tài khoản không thể xóa", "error");
                                    }
                            )
                    });
        });


        // delegate for append data
        // dynamic data
        $(document).on('click', '.button-xoa', function(){
            id = $(this).attr("id-xoa");
            name = $(this).attr("name-xoa");
            swal({   title: "Bạn có thực sự muốn xóa  <br/><font color='red'>" + name + "</font> ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false,
                        html: true
                    },
                    function(){
                        $.get('/delete/user',
                                {id_xoa: id, xoa: true},
                                function(data){
                                    if(data == 'delete-successfully'){
                                        $(".row"+id).hide();
                                        swal( name, "Xóa thành công "+ name , "success");
                                        return ;
                                    }
                                    swal( "Xóa thất bại", "Tài khoản này đã có thao tác với hệ thống", "error");
                                }
                        )
                    });
        })


    </script>
@stop
