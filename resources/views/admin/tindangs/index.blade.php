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
            Tin đăng
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
                               placeholder="Nhập tiêu đề tin đăng hoặc tên người đăng ... [không điền giá trị = tìm kiếm tất cả]">
                    </div>
                    <div class="col-sm-2" style="margin-bottom: 5px;">
                        <a href="#"
                           class="btn btn-primary btn_search"><span class="fa fa-search"></span> Tìm kiếm
                        </a>
                    </div>
                </div>

                @if(isset($tindangs))
                    <table class="table table-hover table-bordered text-center">
                        <tr class="info">
                            <th class="text-right col-sm-5">Tiêu đề</th>
                            <th class="text-right col-sm-2">Ngày đăng</th>
                            <th class="text-right col-sm-2">Người đăng</th>
                            <th style="padding-left: 5%" class="col-sm-3">Thao tác</th>
                        </tr>
                        @foreach($tindangs as $tindang)
                            <tr>
                                <td>{{ $tindang->tieude }}</td>
                                <td>{{ $tindang->ngaydang }}</td>
                                <td>{{ $tindang->user->hoten }}</td>
                                <td>
                                    @if($tindang['status'])
                                        <button id_tindang="{{ $tindang['id'] }}"
                                                class="btn btn-info btn-sm btn_an btn_an{{ $tindang['id'] }}"><span
                                            <span class="fa fa-times-circle"></span> Ẩn
                                        </button>

                                        <button id_tindang="{{ $tindang['id'] }}" disabled
                                                class="btn btn-info btn-sm btn_hien btn_hien{{ $tindang['id'] }}"><span
                                            <span class="fa fa-times-circle"></span> Hiện
                                        </button>
                                    @else
                                        <button id_tindang="{{ $tindang['id'] }}" disabled
                                                class="btn btn-info btn-sm btn_an btn_an{{ $tindang['id'] }}"><span
                                            <span class="fa fa-times-circle"></span> Ẩn
                                        </button>

                                        <button id_tindang="{{ $tindang['id'] }}"
                                                class="btn btn-info btn-sm btn_hien btn_hien{{ $tindang['id'] }}"><span
                                            <span class="fa fa-times-circle"></span> Hiện
                                        </button>
                                    @endif

                                    <a href="#"
                                       class="btn btn-sm btn-danger btn_delete" id_xoa="{{ $tindang->id }}"><span
                                                class="glyphicon glyphicon-trash"></span> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif


            </div><!-- /.box-body -->
            {{-- use for paging position --}}
            <div class="text-center">
                {{ $tindangs->appends(Request::only('keyword'))->render() }}
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
                            window.location.replace("/admin/tindangs/xoa/" + id);
                        }
                    });
        });


        // put keyword to url to search
        $('.btn_search').click(function () {
            keyword = $('.txt_keyword').val();
            window.location.replace("/admin/tindangs?keyword=" + keyword);
        })


        // Ẩn tin đăng
        $('.btn_an').click(function () {
            id = $(this).attr("id_tindang");

            $(this).attr("disabled", true);
            $(".btn_hien" + id).attr("disabled", false);

            $.get('/tindangs_admin/an',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })

        // Hiện tin đăng
        $('.btn_hien').click(function () {
            id = $(this).attr("id_tindang");

            $(this).attr("disabled", true);
            $(".btn_an" + id).attr("disabled", false);

            $.get('/tindangs_admin/hien',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })

    </script>
@endsection






