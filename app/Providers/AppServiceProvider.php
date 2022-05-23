<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Models\Course;
use App\Observers\CourseObserver;
use App\Models\Lesson;
use App\Observers\LessonObserver;
use App\Models\Post;
use App\Observers\PostObserver;
use App\Models\Slider;
use App\Observers\SliderObserver;
use App\Models\Tip;
use App\Observers\TipObserver;
use App\Models\User;
use App\Observers\UserObserver;
use App\Models\Admin;
use App\Observers\AdminObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set time to vietnamese
        Carbon::setLocale(env('LOCALE', 'vi'));
        
        // Force https
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        // Observer
        Category::observe(CategoryObserver::class);
        Course::observe(CourseObserver::class);
        Lesson::observe(LessonObserver::class);
        Post::observe(PostObserver::class);
        Slider::observe(SliderObserver::class);
        Tip::observe(TipObserver::class);
        User::observe(UserObserver::class);
        Admin::observe(AdminObserver::class);
    }
}
