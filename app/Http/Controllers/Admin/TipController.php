<?php

namespace App\Http\Controllers\Admin;

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
        return view('backend.tip.index')->with(compact('tip'));
    }

    /**
     * Update tip status.
     *
     * @return \Illuminate\Http\Response
     */
    public function tipStatus(Request $request)
    {
        if($request->mode == 'true'){
            Tip::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Tip::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.tip.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        Session::flash('success', 'Thêm thành công');
        return redirect()->route('tip.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.tip.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tip = Tip::findOrFail($id);
        return view('backend.tip.edit')->with(compact('tip'));
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
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('tip.index')->with(compact('tip'));
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
        Session::flash('success', 'Xoá thành công');
        return redirect()->route('tip.index');
    }
}
