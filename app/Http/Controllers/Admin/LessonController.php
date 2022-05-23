<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Http\Requests\Lesson\LessonRequest;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    use ImageTrait;

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
    public function lessonStatus(Request $request)
    {
        if($request->mode == 'true'){
            Lesson::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Lesson::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.lesson.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        return view('backend.lesson.edit')->with(compact('lesson'));
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
            $lesson = Lesson::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'thumbnail', 'lesson', $lesson);
            if(!empty($dataUpload)) {
                $data['thumbnail'] = $dataUpload['thumbnail'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $lesson->update($data);
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
            $lesson = Lesson::findOrFail($id);
            $lesson->delete();
            DB::commit();
            return redirect()->back()->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }

    /**
     * Add lesson from section id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addLesson(Request $request, $id)
    {
        if ($request->getMethod() == 'GET') {
            $course = Course::with('category', 'lesson')->findOrFail($id);
            return view('backend.lesson.create')->with(compact('course'));
        }

        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $request['course_id'] = $id;
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'thumbnail', 'lesson');
            if(!empty($dataUpload)) {
                $data['thumbnail'] = $dataUpload['thumbnail'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $lesson = Lesson::create($data);
            DB::commit();
            return redirect()->back()->withSuccess('Thêm thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
