<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Http\Requests\MissionRequest;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mission = Mission::with('lesson')->get();
        return response(['status' => '200', 'data' => $mission], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mission = Mission::create($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('mission')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $mission->image = $imageUrl;
            $mission->public_id = $publicId;
        }
        $mission->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $mission], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mission = Mission::findOrFail($id);
        return response(['status' => '200', 'data' => $mission], 200);
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
        $mission = Mission::findOrFail($id);
        $mission->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($mission->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('mission')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $mission->image = $imageUrl;
            $mission->public_id = $publicId;
        }
        $mission->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $mission], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mission = Mission::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($mission->public_id);
        $mission->delete();
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
