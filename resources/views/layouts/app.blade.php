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
    <link href="{{ asset("css/all.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("css/libs.css") }}">
    <link rel="stylesheet" href="{{ asset("css/site.css") }}">

    <script src="{{ asset("js/all.js") }}"></script>
    <script src="{{ asset("js/libs.js") }}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
            font-family: 'Arial';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<!-- Navigation -->
@include('partials.nav')
<div class="row" style="height: 60px"></div>
<div class="row text-right">
    <a href="#" class="trogiup" title="Trợ giúp">
        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"
              style="font-size: 20px; margin-right:2%"></span>
    </a>
</div>
<div class="container-fluid" style="padding: 0 5% 0 5%">
    @yield('content')
</div>
<!--Footer-->
@include('partials.footer')

</body>
</html>
<script>
    $('.trogiup').click(function () {

        $.get('/trogiup',
                function (data) {
                    str = "Tên loại tin và giá tiền";
                    $.each(data, function (key, value) {
                        str = str +
                                "<hr><div class='row' style='margin-left: 29%'> " +
                                "<div class='col-sm-4 text-left'>" +
                                value['tenLT'] +
                                ":</div>" +
                                "<div class='col-sm-3 text-center'>" +
                                "<font color='red'><b>" + value['giatien'] + "đ</b></font><br>" +
                                "</div>" +
                                "</div>"

                    })
                    str = str + "<div class='row'><hr>Làm mới: <font color='red'><b>&nbsp;&nbsp;&nbsp;Giá loại tin / 2</b></font></div><hr>";
                    swal({
                        title: "Trợ giúp!",
                        text: str,
                        html: true,
                        animation: "slide-from-top",
                        timer: 5000,
                    });
                })
    });
</script>