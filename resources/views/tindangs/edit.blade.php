@extends('layouts.app')

@section('content')
    <div style=" color: black; background: white; overflow: hidden">
      @include('flash')
     {!! Form::model($tindang, ['method' => 'PATCH', 'class' =>'col-sm-10 col-sm-offset-1' ,'action' => ['TindangsController@update', $tindang->id]]) !!}

        @include('tindangs.form',['submitButtonText' => 'Cập nhật'])

     {!! Form::close() !!}
    </div>
@stop