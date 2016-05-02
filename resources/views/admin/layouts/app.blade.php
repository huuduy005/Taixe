<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Taixe.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('css')

</head>
<!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header" >
        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">QL</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">Quản Lý Danh Mục</span>
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
        </a>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li>
                    <a href="/">
                        <i class="fa fa-backward"></i> <span>Trở về trang chủ</span>
                    </a>
                </li>
                <li class="sub_menu_tintuc">
                    <a href="{{ action('Admin\TintucsController@index') }}">
                        <i class="fa fa-newspaper-o"></i> <span>Tin tức</span>
                    </a>
                </li>
                <li class="sub_menu_thanhpho">
                    <a href="{{ action('Admin\ThanhphosController@index') }}">
                        <i class="fa fa-list-alt"></i> <span>Tỉnh, thành phố</span>
                    </a>
                </li>
                <li class="sub_menu_loaixe">
                    <a href="{{ action('Admin\LoaixesController@index') }}">
                        <i class="fa  fa-car"></i> <span>Loại xe</span>
                    </a>
                </li>
                <li class="sub_menu_loaitin">
                    <a href="{{ action('Admin\LoaitinsController@index') }}">
                        <i class="fa fa-list-ol"></i> <span>Loại tin</span>
                    </a>
                </li>
                <li class="sub_menu_taikhoan">
                    <a href="{{ action('Admin\TaikhoansController@index') }}">
                        <i class="fa  fa-user"></i> <span>Tài khoản</span>
                    </a>
                </li>
                <li class="sub_menu_tindang">
                    <a href="{{ action('Admin\TindangsController@index') }}">
                        <i class="fa fa-list-ul"></i> <span>Tin đăng</span>
                    </a>
                </li>
                <li>
                    <a href="/logout">
                        <i class="fa fa-sign-out"></i> <span>Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<script src="{{asset("js/admin.js")}}"></script>

<script>
    @if(Request::is('admin/thanhphos'))
         $('.sub_menu_thanhpho').addClass("active");
    @endif

      @if(Request::is('admin/loaixes'))
        $('.sub_menu_loaixe').addClass("active");
    @endif

      @if(Request::is('admin/loaitins'))
        $('.sub_menu_loaitin').addClass("active");
    @endif

      @if(Request::is('admin/taikhoans'))
        $('.sub_menu_taikhoan').addClass("active");
    @endif

      @if(Request::is('admin/tindangs'))
        $('.sub_menu_tindang').addClass("active");
    @endif

    @if(Request::is('admin/tintucs'))
        $('.sub_menu_tintuc').addClass("active");
    @endif
</script>

@yield('script')

</body>
</html>
