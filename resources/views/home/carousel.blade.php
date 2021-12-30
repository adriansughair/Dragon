<div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">
        @foreach ($banners as $index => $banner)
	         @if ($banner->offerType==2)
                <div class="carousel-item-a intro-item bg-image" style="background-image: url(http://52.202.149.74/Dragon.RE_web_dev/public/files/matlop.jpg1608903801.jpeg)">
       	    @else
                <div class="carousel-item-a intro-item bg-image" style="background-image: url({{@asset($banner->gallery[0]->filepath)}})">
       	    @endif
        
                <div class="overlay overlay-a"></div>
                <div class="intro-content display-table">
                    <div class="table-cell">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="intro-body">
                                        <p class="intro-title-top">{{$banner->district}}
                                        </p>
                                        <h1 class="intro-title mb-4">
                                            {{$banner->title}}
                                        </h1>
                                        <p class="intro-subtitle intro-price">
                                            <a href="{{ route('realestates.show', [app()->getLocale(), $banner->id]) }}"><span class="price-a">{{$banner->offerType ? __('sale') : __('rent')}} | {{__('QAR')}} {{$banner->price}} </span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div><!-- End Intro Section -->

