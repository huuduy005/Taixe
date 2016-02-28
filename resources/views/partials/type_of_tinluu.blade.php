@inject('loaitins', 'App\Loaitin')

{{-- */ $loaitins = $loaitins::all()/*--}}



<div class="row">
    <select id="type" class="form-control typeOfTinLuu"
            style="width: 15%; float: right;margin-right: 14px; margin-top: 10px; font-weight: normal; font-size: 12px">
        @foreach($loaitins as $loaitin)
                <option value="{{ $loaitin->id }}"
                @if(app("request")->input("loaitin_id") == $loaitin->id)
                    selected
                @endif
                >{{ $loaitin->tenLT }}</option>
        @endforeach
    </select>
</div>

<script>

    $(
            $('#type').change(function () {
                window.location.replace("/dashboard?loaitin_id=" + this.value)
            })
    )
</script>
<div style="margin-top: 3px"></div>