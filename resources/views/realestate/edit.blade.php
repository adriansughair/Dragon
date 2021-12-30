@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="title py-5">{{ __('Create new Real Estate') }}</h1>
        <form method="POST" action="{{ route('realestates.store', app()->getLocale()) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title"><b>{{ __('Title') }}</b></label>
                <input class="form-control" name="title" value="{{ $realEstate->title }}" id="title" type="text">
                <small class="text-danger">@error('title'){{ $message }}@enderror</small>
            </div>
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="price"><b>{{ __('Price') }}</b></label>
                    <input class="form-control" name="price" value="{{ $realEstate->price }}" id="price" type="number">
                    <small class="text-danger">@error('price'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="area"><b>{{ __('Area') }}</b></label>
                    <input class="form-control" name="area" value="{{ $realEstate->area }}" id="area" type="number">
                    <small class="text-danger">@error('area'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="district"><b>{{ __('District') }}</b></label>
                    <input class="form-control" name="district" value="{{ $realEstate->district }}" id="district"
                        type="text">
                    <small class="text-danger">@error('district'){{ $message }}@enderror</small>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="test"><b>{{ __('Temproary') }}</b></label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="temp" id="temp1" value="1"
                                {{ $realEstate->temp ? 'checked' : '' }}>
                            <label class="form-check-label" for="temp1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="temp" id="temp2" value="0"
                                {{ !$realEstate->temp ? 'checked' : '' }}>
                            <label class="form-check-label" for="temp2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="test"><b>{{ __('Offer Type') }}</b></label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="offerType" id="offerType1" value="0"
                                {{ $realEstate->offerType ? 'checked' : '' }}>
                            <label class="form-check-label" for="offerType1">
                                {{ __('For rent') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="offerType" id="offerType2" value="1"
                                {{ !$realEstate->offerType ? 'checked' : '' }}>
                            <label class="form-check-label" for="offerType2">
                                {{ __('For sale') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="test"><b>{{ __('Is Paid') }}</b></label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="paid" id="paid1" value="1"
                                {{ $realEstate->paid ? 'checked' : '' }}>
                            <label class="form-check-label" for="paid1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="paid" id="paid2" value="0"
                                {{ !$realEstate->paid ? 'checked' : '' }}>
                            <label class="form-check-label" for="paid2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="test"><b>{{ __('With Tax') }}</b></label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="tax" id="withTax1" value="1"
                                {{ $realEstate->tax ? 'checked' : '' }}>
                            <label class="form-check-label" for="withTax1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tax" id="withTax2" value="0"
                                {{ !$realEstate->tax ? 'checked' : '' }}>
                            <label class="form-check-label" for="withTax2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="district"><b>{{ __('Location') }}</b></label>
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="longitude">{{ __('Longitude') }}</label>
                            <input class="form-control" name="longitude" id="longitude" type="text">
                            <small class="text-danger">@error('longitude'){{ $message }}@enderror</small>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label for="latitude">{{ __('Latitude') }}</label>
                            <input class="form-control" name="latitude" id="latitude" type="text">
                            <small class="text-danger">@error('latitude'){{ $message }}@enderror</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 mb-3">
                    <label for="rooms"><b>{{ __('Rooms') }}</b></label>
                    <input class="form-control" name="rooms" value="{{ $realEstate->rooms }}" id="rooms" type="number">
                    <small class="text-danger">@error('rooms'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="baths"><b>{{ __('Baths') }}</b></label>
                    <input class="form-control" name="baths" value="{{ $realEstate->price }}" id="baths" type="number">
                    <small class="text-danger">@error('baths'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="parkings"><b>{{ __('Parkings') }}</b></label>
                    <input class="form-control" name="parkings" value="{{ $realEstate->parkings }}" id="parkings"
                        type="number">
                    <small class="text-danger">@error('parkings'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="kitchens"><b>{{ __('Kitchens') }}</b></label>
                    <input class="form-control" name="kitchens" value="{{ $realEstate->kitchens }}" id="kitchens"
                        type="number">
                    <small class="text-danger">@error('kitchens'){{ $message }}@enderror</small>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="description"><b>{{ __('Description') }}</b></label>
                <textarea class="form-control" name="description" id="description"
                    rows="3">{{ $realEstate->description }}</textarea>
                <small class="text-danger">@error('description'){{ $message }}@enderror</small>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
        </form>
    </div>

@endsection
