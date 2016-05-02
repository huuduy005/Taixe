@extends('admin.layouts.app')

@section('css')
    <style>
        .box-body {
            padding-bottom: 5px;
        }
    </style>
    @endsection

    @section('content')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tài khoản
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('flash')
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-10" style="margin-bottom: 5px;">
                        <input type="text" class="form-control txt_keyword" name="txt_keyword"
                               value="{{ session('search_val') ? session::pull('search_val') : '' }}"
                               placeholder="Nhập email tài khoản ... [không điền giá trị = tìm kiếm tất cả]">
                    </div>
                    <div class="col-sm-2" style="margin-bottom: 5px;">
                        <a href="#"
                           class="btn btn-primary btn_search"><span class="fa fa-search"></span> Tìm kiếm
                        </a>
                    </div>
                </div>

                @if(isset($taikhoans))
                    <table class="table table-hover table-bordered text-center">
                        <tr class="info">
                            <th class="text-right col-sm-4">Email</th>
                            <th class="text-right col-sm-4">Số dư tài khoản</th>
                            <th style="padding-left: 5%" class="col-sm-4">Thao tác</th>
                        </tr>
                        @foreach($taikhoans as $taikhoan)
                            <tr>
                                <td>{{ $taikhoan->email }}</td>
                                <td class="sodu{{ $taikhoan['id'] }}">{{ $taikhoan->soduTK }}đ </td>
                                <td>
                                    <button  name-cong="{{ $taikhoan['email'] }}"  id-cong="{{ $taikhoan['id'] }}" class="btn btn-primary btn-sm btn_cong">
                                        <span class="fa fa-plus-square"></span> Cộng tiền
                                    </button>
                                    @if($taikhoan['status'])
                                        <button id_taikhoan="{{ $taikhoan['id'] }}"
                                                class="btn btn-info btn-sm btn_khoa btn_khoa{{ $taikhoan['id'] }}"><span
                                                    class="fa fa-lock"></span> Khóa
                                        </button>

                                        <button id_taikhoan="{{ $taikhoan['id'] }}" disabled
                                                class="btn btn-info btn-sm btn_mokhoa btn_mokhoa{{ $taikhoan['id'] }}">
                                            <span class="fa fa-unlock"></span>Mở khóa
                                        </button>
                                    @else
                                        <button disabled id_taikhoan="{{ $taikhoan['id'] }}"
                                                class="btn btn-info btn-sm btn_khoa  btn_khoa{{ $taikhoan['id'] }}">
                                            <span class="fa fa-lock"></span> Khóa
                                        </button>

                                        <button id_taikhoan="{{ $taikhoan['id'] }}"
                                                class="btn btn-info btn-sm btn_mokhoa btn_mokhoa{{ $taikhoan['id'] }}">
                                            <span class="fa fa-unlock"></span>Mở khóa
                                        </button>
                                    @endif
                                    <a href="#"
                                       class="btn btn-sm btn-danger btn_delete" id_xoa="{{ $taikhoan->id }}"><span
                                                class="glyphicon glyphicon-trash"></span> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif


            </div><!-- /.box-body -->
            {{-- use for paging position --}}
            <div class="text-center">
                {{ $taikhoans->appends(Request::only('keyword'))->render() }}
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

@endsection

@section('script')
    <script>


        $('.btn_delete').click(function (e) {
            id = $(this).attr("id_xoa");
            e.preventDefault();
            swal({
                        title: "Xác nhận xóa ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            window.location.replace("/admin/taikhoans/xoa/" + id);
                        }
                    });
        });


        // put keyword to url to search
        $('.btn_search').click(function () {
            keyword = $('.txt_keyword').val();
            window.location.replace("/admin/taikhoans?keyword=" + keyword);
        })

        // Ajax unlock account
        $('.btn_khoa').click(function () {
            id = $(this).attr("id_taikhoan");

            $(this).attr("disabled", true);

            $(".btn_mokhoa" + id).attr("disabled", false);

            $.get('/taikhoans/khoa',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })

        // Ajax lock account
        $('.btn_mokhoa').click(function () {
            id = $(this).attr("id_taikhoan");

            $(this).attr("disabled", true);

            $(".btn_khoa" + id).attr("disabled", false);


            $.get('/taikhoans/mokhoa',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })

        // Ajax cộng tiền vào tài khoản
        $('.btn_cong').on('click', function (e) {
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
                        var intRegex = /^-?\d*\.?\d*$/;
                        if (inputValue.match(intRegex) == null) {
                            sweetAlert("Thông báo", "Bạn phải nhập đúng định dạng số!", "error");
                            swal.disableLoading();
                        }else setTimeout(function () {
                            $.get('/taikhoans/congtien',
                                    {
                                        id: taikhoan_id,
                                        amount: inputValue,
                                    },
                                    function (data) {
                                        if (data != null && data != "") {
                                            sweetAlert("Thành công", "Bạn đã cộng tiền thành công!", "success");
                                            $('.sodu' + taikhoan_id).text(data + 'đ');
                                        }
                                    });
                        }, 1000);

                    })
        })

    </script>
@endsection






