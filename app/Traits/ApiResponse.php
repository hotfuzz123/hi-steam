<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data = null, $message = null, $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => 'success',
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message = null, $code = 200)
    {
        return response()->json([
            'status' => $code,
            'message' => 'fail',
            'data' => null
        ], $code);
    }
}