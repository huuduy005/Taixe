@extends('admin.layouts.app')

@section('content')

    @include('admin.partials.option_template', ['title' => 'QUẢN LÝ LOẠI TIN'])

    <div class="row admin-div-tinhthanh">
        <hr>
        <div class="col-sm-1"></div>
        <div class="form-group col-sm-9">
            {!! Form::label('loaitin', 'Tên loại tin:', ['class' => 'col-sm-2']) !!}
            <div class="col-sm-4">
                {!! Form::text('loaitin', null, ['class' => 'form-control']) !!}
            </div>
            {!! Form::label('giatien', 'Giá tiền:', ['class' => 'col-sm-2']) !!}
            <div class="col-sm-4">
                {!! Form::text('giatien', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group text-center col-sm-2">
            {!! Form::button('Thêm', ['class' => 'btn btn-primary button-form']) !!}
        </div>
    </div>

    @include('admin.partials.search_template', ['name' => 'Tên loại tin:'])

    <div class="row col-sm-offset-2">
        <div class="col-sm-1"><b>STT</b></div>
        <div class="col-sm-4">
            <b>Tên loại tin</b>
        </div>
        <div class="col-sm-2">
            <b>Giá</b>
        </div>
        <div class="col-sm-5">
            <b>Thao tác</b>
        </div>
    </div>
    <hr>
    <div id="anchor-list">
    </div>
    <div class="list-data">
        @foreach($loaitins as $item => $value)
            <div class="row title-margin row{{ $value['id'] }}" id-data="{{ $value['id'] }}">
                <input type="checkbox" class="col-sm-1 checkbox" name="check_tp">
                <div class="col-sm-1">{{ $item + 1}}</div>
                <div class="col-sm-3 tenTP{{ $value['id'] }}">
                    {{ $value['tenLT'] }}
                </div>
                <div class="col-sm-2 text-center giatien{{ $value['id'] }}">
                    {{ $value['giatien'] }}
                </div>
                <div class="col-sm-5">
                    <button class="btn btn-primary button-luu" tien-luu="{{ $value['giatien'] }}"
                            name-luu="{{ $value['tenLT'] }}" id-luu="{{ $value['id'] }}">Lưu
                    </button>
                    <button class="btn btn-secondary button-huy" tien-huy="{{ $value['giatien'] }}"
                            name-huy="{{ $value['tenLT'] }}" id-huy="{{ $value['id'] }}">Hủy
                    </button>
                    <button class="btn btn-primary button-sua" tien-sua="{{ $value['giatien'] }}"
                            name-sua="{{ $value['tenLT'] }}" id-sua="{{ $value['id'] }}">Sửa
                    </button>
                    <button class="btn btn-danger button-xoa" tien-xoa="{{ $value['giatien'] }}"
                            name-xoa="{{ $value['tenLT'] }}" id-xoa="{{ $value['id'] }}">Xóa
                    </button>
                </div>
            </div>
            <hr class="row{{ $value['id'] }}">
        @endforeach
    </div>
    <button class="btn btn-danger button-xoachon" style="margin-left: 18%">Xóa chọn</button>
    <button class="btn btn-primary button-huychon">Huỷ chọn</button>

    <script>
        $(document).on('click', ".button-form-search", function () {
            $.get('/find/loaitin',
                    {tenTP: $('#thanhpho_search').val(), timkiem: true},
                    function (data) {
                        if (data[0] == "null-data") {
                            sweetAlert("Thông báo", "Không tìm thấy đữ liệu", "info");
                        }
                        console.log(data[1]);
                        $('.list-data').hide();
                        $('#anchor-list').html("");

                        $.each(data[1], function (item, value) {
                            item1 = item + 1;
                            $("#anchor-list").append("<div class='row title-margin row" + value['id'] + "' id-data=" + value['id'] + ">" +
                                    "<input type='checkbox'  class='col-sm-1 checkbox' name=check_tp >" +
                                    "<div class='col-sm-1'>" + item1 + "</div>" +
                                    "<div class='col-sm-3 tenTP" + value['id'] + "' >" + value['tenLT'] +
                                    "</div>" +
                                    " <div class='col-sm-2 text-center giatien" + value['id'] + "'>" + value['giatien'] +
                                    "</div>" +
                                    "<div class='col-sm-5'>" +
                                    "<button class='btn btn-primary button-luu' style='margin-right: 4px;' tien-luu='" + value['giatien'] + "' name-luu='" + value['tenLT'] + "' id-luu='" + value['id'] + "' >Lưu</button>" +
                                    "<button class='btn btn-secondary button-huy' tien-huy='" + value['giatien'] + "' name-huy='" + value['tenLT'] + "' id-huy='" + value['id'] + "' >Hủy</button>" +
                                    "<button class='btn btn-primary button-sua' tien-sua='" + value['giatien'] + "' style='margin-right: 4px;' name-sua='" + value['tenLT'] + "' id-sua=" + value['id'] + ">Sửa</button>" +
                                    "<button class='btn btn-danger button-xoa' tien-xoa='" + value['giatien'] + "' name-xoa='" + value['tenLT'] + "' id-xoa=" + value['id'] + ">Xóa</button>" +
                                    "</div>" +
                                    "</div>" +
                                    "<hr class=row" + value['id'] + ">");
                        });
                    }
            )
        })


        $(".button-form").click(function () {
            if ($('#loaitin').val() == "") {
                sweetAlert("Có lỗi", "Bạn phải nhập dữ liệu vào ô tên loại tin", "error");
            } else
                swal({
                            title: "Bạn có thực sự muốn thêm   ?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#337ab7",
                            confirmButtonText: "Đồng ý",
                            cancelButtonText: "Hủy",
                            closeOnConfirm: false
                        },
                        function () {
                            $.get('/insert/loaitin',
                                    {tenLT: $('#loaitin').val(), giatien: $('#giatien').val(), themmoi: true},
                                    function (data) {
                                        if (data[0] == 'insert-successfully') {
                                            $("#anchor-list").append("<div class='row title-margin row" + data[1]['id'] + "' id-data=" + data[1]['id'] + ">" +
                                                    "<input type='checkbox'  class='col-sm-1 checkbox' name=check_tp >" +
                                                    "<div class='col-sm-1'>" + data[2] + "</div>" +
                                                    "<div class='col-sm-3 tenTP" + data[1]['id'] + "' >" + data[1]['tenLT'] +
                                                    "</div>" +
                                                    " <div class='col-sm-2 text-center giatien" + data[1]['id'] + "'>" + data[1]['giatien'] +
                                                    "</div>" +
                                                    "<div class='col-sm-5'>" +
                                                    "<button class='btn btn-primary button-luu' style='margin-right: 4px;' tien-luu='" + data[1]['giatien'] + "' name-luu='" + data[1]['LT'] + "' id-luu='" + data[1]['id'] + "' >Lưu</button>" +
                                                    "<button class='btn btn-secondary button-huy' tien-huy='" + data[1]['giatien'] + "' name-huy='" + data[1]['tenLT'] + "' id-huy='" + data[1]['id'] + "' >Hủy</button>" +
                                                    "<button class='btn btn-primary button-sua' style='margin-right: 4px;' tien-sua='" + data[1]['giatien '] + "' name-sua='" + data[1]['tenLT'] + "' id-sua=" + data[1]['id'] + ">Sửa</button>" +
                                                    "<button class='btn btn-danger button-xoa' tien-xoa='" + data[1]['giatien'] + "' name-xoa='" + data[1]['tenLT'] + "' id-xoa=" + data[1]['id'] + ">Xóa</button>" +
                                                    "</div>" +
                                                    "</div>" +
                                                    "<hr class=row" + data[1]['id'] + ">");

                                            swal($('#loaitin').val(), "Thêm mới thành công " + $('#loaitin').val(), "success");
                                        }
                                    }
                            )
                        });
        })
    </script>
    @include('admin.partials.template', ['model' => 'loaitin'])
@stop
