@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Comments') }}</h1>
        <table class="table table-stdiped">
            <thead>
                <th>{{ __('id') }}</th>
                <th>{{ __('Real Estate') }}</th>
                <th>{{ __('Text') }}</th>
                <th>{{ __('By') }}</th>
            </thead>

            <body>
                @foreach ($comments as $item)
                    <tr>
                        <td><b>{{ $item->id }}</b></td>
                        <td>
                            <a target="_blank"
                                href="{{ route('realestates.show', [app()->getLocale(), $item->realEstate()->first()->id]) }}#comment-{{$item->id}}">{{ $item->realEstate()->first()->title }}</a>
                        </td>
                        <td>{{ strlen($item->text) > 20 ? substr($item->text, 0, 20) . ' ...' : $item->text }}</td>
                        <td>{{ $item->user()->first()->name }}</td>
                        <td>
                            <form action="{{ route('admin.remove_comment', [app()->getLocale(), $item->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">{{ __('Remove') }}</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </body>
        </table>
    </div>

@endsection
