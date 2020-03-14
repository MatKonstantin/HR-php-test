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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', ['as' => 'index', 'uses' => 'Pages\WeatherController@showWeather']);
Route::group(['prefix' => '/orders'], function () {
    Route::get('/', ['as' => 'orders', 'uses' => 'Pages\OrderController@index']);
    Route::get('/{id}/edit', ['as' => 'order_edit', 'uses' => 'Pages\OrderController@edit']);
    Route::post('/{id}/update', ['as' => 'order_update', 'uses' => 'Pages\OrderController@update']);
});