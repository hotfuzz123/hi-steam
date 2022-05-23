<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\Post\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::orderBy('created_at', 'DESC')->get();
        return view('backend.post.index')->with(compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'image', 'post');
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $post = Post::create($data);
            DB::commit();
            return redirect()->route('post.index')->withSuccess('Thêm thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('backend.post.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.post.edit')->with(compact('post'));
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
        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $post = Post::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'image', 'post', $post);
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $post->update($data);
            DB::commit();
            return redirect()->route('post.index')->with(compact('post'))->withSuccess('Cập nhật thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $post = Post::findOrFail($id);
            $post->delete();
            DB::commit();
            return redirect()->route('post.index')->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }

        
    }
}
