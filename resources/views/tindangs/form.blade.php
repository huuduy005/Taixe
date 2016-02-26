<h1 class="text-center">{{ $submitButtonText }}</h1>
<br>
<br>
<div class="row">
    <div class="col-sm-4"><label>Loại tin :</label></div>
    <div class="col-sm-2">
        <input type="radio" name="rd_loaitin" checked id="rd_tinthuong" value="tinthuong">&nbsp;&nbsp;&nbsp;Tin thường
    </div>
    <div class="col-sm-2">
        @if(isset($tindang))
            @if($tindang->loaitin->tenLT == "Dịch vụ")
                <input type="radio" name="rd_loaitin" id="rd_tindichvu" checked value="tindichvu">&nbsp;&nbsp;&nbsp;Tin dịch vụ
            @else
                <input type="radio" name="rd_loaitin" id="rd_tindichvu"  value="tindichvu">&nbsp;&nbsp;&nbsp;Tin dịch vụ
            @endif
        @else
            <input type="radio" name="rd_loaitin" id="rd_tindichvu"  value="tindichvu">&nbsp;&nbsp;&nbsp;Tin dịch vụ
        @endif
    </div>
</div>
<hr>

{{ csrf_field() }}

@include('errors.list')

        <!-- add tieude Form input -->
<div class="form-group">
    {!! Form::label('tieude', 'Tiêu đề  (*):') !!}
    {!! Form::text('tieude', null, ['class' => 'form-control', 'required']) !!}
</div>

<div id="tindichvu_tinthuong">
    @inject('provinces', 'App\Thanhpho')
    {{-- */ $province = $provinces->all()->lists('tenTP', 'tenTP');/* --}}

    <div class="form-group row">
        <!-- Nơi đi input -->
        {!! Form::label('noidi', 'Nơi đi:',['class'=> 'col-md-2']) !!}
        <div class="col-md-5">
            {!! Form::text('noidi', null, ['class' => 'form-control ']) !!}
        </div>
        <label for="thanhphonoidi" class="col-md-2">TP Nơi đi:</label>
        <div class="col-md-3">
            {!! Form::select('thanhphonoidi', $province, null, ['class' => 'form-control']) !!}

        </div>
    </div>

    <div class="form-group row">
        <!-- Nơi đến input -->
        {!! Form::label('noiden', 'Nơi đến:',['class'=> 'col-md-2']) !!}
        <div class="col-md-5">
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
        <a href="/dashboard" class="btn btn-warning" style="width: 9%">Hủy</a>
    @else
        {!! Form::reset('Nhập lại', ['class' => 'btn btn-warning']) !!}
    @endif
</div>

@include('partials.script_style.money_format_js')
<script type="text/javascript">
    $("#giave").keydown(function(){
        var value = $(this).val();
        $(this).number( true, 0, ' ', '.');
    });

    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
    });

    if ($("#ngaykhoihanh").val() == "" || $("#ngaykhoihanh").val() == null) {
        $("#datepicker").datepicker("update", new Date());
    } else {
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

    $('#rd_tinthuong').change(function(){
        $('#tindichvu_tinthuong').show();
    })

    $('#rd_tindichvu').change(function(){
        $('#tindichvu_tinthuong').hide();
    })

    if( $('#rd_tinthuong').attr("checked")){
        $('#tindichvu_tinthuong').show();
    }

    if( $('#rd_tindichvu').attr("checked")){
        $('#tindichvu_tinthuong').hide();
    }

</script>
