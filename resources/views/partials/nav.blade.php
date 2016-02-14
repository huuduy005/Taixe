<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container" style="margin-right: 5px">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ action('PagesController@trangchu') }}">Trang chủ</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll nav-timxe">
                    <a href="{{ action('PagesController@timxe') }}">Tìm xe</a>
                </li>
                <li class="page-scroll nav-timkhach">
                    <a href="{{ action('PagesController@timkhach') }}">Tìm khách</a>
                </li>

                <li class="page-scroll">
                    <a href="#">Tin tức</a>
                </li>
                <li class="page-scroll">
                    <a href="#">Dịch vụ</a>
                </li>
                <li class="page-scroll">
                    <a href="#">Liên hệ</a>
                </li>
                <li class="page-scroll nav-dangtin">
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
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
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
</script>