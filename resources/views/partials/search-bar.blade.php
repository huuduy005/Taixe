<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
<style>
    .div_noidi{
        padding-left: 4%;
    }
</style>

@inject('provinces', 'App\Thanhpho')
{{-- */ $province = $provinces::all();/* --}}
<div class="row border_radius" id="search">
    <form class="form-inline" action="{{ Request::url() }}" method="GET" role="form">
        <input type="hidden" name="sort" id="sort" value="test">
        <div class="form-group col-sm-4 div_noidi">
            <div class="col-sm-10">
            <label for="thanhphonoidi" class="form-control-static">Nơi đi: &nbsp; &nbsp;</label>
            <select class="form-control select-bar select2" id="thanhphonoidi" name="thanhphonoidi">
                @foreach($province as $item)
                    @if(Request::input('thanhphonoidi') == $item['tenTP'])
                        <option value="{{ $item['tenTP'] }}" selected>{{ $item['tenTP']}}</option>
                    @endif
                    <option value="{{ $item['tenTP'] }}">{{ $item['tenTP']}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group col-sm-2">
                <a href="#" class="switch_thanhpho" data-placement="bottom" data-toggle="tooltip"
                   title="Chuyển nơi đi - nơi đến">
                    <span class="glyphicon glyphicon-resize-horizontal"></span>
                </a>
            </div>
        </div>


        <div class="form-group col-sm-3">
            <label for="thanhphonoiden" class="form-control-static">Nơi đến: &nbsp; &nbsp;</label>
            <select name="thanhphonoiden" id="thanhphonoiden" class="form-control select-bar select2">
                @foreach($province as $item)
                    @if(Request::input('thanhphonoiden') == $item['tenTP'])
                        <option value="{{  $item['tenTP'] }}" selected>{{  $item['tenTP'] }}</option>
                    @endif
                    <option value="{{  $item['tenTP'] }}">{{  $item['tenTP'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-sm-3">
            {!! Form::label('ngaykhoihanh', 'Khởi hành: ') !!} &nbsp;&nbsp;
            <div style="width: 63%" id="datepicker" class="input-group date" data-date-format="dd/mm/yyyy">
                <input class="form-control input-sm" type="text" name="ngaykhoihanh"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>

        <div class="col-sm-2">
            <button class="btn btn-primary input-sm" style="font-size: 12px" type="submit"><b>Tìm kiếm</b></button>
        </div>
    </form>
</div>

<script type="text/javascript" src="{{ asset('plugins/select2/select2.full.js') }}"></script>
<script type="text/javascript">

    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        $('.switch_thanhpho').click(function () {
            tpnoidi = $('#thanhphonoidi').val();
            tpnoiden = $('#thanhphonoiden').val();

            $('#thanhphonoidi').select2("val", tpnoiden);

            $('#thanhphonoiden').select2("val", tpnoidi);

        });


        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false,
        });
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());

        @if(Request::input('ngaykhoihanh') != null && Request::input('ngaykhoihanh') != "")
         $("#datepicker").datepicker("setDate", "{{ Request::input('ngaykhoihanh') }}");
        @endif
                $(document).ready(function () {
            $("form").submit(function () {
                x = $('#tieuchi').val();
                $('#sort').attr('value', x);
            })
        });
    });
</script>