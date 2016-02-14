@extends('layouts.app')
@section('content')

    @include('partials.search-bar')
    @include('flash')
    @include('partials.timkhach')

    <div class="text-right">
        {!! $tindang_hanhkhaches->render() !!}
    </div>

    @include('partials.script_style.option_tindang'){{-- style and script for option tindang --}}
@stop
