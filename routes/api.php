<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', 'Admin\UsersController@AuthRouteAPI');

Route::post('register', 'Api\RegisterController@register');
Route::post('login', 'Api\RegisterController@login');
Route::get('getinfo', 'Api\RegisterController@getinfo');
Route::middleware('auth:api')->post('phone/verify', 'Api\RegisterController@verify');

/**
 * Get current user
 */
Route::middleware('auth:api')->get('/user', function () {
    return auth('api')->user();
});

/**
 * Create Real Estate Item
 */
Route::middleware('auth:api')->post('realestates/create', 'Api\RealEstatesController@create');

/**
 * Uplaod Image
 */
Route::middleware('auth:api')->post('realestates/upload', 'Api\RealEstatesController@upload');

/**
 * Filter Real Estates
 */
Route::middleware('auth:api')->get('realestates/filter', 'Api\RealEstatesController@filter');

/**
 * Banners
 */
Route::get('realestates/banners', 'Api\RealEstatesController@banners');

/**
 * Get Liked Real Estates
 */
Route::middleware('auth:api')->get('realestates/favorites', 'Api\RealEstatesController@favorites');

/**
 * Get Real Estate
 */
Route::middleware('auth:api')->get('realestates/{id?}', 'Api\RealEstatesController@get');

/**
 * Like Estate
 */
Route::middleware('auth:api')->post('realestates/like/{id?}', 'Api\RealEstatesController@like');

/**
 * Get Comments for real estate
 */
Route::middleware('auth:api')->get('comments/{id?}', 'Api\CommentsController@get');

/**
 * Get Comments for real estate
 */
Route::middleware('auth:api')->post('comments/{id?}', 'Api\CommentsController@add');

/**
 * Contact Us
 */
Route::post('contact', 'Api\ContactController@add');