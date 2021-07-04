<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mission;
use App\Models\Course;
use App\Http\Requests\MissionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        $mission = Mission::with('course')->get();
        return view('backend.mission.index')->with(compact('mission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::all();
        return view('backend.mission.create')->with(compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MissionRequest $request)
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
        Session::flash('success', 'Thêm thành công');
        return redirect()->route('mission.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.mission.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mission = Mission::findOrFail($id);
        $course = Course::all();
        return view('backend.mission.edit')->with(compact('mission', 'course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MissionRequest $request, $id)
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
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('mission.index')->with(compact('mission'));
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
        Session::flash('success', 'Xoá thành công');
        return redirect()->route('mission.index');
    }
}
