<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Admin::orderBy('created_at', 'DESC')->get();
        return view('backend.admin.index')->with(compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => bcrypt($request['password']),
            ]);
            DB::commit();
            return redirect()->route('admin.index')->withSuccess('Thêm thành công');
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
        // return view('backend.category.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $admin = Admin::findOrFail($id);
        // return view('backend.admin.edit')->with(compact('admin'));
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
            $admin = Admin::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'avatar', 'admin', $admin);
            if(!empty($dataUpload)) {
                $data['avatar'] = $dataUpload['avatar'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $admin->update($data);
            DB::commit();
            return redirect()->route('admin.index')->with(compact('admin'))->withSuccess('Cập nhật thành công');
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
        //
    }

    public function editProfile(Request $request){
        if ($request->getMethod() == 'GET') {
            return view('backend.settings.profile');
        }

        try {
            DB::beginTransaction();
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'avatar', 'admin', $admin);
            if(!empty($dataUpload)) {
                $data['avatar'] = $dataUpload['avatar'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $admin->update($data);
            DB::commit();
            return redirect()->back()->withSuccess('Cập nhật thành công');
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return back()->withError('Đã có lỗi xảy ra');
        }
    }
}
