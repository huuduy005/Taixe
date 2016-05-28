@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/all.css') }}">
    @endsection

    @section('content')
            <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tin tức
            <div class="pull-right">
                <a href="/admin/tintucs/themmoi" class="btn btn-sm  btn-primary iframe cboxElement"><span
                            class="glyphicon glyphicon-plus-sign"></span> Thêm mới</a>
            </div>
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('flash')
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-10" style="margin-bottom: 5px;">
                        <input type="text" class="form-control txt_keyword" name="txt_keyword"
                               value="{{ session('search_val') ? session::pull('search_val') : '' }}"
                               placeholder="Nhập tiêu đề tin tức ... [không điền giá trị = tìm kiếm tất cả]">
                    </div>
                    <div class="col-sm-2" style="margin-bottom: 5px;">
                        <a href="#"
                           class="btn btn-primary btn_search"><span class="fa fa-search"></span> Tìm kiếm
                        </a>
                    </div>
                </div>
                @if(isset($tintucs))
                    <table class="table table-hover table-bordered">
                        <tr class="info">
                            <th class="col-sm-6 text-center">Tiêu đề</th>
                            <th class="text-center">Ngày cập nhật</th>
                            <th class="text-center">Tin hot</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                        @foreach($tintucs as $tintuc)
                            <tr>
                                <td>{{ $tintuc->tieude }}</td>
                                <td class="text-center">{{ $tintuc->created_at }}</td>
                                <td class="text-center"><input class="minimal chbx_tinhot" id_tintuc="{{ $tintuc['id'] }}" id="chbx_tinhot"
                                                               type="checkbox" {{ $tintuc->hot ? 'checked' : '' }}></td>
                                <td class="text-center"><a href="/admin/tintucs/{{$tintuc->id}}/sua"
                                                           class="btn btn-primary btn-sm btn_edit"><span
                                                class="glyphicon glyphicon-pencil"></span> Sửa</a>
                                    @if($tintuc['status'])
                                        <button id_tintuc="{{ $tintuc['id'] }}"
                                                class="btn btn-info btn-sm btn_an btn_an{{ $tintuc['id'] }}">
                                            <span class="fa fa-times-circle"></span> Ẩn
                                        </button>

                                        <button id_tintuc="{{ $tintuc['id'] }}" disabled
                                                class="btn btn-info btn-sm btn_hien btn_hien{{ $tintuc['id'] }}">
                                            <span class="fa fa-times-circle"></span> Hiện
                                        </button>
                                    @else
                                        <button id_tintuc="{{ $tintuc['id'] }}" disabled
                                                class="btn btn-info btn-sm btn_an btn_an{{ $tintuc['id'] }}">
                                            <span class="fa fa-times-circle"></span> Ẩn
                                        </button>

                                        <button id_tintuc="{{ $tintuc['id'] }}"
                                                class="btn btn-info btn-sm btn_hien btn_hien{{ $tintuc['id'] }}">
                                            <span class="fa fa-times-circle"></span> Hiện
                                        </button>
                                    @endif


                                    <a href="#"
                                       class="btn btn-sm btn-danger btn_delete" id_xoa="{{ $tintuc->id }}"><span
                                                class="glyphicon glyphicon-trash"></span> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif


            </div><!-- /.box-body -->
            {{-- use for paging position --}}
            <div class="text-center">
                {{ $tintucs->render() }}
            </div><!-- /.box-footer-->
        </div><!-- /.box -->
    </section><!-- /.content -->

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $( document ).ready(function() {
        // Make icheck for checkbox Tin hot
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });

        {{-- Ajax Check tin hot true or false --}}
        $('.chbx_tinhot').on('ifChanged', function (event) {


            id = $(this).attr("id_tintuc");
            val = $(this).prop('checked');
            $.get('/tintucs_admin/hot',
                    {id: id, value: val},
                    function (data) {
                    }
            )
        });


        // Xóa tin tức js
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
                            window.location.replace("/admin/tintucs/xoa/" + id);
                        }
                    });
        });

        // put keyword to url to search
        $('.btn_search').click(function () {
            keyword = $('.txt_keyword').val();
            window.location.replace("/admin/tintucs?keyword=" + keyword);
        })

        // Ẩn tin tức
        $('.btn_an').click(function () {
            id = $(this).attr("id_tintuc");

            $(this).attr("disabled", true);
            $(".btn_hien" + id).attr("disabled", false);

            $.get('/tintucs_admin/an',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })

        // Hiện tin tức
        $('.btn_hien').click(function () {
            id = $(this).attr("id_tintuc");

            $(this).attr("disabled", true);
            $(".btn_an" + id).attr("disabled", false);

            $.get('/tintucs_admin/hien',
                    {id: id},
                    function (data) {
                        console.log(data);
                    }
            )
        })
        });
    </script>
@endsection






