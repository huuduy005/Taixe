<div class="row table{{$tindang->id}}">
    <div class="col-sm-6" style="padding-right: 0px; padding-left: 3%">
        <div class="g"><!--m-->
            <div class="rc" data-hveid="33">
                <h3 class="r">
                    <a class="tintuc_tieude a_tieude"
                       href="{{url('/tindangs', $tindang->id)}}">{{$tindang->tieude}}</a>
                </h3>
                <div class="s">
                    <font style="font-size: 12px">{{ $tindang->ngaydang }}</font>
                    <div class="div_content_tintuc">
                        {!! Str::words($tindang->noidung, 15, ".....") !!}
                    </div>
                </div>
            </div><!--n-->
        </div>
    </div>
    <div class="col-sm-6" style="padding: 9px 0 0 0">
        @unless($tindang->status)
            <p class="col-sm-4 text-left"><font color="red" size="4">Bài
                    đăng đã bị xóa</font></p>
        @endunless
        <div class="col-sm-1">
            @if(isset($tinluu) and $tinluu)
                @include('partials.option_tindang_luu')
            @else
                @include('partials.option_tindang')
            @endif
        </div>

    </div>
</div>