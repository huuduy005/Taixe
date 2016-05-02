@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Đăng ký tài khoản</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {!! csrf_field() !!}

                            <div class="form-group row">
                                <label for="banla" class="col-md-4 control-label">Bạn là :</label>
                                <div class="col-sm-6">
                                    <select name="banla" id="banla" class="form-control select2">
                                        <option value="taixe">Tài xế</option>
                                        <option value="khachhang">Khách hàng</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('hoten') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Họ tên</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control  input-sm" name="hoten"
                                           value="{{ old('hoten') }}"
                                           required>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Địa chỉ email</label>

                                <div class="col-md-6">
                                    <input type="email" class="form-control  input-sm" name="email"
                                           value="{{ old('email') }}"
                                           required>

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
                                    <input type="password" class="form-control  input-sm" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Xác nhận mật khẩu</label>

                                <div class="col-md-6">
                                    <input type="password" class="form-control  input-sm" name="password_confirmation"
                                           required>

                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- add SDT Form input -->
                            <div class="form-group row">
                                {!! Form::label('SDT', 'SDT:', ['class'=> 'col-md-4 control-label']) !!}
                                <div class="col-sm-6">
                                    {!! Form::text('SDT', null, ['class' => 'form-control input-sm', 'required']) !!}
                                </div>
                            </div>

                            <div class="is_taixe">
                                <div class="form-group row">
                                    {!! Form::label('loaixe_id', 'Loại xe :', ['class'=> 'col-md-4 control-label label-loaixe']) !!}
                                    <div class="col-sm-6">
                                        <select class="form-control select2" name="loaixe_id" id="loaixe_id">
                                            @if(isset($loaixes))
                                                @foreach($loaixes as $key => $values)
                                                    <option value="{{ $values['id'] }}">{{ $values['tenLX'] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <!-- add bienso Form input -->
                                <div class="form-group row">
                                    {!! Form::label('bienso', 'Biển số:', ['class'=> 'col-md-4 control-label label-bienso']) !!}
                                    <div class="col-sm-6">
                                        {!! Form::text('bienso', null, ['class' => 'form-control  input-sm']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i>Đăng ký
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script>

        $(".select2").select2();

        $('#banla').change(function () {
            if ($('#banla').val() == "taixe") {
                $(".is_taixe").show();
            } else {
                $(".is_taixe").hide();
            }
        })
    </script>
@endsection
