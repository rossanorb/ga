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
    Route::post('/')->use('StudentController@store');
    Route::put('/{id}')->use('StudentController@update');
    Route::delete('/{id}')->use('StudentController@destroy');
});
