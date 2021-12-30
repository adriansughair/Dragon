@extends('layouts.welcome')

@section('content')
    <style>
        .fixed-top {
            position: inherit;
        }

    </style>
    <section class="intro-single pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">{{ __('Add new Real Estate') }}</h1>
                        <form class="mt-5" id="set-tax" action="{{ route('set_tax', [app()->getLocale()]) }}" method="POST">
                            @csrf
                            <div class="tax-yes-container boolean-container text-center btn-success">
                                {{ __('With commision') }}
                            </div>
                            <div class="tax-no-container boolean-container text-center btn-danger">
                                {{ __('Without commision') }}
                            </div>
                            <input type="hidden" value="null" name="tax" id="tax">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.tax-yes-container').click(function() {
                $('#tax').val('1')
                $('#set-tax').submit();
            })
            $('.tax-no-container').click(function() {
                $('#tax').val('0')
                $('#set-tax').submit();
            })

        </script>
    </section>

@endsection
