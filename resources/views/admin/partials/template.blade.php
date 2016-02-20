<style>
    label {
        font-size: 15px;
        font-weight: bold;
    }

    .button-luu, .button-xoachon, .button-huychon, .button-huy {
        display: none;
    }

    .title-margin {
        margin-left: 10%;
    }
</style>

<script>

    $(document).on('click', '.button-huy', function () {
        id_huy = $(this).attr('id-huy');
        $(this).hide();
        $.get('/cancel_update/{{$model}}',
                {id: id_huy},
                function (data) {
                    @if($model == 'loaitin')
                        $('.tenTP' + id_huy).html(data[0]);
                        $('.giatien' + id_huy).html(data[1]);
                    @else
                        $('.tenTP' + id_huy).html(data);
                    @endif
                    $(".row" + id_huy + " .button-xoa").show();
                    $(".row" + id_huy + " .button-sua").show();
                    $(".row" + id_huy + " .button-luu").hide();

                }
        );
    })

    $(document).on('click', '.button-sua', function () {
        id = $(this).attr("id-sua");
        name = $(this).attr("name-sua");

        @if($model == 'loaitin')
                tien = $(this).attr("tien-sua");
        $('.giatien' + id).html("<input type=text value='" + tien + "' class='form-control tien" + id + "' />");
        @endif

        $(".row" + id + " .button-xoa").hide();
        $(".row" + id + " .button-sua").hide();
        $(".row" + id + " .button-luu").show();
        $(".row" + id + " .button-huy").show();
        $('.tenTP' + id).html("<input type=text value='" + name + "' class='form-control text" + id + "' />");
    })

    $(document).on('click', '.button-luu', function () {
        id = $(this).attr("id-luu");
        new_name = $('.text' + id).val();

        console.log(new_name);

        @if($model == 'loaitin')
                new_tien = $('.tien' + id).val();
        @endif

        if (new_name == "") {
            sweetAlert("Có lỗi", "Bạn không được phép sửa dữ liệu thành rỗng", "error");
        } else
            swal({
                        title: "Bạn có thực sự muốn sửa  ?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#337ab7",
                        confirmButtonText: "Đồng ý",
                        cancelButtonText: "Hủy",
                        closeOnConfirm: false
                    },
                    function () {
                        $.get('/edit/{{$model}}',
                                {id_sua: id, new_tp: new_name, @if($model == "loaitin")price: new_tien @endif},
                                function (data) {
                                    if (data[0] == 'edit-successfully') {
                                        $('.tenTP' + id).html(data[1]);

                                        @if($model == 'loaitin')
                                            $('.giatien' + id).html(data[2]);
                                        $(".row" + id + " .button-xoa").attr("tien-xoa", data[2]);
                                        $(".row" + id + " .button-sua").attr("tien-sua", data[2]);
                                        $(".row" + id + " .button-luu").attr("tien-luu", data[2]);
                                        @endif
                                        $(".row" + id + " .button-xoa").show();
                                        $(".row" + id + " .button-xoa").attr("name-xoa", data[1]);

                                        $(".row" + id + " .button-sua").show();
                                        $(".row" + id + " .button-sua").attr("name-sua", data[1]);

                                        $(".row" + id + " .button-luu").hide();
                                        $(".row" + id + " .button-luu").attr("name-luu", data[1]);

                                        $(".row" + id + " .button-huy").hide();
                                        $(".row" + id + " .button-huy").attr("name-huy", data[1]);

                                        swal(new_name, "Sửa thành công " + new_name, "success");
                                    }
                                }
                        )
                    });
    })

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
                        $.get('/delete_chosen/{{ $model }}',
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

    $('.admin-div-timkiem').hide();
    $('.admin-button-timkiem').click(function () {
        $('.admin-div-timkiem').show();
        $('.admin-div-tinhthanh').hide();
    })

    $('.admin-div-tinhthanh').hide();
    $('.admin-button-tinhthanh').click(function () {
        $('.admin-div-tinhthanh').show();
        $('.admin-div-timkiem').hide();
    })

    $('.button-chontatca').click(function () {
        $('.button-xoachon').show();
        $('.button-huychon').show();
    });

    $(document).on('change', '.checkbox', function () {
        $('.button-xoachon').show();
        $('.button-huychon').show();

    });

    $('.button-huychon').click(function () {
        checkbox = $('.checkbox');
        for (i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = false;
        }
    });

    $('.button-chontatca').click(function () {
        checkbox = $('.checkbox');

        for (i = 0; i < checkbox.length; i++) {
            checkbox[i].checked = true;
        }
    });

    // delegate for append data
    // dynamic data
    $(document).on('click', '.button-xoa', function () {
        id = $(this).attr("id-xoa");
        name = $(this).attr("name-xoa");
        swal({
                    title: "Bạn có thực sự muốn xóa <br/><font color='red'>" + name + "</font> ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false,
                    html: true
                },
                function () {
                    $.get('/delete/{{$model}}',
                            {id_xoa: id},
                            function (data) {
                                console.log(data);
                                if (data == 'delete-successfully') {
                                    $(".row" + id).hide();
                                    swal(name, "Xóa thành công" + name, "success");
                                    return;
                                }
                                swal("Không cho phép", "Dữ liệu này có liên quan đến những dữ liệu khác", "error");
                            }
                    )
                });
    })
</script>