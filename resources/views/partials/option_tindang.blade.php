@if(Auth::check())
    {{ $check = false }}
    @foreach(Auth::user()->tindangs as $t)
        @if($t->id == $tindang->id)
            {{--*/ $check = true /*--}}
        @endif
    @endforeach
    @if($check == true)
        <div class="dropdown" style="float: right">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
            </a>
            <ul class="dropdown-menu option-menu" role="menu">
                <li><a role="menuitem" tabindex="-1"
                       href="/tindangs/{{ $tindang->id }}/sua">Sửa</a></li>
                <li><a role="menuitem" tabindex="-1" class="xoa_tindang"
                       id-xoa="{{ $tindang->id }}" href="#">Xóa</a></li>
                <li><a role="menuitem" tabindex="-1" class="lammoi_tindang"
                       id-lammoi="{{ $tindang->id }}" href="#">Làm mới</a></li>
            </ul>
        </div>
    @endif
@endif