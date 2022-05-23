<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\Admin\AdminRegister;
use App\Http\Requests\Admin\AdminLogin;
use App\Http\Requests\Admin\AdminChangePass;
use App\Http\Resources\AdminResource;
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
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $admin = Admin::with('course')->limit($limit)->get();
        return AdminResource::collection($admin);
    }

    /**
     * Display a listing of the best teacher.
     *
     * @return \Illuminate\Http\Response
     */
    public function bestTeacher(Request $request)
    {
        $admin = Admin::orderBy('number_student_follow', 'DESC')->limit(4)->get();
        return AdminResource::collection($admin);
    }
}
