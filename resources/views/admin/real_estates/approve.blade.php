@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Real Estates') }}</h1>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('By') }}</th>
            </thead>

            <body>
                @foreach ($realEstates as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->price }}</td>
                        <td>{{ $item->user()->first()->name }}</td>
                        <td>
                            <form action="{{ route('admin.approve_real_estate', [app()->getLocale(), $item->id]) }}"
                                method="POST">
                                @csrf
                                <a target="_blank" href="{{ route('realestates.show', [app()->getLocale(), $item->id]) }}"
                                    class="btn btn-outline-primary">
                                    <i class="fa fa-eye"></i>
                                 </a>
                                <button type="submit" class="btn btn-primary">{{ __('Approve') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>

@endsection
