@extends('layouts.welcome')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Create new Real Estate') }}</h1>
        <form method="POST" action="{{ route('admin.store_testimonial', app()->getLocale()) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="name"><b>{{ __('Name') }}</b></label>
                <input class="form-control" name="name" id="name" type="text">
                <small class="text-danger">@error('name'){{ $message }}@enderror</small>
            </div>
            <div class="form-group mb-3">
                <label for="images"><b>{{ __('Image') }}</b></label>
                <input required type="file" class="form-control" name="image" id="images" placeholder="address">
                <small class="text-danger">@error('images'){{ $message }}@enderror</small>
            </div>
            <div class="form-group mb-3">
                <label for="body"><b>{{ __('Body') }}</b></label>
                <textarea class="form-control" name="body" id="body" rows="3"></textarea>
                <small class="text-danger">@error('body'){{ $message }}@enderror</small>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
        </form>
    </div>

@endsection
