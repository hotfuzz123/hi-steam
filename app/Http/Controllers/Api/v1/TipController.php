<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tip;
use App\Http\Requests\TipRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class TipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tip = Tip::all();
        return response(['status' => '200', 'data' => $tip], 200);
    }

    /**
     * Random a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function randomTip()
    {
        $tip = Tip::where('status', 'active')->inRandomOrder()->limit(4)->get();
        return response(['status' => '200', 'data' => $tip], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipRequest $request)
    {
        $tip = Tip::create($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('tip')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $tip->image = $imageUrl;
            $tip->public_id = $publicId;
        }
        $tip->save();
        return response(['status' => '200', 'message' => 'Thêm thành công', 'data' => $tip], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tip = Tip::findOrFail($id);
        return response(['status' => '200', 'data' => $tip], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TipRequest $request, $id)
    {
        $tip = Tip::findOrFail($id);
        $tip->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($tip->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('tip')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $tip->image = $imageUrl;
            $tip->public_id = $publicId;
        }
        $tip->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công', 'data' => $tip], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tip = Tip::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($tip->public_id);
        $tip->delete();
        return response(['status' => '200', 'message' => 'Xoá thành công', 'data' => null], 200);
    }
}
