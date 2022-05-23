<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Document;
use App\Http\Requests\Document\DocumentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $document = Document::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'image', 'document', $document);
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $document->update($data);
            DB::commit();
            return redirect()->back()->withSuccess('Cập nhật thành công');
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
            $document = Document::findOrFail($id);
            $document->delete();
            DB::commit();
            return redirect()->back()->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }

    /**
     * Add document from lesson id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addDocument(Request $request, $id)
    {
        if ($request->getMethod() == 'GET') {
            $lesson = Lesson::with('document')->findOrFail($id);
            return view('backend.document.create')->with(compact('lesson'));
        }

        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $request['lesson_id'] = $id;
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'image', 'document');
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $document = Document::create($data);
            DB::commit();
            return redirect()->back()->withSuccess('Thêm thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
