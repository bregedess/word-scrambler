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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('/words', 'WordsController@index');
    Route::post('/words', 'WordsController@store');
    Route::patch('/words/{word}', 'WordsController@update');
    Route::delete('/words/{word}', 'WordsController@destroy');
    Route::get('/words/{word}', 'WordsController@show');
});
