<h1 class="text-center">{{ $submitButtonText }}</h1>
<hr>

{{ csrf_field() }}

@include('errors.list')

@if(Auth::user()->is('hanhkhach'))
    <input type="hidden" name="loaitin_id" value="2">
@else
    <input type="hidden" name="loaitin_id" value="1">
@endif

<!-- add tieude Form input -->
<div class="form-group">
    {!! Form::label('tieude', 'Tiêu đề  (*):') !!}
    {!! Form::text('tieude', null, ['class' => 'form-control', 'required']) !!}
</div>

@inject('provinces', 'App\Thanhpho')
{{-- */ $province = $provinces->all()->lists('tenTP', 'tenTP');/* --}}

<div class="form-group row">
    <!-- Nơi đi input -->
    {!! Form::label('noidi', 'Nơi đi:',['class'=> 'col-md-1']) !!}
    <div class="col-md-6">
        {!! Form::text('noidi', null, ['class' => 'form-control ']) !!}
    </div>
    <label for="thanhphonoidi" class="col-md-2">TP Nơi đi:</label>
    <div class="col-md-3">
        {!! Form::select('thanhphonoidi', $province, null, ['class' => 'form-control']) !!}

    </div>
</div>

<div class="form-group row">
    <!-- Nơi đến input -->
    {!! Form::label('noiden', 'Nơi đến:',['class'=> 'col-md-1']) !!}
    <div class="col-md-6">
        {!! Form::text('noiden', null, ['class' => 'form-control ']) !!}
    </div>
    <label for="thanhphonoiden" class="col-md-2">TP Nơi đến:</label>
    <div class="col-md-3">
        {!! Form::select('thanhphonoiden', $province, null, ['class' => 'form-control']) !!}
    </div>
</div>

<div class="row form-group">
    <label for="giokhoihanh" class="col-md-2">Giờ khởi hành:</label>
    <div class="col-md-3  bootstrap-timepicker">
        {!! Form::text('giokhoihanh', null, ['class' => 'form-control timepicker']) !!}
    </div>
    <div class="col-md-2"></div>
    {!! Form::label('ngaykhoihanh', 'Ngày khởi hành:', ['class'=> 'col-md-2']) !!}
    <div id="datepicker" class="input-group date col-md-3">
        {!! Form::text('ngaykhoihanh', null, ['class' => 'form-control']) !!}
        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
</div>
</div>

<div class="form-group row row_giave">
    {!! Form::label('giave', 'Giá vé ( VNĐ ):', ['class' => 'col-md-2 label-giave']) !!}
    <div class="col-md-3">
        {!! Form::text('giave', null, ['class' => 'form-control', 'placeholder'=>'Để trống là thỏa thuận']) !!}
    </div>
</div>

<!-- add noidung Form input -->
<div class="form-group">
    {!! Form::label('noidung', 'Nội dung:') !!}
    {!! Form::textarea('noidung', null, ['class' => 'form-control']) !!}
</div>

<hr>
<!-- add Dang tin Form input -->
<div class="form-group text-center">
    {!! Form::submit($submitButtonText , ['class' => 'btn btn-primary']) !!}
    @if(Request::is('*sua'))
        <a href="/dashboard" class="btn btn-primary">Hủy</a>
    @else
        {!! Form::reset('Nhập lại', ['class' => 'btn btn-primary']) !!}
    @endif
</div>

<script type="text/javascript">
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
    });

    if($("#ngaykhoihanh").val() == "" || $("#ngaykhoihanh").val() == null){
        $("#datepicker").datepicker("update", new Date());
    } else{
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        });
    }
    @if(Auth::user()->is('hanhkhach'))
        $('.row_giave').hide();
    @else
    $('.row_giave').show();
    @endif
</script>