<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\AdminChangePass;
use App\Models\Admin;

class ChangePasswordController extends Controller
{
    public function password(){
        $adminPassword = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('backend.settings.password')->with(compact('adminPassword'));
    }

    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function updateCurrentPassword(AdminChangePass $request){
        if($request -> isMethod('post')){
            // Check if current password is correct
            if(Hash::check($request['old_password'], Auth::guard('admin')->user()->password)){
                // Check new password and confirm password are same
                if ($request['password'] == $request['password_confirmation']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($request['password'])]);
                    return redirect()->back()->with('error', 'Cập nhật mật khẩu thành công!');
                // Check new password and confirm password are not same
                } else {
                    return redirect()->back()->with('error', 'Mật khẩu mới và xác nhận mật khẩu không giống nhau !!!');
                }
            }else{
                return redirect()->back()->with('error', 'Mật khẩu hiện tại sai rồi !!!');
            }
            return redirect()->back();
        }
    }
}
