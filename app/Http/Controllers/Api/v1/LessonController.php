<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Http\Requests\LessonRequest;
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
        $lesson = Lesson::with('admin', 'course', 'document', 'mission', 'comment', 'homework')->get();
        return response(['status' => '200', 'data' => $lesson], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function randomLesson(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $lesson = Lesson::with('admin', 'course')->where('status', 'active')->inRandomOrder()->limit($limit)->offset(($page - 1) * $limit)->get();
        return response(['status' => '200', 'data' => $lesson], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        $request['admin_id'] = auth()->user()->id;
        $lesson = Lesson::create($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('lesson')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $lesson->image = $imageUrl;
            $lesson->public_id = $publicId;
        }
        $lesson->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $lesson], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        return response(['status' => '200', 'data' => $lesson], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($lesson->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('lesson')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $lesson->image = $imageUrl;
            $lesson->public_id = $publicId;
        }
        $lesson->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $lesson], 200);
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
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
