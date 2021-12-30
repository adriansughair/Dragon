@php
// $fixed = url()->current() == route('login', app()->getLocale()) ? '' : ' fixed-top';
$target = app()->getLocale() == 'ar' ? 'en' : 'ar';
$selected = app()->getLocale();
$currentUrl = str_replace($selected, $target, url()->current());
@endphp
<!-- ======= Header/Navbar ======= -->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
            aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand" href="{{ url('/') . '/' . app()->getLocale() }}">
            <img class="w-100" src="{{ asset('images/header.png') }}" alt="logo" srcset="">
        </a>
        <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none"
            data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
            <span class="fa fa-search" aria-hidden="true"></span>
        </button>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about', app()->getLocale()) }}">{{ __('About') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('realestates.index', app()->getLocale()) }}">{{ __('Real Estates') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('contact.index', app()->getLocale()) }}">{{ __('Contact Us') }}</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @if (app()->getLocale() == 'ar')
                    <div class="row navbar-buttons">
                        <button type="button"
                            class="btn btn-success d-sm-none navbar-toggle-box-collapse d-none d-md-block ml-2"
                            data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
                            <span class="fa fa-search" aria-hidden="true"></span>
                        </button>
                        <a class="btn btn-b-n d-sm-none d-none d-md-block language-button ml-2"
                            href="{{ $currentUrl }}">
                            <span>En</span>
                        </a>
                    </div>
                @endif
                @guest
                    <div class="d-flex align-items-center">
                        <a href="{{ route('login', app()->getLocale()) }}" class="btn btn-success">
                            {{ __('Login') }}
                        </a>
                        <div class="mx-3">{{ __('OR') }}</div>
                        <a href="{{ route('register', app()->getLocale()) }}" class="btn btn-success">
                            {{ __('Register') }}
                        </a>
                    </div>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('realestates.create', app()->getLocale()) }}">
                                {{ __('Add new Real Estate') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('realestates.favorite', app()->getLocale()) }}">
                                {{ __('My Favorites') }}
                            </a>
                            @can('manage-website', Model::class)
                                <a target="_blank" class="dropdown-item" href="{{ route('admin', app()->getLocale()) }}">
                                    {{ __('Admin Dashboard') }}
                                </a>
                            @endcan
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                @if (app()->getLocale() == 'en')
                    <div class="row navbar-buttons">
                        <a class="btn btn-success d-sm-none d-none d-md-block language-button" href="{{ $currentUrl }}">
                            <span>ع</span>
                        </a>
                        <button type="button"
                            class="btn btn-b-n d-sm-none navbar-toggle-box-collapse d-none d-md-block mx-2"
                            data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-expanded="false">
                            <span class="fa fa-search" aria-hidden="true"></span>
                        </button>
                    </div>
                @endif
            </ul>
        </div>
    </div>
</nav><!-- End Header/Navbar -->
