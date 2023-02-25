<?php

use App\Http\Controllers\AvbookController;
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

//Route::get('/', 'AvbookController@index');
Route::get('/', function () {
    return redirect('/censored?');
});

Route::get('censored', [AvbookController::class, 'index']);

Route::get('movie', [AvbookController::class, 'movie']);

Route::get('genre', [AvbookController::class, 'genre']);

Route::get('actresses', [AvbookController::class, 'actresses']);

Route::get('javlib', [AvbookController::class, 'javlib']);
Route::get('javlibmovie', [AvbookController::class, 'javlibmovie']);
