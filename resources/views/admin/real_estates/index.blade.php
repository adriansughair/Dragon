@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Real Estates') }}</h1>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Is paid') }}</th>
                <th>{{ __('By') }}</th>
            </thead>

            <body>
                @foreach ($realEstates as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->paid ? __('Yes') : __('No') }}</td>
                        <td>{{ $item->user()->first()->name }}</td>
                        <td>
                            @csrf
                            <a target="_blank" href="{{ route('realestates.show', [app()->getLocale(), $item->id]) }}"
                                class="btn btn-outline-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a target="_blank" href="{{ route('admin.comments', [app()->getLocale(), $item->id]) }}"
                                class="btn btn-outline-primary">
                                <i class="fa fa-comments"></i>
                            </a>
                            <form class="d-inline-block" action="{{ route('realestates.destroy', [app()->getLocale(), $item->id]) }}" method="POST">
                                @method("DELETE")
                                @csrf
                                <button href="{{ route('realestates.show', [app()->getLocale(), $item->id]) }}"
                                    class="btn btn-outline-danger">
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
