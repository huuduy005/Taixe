@extends('admin.layouts.app')


@section('content')
    <div style="padding-top: 12px">
        <a href="/admin/tintucs" type="button" class="btn btn-primary btn-sm">
            <i class="fa fa-backward"></i>
            <span>Trở về</span>
        </a>
    </div>
    <form method="POST" action="/admin/tintucs" class="col-sm-10 col-sm-offset-1" onreset="onResetButton()">

        {{ csrf_field() }}

        <h2 class="text-center">THÊM MỚI TIN ĐĂNG</h2>

        <!-- add tieude Form input -->
        <div class="form-group">
            {!! Form::label('tieude', 'Tiêu đề  (*):',['class'=>'label1']) !!}
            {!! Form::text('tieude', null, ['class' => 'form-control', 'required', 'placeholder'=>'Nhập tiêu đề...']) !!}
        </div>

        <!-- add noidung Form input -->
        <div class="form-group">
            {!! Form::label('noidung', 'Nội dung:',['class'=>'label1']) !!}
            {!! Form::textarea('noidung', null, ['class' => 'form-control', 'id' => 'editor1']) !!}
        </div>
        <div class="form-group text-center">
            {{--   {!! Form::submit("Đăng tin" , ['class' => 'btn btn-primary btn_dangtin']) !!}--}}
            {{--{!! Form::reset('Nhập lại', ['class' => 'btn btn-warning btn_dangtin' ]) !!}--}}
            {{ Form::button('<span class="glyphicon glyphicon-ok-circle"></span> Đăng tin', array('class'=>'btn btn-primary btn_dangtin', 'type'=>'submit')) }}
            {{ Form::button('<span class="glyphicon glyphicon-remove-circle"></span> Nhập lại', array('class'=>'btn btn-warning btn_dangtin', 'type'=>'reset')) }}

        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
    </script>
@endsection
