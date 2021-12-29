<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\TipController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\LessonController;
use App\Http\Controllers\Api\v1\AdminController;
use App\Http\Controllers\Api\v1\CourseController;
use App\Http\Controllers\Api\v1\ReviewController;
use App\Http\Controllers\Api\v1\SliderController;
use App\Http\Controllers\Api\v1\CommentController;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\DocumentController;
use App\Http\Controllers\Api\v1\EnrolledController;
use App\Http\Controllers\Api\v1\HomeworkController;
use App\Http\Controllers\Api\v1\SubscribeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    // Users
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['prefix' => 'auth', 'middleware' => 'auth:api'], function(){
        Route::delete('logout', [AuthController::class, 'logout']);
        Route::get('user', [AuthController::class, 'getUser']);
        Route::post('user', [AuthController::class, 'updateUser']);
        Route::post('change-password', [AuthController::class, 'changePassword']);

        // Category Section
        Route::apiResource('category', CategoryController::class);

        // Slider Section
        Route::apiResource('slider', SliderController::class);

        // Course Section
        Route::apiResource('course', CourseController::class);

        // Homework Section
        Route::apiResource('homework', HomeworkController::class);

        // Subscribe Section
        Route::apiResource('subscribe', SubscribeController::class);

        // Info Teacher Section
        Route::apiResource('admin', AdminController::class);

        // Best teacher
        Route::get('best-teacher', [AdminController::class, 'bestTeacher']);

        // Tip Section
        Route::apiResource('tip', TipController::class);
        Route::get('random-tip', [TipController::class, 'randomTip']);

        // Review Section
        Route::apiResource('review', ReviewController::class);

        // Lesson Section
        Route::apiResource('lesson', LessonController::class);
        Route::get('random-lesson', [LessonController::class, 'randomLesson']);

        // Document Section
        Route::apiResource('document', DocumentController::class);

        // Post Section
        Route::apiResource('post', PostController::class);

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
        Route::post('change-password', [AdminController::class, 'changePassword']);
    });
});
