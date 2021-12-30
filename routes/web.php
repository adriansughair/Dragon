<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::name('shoop')->get('/shoop','Admin\ControllerCategories@create');
Route::name('shoop2')->get('/shoop2','Admin\ControllerCategories@index');
Route::name('viewEditCategory')->get('/viewEditCategory/{id}','Admin\ControllerCategories@show')->where(['id' => '[0-9]+']);
Route::name('deleteCategory')->delete('/delete/Category/{id}','Admin\ControllerCategories@destroy')->where(['id' => '[0-9]+']);
Route::name('viewAddCategory')->get('/viewAddCategory','Admin\ControllerCategories@showAdd');


Route::name('homepage')->get('/', function () {
    return redirect(App::getLocale());
});

Route::group(['prefix' => '/{lang?}/', 'where' => ['lang' => '[a-z]{2}'], 'middleware' => 'setlocale'], function () {

    Auth::routes();

    // Home
    Route::get('/', 'HomeController@index')->name('home');

    // About
    Route::name('about')->get('/about', function () {
        return view('about');
    });
    
    	Route::name('privacy')->get('/privacy', function () {
    		return view('privacy.privacy');
    	});

    // Admin Routes
    Route::name('admin')->middleware('can:manage-website')->get('/admin', function () {
        return view('admin.index');
    });
    Route::name('admin.')->prefix('admin')->middleware('can:manage-website')->group(function () {
        Route::resource('/users', 'Admin\UsersController', ['except' => ['create', 'store', 'show']]);
    });
    Route::name('admin.banners')->middleware('can:manage-website')->get('admin/realestates/banners', 'Admin\ControllPanelController@index');
    
    Route::name('admin.toggle_banner')->middleware('can:manage-website')->post('admin/realestates/toggle_banner/{id?}/', 'Admin\ControllPanelController@toggleBanner');
    Route::name('admin.approve_real_estates_page')->middleware('can:manage-website')->get('admin/realestates/approve/', 'Admin\ControllPanelController@approveRealEstatesView');
    Route::name('admin.approve_real_estate')->middleware('can:manage-website')->post('admin/realestates/approve/{id?}/', 'Admin\ControllPanelController@handleApprove');
    // Administer comments
    Route::name('admin.comments')->middleware('can:manage-website')->get('admin/realestates/comments/{id?}', 'Admin\ControllPanelController@comments');
    Route::name('admin.remove_comment')->middleware('can:manage-website')->post('admin/realestates/comments/{id?}', 'Admin\ControllPanelController@removeComment');
    // Administer testimonials
    Route::name('admin.add_testimonial')->middleware('can:manage-website')->get('admin/testimonials/create', 'Admin\ControllPanelController@addTestimonial');
    Route::name('admin.store_testimonial')->middleware('can:manage-website')->post('admin/testimonials/store', 'Admin\ControllPanelController@storeTestimonial');
    Route::name('admin.testimonials')->middleware('can:manage-website')->get('admin/testimonials/{id?}', 'Admin\ControllPanelController@testimonials');
    Route::name('admin.remove_testimonial')->middleware('can:manage-website')->post('admin/testimonials/{id?}', 'Admin\ControllPanelController@removeTestimonial');
    // Admin Login
    Route::name('admin_login')->middleware('guest')->get('admin/login', 'Admin\AdminAuthController@adminLoginPage');
    Route::name('admin_login')->post('admin/login', 'Admin\AdminAuthController@adminLogin');
    
    // Administer Real Estates
    Route::name('admin.realestates')->middleware('can:manage-website')->get('admin/realestates', 'Admin\ControllPanelController@realEstates');
    
    // Real Estates
    Route::name('realestates.favorite')->get('/realestates/favorites', 'RealEstatesController@favorites');
    Route::group([], function () {
        Route::resource('/realestates', 'RealEstatesController');
    });

    // Contact
    Route::group([], function () {
        Route::resource('/contact', 'ContactController');
    });

    Route::name('custom_login')->post('/custom_login', 'CustomLoginController@login');
    Route::name('comment_submit')->post('/comment/{id?}', 'CommentsController@add');
    Route::name('like')->post('/like/{id?}', 'RealEstatesController@like');

    Route::name('set_paid')->post('/tax/', 'RealEstatesController@setPaid');
    Route::name('set_tax')->post('/paid/', 'RealEstatesController@setTax');

});
