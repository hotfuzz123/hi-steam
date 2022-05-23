<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Requests\Slider\SliderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\ImageTrait;

class SliderController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::orderBy('created_at', 'DESC')->get();
        return view('backend.slider.index')->with(compact('slider'));
    }

    /**
     * Update slider status.
     *
     * @return \Illuminate\Http\Response
     */
    public function sliderStatus(Request $request)
    {
        if($request->mode == 'true'){
            Slider::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Slider::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'image', 'slider');
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $slider = Slider::create($data);
            DB::commit();
            return redirect()->route('slider.index')->withSuccess('Thêm thành công');
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
        return view('backend.slider.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit')->with(compact('slider'));
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
        try {
            DB::beginTransaction();
            $slider = Slider::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'image', 'slider', $slider);
            if(!empty($dataUpload)) {
                $data['image'] = $dataUpload['image'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $slider->update($data);
            DB::commit();
            return redirect()->route('slider.index')->with(compact('slider'))->withSuccess('Cập nhật thành công');
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
            $slider = Slider::findOrFail($id);
            $slider->delete();
            DB::commit();
            return redirect()->route('slider.index')->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
