@if(Auth::check())
    <div class="dropdown" style="float: right">
        <a class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span>
        </a>
        <ul class="dropdown-menu option-menu" role="menu">
            <li><a role="menuitem" tabindex="-1" class="xoa_tinluu"
                   id-xoa="{{ $tindang->id }}" href="#">Xóa lưu</a></li>
        </ul>
    </div>
@endif