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

    Route::apiResource('category', 'CategoryController');

    Route::apiResource('slider', 'SliderController');

    Route::apiResource('course', 'CourseController')->only('index', 'show');
    Route::get('random-course', 'CourseController@randomCourse');

    Route::apiResource('homework', 'HomeworkController')->only('index', 'show');

    Route::apiResource('grade', 'GradeController');

    Route::apiResource('mission', 'MissionController');

    Route::apiResource('admin', 'AdminController');

    // Tip Section
    Route::apiResource('tip', 'TipController');
    Route::get('random-tip', 'TipController@randomTip');


    Route::apiResource('lesson', 'LessonController')->only('index', 'show');

    Route::apiResource('document', 'DocumentController')->only('index', 'show');

    Route::apiResource('post', 'PostController')->only('index', 'show');

    Route::apiResource('comment', 'CommentController')->only('index', 'show');

    // Users
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function(){
        Route::delete('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@getUser');
        Route::post('user', 'AuthController@updateUser');
        Route::post('change-password', 'AuthController@changePassword');

        // Except index and show only
        Route::apiResource('homework', 'HomeworkController')->except('index', 'show');
        Route::apiResource('comment', 'CommentController')->except('index', 'show');
    });

    // Admins
    Route::post('register-admin', 'AdminController@registerAdmin');
    Route::post('login-admin', 'AdminController@loginAdmin');

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin-api'], function(){
        Route::delete('logout', 'AdminController@logout');
        Route::get('admin', 'AdminController@getAdmin');
        Route::post('admin', 'AdminController@updateAdmin');
        Route::post('change-password', 'AdminController@changePassword');

        // Except index and show only
        Route::apiResource('post', 'PostController')->except('index', 'show');
        Route::apiResource('document', 'DocumentController')->except('index', 'show');
        Route::apiResource('course', 'CourseController')->except('index', 'show');
        Route::apiResource('lesson', 'LessonController')->except('index', 'show');
    });
});
