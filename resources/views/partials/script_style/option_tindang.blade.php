<style>
    .option-menu {
        min-width: 0;
    }

    .option-menu li {
        background: #f7f7f7;
    }

    .option-menu li a {
        font-size: 12px;
        padding: 4px 10px;
    }

    .option-menu li a:hover {
        color: white;
    }
</style>
<script>
    $('.xoa_tindang').click(function () {
        id = $(this).attr('id-xoa');
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
                    $.get('/delete_tindang',
                            {id_xoa: id},
                            function (data) {
                                if (data == 'delete-successfully') {
                                    $(".table" + id).hide();
                                    swal("Thông báo", "Xóa thành công ", "success");
                                }
                            }
                    )
                });
    })

    $('.lammoi_tindang').click(function () {
        id = $(this).attr('id-lammoi');
        swal({
                    title: "Xác nhận làm mới  ?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý",
                    cancelButtonText: "Hủy",
                    closeOnConfirm: false
                },
                function () {
                    $.get('/update_tindang',
                            {id_xoa: id},
                            function (data) {
                                window.location.replace("{{ Request::url() }}");
                            }
                    )
                });
    })

</script>