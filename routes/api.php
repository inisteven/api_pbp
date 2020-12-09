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

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::get('user/search/{id}', 'UserController@find');
Route::get('user', 'UserController@index');
Route::get('user/{id}', 'UserController@show');
Route::post('user', 'UserController@store');
Route::put('user/{id}', 'UserController@update');
Route::delete('user/{id}', 'UserController@destroy');

Route::get('motor', 'MotorController@index');
Route::get('motor/{id}', 'MotorController@show');
Route::post('motor', 'MotorController@store');
Route::put('motor/{id}', 'MotorController@update');
Route::delete('motor/{id}', 'MotorController@destroy');

Route::get('history', 'HistoryController@index');
Route::get('history/{id}', 'HistoryController@show');
Route::post('history', 'HistoryController@store');
Route::put('history/{id}', 'HistoryController@update');
Route::delete('history/{id}', 'HistoryController@destroy');
Route::get('history/search/{id}', 'HistoryController@find');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('product', 'Api\ProductController@index');
    Route::get('product/{id}', 'Api\ProductController@show');
    Route::post('product', 'Api\ProductController@store');
    Route::put('product/{id}', 'Api\ProductController@update');
    Route::delete('product/{id}', 'Api\ProductController@destroy');
});

