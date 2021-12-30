    <!-- ======= Latest Properties Section ======= -->
    <section class="section-property section-t8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-wrap d-flex justify-content-between">
                        <div class="title-box">
                            <h2 class="title-a">{{ __('Latest Properties') }}</h2>
                        </div>
                        <div class="title-link">
                            <a href="{{ route('realestates.index', app()->getLocale()) }}">{{ __('More') }}
                                <span
                                    class="ion-ios-arrow-{{ app()->getLocale() == 'ar' ? 'back' : 'forward' }}"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="property-carousel" class="owl-carousel owl-theme">
                @foreach ($latestProperties as $prop)
                    <div class="carousel-item-b">
                        <div class="card-box-a card-shadow">
                            <div class="offerType">
                                {{ $prop->tax == '0' ? __('With commision') : __('Without commision') }}</div>
                            <div class="img-box-a">
                                   @if (@$prop->offerType==2)
                                		<img src="http://52.202.149.74/Dragon.RE_web_dev/public/files/matlop.jpg1608903801.jpeg" alt="" class="img-a">
                            	   @else
                             		<img src="{{ asset(@$prop->gallery[0]->filepath) }}" alt="" class="img-a">
                                  @endif
                                </div>
                            <div class="card-overlay">
                                <div class="card-overlay-a-content">
                                    <div class="card-header-a">
                                        <h2 class="card-title-a">
                                            <a href="{{ route('realestates.show', [app()->getLocale(), $prop->id]) }}">{{ $prop->title }}
                                                {{-- <br /> Olive Road Two</a>
                                            --}}
                                        </h2>
                                    </div>
                                    <div class="card-body-a">
                                        <div class="price-box d-flex">
                                            <span class="price-a">{{ $prop->offerType ? __('sale') : __('rent') }} | {{__('QAR')}}
                                                {{ $prop->price }}</span>
                                        </div>
                                        <a href="{{ route('realestates.show', [app()->getLocale(), $prop->id]) }}"
                                            class="link-a">{{ __('Click here to view') }}
                                            <span
                                                class="ion-ios-arrow-{{ app()->getLocale() == 'ar' ? 'back' : 'forward' }}"></span>
                                        </a>
                                    </div>
                                    <div class="card-footer-a">
                                        <ul class="card-info d-flex justify-content-around">
                                            <li>
                                                <h4 class="card-info-title">{{ __('Area') }}</h4>
                                                <span>{{ $prop->area }}
                                                    {{-- m<sup>2</sup>
                                                    --}}
                                                </span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Beds') }}</h4>
                                                <span>{{ $prop->rooms }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Baths') }}</h4>
                                                <span>{{ $prop->baths }}</span>
                                            </li>
                                            <li>
                                                <h4 class="card-info-title">{{ __('Garages') }}</h4>
                                                <span>{{ $prop->parkings }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Latest Properties Section -->
