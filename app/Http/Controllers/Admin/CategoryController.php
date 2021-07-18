<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
        $category = Category::all();
        return view('backend.category.index')->with(compact('category'));
    }

    /**
     * Update category status.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryStatus(Request $request)
    {
        if($request->mode == 'true'){
            Category::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Category::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.category.create');
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
        Session::flash('success', 'Thêm thành công');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.category.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
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
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('category.index')->with(compact('category'));
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
        //Delete old image
        Cloudinary::destroy($category->public_id);
        $category->delete();
        Session::flash('success', 'Xoá thành công');
        return redirect()->route('category.index');
    }
}
