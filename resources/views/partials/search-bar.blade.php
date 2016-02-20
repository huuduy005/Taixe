@inject('provinces', 'App\Thanhpho')
{{-- */ $province = $provinces::all();/* --}}
<div class="row container-fluid border_radius" id="search">
    <form action="{{ Request::url() }}" role="form" method="GET">
        <input type="hidden" name="sort" id="sort" value="test">
        <div class="col-sm-12">
            <div class="col-sm-3 text-left search_info">
                <label for="thanhphonoidi">Nơi đi</label>
                <select class="form-control col-sm-2 select-bar" id="thanhphonoidi" name="thanhphonoidi">
                    @foreach($province as $item)
                        @if(Request::input('thanhphonoidi') == $item['tenTP'])
                            <option value="{{ $item['tenTP'] }}" selected>{{ $item['tenTP']}}</option>
                        @endif
                            <option value="{{ $item['tenTP'] }}">{{ $item['tenTP']}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1 text-right">
                <a href="#" class="switch_thanhpho">
                    <span class="glyphicon glyphicon-resize-horizontal"></span>
                </a>
            </div>
            <div class="col-sm-3 text-left search_info">
                <label for="thanhphonoiden">Nơi đến</label>
                <select name="thanhphonoiden" id="thanhphonoiden" class="form-control select-bar">
                    @foreach($province as $item)
                        @if(Request::input('thanhphonoiden') == $item['tenTP'])
                            <option value="{{  $item['tenTP'] }}" selected>{{  $item['tenTP'] }}</option>
                        @endif
                            <option value="{{  $item['tenTP'] }}">{{  $item['tenTP'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-3 search_info text-left">
                {!! Form::label('ngaykhoihanh', 'Khởi hành') !!}
                <div id="datepicker" class="input-group date col-sm-8" data-date-format="dd/mm/yyyy">
                    <input class="form-control" type="text" name="ngaykhoihanh"/>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>

            <div class="col-sm-2 text-center">
                <button class="btn btn-default search_info" type="submit"><b>Tìm kiếm</b></button>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">


    $('.switch_thanhpho').click(function(){
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

</script>