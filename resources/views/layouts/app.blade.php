<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    // for comment facebook
    <meta property="fb:app_id" content="1162849360405408"/>
    <meta property="fb:admins" content="100005288296785"/>

    <title>Tài xế</title>


    <!-- Fonts -->
    <link href="{{ asset("fonts/font_app.css") }}" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="{{ asset("css/site.css") }}" rel="stylesheet">
    <link href="{{ asset("css/temp.css") }}" rel="stylesheet">
    @yield('css')

    <script src="{{ asset("js/site.js") }}"></script>
    {{--<script src="{{asset("js/temp.js")}}"></script>--}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="app-layout">

<!-- Navigation -->
@include('partials.nav')

<div class="row" style="height: 35px"></div>
<div class="row">
    <div class="pull-left" style="width: 96%">
            @include('partials.hot_post')
    </div>
    <div class="text-left pull-right" style="width: 3%;">
        <a href="#" class="trogiup" data-placement="left" data-toggle="tooltip" title="Trợ giúp">
            <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
        </a>
    </div>
</div>

<div class="container-fluid" style="padding: 0 5% 0 5%; min-height: 425px">
    @yield('content')
</div>

<!--Footer-->
@include('partials.footer')
@yield('script')
</body>
</html>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('.trogiup').click(function () {

            $.get('/trogiup',
                    function (data) {
                        str = "Tên loại tin và giá tiền";
                        $.each(data, function (key, value) {
                            str = str +
                                    "<hr style='margin: 10px 0 10px 0'><div class='row' style='margin-left: 29%'> " +
                                    "<div class='col-sm-4 text-left'>" +
                                    value['tenLT'] +
                                    ":</div>" +
                                    "<div class='col-sm-3 text-center'>" +
                                    "<font color='red'><b>" + value['giatien'] + "đ</b></font><br>" +
                                    "</div>" +
                                    "</div>"

                        })
                        str = str + "<hr style='margin: 10px 0 10px 0'><div class='row' style='margin-left: 29%'>" +
                                "<div class='col-sm-4 text-left'>Làm mới: </div>" +
                                "<div class='col-sm-5 text-center'>" +
                                "<font color='red'><b>Giá loại tin / 2</b></font></div></div><hr style='margin: 10px 0 10px 0'>";
                        swal({
                            title: "Trợ giúp!",
                            text: str,
                            html: true,
                            animation: "slide-from-top",
                            confirmButtonText: "Đồng ý",
                            //timer: 5000,
                        });
                    })
        });
    });
</script>