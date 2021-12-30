@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 class="title py-5">{{__('Welcome')}} {{auth()->user()->name}}</h1>
    </div>

@endsection
