<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tip;
use App\Http\Requests\Tip\TipRequest;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TipController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tip = Tip::orderBy('created_at', 'DESC')->get();
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
        try {
            DB::beginTransaction();
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'image', 'tip');
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $tip = Tip::create($data);
            DB::commit();
            return redirect()->route('tip.index')->withSuccess('Thêm thành công');
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
        try {
            DB::beginTransaction();
            $tip = Tip::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'image', 'tip', $tip);
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $tip->update($data);
            DB::commit();
            return redirect()->route('tip.index')->with(compact('tip'))->withSuccess('Cập nhật thành công');
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
            $tip = Tip::findOrFail($id);
            $tip->delete();
            DB::commit();
            return redirect()->route('tip.index')->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
