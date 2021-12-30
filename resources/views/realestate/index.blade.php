@extends('layouts.welcome')

@section('content')
    @include('components.search')
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">{{ $isFavorite ? __('My Favorites') : __('Our Amazing Properties') }}</h1>
                        <span class="color-text-a">{{ __('Grid Properties') }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">{{ __('Home') }}</a>
                            </li>
                            <li class="mx-2">/</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $isFavorite ? __('My Favorites') : __('Real Estates') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->
    {{-- {{ dd($type) }} --}}
    <!-- ======= Property Grid ======= -->
    <section class="property-grid grid">
        <div class="container">
            <div class="col-sm-12">
                <div class="grid-option row">
                    <select class="custom-select" id="offerTypeFilter">
                        <option {{ !$type ? ' selected' : '' }} value="null">{{ __('Any') }}</option>
                        <option {{ $type == 'rent' ? ' selected' : '' }} value="rent">{{ __('For rent') }}</option>
                        <option {{ $type == 'sale' ? ' selected' : '' }} value="sale">{{ __('For sale') }}</option>
                        <option {{ $type == 'required' ? ' selected' : '' }} value="required">{{ __('Required') }}</option>
                        <option {{ $type == 'Lands' ? ' selected' : '' }} value="Lands">{{ __('Lands') }}</option>
                    </select>
                    <button type="button" class="btn btn-b-n navbar-toggle-box-collapse mx-2" data-toggle="collapse"
                        data-target="#navbarTogglerDemo01" aria-expanded="false">
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </button>
                </div>
            </div>
            <div class="row">
                @if (count($realEstates) == 0)
                    <div class="container">{{ __('No items') }}</div>
                @endif
                @foreach ($realEstates as $item)
                    <div class="col-md-4">
                        <div class="card-box-a card-shadow">
                            <div class="offerType">{{$item->tax == '0' ? __('Without commision') : __('With commision')}}</div>
                               <div class="img-box-a">
                            	 @if ($item->offerType==2)
                                		<img src="http://52.202.149.74/Dragon.RE_web_dev/public/files/matlop.jpg1608903801.jpeg" alt="" class="img-a">
                            	   @else
                             		<img src="{{ asset($item->gallery()->get()->first()['filepath']) }}" alt="" class="img-a">
                                  @endif
                                </div>
                            <div class="card-overlay">
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ route('realestates.show', [app()->getLocale(), $item->id]) }}">{{ $item->title }}
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="price-a">{{ $item->offerType ? __('sale') : __('rent') }} | {{__('QAR')}}
                                                {{ $item->price }}</span>
                                        </div>
                                        <a href="{{ route('realestates.show', [app()->getLocale(), $item->id]) }}"
                                            class="link-a">{{ __('Click here to view') }}
                                            <span
                                                class="ion-ios-arrow-{{ app()->getLocale() == 'ar' ? 'back' : 'forward' }}"></span>
                                        </a>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">{{ __('Area') }}</h4>
                                                <span>{{ $item->area }}m
                                                    <sup>2</sup>
                                                </span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Beds') }}</h4>
                                                <span>{{ $item->rooms }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Baths') }}</h4>
                                                <span>{{ $item->baths }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Garages') }}</h4>
                                                <span>{{ $item->parkings }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <nav class="pagination-a">
                        <ul class="pagination justify-content-end">
                            {{ $realEstates->withQueryString()->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Property Grid Single-->
    <script>
        $('#offerTypeFilter').change(function(e) {
            let type = e.target.value != 'null' ? '?offerType=' + e.target.value : ''
            let route = ''
            if ("{{ $isFavorite }}") {
                route = "{{ route('realestates.favorite', app()->getLocale()) }}"
            } else {
                route = "{{ route('realestates.index', app()->getLocale()) }}"
            }
            window.location = route + type
        })

    </script>
@endsection
