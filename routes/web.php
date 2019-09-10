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

Auth::routes();

Route::get('/', 'SlideController@slideShow')->name('slideShow');


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', 'SlideController@index')->name('overview');
    Route::get('/add', 'SlideController@create');
    Route::get('/add/{type}', 'SlideController@create');
    Route::post('/add/{type}', 'SlideController@store');
    Route::get('/{slide}', 'SlideController@show');
    Route::get('/{slide}/edit', 'SlideController@edit');
    Route::post('/{slide}/edit', 'SlideController@update');
    Route::get('/{slide}/activate', 'SlideController@activate');
    Route::delete('/{slide}', 'SlideController@destroy');
});