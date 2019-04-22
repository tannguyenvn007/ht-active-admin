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


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::group(['prefix' => 'service-category'], function () {
        Route::get('/', 'CategoryServiceController@index')->name('service-category');
        Route::get('/add', 'CategoryServiceController@create')->name('add-service-category');
        Route::post('/add', 'CategoryServiceController@store')->name('post-add-service-category');
        Route::get('/edit/{id}', 'CategoryServiceController@edit')->name('get-edit-service-category');
        Route::post('/edit/{id}', 'CategoryServiceController@update')->name('post-edit-service-category');
        Route::get('/delete/{id}', 'CategoryServiceController@destroy')->name('delete-service-category');
    });
    Route::group(['prefix' => 'service'], function () {
        Route::get('/', 'ServiceController@index')->name('service');
        Route::get('/add', 'ServiceController@create')->name('add-service');
        Route::post('/add', 'ServiceController@store')->name('post-add-service');
        Route::get('/edit/{id}', 'ServiceController@edit')->name('get-edit-service');
        Route::post('/edit/{id}', 'ServiceController@update')->name('post-edit-service');
        Route::get('/delete/{id}', 'ServiceController@destroy')->name('delete-service');
    });
    Route::group(['prefix' => 'portfolios'], function () {
        Route::get('/', 'PortfoliosController@index')->name('portfolios');
        Route::get('/add', 'PortfoliosController@create')->name('add-portfolios');
        Route::post('/add', 'PortfoliosController@store')->name('post-add-portfolios');
        Route::get('/edit/{id}', 'PortfoliosController@edit')->name('get-edit-portfolios');
        Route::post('/edit/{id}', 'PortfoliosController@update')->name('post-edit-portfolios');
        Route::get('/delete/{id}', 'PortfoliosController@destroy')->name('delete-portfolios');
    });
});

