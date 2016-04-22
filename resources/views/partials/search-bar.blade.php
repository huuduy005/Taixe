<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
<style>
    #search .form-group{
        padding-left: 5%;
    }
</style>

@inject('provinces', 'App\Thanhpho')
{{-- */ $province = $provinces::all();/* --}}
<div class="row border_radius" id="search">
    <form class="form-inline" action="{{ Request::url() }}" method="GET" role="form">
        <input type="hidden" name="sort" id="sort" value="test">
        <div class="form-group">
            <label for="thanhphonoidi" class="form-control-static">Nơi đi: &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select class="form-control select-bar select2" id="thanhphonoidi" name="thanhphonoidi">
                @foreach($province as $item)
                    @if(Request::input('thanhphonoidi') == $item['tenTP'])
                        <option value="{{ $item['tenTP'] }}" selected>{{ $item['tenTP']}}</option>
                    @endif
                    <option value="{{ $item['tenTP'] }}">{{ $item['tenTP']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <a href="#" class="switch_thanhpho">
                <span class="glyphicon glyphicon-resize-horizontal"></span>
            </a>
        </div>

        <div class="form-group">
            <label for="thanhphonoiden"  class="form-control-static">Nơi đến: &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="thanhphonoiden" id="thanhphonoiden" class="form-control select-bar col-sm-12 select2">
                @foreach($province as $item)
                    @if(Request::input('thanhphonoiden') == $item['tenTP'])
                        <option value="{{  $item['tenTP'] }}" selected>{{  $item['tenTP'] }}</option>
                    @endif
                    <option value="{{  $item['tenTP'] }}">{{  $item['tenTP'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {!! Form::label('ngaykhoihanh', 'Khởi hành: ') !!}
            <div style="padding-left: 10px" id="datepicker" class="input-group date col-sm-7" data-date-format="dd/mm/yyyy">
                <input class="form-control input-sm" type="text" name="ngaykhoihanh"/>
                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
        </div>

        <button class="btn btn-primary input-sm" style="font-size: 12px" type="submit"><b>Tìm kiếm</b></button>
    </form>
</div>

<script type="text/javascript" src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        $('.switch_thanhpho').click(function () {
            tpnoidi = $('#thanhphonoidi').val();
            tpnoiden = $('#thanhphonoiden').val();

            $('#thanhphonoidi').val(tpnoiden);

            $('#thanhphonoiden').val(tpnoidi);

        });

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false,
        });
        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true,
        }).datepicker('update', new Date());

        $(document).ready(function () {
            $("form").submit(function () {
                x = $('#tieuchi').val();
                $('#sort').attr('value', x);
            })
        });
    });
</script>