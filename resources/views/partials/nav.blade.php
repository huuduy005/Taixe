<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid" style="margin-right: 5px">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#div-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ action('PagesController@trangchu') }}">Trang chủ</a>
        </div>

        <div class="collapse navbar-collapse" id="div-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="nav-timxe">
                    <a href="{{ action('PagesController@timxe') }}">Tìm xe</a>
                </li>
                <li class="nav-timkhach">
                    <a href="{{ action('PagesController@timkhach') }}">Tìm khách</a>
                </li>

                <li>
                    <a href="#">Tin tức</a>
                </li>
                <li class="nav-dichvu">
                    <a href="{{action('PagesController@dichvu')}}">Dịch vụ</a>
                </li>
                <li>
                    <a href="#">Liên hệ</a>
                </li>
                <li class=" nav-dangtin">
                    <a href="{{ action('TindangsController@create') }}">Đăng tin</a>
                </li>

                @if (Auth::guest())
                    <li class="dangky_dangnhap"><a href="{{ url('/login') }}">Đăng nhập</a></li>
                    <li class="dangky_dangnhap"><a href="{{ url('/register') }}">Đăng ký</a></li>
                @else
                    @if(Auth::user()->admin)
                        <li class="dangky_dangnhap"><a class="hoten-nav" href="{{ url('/admin') }}"
                                                       title="{{ Auth::user()->hoten }}">{{ Auth::user()->hoten }}</a>
                        </li>
                    @else
                        <li class="dangky_dangnhap"><a class="hoten-nav" href="{{ url('/dashboard')}}"
                                                       title="{{ Auth::user()->hoten }}">{{ Auth::user()->hoten }}</a>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li class="dangky_dangnhap dangxuat"><a href="{{ url('/logout') }}"><i
                                            class="fa fa-btn fa-sign-out"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    .hoten-nav {
        white-space: nowrap;
        width: 70px;
        height: 22px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

<script>
    @if(Request::is('dangtin'))
        $('.nav-dangtin').css({'background': '#ddd'});
    @endif

    @if(Request::is('timkhach'))
        $('.nav-timkhach').css({'background': '#ddd'});
    @endif

    @if(Request::is('timxe'))
        $('.nav-timxe').css({'background': '#ddd'});
    @endif

     @if(Request::is('dichvu'))
        $('.nav-dichvu').css({'background': '#ddd'});
    @endif
</script>