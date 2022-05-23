<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Homework;
use App\Http\Requests\Homework\HomeworkRequest;
use App\Http\Resources\HomeworkResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homework = Homework::with('user', 'lesson')->get();
        return $this->successResponse(HomeworkResource::collection($homework));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeworkRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['user_id'] = auth()->user()->id;
            $data = $request->all();
            $dataUpload = $this->uploadImage($request, 'file', 'homework');
            if(!empty($dataUpload)) {
                $data['file'] = $dataUpload['file'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $homework = Homework::create($data);
            DB::commit();
            return $this->successResponse(HomeworkResource::collection($homework));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return $this->errorResponse();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homework = Homework::findOrFail($id);
        return $this->successResponse(HomeworkResource::collection($homework));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeworkRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $homework = Homework::findOrFail($id);
            $data = $request->all();
            $dataUpload = $this->updateImage($request, 'file', 'homework', $homework);
            if(!empty($dataUpload)) {
                $data['file'] = $dataUpload['file'];
                $data['public_id'] = $dataUpload['public_id'];
            }
            $homework->update($data);
            DB::commit();
            return $this->successResponse(HomeworkResource::collection($homework));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return $this->errorResponse();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $homework = Homework::findOrFail($id);
            $homework->delete();
            DB::commit();
            return $this->successResponse(HomeworkResource::collection($homework));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return $this->errorResponse();
        }
    }
}
