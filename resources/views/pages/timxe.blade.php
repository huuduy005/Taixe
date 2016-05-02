@extends('layouts.app')
@section('content')

    @include('partials.search-bar')
    @include('partials.filter_tieuchi')
    @include('flash')
    @include('partials.timxe')

    <div class="text-right">
        {!! $tindang_taixes->appends(Request::except('page'))->render() !!}
    </div>

    @include('partials.script_style.option_tindang'){{-- style and script for option tindang --}}
@stop
