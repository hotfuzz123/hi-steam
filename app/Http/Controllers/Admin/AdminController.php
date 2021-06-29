<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Image;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Models\Admin;

class AdminController extends Controller
{
    public function dashboard(){
        return view('backend.admin_dashboard');
    }

    public function password(){
        $adminPassword = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('backend.admin_password')->with(compact('adminPassword'));
    }

    public function login(Request $request){
        if($request -> isMethod('post')){
            $data = $request->all();
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                return redirect('admin/dashboard');
            } else {
                return redirect('/admin')->with('error_message', 'Email hoặc mật khẩu sai !!!');
            }
        }
        return view('backend.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin')->with('success_message', 'Đăng xuất admin thành công');
    }

    public function chkCurrentPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        //echo "<pre>"; print_r(Auth::guard('admin')->user()); die;
        if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
            echo "true";
        }else{
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request){
        if($request -> isMethod('post')){
            $data = $request->all();
            // Check if current password is correct
            if(Hash::check($data['current_pwd'], Auth::guard('admin')->user()->password)){
                // Check new password and confirm password are same
                if ($data['new_pwd'] == $data['confirm_pwd']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_pwd'])]);
                    Session::flash('success_message', 'Cập nhật mật khẩu thành công!');
                // Check new password and confirm password are not same
                } else {
                    Session::flash('error_message', 'Mật khẩu mới và xác nhận mật khẩu không giống nhau !!!');
                    return redirect()->back();
                }
            }else{
                Session::flash('error_message', 'Mật khẩu hiện tại sai rồi !!!');
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function settings(Request $request){
        if($request -> isMethod('post')){
            $admin = Admin::find(Auth::guard('admin')->user()->id);
            $admin->update($request->all());
            if($request->hasFile('image')){
                $files = $request->file('image');
                //Delete old image
                Cloudinary::destroy($admin->public_id);
                //Upload new image
                $imageUrl = $files->storeOnCloudinary('admin')->getSecurePath();
                //Get public_id
                $publicId = Cloudinary::getPublicId();
                //Get url image and public_id to db
                $admin->image = $imageUrl;
                $admin->public_id = $publicId;
            }
            $admin->save();
            Session::flash('success_message', 'Cập nhật thành công');
        }
        return view('backend.settings.admin_settings');
    }
}
