@extends('layouts.app')
@section('content')

    @include('partials.search-bar')

    {{--slide show would be here--}}
    <img src="images/car.jpg" class="img-responsive img-rounded img_slideshow">
    @include('partials.filter_tieuchi')
    @include('flash')

    @include('partials.timxe')

    @include('partials.timkhach')
    <div class="text-right">
        @if(isset($tindang_taixes))
            {!! $tindang_taixes->render() !!}
        @else
            {!! $tindang_hanhkhaches->render() !!}
        @endif
    </div>

    @include('partials.script_style.option_tindang'){{-- style and script for option tindang --}}
@stop
