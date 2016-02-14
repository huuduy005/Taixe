<div class="row search-bar">
    <select id="tieuchi" class="form-control text-right"
            style="width: 15%; float: right; margin-right: 14px; margin-top: 10px; font-weight: normal; font-size: 12px">
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

<script>

    $(
            $('#tieuchi').change(function () {
                window.location.replace("{{Request::url()}}?sort=" + this.value)
            })
    )
</script>
<div style="margin-top: 3px"></div>