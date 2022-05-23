<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\User\UserRegister;
use App\Http\Requests\User\UserLogin;
use App\Http\Requests\User\UserChangePass;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegister $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
        return response(['status' => '200', 'message' => 'Đăng ký thành công!', 'data' => $user], 200);
    }

    /**
     * Login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(UserLogin $request)
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            $tokenResult = $user->createToken('token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);

            //save the token
            $token->save();

            return response()->json([
                'status' => '200',
                'message' => 'Đăng nhập thành công!',
                'data' => $user,
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
     * Get user info after login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request)
    {
        $user = auth()->user();
        return response(['status' => '200', 'data' => $user], 200);
    }

    /**
     * Update user info after login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        $user = User::find($request->user()->id);
        $user->update($request->all());
        if($request->hasFile('image')){
            $files = $request->file('image');
            //Delete old image
            Cloudinary::destroy($user->public_id);
            //Upload new image
            $imageUrl = $files->storeOnCloudinary('user')->getSecurePath();
            //Get public_id
            $publicId = Cloudinary::getPublicId();
            //Get url image and public_id to db
            $user->image = $imageUrl;
            $user->public_id = $publicId;
        }
        $user->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công!', 'data' => $user], 200);
    }


    /**
     * Change pass
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(UserChangePass $request){
        // Check if current password is correct
        if(Hash::check($request['old_password'], Auth::user()->password)){
            // Check new password and confirm password are same
            if($request['password'] == $request['password_confirmation']) {
                User::where('id', Auth::user()->id)->update(['password' => bcrypt($request['password'])]);
                return response(['status' => '200', 'message' => 'Đổi mật khẩu thành công'], 200);
            // Check new password and confirm password are not same
            }else{
                return response(['status' => '211', 'message' => 'Mật khẩu mới và xác nhận mật khẩu không giống nhau !!!'], 211);
            }
        }else{
            return response(['status' => '211', 'message' => 'Mật khẩu hiện tại sai rồi !!!'], 211);
        }
    }
}
