<?php

// namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TipController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GradeController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DocumentController;

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


Route::prefix('admin')->group(function(){
    // All the admin route will be defined here
    Route::match(['get', 'post'], '/', [AdminController::class, 'login'])->name('admin.login');;
    Route::group(['middleware' => ['admin']], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('password', [AdminController::class, 'password'])->name('admin.password');
        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::post('check-current-pwd', [AdminController::class, 'chkCurrentPassword']);
        Route::post('update-current-pwd', [AdminController::class, 'updateCurrentPassword'])->name('update.password');
        Route::match(['get', 'post'], 'settings', [AdminController::class, 'settings'])->name('admin.settings');

        // Category Section
        Route::resource('category', CategoryController::class);
        Route::post('category-status', [CategoryController::class, 'categoryStatus'])->name('category.status');

        // Slider Section
        Route::resource('slider', SliderController::class);
        Route::post('slider-status', [SliderController::class, 'sliderStatus'])->name('slider.status');

        // Course Section
        Route::resource('course', CourseController::class);
        Route::post('course-status', [CourseController::class, 'courseStatus'])->name('course.status');

        // Lesson Section
        Route::resource('lesson', LessonController::class);
        Route::match(['get', 'post'], 'add-lesson/{id}', [LessonController::class, 'addLesson'])->name('lesson.add');
        Route::post('lesson-status', [LessonController::class, 'lessonStatus'])->name('lesson.status');

        // Document Section
        Route::resource('document', DocumentController::class);
        Route::match(['get', 'post'], 'add-document/{id}', [DocumentController::class, 'addDocument'])->name('document.add');
        Route::post('document-status', [DocumentController::class, 'documentStatus'])->name('document.status');

        // Post Section
        Route::resource('post', PostController::class);
        Route::match(['get', 'post'], 'add-post/{id}', [PostController::class, 'addPost'])->name('post.add');
        Route::post('post-status', [PostController::class, 'postStatus'])->name('post.status');

        // Grade Section
        Route::resource('grade', GradeController::class);

        // Tip Section
        Route::resource('tip', TipController::class);
        Route::post('tip-status', [TipController::class, 'tipStatus'])->name('tip.status');

        // User Section
        Route::resource('user', UserController::class);

        // Admin Section
        Route::resource('admin', AuthController::class);
    });
});
