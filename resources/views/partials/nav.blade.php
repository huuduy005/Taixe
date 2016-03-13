<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header" style="margin-left: 4%">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#div-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ action('PagesController@trangchu') }}"><img class="img img-responsive navbar-brand img-brand" src="{{asset("images/steering_wheel.png")}}" ></a>
            <a class="navbar-brand" href="{{ action('PagesController@trangchu') }}"><font size="5">TRANG CHỦ</font></a>
        </div>

        <div class="collapse navbar-collapse" id="div-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="nav-timxe">
                    <a href="{{ action('PagesController@timxe') }}">TÌM XE</a>
                </li>
                <li class="nav-timkhach">
                    <a href="{{ action('PagesController@timkhach') }}">TÌM KHÁCH</a>
                </li>

                <li>
                    <a href="#">TIN TỨC</a>
                </li>
                <li class="nav-dichvu">
                    <a href="{{action('PagesController@dichvu')}}">DỊCH VỤ</a>
                </li>
                <li class=" nav-dangtin">
                    <a href="{{ action('TindangsController@create') }}">ĐĂNG TIN</a>
                </li>

                @if (Auth::guest())
                    <li class="nav-dangnhap"><a href="{{ url('/login') }}">ĐĂNG NHẬP</a></li>
                    <li class="nav-dangky"><a href="{{ url('/register') }}">ĐĂNG KÝ</a></li>
                @else
                    @if(Auth::user()->admin)
                        <li><a class="hoten-nav" href="{{ url('/admin') }}"
                                                       title="{{ Auth::user()->hoten }}">{{ Auth::user()->hoten }}</a>
                        </li>
                    @else
                        <li><a class="hoten-nav" href="{{ url('/dashboard')}}"
                                                       title="{{ Auth::user()->hoten }}">{{ Auth::user()->hoten }}</a>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu drop_dangxuat" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}" class="a_dangxuat"><i class="fa fa-btn fa-sign-out"></i>Đăng xuất</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<style>
    .img-brand{
      padding: 1px 0 1px 15px;
    }
    .hoten-nav {
        white-space: nowrap;
        width: 90px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    #div-collapse li:hover{
        background: #77bb44;
    }

    #div-collapse li a:hover{
        color: #fff!important;
    }
    .navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus{
        background: #77bb33;
    }
</style>

<script>
    @if(Request::is('dangtin'))
        $('.nav-dangtin').css({'background': '#77bb33'});
    @endif

    @if(Request::is('timkhach'))
        $('.nav-timkhach').css({'background': '#77bb33'});
    @endif

    @if(Request::is('timxe'))
        $('.nav-timxe').css({'background': '#77bb33'});
    @endif

     @if(Request::is('dichvu'))
        $('.nav-dichvu').css({'background': '#77bb33'});
    @endif

    @if(Request::is('dashboard'))
        $('.hoten-nav').css({'background': '#77bb33'});
    @endif

    @if(Request::is('login'))
        $('.nav-dangnhap').css({'background': '#77bb33'});
    @endif

    @if(Request::is('register'))
        $('.nav-dangky').css({'background': '#77bb33'});
    @endif
</script>