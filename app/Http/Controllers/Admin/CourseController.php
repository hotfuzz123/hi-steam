<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::with('category', 'admin')->get();
        return view('backend.course.index')->with(compact('course'));
    }

    /**
     * Update course status.
     *
     * @return \Illuminate\Http\Response
     */
    public function courseStatus(Request $request)
    {
        if($request->mode == 'true'){
            DB::table('course')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('course')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $category = Category::all();
        return view('backend.course.create')->with(compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['admin_id'] = Auth::guard('admin')->user()->id;
        $course = Course::create($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('course')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $course->image = $imageUrl;
            $course->public_id = $publicId;
        }
        $course->save();
        Session::flash('success', 'Thêm thành công');
        return redirect()->route('course.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.course.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $category = Category::all();
        return view('backend.course.edit')->with(compact('course', 'category'));
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
        $course = Course::findOrFail($id);
        $request['admin_id'] = Auth::guard('admin')->user()->id;
        $course->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($course->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('course')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $course->image = $imageUrl;
            $course->public_id = $publicId;
        }
        $course->save();
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('course.index')->with(compact('course'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($course->public_id);
        $course->delete();
        Session::flash('success', 'Xoá thành công');
        return redirect()->route('course.index');
    }
}
