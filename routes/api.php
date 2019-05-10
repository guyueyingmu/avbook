<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::get('/addgenre', 'API\MovieinfoController@addgenre');
//Route::get('/magnetlinks', 'API\MovieinfoController@magnetlinks');


//Route::any('/test/{action}', function ($action) {
//    $class = App::make(\App\Http\Controllers\TestController::class);
//    return $class->$action();
//});
Route::any('/{action}', function (Request $request,$action) {
    $class = App::make(\App\Http\Controllers\API\MovieinfoController::class);
    return $class->$action($request);
});



