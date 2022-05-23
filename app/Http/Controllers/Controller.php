<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use RealRashid\SweetAlert\Facades\Alert;
use Flasher\Laravel\Facade\Flasher;
use App\Traits\ApiResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if (session('success')) {
                Flasher::addSuccess(session('success'));
            }

            if (session('error')) {
                Flasher::addError(session('error'));
            }

            if (session('warning')) {
                Flasher::addWarning(session('warning'));
            }

            if (session('info')) {
                Flasher::addInfo(session('info'));
            }

            return $next($request);
        });
    }
}
