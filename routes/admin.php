<?php

use Illuminate\Support\Facades\Route;

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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['middleware' => ['auth', 'permission'], 'prefix' => 'admin'], function () {

        Route::get('/', 'App\Http\Controllers\Dashboard\DashboardController@index')->name('admin.dashboard');

        // Route::get('/users', 'App\Http\Controllers\Dashboard\UserController@index')->name('users');
        // Route::get('/users/details/{id}', 'App\Http\Controllers\Dashboard\UserController@details')
        //     ->name('user.details');


        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', 'App\Http\Controllers\Dashboard\ContactController@index')
                ->name('contact');
            Route::get('/details/{id}', 'App\Http\Controllers\Dashboard\ContactController@details')
                ->name('contact.details');
        });



        Route::resource('categories', 'App\Http\Controllers\Dashboard\CategoryController');

        Route::resource('brands', 'App\Http\Controllers\Dashboard\BrandController');
        Route::resource('users', 'App\Http\Controllers\Dashboard\UserController');
        Route::get('user/addresses/{id}', 'App\Http\Controllers\Dashboard\UserController@addresses')->name('user.addresses');
        Route::resource('banners', 'App\Http\Controllers\Dashboard\BannerController');
        Route::resource('products', 'App\Http\Controllers\Dashboard\ProductsController');
        Route::get('product/filter', 'App\Http\Controllers\Dashboard\ProductsController@index')->name('product.filter');



        Route::resource('roles', 'App\Http\Controllers\Dashboard\RolesController');
        Route::resource('permissions', 'App\Http\Controllers\Dashboard\PermissionsController');
    });



    Route::get('admin/login', 'App\Http\Controllers\Dashboard\LoginController@login')
        ->name('admin.login');



    Route::get('logout', 'App\Http\Controllers\Dashboard\LoginController@logout')->name('admin.logout');
    Route::post('admin/login', 'App\Http\Controllers\Dashboard\LoginController@postLogin')
        ->name('admin.post.login');
    Route::get('profile/edit', 'App\Http\Controllers\Dashboard\ProfileController@editProfile')
        ->name('edit.profile');
    Route::put('profile/update', 'App\Http\Controllers\Dashboard\ProfileController@updateprofile')
        ->name('update.profile');
});
