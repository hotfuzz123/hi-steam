<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\LoginRequest;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('backend.admin.auth.login');
        }

        $credentials = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            return redirect()->route('admin.dashboard')->withInfo('Xin chào, '. $admin->name);
        } else {
            return redirect()->back()->withError('Email hoặc mật khẩu sai !!!');
        }
        return view('backend.admin.auth.login');
}
}
