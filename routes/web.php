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

Auth::routes();

Route::get('routes', function() {
    \Artisan::call('route:list');
    return '<pre>' . \Artisan::output() . '</pre>';
});
Route::middleware(['restrictIp'])->group(function () {
    Route::group(['namespace' => 'Front'], function () {
        Route::get('/', 'IndexController@index')->name('index');
        Route::get('/mieszkania', 'InvestmentController@show')->name('plan');

        // Developro
        Route::group(['prefix'=>'/pietro', 'as' => 'front.investment.'], function() {
            // Inwestycja budynkowa

            Route::get('/budynek/{investment_id}/p/{floor}',
                'Developro\InvestmentFloorController@index')->name('floor');

            Route::get('/budynek/{investment_id}/p/{floor}/m/{property}',
                'Developro\InvestmentPropertyController@index')->name('property');
        });

        Route::post('/kontakt', 'ContactController@contact')->name('homepage.contact');
        Route::post('/kontakt/{property}', 'ContactController@property')->name('contact.property');

    });
});