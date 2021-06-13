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

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function(){
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function(){
        Route::delete('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@getUser');
        Route::post('user', 'AuthController@updateUser');
    });
});
