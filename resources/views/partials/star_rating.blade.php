<script>
    $('#rating{{ $tindang->id }}').on('rating.change', function (event, value, caption) {
        @if(Auth::check())
              @if(Auth::user()->taixe['id'] == $taixe->id)
                  sweetAlert("Không thành công", "Bạn không thể đánh giá tài khoản của mình!", "error");
        $('.rating{{ $taixe->id }}').rating('reset');
        @else
            {{ $check = false }}
             @foreach(Auth::user()->rate_taixes as $item)
                @if( $taixe->id == $item['id'])
                    {{ $check = true}}
                @endif
            @endforeach

            @if($check)
                sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
        $('.rating{{ $taixe->id }}').rating('reset');
        @else
          $.get('/rating',
                {
                    tindang_taixe_id: "{{ $taixe->id }}",
                    point: value
                },
                function (data) {
                    if (data[0] == 'error') {
                        sweetAlert("Không thành công", "Bạn đã đánh giá tài xế này rồi!", "error");
                        $('.rating{{ $taixe->id }}').rating('update', data[1]["ratepoint"]);
                    } else {
                        $('.ratinglabel{{ $taixe->id }}').text(data["ratepoint"] + "/ 5 điểm - " + data["ratecount"]);
                        $('.rating{{ $taixe->id }}').rating('update', data["ratepoint"]);
                    }
                })
        @endif
    @endif
@else
    sweetAlert("Không thành công", "Bạn phải đăng nhập thì mới được đánh giá!", "error");
        $('.rating{{ $taixe->id }}').rating('reset');
        @endif

    })
</script>