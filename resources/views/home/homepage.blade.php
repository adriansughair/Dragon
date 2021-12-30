@extends('layouts.welcome')

{{-- {{dd(auth()->user()->roles()->get())}} --}}

@section('content')

    @include('components.search')
    @include('home.carousel')
    @include('home.latest_properties')
    @include('home.testimonials')

@endsection
