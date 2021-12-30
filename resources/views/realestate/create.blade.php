@extends('layouts.welcome')

@php
    $taxVal = Session::has('tax') ? Session::get('tax') : null
@endphp

@section('content')
<style>
    .fixed-top {
        position: inherit;
    }

</style>

    <div class="container">
        <h1 class="title py-5">{{ __('Create new Real Estate') }}</h1>
        <form method="POST" action="{{ route('realestates.store', app()->getLocale()) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <label for="title"><b>{{ __('AD Title') }}</b></label>
                <input class="form-control" name="title" id="title" type="text">
                <small class="text-danger">@error('title'){{ $message }}@enderror</small>
            </div>
            <div class="row">
                <div class="form-group col-md-4 mb-3">
                    <label for="price"><b>{{ __('Price') }}</b></label>
                    <input class="form-control" name="price" id="price" type="number">
                    <small class="text-danger">@error('price'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-4 mb-3">
                    <label for="area"><b>{{ __('Area') }}</b></label>
                    <input class="form-control" name="area" id="area" type="text">
                    <small class="text-danger">@error('area'){{ $message }}@enderror</small>
                </div>
<!--                 <div class="form-group col-md-4 mb-3"> -->
<!--                     <label for="district"><b>{{ __('District') }}</b></label> -->
<!--                     <input class="form-control" name="district" id="district" type="text"> -->
<!--                     <small class="text-danger">@error('district'){{ $message }}@enderror</small> -->
<!--                 </div> -->
            </div>
            <div class="row">
<!--                 <div class="form-group col-md-4 mb-3"> -->
<!--                     <label for="test"><b>{{ __('Temproary') }}</b></label> -->
<!--                     <div class="d-flex justify-content-start"> -->
<!--                         <div class="form-check mr-3"> -->
<!--                             <input class="form-check-input" type="radio" name="temp" id="temp1" value="1"> -->
<!--                             <label class="form-check-label" for="temp1"> -->
<!--                                 {{ __('Yes') }} -->
<!--                             </label> -->
<!--                         </div> -->
<!--                         <div class="form-check"> -->
<!--                             <input class="form-check-input" type="radio" name="temp" id="temp2" value="0"> -->
<!--                             <label class="form-check-label" for="temp2"> -->
<!--                                 {{ __('No') }} -->
<!--                             </label> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                 </div> -->
<!--                 <div class="form-group col-md-4 mb-3"> -->
<!--                     <label for="test"><b>{{ __('Offer Type') }}</b></label> -->
<!--                     <div class="d-flex justify-content-start"> -->
<!--                         <div class="form-check mr-3"> -->
<!--                             <input class="form-check-input" type="radio" name="offerType" id="offerType1" value="0"> -->
<!--                             <label class="form-check-label" for="offerType1"> -->
<!--                                 {{ __('For rent') }} -->
<!--                             </label> -->
<!--                         </div> -->
<!--                         <div class="form-check"> -->
<!--                             <input class="form-check-input" type="radio" name="offerType" id="offerType2" value="1"> -->
<!--                             <label class="form-check-label" for="offerType2"> -->
<!--                                 {{ __('For sale') }} -->
<!--                             </label> -->
<!--                         </div> -->
<!--                     </div> -->
<!--                 </div> -->
                <div class="form-group col-md-4 mb-3">
                    <label for="test"><b>{{ __('With commision') }}</b></label>
                    <div class="d-flex justify-content-start">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="radio" name="tax" id="withTax1" value="1" {{($taxVal && $taxVal == '1') ? ' checked' : ''}}>
                            <label class="form-check-label" for="withTax1">
                                {{ __('Yes') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tax" id="withTax2" value="0" {{($taxVal && $taxVal == '0') ? ' checked' : ''}}>
                            <label class="form-check-label" for="withTax2">
                                {{ __('No') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-2 mb-2">
                    <label for="district"><b>{{ __('Location') }}</b></label>
						<select class="form-select form-select-lg mb-3" name="location" id="location">
  							<option selected>{{ __('Location') }}</option>
  								<option value="1">One</option>
  								<option value="2">Two</option>
 								 <option value="3">Three</option>
						</select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="district"><b>{{ __('Offer Type') }}</b></label>
						<select class="form-select form-select-lg mb-3" name="offerType">
  							<option selected>{{ __('Offer Type') }}</option>
  								<option value="0">{{ __('For rent') }}</option>
  								<option value="1">{{ __('For sale') }}</option>
 								<option value="2">required</option>
 								<option value="3">Lands</option>
						</select>
                </div>
                <div class="form-group col-md-2 mb-2">
                    <label for="district"><b>district</b></label>
						<select class="form-select form-select-lg mb-3" name="district" id="district">
  							<option selected>district</option>
  								<option value="1">One</option>
  								<option value="2">Two</option>
 								 <option value="3">Three</option>
						</select>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="district"><b>RE_Type</b></label>
						<select class="form-select form-select-lg mb-3" name="RE_Type" id="RE_Type">
  							<option selected>RE_Type</option>
  								<option value="1">One</option>
  								<option value="2">Two</option>
 								 <option value="3">Three</option>
						</select>
                </div>
                <div class="form-group col-md-2 mb-2">
                    <label for="district"><b>furniture</b></label>
						<select class="form-select form-select-lg mb-5" name="furniture" id="furniture">
  							<option selected>furniture</option>
  								<option value="1">One</option>
  								<option value="2">Two</option>
 								 <option value="3">Three</option>
						</select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3 mb-3">
                    <label for="rooms"><b>{{ __('Rooms') }}</b></label>
                    <input class="form-control" name="rooms" id="rooms" type="number">
                    <small class="text-danger">@error('rooms'){{ $message }}@enderror</small>
                </div>
                <div class="form-group col-md-3 mb-3">
                    <label for="baths"><b>{{ __('Baths') }}</b></label>
                    <input class="form-control" name="baths" id="baths" type="number">
                    <small class="text-danger">@error('baths'){{ $message }}@enderror</small>
                </div>
<!--                 <div class="form-group col-md-3 mb-3"> -->
<!--                     <label for="parkings"><b>{{ __('Parkings') }}</b></label> -->
<!--                     <input class="form-control" name="parkings" id="parkings" type="number"> -->
<!--                     <small class="text-danger">@error('parkings'){{ $message }}@enderror</small> -->
<!--                 </div> -->
<!--                 <div class="form-group col-md-3 mb-3"> -->
<!--                     <label for="kitchens"><b>{{ __('Kitchens') }}</b></label> -->
<!--                     <input class="form-control" name="kitchens" id="kitchens" type="number"> -->
<!--                     <small class="text-danger">@error('kitchens'){{ $message }}@enderror</small> -->
<!--                 </div> -->
            </div>
            <div class="form-group col-md-4 mb-3">
                <label for="images"><b>{{ __('Images') }}</b></label>
                <input required type="file" class="form-control" name="images[]" id="images" placeholder="address" multiple>
                <small class="text-danger">@error('images'){{ $message }}@enderror</small>
            </div>
            <div class="form-group mb-3">
                <label for="description"><b>{{ __('Description') }}</b></label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                <small class="text-danger">@error('description'){{ $message }}@enderror</small>
            </div>
            <button class="btn btn-primary" type="submit">{{ __('Add') }}</button>
        </form>
    </div>

@endsection
