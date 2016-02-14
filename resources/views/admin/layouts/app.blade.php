<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <link href="{{ asset("css/admin.css") }}" rel="stylesheet" />
      <link href="{{ asset("css/libs.css") }}" rel="stylesheet" />
      <script src="{{asset("js/all.js")}}"></script>
      <script src="{{asset("js/libs.js")}}"></script>
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <header class="header dark-bg row">
          <div style="height: 61px; width: 90%;float: left">
            <a href="#" class="logo" style="font-size: 17px">Quản lý danh mục</a>
          </div>
           <div  class="admin-nav border-nav"><a href="/admin" class="admin-logout"><i>Admin</i></a></div>
            <div class="admin-nav">
                <a href="/logout" class="admin-logout"><i>Log out</i></a>
            </div>
      </header>

      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">

                  <li class="sub-menu">
                      <a href="{{ action('AdminController@thanhpho') }}" class="">
                          <i class="icon_table"></i>
                          <span>Tỉnh, thành phố</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{ action('AdminController@loaixe') }}" class="">
                          <i class="icon_table"></i>
                          <span>Loại xe</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{ action('AdminController@loaitin') }}" class="">
                          <i class="icon_table"></i>
                          <span>Loại tin</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{ action('AdminController@taikhoan') }}" class="">
                          <i class="icon_table"></i>
                          <span>Tài khoản</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="{{ action('AdminController@tindang') }}" class="">
                          <i class="icon_table"></i>
                          <span>Tin đăng</span>
                          <span class="menu-arrow arrow_carrot-right"></span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">

                  @yield('content')
			</div>
          </section>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

  </body>
</html>

<style>

    body{
        background-color: white;
    }
    h1{
        font-weight:bold;
    }
    .admin-logout{
        color: #fff!important;font-size: 15px ;font-weight: bold;
    }

    .admin-nav a:hover{
        color: #00A000!important;
    }
    .admin-nav{
        width: 5%;
        height: 61px;
        float: left;
        padding-top:20px;
        font-size: 15px;
        padding-left: 5px;
    }
    .border-nav{
        border-right: 1px solid #aaaaaa;
        border-left: 1px solid #aaaaaa;

    }
</style>