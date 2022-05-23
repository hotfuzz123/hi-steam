<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->back()->withSuccess('Đăng xuất thành công');
    }
}
