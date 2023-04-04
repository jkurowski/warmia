<?php

use Illuminate\Support\Facades\App;
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

Auth::routes();

Route::get('routes', function() {
    \Artisan::call('route:list');
    return '<pre>' . \Artisan::output() . '</pre>';
});

Route::middleware(['restrictIp'])->group(function () {
    Route::group(['prefix' => '{locale?}', 'where' => ['locale' => '(?!admin)*[a-z]{2}'],], function() {
        Route::group(['namespace' => 'Front'], function () {

            Route::get('/', 'IndexController@index')->name('index');
            Route::get('/plan-inwestycji', 'InvestmentController@show')->name('plan');
            Route::get('/galeria', 'Gallery\IndexController@index')->name('gallery');
            Route::get('/lokalizacja', 'Location\IndexController@index')->name('location');
            Route::get('/strefa-klienta', 'Client\IndexController@index')->name('client');
            Route::get('/strefa-klienta/{slug}', 'Client\IndexController@show')->name('client.show');

            Route::get('/dom/{property}',
                'Developro\InvestmentPropertyController@index')->name('property');

            Route::get('/kontakt', 'ContactController@index')->name('contact');
            Route::post('/kontakt', 'ContactController@contact')->name('homepage.contact');
            Route::post('/kontakt/{property}', 'ContactController@property')->name('contact.property');

        });
    });

    // Inline
    Route::group(['namespace' => 'Front', 'prefix'=>'/inline/', 'as' => 'front.inline.'], function() {
        Route::get('/', 'InlineController@index')->name('index');
        Route::get('/loadinline/{inline}', 'InlineController@show')->name('show');
        Route::post('/update/{inline}', 'InlineController@update')->name('update');
    });
});