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
                        <form id="set-paid" action="{{ route('set_paid', [app()->getLocale()]) }}" method="POST" class="mt-5">
                            @csrf
                            <div class="paid-yes-container boolean-container text-center btn-primary">
                                {{ __('Paid AD') }}
                            </div>
                            <div class="paid-no-container boolean-container text-center btn-primary">
                                {{ __('Free AD') }}
                            </div>
                            <input type="hidden" value="null" name="paid" id="paid">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.paid-yes-container').click(function() {
                $('#paid').val('1')
                $('#set-paid').submit();
            })
            $('.paid-no-container').click(function() {
                $('#paid').val('0')
                $('#set-paid').submit();
            })

        </script>
    </section>

@endsection
