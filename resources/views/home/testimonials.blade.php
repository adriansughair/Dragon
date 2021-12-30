<!-- ======= Testimonials Section ======= -->
<section class="section-testimonials section-t8 nav-arrow-a">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-wrap d-flex justify-content-between">
                    <div class="title-box">
                        <h2 class="title-a">{{ __('Testimonials') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div id="testimonial-carousel" class="owl-carousel owl-arrow">
            @foreach ($testimonials as $item)
                <div class="carousel-item-a">
                    <div class="testimonials-box">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="testimonial-img">
                                    <img src="{{ asset($item->image) }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="testimonial-ico">
                                    <span class="ion-ios-quote"></span>
                                </div>
                                <div class="testimonials-content">
                                    <p class="testimonial-text">{{ $item->body }}</p>
                                </div>
                                <div class="testimonial-author-box">
                                    <img src="assets/img/mini-testimonial-1.jpg" alt="" class="testimonial-avatar">
                                    <h5 class="testimonial-author">{{ $item->name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{-- <div class="carousel-item-a">
                <div class="testimonials-box">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="testimonial-img">
                                <img src="https://lightningdesignsystem.com/assets/images/avatar2.jpg" alt=""
                                    class="img-fluid">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="testimonial-ico">
                                <span class="ion-ios-quote"></span>
                            </div>
                            <div class="testimonials-content">
                                <p class="testimonial-text">
                                    {{ __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book") }}.
                                </p>
                            </div>
                            <div class="testimonial-author-box">
                                <img src="assets/img/mini-testimonial-2.jpg" alt="" class="testimonial-avatar">
                                <h5 class="testimonial-author">Pablo & Emma</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section><!-- End Testimonials Section -->
