<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRegister;
use App\Http\Requests\UserLogin;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Carbon\Carbon;
use App\Http\Resources\UserResource;

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
        $user = User::create($request->all());
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
            $token = $user->createToken("token")->accessToken;
            return response([
                'status' => '200',
                'message' => 'Đăng nhập thành công!',
                'data' => $user,
                'token' => $token,
                'token_type' => 'Bearer',
            ]);
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
        return response(['status' => '200', 'message' => '', 'data' => $user], 200);
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
        if($request->hasFile('avatar')){
            $files = $request->file('avatar');
            $path = public_path('storage/images/user/'.$user->avatar);
            if(file_exists($path)){
                unlink($path);
            }
            $name = date('dmYHis').'_'.uniqid().'.'.$files->getClientOriginalExtension();
            $files->storeAs('images/user', $name, 'public');
            $user->avatar = $name;
        }
        $user->save();
        return response(['status' => '200', 'message' => 'Cập nhật thành công!', 'data' => $user], 200);

    }
}
