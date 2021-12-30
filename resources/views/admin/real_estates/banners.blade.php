@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Banners') }}</h1>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Rooms') }}</th>
                <th>{{ __('Distdict') }}</th>
                <th>{{ __('Offer Type') }}</th>
                <th>{{ __('By') }}</th>
            </thead>

            <body>
                @foreach ($banners as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->rooms . ' + ' . $item->baths }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->offerType ? __('For Sale') : __('For Rent') }}</td>
                        <td>{{ $item->user()->first()->name }}</td>
                        <td>
                            <form action="{{ route('admin.toggle_banner', [app()->getLocale(), $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{ __('Remove from banners') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>

    <div class="container">
        <h1 class="title py-5">{{ __('Real Estates') }}</h1>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Rooms') }}</th>
                <th>{{ __('Distdict') }}</th>
                <th>{{ __('Offer Type') }}</th>
                <th>{{ __('By') }}</th>
            </thead>

            <body>
                @foreach ($not_banners as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->rooms . ' + ' . $item->baths }}</td>
                        <td>{{ $item->district }}</td>
                        <td>{{ $item->offerType ? __('For Sale') : __('For Rent') }}</td>
                        <td>{{ $item->user()->first()->name }}</td>
                        <td>
                            <form action="{{ route('admin.toggle_banner', [app()->getLocale(), $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">{{ __('Add as banner') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>

@endsection
