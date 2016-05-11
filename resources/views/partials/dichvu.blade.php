<div class="container-edit">
    @if(isset($tin_dichvus))
        @foreach($tin_dichvus as $tindang)
            @include('partials.dichvu_child')
        @endforeach
    @endif
</div>
