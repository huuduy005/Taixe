<div class="row admin-div-timkiem">
    <hr>
    <div class="col-sm-2"></div>
    <div class="form-group col-sm-8">
        {!! Form::label('thanhpho_search', $name, ['class' => 'col-sm-3']) !!}
        <div class="col-sm-9">
            {!! Form::text('thanhpho_search', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group text-center col-sm-2">
        {!! Form::button('Tìm', ['class' => 'btn btn-primary button-form-search']) !!}
    </div>
</div>
<hr>