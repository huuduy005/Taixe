@extends('layouts.app')

@section('content')

    <div style=" color: black; background: white; overflow: hidden">
        @include('flash')
        <form method="POST" action="/dangtin" class="col-sm-10 col-sm-offset-1">
           @include('tindangs.form',['submitButtonText' => 'Đăng tin'])
        </form>
    </div>

@stop