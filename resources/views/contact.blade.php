@extends('layouts.welcome')

@section('content')

    @include('components.search')

    <style>
        .fixed-top {
            position: inherit;
        }

    </style>
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">{{ __('Contact Us') }}</h1>
                        <span
                            class="color-text-a">{{ __("Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book") }}</span>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home', [app()->getLocale()]) }}">{{ __('Home') }}</a>
                            </li>
                            <li class="mx-2">/</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ __('Contact') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section><!-- End Intro Single-->

    <!-- ======= Contact Single ======= -->
    <section class="contact">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="contact-map box">
                        <div id="map" class="contact-map">
                            <iframe src="https://maps.google.com/maps?q=25.363882,51.436319&hl=es&z=14&amp;output=embed"
                                width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
                            {{-- <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834"
                                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                            --}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 section-t8">
                    <div class="row">
                        <div class="col-md-7">
                            <form action="{{ route('contact.store', app()->getLocale()) }}" method="POST" role="form"
                                class="php-email-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="name"
                                                class="form-control form-control-lg form-control-a" placeholder="{{__('Name')}}"
                                                data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                                            <small class="text-danger">@error('name'){{ $message }}@enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <input name="email" type="email"
                                                class="form-control form-control-lg form-control-a" placeholder="{{__('Email address')}}"
                                                data-rule="email" data-msg="Please enter a valid email">
                                            <small class="text-danger">@error('email'){{ $message }}@enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <input type="text" name="phone"
                                                class="form-control form-control-lg form-control-a" placeholder="{{__('Subject')}}"
                                                data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject">
                                            <small class="text-danger">@error('phone'){{ $message }}@enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" name="message" cols="45" rows="8"
                                                data-rule="required" data-msg="Please write something for us"
                                                placeholder="{{__('Message')}}"></textarea>
                                            <small class="text-danger">@error('message'){{ $message }}@enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-a">{{__('Send Message')}}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-5 section-md-t3">
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="ion-ios-paper-plane"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">Say Hello</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <p class="mb-1">{{__('Email')}}.
                                            <span class="color-a">contact@example.com</span>
                                        </p>
                                        <p class="mb-1">{{__('Phone')}}.
                                            <span class="color-a">+54 356 945234</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box section-b2">
                                <div class="icon-box-icon">
                                    <span class="ion-ios-pin"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">{{__('Find us in')}}</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <p class="mb-1">
                                            Manhattan, Nueva York 10036,
                                            <br> EE. UU.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="icon-box">
                                <div class="icon-box-icon">
                                    <span class="ion-ios-redo"></span>
                                </div>
                                <div class="icon-box-content table-cell">
                                    <div class="icon-box-title">
                                        <h4 class="icon-title">{{__('Social networks')}}</h4>
                                    </div>
                                    <div class="icon-box-content">
                                        <div class="socials-footer">
                                            <ul class="list-inline">
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#" class="link-one">
                                                        <i class="fa fa-dribbble" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Contact Single-->

@endsection
