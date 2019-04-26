<?php

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


Route::group(['prefix' => 'admin','middleware' => 'adminLogin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::post('/search', 'SearchController@searchBlog')->name('search');
    Route::group(['prefix' => 'service-category'], function () {
        Route::get('/', 'CategoryServiceController@index')->name('service-category');
        Route::get('/add', 'CategoryServiceController@create')->name('add-service-category');
        Route::post('/add', 'CategoryServiceController@store')->name('post-add-service-category');
        Route::get('/details/{id}', 'CategoryServiceController@show')->name('get-service-category-detaitls');
        Route::get('/edit/{id}', 'CategoryServiceController@edit')->name('get-edit-service-category');
        Route::post('/edit/{id}', 'CategoryServiceController@update')->name('post-edit-service-category');
        Route::get('/delete/{id}', 'CategoryServiceController@destroy')->name('delete-service-category');
    });
    Route::group(['prefix' => 'service'], function () {
        Route::get('/', 'ServiceController@index')->name('service');
        Route::get('/add', 'ServiceController@create')->name('add-service');
        Route::post('/add', 'ServiceController@store')->name('post-add-service');
        Route::get('/details/{id}', 'ServiceController@show')->name('get-service-detaitls');
        Route::get('/edit/{id}', 'ServiceController@edit')->name('get-edit-service');
        Route::post('/edit/{id}', 'ServiceController@update')->name('post-edit-service');
        Route::get('/delete/{id}', 'ServiceController@destroy')->name('delete-service');
    });
    Route::group(['prefix' => 'portfolios'], function () {
        Route::get('/', 'PortfoliosController@index')->name('portfolios');
        Route::get('/add', 'PortfoliosController@create')->name('add-portfolios');
        Route::post('/add', 'PortfoliosController@store')->name('post-add-portfolios');
        Route::get('/details/{id}', 'PortfoliosController@show')->name('get-portfolios-detaitls');
        Route::get('/edit/{id}', 'PortfoliosController@edit')->name('get-edit-portfolios');
        Route::post('/edit/{id}', 'PortfoliosController@update')->name('post-edit-portfolios');
        Route::get('/delete/{id}', 'PortfoliosController@destroy')->name('delete-portfolios');
    });
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'BlogController@index')->name('blog');
        Route::get('/add', 'BlogController@create')->name('add-blog');
        Route::post('/add', 'BlogController@store')->name('post-add-blog');
        Route::get('/details/{id}', 'BlogController@show')->name('get-blog-detaitls');
        Route::get('/edit/{id}', 'BlogController@edit')->name('get-edit-blog');
        Route::post('/edit/{id}', 'BlogController@update')->name('post-edit-blog');
        Route::get('/delete/{id}', 'BlogController@destroy')->name('delete-blog');
    });
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/', 'ContactController@index')->name('contact');
        // Route::get('/add', 'BlogController@create')->name('add-blog');
        // Route::post('/add', 'BlogController@store')->name('post-add-blog');
        // Route::get('/edit/{id}', 'BlogController@edit')->name('get-edit-blog');
        // Route::post('/edit/{id}', 'BlogController@update')->name('post-edit-blog');
        Route::get('/delete/{id}', 'ContactController@destroy')->name('delete-contact');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('user');
        Route::get('/add', 'UserController@create')->name('add-user');
        Route::post('/add', 'UserController@store')->name('post-add-user');
        Route::get('/edit/{id}', 'UserController@edit')->name('get-edit-user');
        Route::post('/edit/{id}', 'UserController@update')->name('post-edit-user');
        Route::get('/delete/{id}', 'UserController@destroy')->name('delete-user');
    });
});


Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

