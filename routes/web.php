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

//Route::get('/', 'AvbookController@index');
Route::get('/', function () {
    return redirect('/censored?');
});

Route::get('censored', 'AvbookController@index');

Route::get('movie', 'AvbookController@movie');

Route::get('genre', 'AvbookController@genre');

Route::get('actresses', 'AvbookController@actresses');

Route::get('javlib', 'AvbookController@javlib');
Route::get('javlibmovie', 'AvbookController@javlibmovie');