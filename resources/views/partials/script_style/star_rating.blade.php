@if(isset($tindang))
    <td colspan="2" align="center">
        <input value="{{ $tindang->ratepoint }}" id="rating{{ $tindang->id }}" type="number"
               class="rating rating{{ $tindang->taixe_id }}" min=0 max=5 step=0.5 data-size="xs"
               data-show-caption="false">
        <font color="#aaa">
            <span class="ratinglabel{{ $tindang->taixe_id }}">{{ $tindang->ratepoint }}
                / 5 điểm - {{ $tindang->ratecount }} </span> lượt bầu
        </font>
        <script>
            $('#rating{{ $tindang->id }}').on('rating.change', function (event, value, caption) {
                @if(Auth::check())
                      @if(Auth::user()->taixe['id'] == $tindang->taixe_id)
                          sweetAlert("Không thành công", "Bạn không thể đánh giá tài khoản của mình!", "error");
                $('.rating{{ $tindang->taixe_id }}').rating('reset');
                @else
                    {{ $check = false }}
                     @foreach(Auth::user()->rate_taixes as $item)
                        @if( $tindang->taixe_id == $item['id'])
                            {{ $check = true}}
                        @endif
                    @endforeach

                    @if($check)
                        sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                $('.rating{{ $tindang->taixe_id }}').rating('reset');
                @else
                  $.get('/rating',
                        {
                            tindang_taixe_id: "{{ $tindang->taixe_id }}",
                            point: value
                        },
                        function (data) {
                            if (data[0] == 'error') {
                                sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                                $('.rating{{ $tindang->taixe_id }}').rating('update', data[1]["ratepoint"]);
                            } else {
                                $('.ratinglabel{{ $tindang->taixe_id }}').text(data["ratepoint"] + "/ 5 điểm - " + data["ratecount"] + " lượt bầu");
                                $('.rating{{ $tindang->taixe_id }}').rating('update', data["ratepoint"]);
                            }
                        })
                @endif
            @endif
        @else
            sweetAlert("Không thành công", "Bạn phải đăng nhập thì mới được đánh giá!", "error");
                $('.rating{{ $tindang->taixe_id }}').rating('reset');
                @endif

            })
        </script>
    </td>
@endif