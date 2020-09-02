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

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/words', 'WordsController@index')->name('words.index');
Route::post('/words', 'WordsController@store')->name('words.store');
Route::get('/words/create', 'WordsController@create')->name('words.create');
Route::get('/words/edit/{word}', 'WordsController@edit')->name('words.edit');
Route::patch('/words/{word}', 'WordsController@update')->name('words.update');
Route::delete('/words/{word}', 'WordsController@destroy');
Route::get('/words/{word}', 'WordsController@show');

Route::post('/guess', 'WordsController@guess')->name('guess');
