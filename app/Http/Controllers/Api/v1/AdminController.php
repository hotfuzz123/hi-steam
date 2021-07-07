<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\AdminRegister;
use App\Http\Requests\AdminLogin;
use App\Http\Requests\AdminChangePass;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;

class AdminController extends Controller
{
    /**
     * Register a new admin
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerAdmin(AdminRegister $request)
    {
        $admin = Admin::create($request->all());
        return response(['status' => '200', 'message' => 'Đăng ký thành công!', 'data' => $admin], 200);
    }

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginAdmin(AdminLogin $request)
    {
        if (Auth::guard('admin')->attempt($request->validated())) {
            $admin = Auth::guard('admin')->user();
            $tokenResult = $admin->createToken('token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);

            //save the token
            $token->save();

            return response()->json([
                'status' => '200',
                'message' => 'Đăng nhập thành công!',
                'data' => $admin,
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
            ],200);
        } else {
            return response(['status' => '401', 'message' => 'Kiểm tra lại số điện thoại và mật khẩu'], 401);
        }
    }

    /**
     * Logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response(['status' => '200', 'message' => 'Đăng xuất thành công'], 200);
    }

    /**
     * Get admin info after login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAdmin(Request $request)
    {
        $admin = auth()->user();
        return response(['status' => '200', 'data' => $admin], 200);
    }

    /**
     * Update user info after login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request)
    {
        $admin = Admin::find($request->user()->id);
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
        return response(['status' => '200', 'message' => 'Cập nhật thành công!', 'data' => $admin], 200);
    }


    /**
     * Change pass
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(AdminChangePass $request){
        // Check if current password is correct
        if(Hash::check($request['old_password'], Auth::user()->password)){
            // Check new password and confirm password are same
            if ($request['password'] == $request['password_confirmation']) {
                Admin::where('id', Auth::user()->id)->update(['password' => bcrypt($request['password'])]);
                return response(['status' => '200', 'message' => 'Đổi mật khẩu thành công'], 200);
            // Check new password and confirm password are not same
            } else {
                return response(['status' => '211', 'message' => 'Mật khẩu mới và xác nhận mật khẩu không giống nhau !!!'], 211);
            }
        }else{
            return response(['status' => '211', 'message' => 'Mật khẩu hiện tại sai rồi !!!'], 211);
        }
    }
}
