<div class="row search-bar"
     style=" width: 100%; margin: 2px 0 5px 0; font-weight: normal; font-size: 12px">
    <div class="col-md-10"></div>
    <div class="col-md-2">
        <select id="tieuchi" class="form-control text-right select2">
            @if(app("request")->input('sort')=="giatangdan")
                <option value="giatangdan" selected>Giá tăng dần</option>
                <option value="giagiamdan">Giá giảm dần</option>
                <option value="ngaydang">Ngày đăng</option>
            @elseif(app("request")->input('sort')=="giagiamdan")
                <option value="giatangdan">Giá tăng dần</option>
                <option value="giagiamdan" selected>Giá giảm dần</option>
                <option value="ngaydang">Ngày đăng</option>
            @else
                <option value="giatangdan">Giá tăng dần</option>
                <option value="giagiamdan">Giá giảm dần</option>
                <option value="ngaydang" selected>Ngày đăng</option>
            @endif
        </select>
    </div>
</div>

<script>
    //Initialize Select2 Elements
    $(".select2").select2();

    $('#tieuchi').change(function () {
        window.location.replace("{{Request::url()}}?sort=" + this.value)
    })
</script>
<div style="margin-top: 3px"></div>