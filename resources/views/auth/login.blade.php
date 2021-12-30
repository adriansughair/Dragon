@extends('layouts.welcome')

@section('content')
    <style>
        .fixed-top {
            position: inherit;
        }

    </style>
    <div class="intro-single py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="title-single-box">
                        <h1 class="title-single">{{ __('Login') }}</h1>
                    </div>
                    <div class="py-4">
                        <form method="POST" action="{{ route('custom_login', app()->getLocale()) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text"
                                        class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                                        value="{{ old('email') }}" required autocomplete="phone_number" autofocus>

                                    @if (Session::has('error'))
                                        <span class="invalid-feedback d-block" role="alert">
                                            {{ Session::get('error') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request', app()->getLocale()) }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                    {{--
                </div> --}}
            </div>
        </div>
    </div>
    </div>
@endsection
