<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::whereNull('parent_id')->get();
        return $this->successResponse(CommentResource::collection($comment));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['user_id'] = auth()->user()->id;
            $comment = Comment::create($request->all());
            DB::commit();
            return $this->successResponse(CommentResource::collection($comment));
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
        $comment = Comment::where("lesson_id", "=", $id)->get();
        return $this->successResponse(CommentResource::collection($comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $comment = Comment::findOrFail($id);
            $comment->update($request->all());
            DB::commit();
            return $this->successResponse(CommentResource::collection($comment));
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
            $comment = Comment::findOrFail($id);
            $comment->delete();
            DB::commit();
            return $this->successResponse(CommentResource::collection($comment));
        } catch (\Throwable $exception) {
            Log::error($exception->getMessage()." expected Line: ".$exception->getLine());
            DB::rollBack();
            return $this->errorResponse();
        }
    }
}
