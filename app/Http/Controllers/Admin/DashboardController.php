<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(Request $request){
        $courseTotal = Course::count();
        $lessonTotal = Lesson::count();
        $userTotal = User::count();
        $postTotal = Post::count();
        $user = User::orderBy('created_at', 'DESC')->limit(10)->get();
        return view('backend.dashboard')->with(compact('courseTotal', 'lessonTotal', 'userTotal', 'postTotal', 'user'));
    }
}
