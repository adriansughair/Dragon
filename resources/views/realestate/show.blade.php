@extends('layouts.welcome')


@section('content')
@include('components.search')
    <style>
        .fixed-top {
            position: inherit;
        }

    </style>

    <!-- ======= Intro Single ======= -->
    <section class="intro-single pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h1 class="title-single">{{ $realEstate->title }}</h1>
                            <form id="like-form" action="{{ route('like', [app()->getLocale(), $realEstate->id]) }}"
                                method="POST">
                                @csrf
                                @auth
                                   @if (Route::has('login'))
                                
                                <div id="like-house" class="d-flex justify-content-start align-items-center">
                                    <i class="fa fa-2x{{ $liked ? ' fa-heart' : ' fa-heart-o' }}"></i>
                                    <span class="container">{{ __('Add to favorites') }}</span>
                                </div>
                                
                              @endif
							  @endauth
                            </form>
                        </div>
                        <span class="color-text-a">{{ $realEstate->district }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home', [app()->getLocale()]) }}">{{ __('Home') }}</a>
                            </li>
                            <li class="mx-2">/</li>
                            <li class="breadcrumb-item">
                                <a
                                    href="{{ route('realestates.index', [app()->getLocale()]) }}">{{ __('Real Estates') }}</a>
                            </li>
                            <li class="mx-2">/</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $realEstate->title }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Property Single ======= -->
    <section class="property-single nav-arrow-b">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">
                        @if ($realEstate->offerType==2)
                                		<img src="http://52.202.149.74/Dragon.RE_web_dev/public/files/matlop.jpg1608903801.jpeg" alt="" class="img-a">
                        @else
	                        @foreach ($realEstate->gallery as $item)
    	                        <div class="carousel-item-b">
        	                        <img src="{{ asset($item->filepath) }}" alt="">
            	                </div>
                	        @endforeach 
                	    @endif
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-5 col-lg-4">
                            <div class="property-price d-flex justify-content-center foo">
                                <div class="card-header-c d-flex">
                                    <div class="card-box-ico">
                                        <span class="ion-money">QAR</span>
                                    </div>
                                    <div class="card-title-c align-self-center">
                                        <h5 class="title-c">{{ $realEstate->price }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="property-summary">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title-box-d section-t4">
                                            <h3 class="title-d">{{ __('Quick Summary') }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="summary-list">
                                    <ul class="list">
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Real Estate ID') }}:</strong>
                                            <span>{{ $realEstate->id }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Location') }}:</strong>
                                            <span>{{ $realEstate->district }}</span>
                                        </li>
                                        {{-- <li class="d-flex justify-content-between">
                                            <strong>{{ __('Real Estate Type') }}:</strong>
                                            <span>House</span>
                                        </li> --}}
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Offer Type') }}:</strong>
                                            <span>{{ $realEstate->offerType ? __('sale') : __('rent') }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Area') }}:</strong>
                                            <span>{{ $realEstate->area }}m
                                                <sup>2</sup>
                                            </span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Beds') }}:</strong>
                                            <span>{{ $realEstate->rooms }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Baths') }}:</strong>
                                            <span>{{ $realEstate->baths }}</span>
                                        </li>
                                        <li class="d-flex justify-content-between">
                                            <strong>{{ __('Garage') }}:</strong>
                                            <span>{{ $realEstate->parkings }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-lg-7 section-md-t3">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">{{ __('Description') }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="property-description">
                                <p class="description color-text-a">
                                    {{ __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book") }}
                                </p>
                                <p class="description color-text-a no-margin">
                                    {{ __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book") }}
                                </p>
                            </div>
                            {{-- <div class="row section-t3">
                                <div class="col-sm-12">
                                    <div class="title-box-d">
                                        <h3 class="title-d">Amenities</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="amenities-list color-text-a">
                                <ul class="list-a no-margin">
                                    <li>Balcony</li>
                                    <li>Outdoor Kitchen</li>
                                    <li>Cable Tv</li>
                                    <li>Deck</li>
                                    <li>Tennis Courts</li>
                                    <li>Internet</li>
                                    <li>Parking</li>
                                    <li>Sun Room</li>
                                    <li>Concrete Flooring</li>
                                </ul>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-10 offset-md-1">
                    <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
                        {{-- <li class="nav-item">
                            <a class="nav-link active" id="pills-video-tab" data-toggle="pill" href="#pills-video"
                                role="tab" aria-controls="pills-video" aria-selected="true">{{ __('Video') }}</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="pills-plans-tab" data-toggle="pill" href="#pills-plans" role="tab"
                                aria-controls="pills-plans" aria-selected="false">{{ __('Agent') }}</a>
                        </li> --}}
                        @if ($location)
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-map-tab" data-toggle="pill" href="#pills-map"
                                    role="tab" aria-controls="pills-map" aria-selected="false">{{ __('Location') }}</a>
                            </li>
                        @endif
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        {{-- <div class="tab-pane fade show active" id="pills-video"
                            role="tabpanel" aria-labelledby="pills-video-tab">
                            <iframe src="https://player.vimeo.com/video/73221098" width="100%" height="460" frameborder="0"
                                webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </div> --}}
                        {{-- <div class="tab-pane fade" id="pills-plans" role="tabpanel"
                            aria-labelledby="pills-plans-tab">
                            <img src="assets/img/plan2.jpg" alt="" class="img-fluid">
                        </div> --}}
                        @if ($location)
                            <div class="tab-pane fade show active" id="pills-map" role="tabpanel"
                                aria-labelledby="pills-map-tab">
                                <iframe
                                    src="https://maps.google.com/maps?q={{ $location[0] }},{{ $location[1] }}&hl=es&z=14&amp;output=embed"
                                    width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row section-t3">
                        <div class="col-sm-12">
                            <div class="title-box-d">
                                <h3 class="title-d">{{ __('Contact Agent') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <img src="https://lightningdesignsystem.com/assets/images/avatar2.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="property-agent">
                                <h4 class="title-agent">{{ ucfirst($realEstate->user()->first()->name) }}</h4>
                                <p class="color-text-a">
                                    {{ __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book") }}
                                </p>
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between">
                                        <strong>{{ __('Phone') }}:</strong>
                                        <span class="color-text-a">{{ $realEstate->user()->first()->phone_number }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <strong>{{ __('Whatsapp') }}:</strong>
                                        <span class="color-text-a">{{ $realEstate->user()->first()->whatsapp }}</span>
                                    </li>
                                </ul>
                                {{-- <div class="socials-a">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-facebook" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-twitter" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-instagram" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-dribbble" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-12 col-lg-4">
                            <div class="property-contact">
                                <form class="form-a">
                                    <div class="row">
                                        <div class="col-md-12 mb-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-lg form-control-a"
                                                    id="inputName" placeholder="Name *" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-lg form-control-a"
                                                    id="inputEmail1" placeholder="Email *" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-1">
                                            <div class="form-group">
                                                <textarea id="textMessage" class="form-control" placeholder="Comment *"
                                                    name="message" cols="45" rows="8" required></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-a">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                    </div>
                </div>
                @auth
                    @include('realestate.components.comments')
                @endauth

            </div>
        </div>
    </section><!-- End Property Single-->
    <script>
        $('#like-house').on('click', function() {
            $('#like-form').submit()
        })

    </script>
@endsection
