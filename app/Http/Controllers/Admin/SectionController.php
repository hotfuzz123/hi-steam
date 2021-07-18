<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Section;
use App\Http\Requests\SectionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
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
     * Update section status.
     *
     * @return \Illuminate\Http\Response
     */
    public function sectionStatus(Request $request)
    {
        if($request->mode == 'true'){
            Section::where('id', $request->id)->update(['status' => 'active']);
        } else {
            Section::where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.section.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('backend.section.edit')->with(compact('section'));
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
        $section = Section::findOrFail($id);
        $section->update($request->all());
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
        $section = Section::findOrFail($id);
        $section->delete();
        Session::flash('success', 'Xoá thành công');
        return redirect()->back();
    }

    /**
     * Add section from course id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addSection(Request $request, $id)
    {
        if($request->isMethod('post')){
            $request['admin_id'] = Auth::guard('admin')->user()->id;
            $request['course_id'] = $id;
            $section = Section::create($request->all());
            Session::flash('success', 'Thêm thành công');
            return redirect()->back();

        }
        $course = Course::with('category', 'section')->findOrFail($id);
        // $course = json_decode(json_encode($course));
        // echo "<pre>"; print_r($course); die;
        return view('backend.section.create')->with(compact('course'));
    }
}
