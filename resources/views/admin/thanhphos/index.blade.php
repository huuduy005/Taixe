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
            Tỉnh, Thành phố
        </h1>

    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        @include('flash')
        <div class="box box-primary">
            <div class="box-body">
                <form action="/admin/thanhphos{{ isset($thanhpho) ? '/'.$thanhpho->id : '' }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <label class="col-sm-2 form-control-static">Tên tỉnh thành: </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Nhập tên thành phố..." name="txt_tenTP"
                                   value="{{ isset($thanhpho) ? $thanhpho->tenTP : '' }}" required>
                        </div>
                    </div>
                    <div class="row pull-right" style="padding:5px 15px 0 0">
                        @if(isset($thanhpho))
                            {{ Form::button('<span class="glyphicon glyphicon-ok-circle"></span> Sửa', array('class'=>'btn btn-primary btn_dangtin', 'type'=>'submit')) }}
                            <a href="/admin/thanhphos" type="button" class="btn btn-warning btn_dangtin">
                                <i class="glyphicon glyphicon-ban-circle"></i>
                                <span>Hủy</span>
                            </a>
                            <input name="_method" type="hidden" value="PATCH">
                        @else
                            {{ Form::button('<span class="glyphicon glyphicon-ok-circle"></span> Thêm mới', array('class'=>'btn btn-primary btn_dangtin', 'type'=>'submit')) }}
                            {{ Form::button('<span class="glyphicon glyphicon-remove-circle"></span> Nhập lại', array('class'=>'btn btn-warning btn_dangtin', 'type'=>'reset')) }}
                        @endif
                    </div>
                </form>
            </div><!-- /.box-body -->
        </div><!-- /.box -->

        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <div class="col-sm-10" style="margin-bottom: 5px;">
                        <input type="text" class="form-control txt_keyword" name="txt_keyword"
                               value="{{ session('search_val') ? session::pull('search_val') : '' }}"
                               placeholder="Nhập tên thành phố ... [không điền giá trị = tìm kiếm tất cả]">
                    </div>
                    <div class="col-sm-2" style="margin-bottom: 5px;">
                        <a href="#"
                           class="btn btn-primary btn_search"><span class="fa fa-search"></span> Tìm kiếm
                        </a>
                    </div>
                </div>

                @if(isset($thanhphos))
                    <table class="table table-hover table-bordered">
                        <tr class="info">
                            <th class="text-right col-sm-6">Tên thành phố</th>
                            <th style="padding-left: 5%"  class="col-sm-6">Thao tác</th>
                        </tr>
                        @foreach($thanhphos as $thanhpho)
                            <tr>
                                <td class="text-right">{{ $thanhpho->tenTP }}</td>
                                <td class="text-left"><a href="/admin/thanhphos/{{$thanhpho->id}}/sua"
                                                         class="btn btn-primary btn-sm btn_edit"><span
                                                class="glyphicon glyphicon-pencil"></span> Sửa</a>
                                    <a href="#"
                                       class="btn btn-sm btn-danger btn_delete" id_xoa="{{ $thanhpho->id }}"><span
                                                class="glyphicon glyphicon-trash"></span> Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @endif


            </div><!-- /.box-body -->
            {{-- use for paging position --}}
            <div class="text-center">
                {{ $thanhphos->appends(Request::only('keyword'))->render() }}
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
                            window.location.replace("/admin/thanhphos/xoa/" + id);
                        }
                    });
        });


        // put keyword to url to search
        $('.btn_search').click(function () {
            keyword = $('.txt_keyword').val();
            window.location.replace("/admin/thanhphos?keyword=" + keyword);
        })
    </script>
@endsection






