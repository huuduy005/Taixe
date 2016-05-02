<div class="col-md-1 text-right" style="position: fixed">
    @if(Auth::check())
        @if(Auth::user()->id == $tindang->user->id)
            @if($tindang->loaitin->tenLT == "Tìm xe")
                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Cập nhật lộ trình" class="capnhat_lotrinh">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"
                                  style="font-size: 25px; color: #337ab7"></span>
                </a>
                <br><br>

                <script>
                    $('.capnhat_lotrinh').click(function () {
                        swal({
                                    title: "Cập nhật!",
                                    text: "Nhập vị trí cập nhật:",
                                    type: "input",
                                    showCancelButton: true,
                                    closeOnConfirm: false,
                                    confirmButtonText: "Đồng ý",
                                    cancelButtonText: "Hủy",
                                    animation: "slide-from-top",
                                    showLoaderOnConfirm: true,
                                    inputPlaceholder: "Nhập vị trí mà bạn muốn cập nhật"
                                },
                                function (inputValue) {
                                    if (inputValue === false) return false;
                                    if (inputValue === "") {
                                        swal.showInputError("Bạn cần phải nhập vị trí!");
                                        return false
                                    }
                                    setTimeout(function () {
                                        $.get('/save_tindang/ajax',
                                                {
                                                    tindang_id: "{{ $tindang->id }}",
                                                    lotrinh: inputValue,
                                                    act: "capnhat"
                                                },
                                                function (data) {
                                                    $('.lotrinhhientai').text(inputValue);
                                                    $('.tg_lotrinh').text("({{ \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('H:i  -   d/m/Y')}})");
                                                    sweetAlert("Thành công", "Bạn đã cập nhật thành công!", "success");
                                                });
                                    }, 1000);
                                });
                    });
                </script>
            @endif
        @else
            <a href="#" class="save-tindang" data-toggle="tooltip" data-placement="bottom" title="Lưu tin đăng">
                        <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"
                              style="font-size: 25px; color: #337ab7"></span>
            </a>
        @endif
        <script>
            $('.save-tindang').click(function () {
                {{ $check = false }}
                @foreach(Auth::user()->save_tindangs as $item)
                    @if($tindang->id == $item['id'])
                    {{ $check = true }}
                    @endif
                @endforeach

                @if($check)
                    sweetAlert("Không thành công", "Bạn đã lưu tin này rồi", "error");
                @else

                        $.get('/save_tindang/ajax',
                        {tindang_id: "{{ $tindang->id }}", act: "luu"},
                        function (data) {
                            console.log(data);
                            if (data == 'error') {
                                sweetAlert("Không thành công", "Bạn đã lưu tin này rồi", "error");
                            } else {
                                sweetAlert("Thành công", "Bạn đã lưu tin!", "success");
                            }
                        });
                @endif
            })
        </script>
    @endif
</div>