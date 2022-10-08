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

Route::group(['prefix' => 'product', 'middleware' => 'auth'], function (Router $router) {
    Route::get('/', 'ProductController@showAll');
    Route::get('/{id}', 'ProductController@show');
});

Route::group(['prefix' => 'wallet', 'middleware' => 'auth'], function (Router $router) {
    Route::put('/{public_key}', 'WalletController@transferDigitalRubles');
    Route::put('/system/{public_key}', 'WalletController@transferSystemDigitalRubles');
});

