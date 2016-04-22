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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        body {
           /*font-family: 'Arial';*/
            font-family: 'Source Sans Pro',sans-serif;
        }
        .trogiup span{
            font-size: 20px; margin-right:2%
        }
        .fa-btn{
            margin-right: 6px;
        }
    </style>

</head>
<body id="app-layout">

<!-- Navigation -->
@include('partials.nav')

<div class="row" style="height: 35px"></div>
<div class="row text-right">
    <a href="#" class="trogiup" title="Trợ giúp">
        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
    </a>
</div>

<div class="container-fluid" style="padding: 0 5% 0 5%; min-height: 425px">
    @yield('content')
</div>

<!--Footer-->
@include('partials.footer')
@yield('scripts')
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
                    str = str + "<hr><div class='row' style='margin-left: 29%'>"+
                                "<div class='col-sm-4 text-left'>Làm mới: </div>" +
                                "<div class='col-sm-5 text-center'>" +
                                "<font color='red'><b>Giá loại tin / 2</b></font></div></div><hr>";
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