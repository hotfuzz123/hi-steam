<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->namespace('Admin')->group(function(){
    // All the admin route will be defined here
    Route::match(['get', 'post'], '/', 'AdminController@login');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('password', 'AdminController@password')->name('admin.password');
        Route::get('logout', 'AdminController@logout')->name('admin.logout');
        Route::post('check-current-pwd','AdminController@chkCurrentPassword');
        Route::post('update-current-pwd','AdminController@updateCurrentPassword')->name('update.password');
        Route::match(['get', 'post'], 'settings', 'AdminController@settings')->name('admin.settings');

        // Category Section
        Route::resource('category', 'CategoryController');
        Route::post('category-status','CategoryController@categoryStatus')->name('category.status');

        // Slider Section
        Route::resource('slider', 'SliderController');
        Route::post('slider-status','SliderController@sliderStatus')->name('slider.status');

        // Course Section
        Route::resource('course', 'CourseController');
        Route::post('course-status','CourseController@courseStatus')->name('course.status');

        // Mission Section
        Route::resource('mission', 'MissionController');

        // User Section
        Route::resource('user', 'UserController');
    });
});
