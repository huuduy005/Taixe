@extends('admin.layouts.app')

@section('content')
    @include('admin.partials.option_template', ['title' => 'Quản lý loại xe'])
    <div class="row admin-div-tinhthanh">
        <hr>
        <div class="col-sm-1"></div>
        <div class="form-group col-sm-7">
            {!! Form::label('loaixe', 'Tên loại xe:', ['class' => 'col-sm-3']) !!}
            <div class="col-sm-9">
                {!! Form::text('loaixe', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group text-center col-sm-2">
            {!! Form::button('Thêm', ['class' => 'btn btn-primary button-form']) !!}
        </div>
    </div>

    @include('admin.partials.search_template', ['name' => 'Tên loại xe:'])

    <div class="row" style="margin-left:23%">
        <div class="col-sm-1"><b>STT</b></div>
        <div class="col-sm-5">
            <b>Tên loại xe</b>
        </div>
        <div class="col-sm-5">
            <b>Thao tác</b>
        </div>
    </div>

    <hr>
    <div id="anchor-list">
    </div>
    <div class="list-data">
        @foreach($loaixes as $item => $value)
            <div class="row col-sm-offset-2 row{{ $value['id'] }}" id-data="{{ $value['id'] }}">
                <input type="checkbox" class="col-sm-1 checkbox" name="check_tp">
                <div class="col-sm-1">{{ $item + 1}}</div>
                <div class="col-sm-4 tenTP{{ $value['id'] }}">
                    {{ $value['tenLX'] }}
                </div>
                <div class="col-sm-5">
                    <button class="btn btn-primary button-luu" name-luu="{{ $value['tenLX'] }}"
                            id-luu="{{ $value['id'] }}">Lưu
                    </button>
                    <button class="btn btn-secondary button-huy" name-huy="{{ $value['tenLX'] }}"
                            id-huy="{{ $value['id'] }}">Hủy
                    </button>
                    <button class="btn btn-primary button-sua" name-sua="{{ $value['tenLX'] }}"
                            id-sua="{{ $value['id'] }}">Sửa
                    </button>
                    <button class="btn btn-danger button-xoa" name-xoa="{{ $value['tenLX'] }}"
                            id-xoa="{{ $value['id'] }}">Xóa
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
            $.get('/find/loaixe',
                    {tenTP: $('#thanhpho_search').val(), timkiem: true},
                    function (data) {
                        if (data[0] == "null-data") {
                            sweetAlert("Thông báo", "Không tìm thấy đữ liệu", "info");
                        }
                        $('.list-data').hide();
                        $('#anchor-list').html("");

                        $.each(data[1], function (item, value) {
                            item1 = item + 1;
                            $("#anchor-list").append("<div class='row col-sm-offset-2 row" + value['id'] + "' id-data=" + value['id'] + ">" +
                                    "<input type='checkbox'  class='col-sm-1 checkbox' name=check_tp >" +
                                    "<div class='col-sm-1'>" + item1 + "</div>" +
                                    "<div class='col-sm-4 tenTP" + value['id'] + "' >" + value['tenLX'] +
                                    "</div>" +
                                    "<div class='col-sm-5'>" +
                                    "<button class='btn btn-primary button-luu' name-luu='" + value['tenLX'] + "' id-luu='" + value['id'] + "' >Lưu</button>" +
                                    "<button class='btn btn-secondary button-huy' name-huy='" + value['tenLX'] + "' id-huy='" + value['id'] + "' >Hủy</button>" +
                                    "<button class='btn btn-primary button-sua' style='margin-right: 4px;' name-sua='" + value['tenLX'] + "' id-sua=" + value['id'] + ">Sửa</button>" +
                                    "<button class='btn btn-danger button-xoa' name-xoa='" + value['tenLX'] + "' id-xoa=" + value['id'] + ">Xóa</button>" +
                                    "</div>" +
                                    "</div>" +
                                    "<hr class=row" + value['id'] + ">");
                        });
                    }
            )
        })

        $(".button-form").click(function () {
            if ($('#loaixe').val() == "") {
                sweetAlert("Có lỗi", "Bạn phải nhập dữ liệu vào ô tên loại xe", "error");
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
                            $.get('/insert/loaixe',
                                    {tenTP: $('#loaixe').val(), themmoi: true},
                                    function (data) {
                                        if (data[0] == 'insert-successfully') {
                                            $("#anchor-list").append("<div class='row col-sm-offset-2 row" + data[1]['id'] + "' id-data=" + data[1]['id'] + ">" +
                                                    "<input type='checkbox'  class='col-sm-1 checkbox' name=check_tp >" +
                                                    "<div class='col-sm-1'>" + data[2] + "</div>" +
                                                    "<div class='col-sm-4 tenTP" + data[1]['id'] + "' >" + data[1]['tenLX'] +
                                                    "</div>" +
                                                    "<div class='col-sm-5'>" +
                                                    "<button class='btn btn-primary button-luu' name-luu='" + data[1]['tenLX'] + "' id-luu='" + data[1]['id'] + "' >Lưu</button>" +
                                                    "<button class='btn btn-secondary button-huy' name-huy='" + data[1]['tenLX'] + "' id-huy='" + data[1]['id'] + "' >Hủy</button>" +
                                                    "<button class='btn btn-primary button-sua' style='margin-right: 4px;' name-sua='" + data[1]['tenLX'] + "' id-sua=" + data[1]['id'] + ">Sửa</button>" +
                                                    "<button class='btn btn-danger button-xoa' name-xoa='" + data[1]['tenLX'] + "' id-xoa=" + data[1]['id'] + ">Xóa</button>" +
                                                    "</div>" +
                                                    "</div>" +
                                                    "<hr class=row" + data[1]['id'] + ">");

                                            swal($('#loaixe').val(), "Thêm mới thành công " + $('#loaixe').val(), "success");
                                        }
                                    }
                            )
                        });
        })
    </script>

    @include('admin.partials.template',['model' => 'loaixe'])
@stop
