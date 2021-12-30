@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="title py-5">{{ __('Testimonials') }}</h1>
            <a href="{{ route('admin.add_testimonial', app()->getLocale()) }}" class="d-flex justify-content-between align-items-center">
                <i class="fa fa-plus fa-2x col"></i>
                <span>{{ __('Add new testimonial') }}</span>
            </a>
        </div>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Body') }}</th>
            </thead>

            <body>
                @foreach ($testimonials as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->image }}</td>
                        <td>{{ $item->body }}</td>
                        <td>
                            <form class="d-inline-block"
                                action="{{ route('admin.remove_testimonial', [app()->getLocale(), $item->id]) }}"
                                method="POST">
                                {{-- @method("DELETE") --}}
                                @csrf
                                <button class="btn btn-outline-danger">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>

@endsection
