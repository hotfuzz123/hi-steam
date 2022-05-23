<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TipController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\EnrolledController;
use App\Http\Controllers\Api\HomeworkController;
use App\Http\Controllers\Api\SubscribeController;

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

// Users
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function(){
    Route::delete('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('user', [AuthController::class, 'updateUser']);
    Route::post('change-password', [AuthController::class, 'changePassword']);

    // Category Section
    Route::get('category', [CategoryController::class, 'index']);

    // Slider Section
    Route::get('slider', [SliderController::class, 'index']);

    // Course Section
    Route::get('course', [CourseController::class, 'index']);

    // Homework Section
    Route::apiResource('homework', HomeworkController::class);

    // Subscribe Section
    Route::apiResource('subscribe', SubscribeController::class);

    // Info Teacher Section
    Route::get('admin', [AdminController::class, 'index']);
    Route::get('best-teacher', [AdminController::class, 'bestTeacher']);

    // Tip Section
    Route::get('tip', [TipController::class, 'index']);
    Route::get('random-tip', [TipController::class, 'randomTip']);

    // Review Section
    Route::apiResource('review', ReviewController::class);

    // Lesson Section
    Route::get('lesson', [LessonController::class, 'index']);
    Route::get('random-lesson', [LessonController::class, 'randomLesson']);

    // Document Section
    Route::apiResource('document', DocumentController::class);

    // Post Section
    Route::get('post', [PostController::class, 'index']);

    // Comment Section
    Route::apiResource('comment', CommentController::class);

    // Enrolled Section
    Route::apiResource('enrolled', EnrolledController::class);
});

// Admins
Route::post('register-admin', [AdminController::class, 'registerAdmin']);
Route::post('login-admin', [AdminController::class, 'loginAdmin']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin-api'], function(){
    Route::delete('logout', [AdminController::class, 'logout']);
    Route::get('admin', [AdminController::class, 'getAdmin']);
    Route::post('admin', [AdminController::class, 'updateAdmin']);
});