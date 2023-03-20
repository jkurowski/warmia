<?php

use Illuminate\Http\Request;
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
Route::group(['prefix'=>'/api'], function () {
    //User
    Route::post('login', 'LoginController@store')->name('auth.login.store');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('form', 'Api\Form\IndexController@store');

        //Client
        Route::group(['namespace' => 'Api\Client'], function () {
            Route::get('clients', 'IndexController@index');
            Route::get('clients/datatable', 'IndexController@datatable');
            Route::get('clients/{client}', 'IndexController@show')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
            Route::get('clients/{client}/rodo', 'IndexController@rodo')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
            Route::get('clients/{client}/files', 'IndexController@files')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
        });

        //Events
        Route::group(['namespace' => 'Api\Event'], function () {
            Route::get('events', 'IndexController@index');

            Route::put('events/{event}/move', 'IndexController@move')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::get('events/{client}', 'IndexController@show')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
            Route::delete('events/{event}/delete', 'IndexController@destroy')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::post('events', 'IndexController@store');
        });

        //Notes
        Route::group(['namespace' => 'Api\Note'], function () {
            Route::get('clients/{client}/notes', 'IndexController@all')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::get('clients/{client}/notes/{note}', 'IndexController@show')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::post('clients/{client}/notes', 'IndexController@store')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::delete('clients/{client}/notes/{note}', 'IndexController@destroy')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::put('clients/{client}/notes/{note}', 'IndexController@update')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });

            Route::put('clients/{client}/notes/{note}/pinned', 'IndexController@pinned')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
        });

        //Chat
        Route::group(['namespace' => 'Api\Chat'], function () {
            Route::get('{client}/chat', 'IndexController@show')->missing(function () {
                return response()->json(['message' => 'Record not found.'], 404);
            });
        });
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
