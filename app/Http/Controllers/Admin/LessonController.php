<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Http\Requests\LessonRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Update lesson status.
     *
     * @return \Illuminate\Http\Response
     */
    public function lessonStatus(Request $request)
    {
        if($request->mode == 'true'){
            Lesson::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Lesson::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['message' => 'Cập nhật trạng thái thành công', 'status'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.lesson.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('backend.lesson.edit')->with(compact('lesson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['admin_id'] = Auth::guard('admin')->user()->id;
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        if($request->hasFile('thumbnail')){
            $files = $request->file('thumbnail');
            //Delete old image
            Cloudinary::destroy($lesson->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('lesson')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $lesson->thumbnail = $imageUrl;
            $lesson->public_id = $publicId;
        }
        $lesson->save();
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($lesson->public_id);
        $lesson->delete();
        Session::flash('success', 'Xoá thành công');
        return redirect()->back();
    }

    /**
     * Add lesson from section id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addLesson(Request $request, $id)
    {
        if($request->isMethod('post')){
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $request['course_id'] = $id;
            $lesson = Lesson::create($request->all());
            if($request->hasFile('thumbnail')){
                $files = $request->file('thumbnail');
                //Upload new image
                $imageUrl = $files->storeOnCloudinary('lesson')->getSecurePath();
                //Get public_id
                $publicId = Cloudinary::getPublicId();
                //Get url image and public_id to db
                $lesson->thumbnail = $imageUrl;
                $lesson->public_id = $publicId;
            }
            $lesson->save();
            Session::flash('success', 'Thêm thành công');
            return redirect()->back();

        }
        $course = Course::with('category', 'lesson')->findOrFail($id);
        // $course = json_decode(json_encode($course));
        // echo "<pre>"; print_r($course); die;
        return view('backend.lesson.create')->with(compact('course'));
    }
}
