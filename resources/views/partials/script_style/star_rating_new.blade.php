@if(isset($tindang))
    <td colspan="2" align="center">
        <input value="{{ $tindang->user->taixe->ratepoint }}" id="rating{{ $tindang->id }}" type="number"
               class="rating rating{{ $tindang->user->taixe->id }}" min=0 max=5 step=0.5 data-size="xs"
               data-show-caption="false">
        <font color="#aaa">
            <span class="ratinglabel{{ $tindang->user->taixe->id }}">{{ $tindang->user->taixe->ratepoint }}
                / 5 điểm - {{ $tindang->user->taixe->ratecount }} </span> lượt bầu
        </font>
        <script>
            $('#rating{{ $tindang->id }}').on('rating.change', function (event, value, caption) {
             @if(Auth::check())
                    @if(Auth::user()->taixe != null && Auth::user()->taixe->id == $tindang->user->taixe->id)
                        sweetAlert("Không thành công", "Bạn không thể đánh giá tài khoản của mình!", "error");
                        $('.rating{{ $tindang->user->taixe->id }}').rating('reset');
                    @else
                        {{ $check = false }}
                         @foreach(Auth::user()->rate_taixes as $item)
                            @if( $tindang->user->taixe->id == $item['id'])
                                {{ $check = true}}
                            @endif
                        @endforeach

                        @if($check)
                            sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                        $('.rating{{ $tindang->user->taixe->id }}').rating('reset');
                        @else
                              $.get('/rating',
                                    {
                                        tindang_taixe_id: "{{ $tindang->user->taixe->id }}",
                                        point: value
                                    },
                                    function (data) {
                                        if (data[0] == 'error') {
                                            sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                                            $('.rating{{ $tindang->user->taixe->id }}').rating('update', data[1]["ratepoint"]);
                                        } else {
                                            $('.ratinglabel{{ $tindang->user->taixe->id }}').text(data["ratepoint"] + "/ 5 điểm - " + data["ratecount"]);
                                            $('.rating{{ $tindang->user->taixe->id }}').rating('update', data["ratepoint"]);
                                        }
                              })
                        @endif
                    @endif
            @else
                sweetAlert("Không thành công", "Bạn phải đăng nhập thì mới được đánh giá!", "error");
                    $('.rating{{ $tindang->user->taixe->id }}').rating('reset');
            @endif
            })
        </script>
    </td>
@endif