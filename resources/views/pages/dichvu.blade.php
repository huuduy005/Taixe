@extends('layouts.app')
@section('content')

    @include('flash')
    @include('partials.dichvu')

    <div class="text-right">
        {!! $tin_dichvus->render() !!}
    </div>

    @include('partials.script_style.option_tindang'){{-- style and script for option tindang --}}
@stop