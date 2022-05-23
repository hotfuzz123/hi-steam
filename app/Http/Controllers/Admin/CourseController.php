<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Category;
use App\Http\Requests\Course\CourseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::with('category', 'admin')->orderBy('created_at', 'DESC')->get();
        return view('backend.course.index')->with(compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.course.create')->with(compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $course = Course::create($request->all());
            DB::commit();
            return redirect()->route('course.index')->withSuccess('Thêm thành công');
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
        return view('backend.course.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $category = Category::all();
        return view('backend.course.edit')->with(compact('course', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $course = Course::findOrFail($id);
            $course->update($request->all());
            DB::commit();
            return redirect()->route('course.index')->with(compact('course'))->withSuccess('Cập nhật thành công');
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
            $course = Course::findOrFail($id);
            $course->delete();
            DB::commit();
            return redirect()->route('course.index')->withSuccess('Xoá thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
