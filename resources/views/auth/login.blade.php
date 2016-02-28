@extends('layouts.app')

@section('content')
    @include('flash')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng nhập</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Địa chỉ email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Nhớ tài khoản
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Đăng nhập
                                    </button>

                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Quên mật khẩu?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('form').submit(function () {
            jQuery.ajaxSetup({async: false});
            temp = $("input[name='email']").val();
            if (temp != null && temp != "") {
                var check = true;
                $.get('/check_auth',
                        {email: temp},
                        function (data) {
                            if (data == 'failed') {
                                check = false;
                            }
                        });
                if (!check) {
                    sweetAlert("Thông báo", "Không thể đăng nhập vì tài khoản của bạn đã bị khóa!", "error");
                    return false;
                }
            }
        })
    </script>
@endsection
