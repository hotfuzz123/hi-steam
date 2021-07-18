<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::with('course.lesson')->get();
        return response(['status' => '200', 'data' => $category], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        if($request->hasFile('icon')){
            $files = $request->file('icon');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('category')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $category->icon = $imageUrl;
            $category->public_id = $publicId;
        }
        $category->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $category], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response(['status' => '200', 'data' => $category], 200);
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
        $category = Category::findOrFail($id);
        $category->update($request->all());
        if($request->hasFile('icon')){
            $files = $request->file('icon');
            //Delete old image
            Cloudinary::destroy($category->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('category')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $category->icon = $imageUrl;
            $category->public_id = $publicId;
        }
        $category->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $category], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        //Delete old image
        Cloudinary::destroy($category->public_id);
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
