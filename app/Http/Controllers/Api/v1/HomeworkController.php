<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homework;
use App\Http\Requests\HomeworkRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homework = Homework::with('course')->get();
        return response(['status' => '200', 'data' => $homework], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $homework = Homework::create($request->all());
        if($request->hasFile('file')){
            $files = $request->file('file');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('homework')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $homework->file = $imageUrl;
            $homework->public_id = $publicId;
        }
        $homework->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $homework], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homework = Homework::findOrFail($id);
        return response(['status' => '200', 'data' => $homework], 200);
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
        $homework = Homework::findOrFail($id);
        $homework->update($request->all());
        if($request->hasFile('file')){
            $files = $request->file('file');
            //Delete old image
            Cloudinary::destroy($homework->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('homework')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $homework->file = $imageUrl;
            $homework->public_id = $publicId;
        }
        $homework->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $homework], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homework = Homework::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($homework->public_id);
        $homework->delete();
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
