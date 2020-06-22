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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('students')->group(function() {
    Route::get('/')->uses('StudentController@index');
    Route::get('/{id}')->uses('StudentController@show')->where('id', '[0-9]+');
    Route::post('/')->uses('StudentController@store');
    Route::put('/{id}')->uses('StudentController@update')->where('id', '[0-9]+');
    Route::delete('/{id}')->uses('StudentController@destroy')->where('id', '[0-9]+');
});
