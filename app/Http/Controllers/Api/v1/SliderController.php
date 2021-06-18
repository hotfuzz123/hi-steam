<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Http\Requests\SliderRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::all();
        return response(['status' => '200', 'data' => $slider], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = Slider::create($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('slider')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $slider->image = $imageUrl;
            $slider->public_id = $publicId;
        }
        $slider->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $slider], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::findOrFail($id);
        return response(['status' => '200', 'data' => $slider], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SliderRequest $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($slider->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('slider')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $slider->image = $imageUrl;
            $slider->public_id = $publicId;
        }
        $slider->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $slider], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($slider->public_id);
        $slider->delete();
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
