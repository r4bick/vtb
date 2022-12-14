<?php

use Illuminate\Support\Facades\Route;
use Laravel\Lumen\Routing\Router;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

Route::group(['prefix' => 'auth'], function (Router $router) {
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'auth'], function (Router $router) {
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'UserController@showAll');
    Route::get('me', 'UserController@me');
    Route::get('/{id}', 'UserController@show');
});

Route::group(['prefix' => 'task', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'TaskController@showAll');
    Route::get('/{id}', 'TaskController@show');
    Route::post('', 'TaskController@create');
    Route::put('/{id}', 'TaskController@update');
});

Route::group(['prefix' => 'task_user', 'middleware' => 'auth'], function (Router $router) {
    Route::post('', 'TaskUserController@create');
});

Route::group(['prefix' => 'task_departure', 'middleware' => 'auth'], function (Router $router) {
    Route::post('', 'TaskDepartureController@create');
});

Route::group(['prefix' => 'product', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'ProductController@showAll');
    Route::get('/{id}', 'ProductController@show');
});

Route::group(['prefix' => 'departure', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'DepartureController@showAll');
    Route::get('/{id}', 'DepartureController@show');
});


Route::group(['prefix' => 'wallet', 'middleware' => 'auth'], function (Router $router) {
    Route::put('/digital_ruble/{public_key}', 'WalletController@transferDigitalRubles');
    Route::put('/digital_ruble/system/{public_key}', 'WalletController@transferSystemDigitalRubles');
    Route::put('/matic/{public_key}', 'WalletController@transferMatic');
    Route::put('/matic/system/{public_key}', 'WalletController@transferSystemMatic');
});

Route::group(['prefix' => 'order', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'OrderController@showAll');
    Route::get('/{id}', 'OrderController@show');
    Route::post('/', 'OrderController@create');
    Route::put('/{id}', 'OrderController@update');
});
