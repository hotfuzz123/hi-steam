<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Document;
use App\Http\Requests\DocumentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class DocumentController extends Controller
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
    public function documentStatus(Request $request)
    {
        if($request->mode == 'true'){
            Document::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Document::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.document.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        return view('backend.document.edit')->with(compact('document'));
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
        $document = Document::findOrFail($id);
        $document->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($document->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('document')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $document->image = $imageUrl;
            $document->public_id = $publicId;
        }
        $document->save();
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
        $document = Document::findOrFail($id);
        //Delete old image
        Cloudinary::destroy($document->public_id);
        $document->delete();
        Session::flash('success', 'Xoá thành công');
        return redirect()->back();
    }

    /**
     * Add document from lesson id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addDocument(Request $request, $id)
    {
        if($request->isMethod('post')){
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $request['lesson_id'] = $id;
            $document = Document::create($request->all());
            if($request->hasFile('image')){
                $files = $request->file('image');
                //Upload new image
                $imageUrl = $files->storeOnCloudinary('document')->getSecurePath();
                //Get public_id
                $publicId = Cloudinary::getPublicId();
                //Get url image and public_id to db
                $document->image = $imageUrl;
                $document->public_id = $publicId;
            }
            $document->save();
            Session::flash('success', 'Thêm thành công');
            return redirect()->back();

        }
        $lesson = Lesson::with('document')->findOrFail($id);
        // $course = json_decode(json_encode($course));
        // echo "<pre>"; print_r($course); die;
        return view('backend.document.create')->with(compact('lesson'));
    }
}
