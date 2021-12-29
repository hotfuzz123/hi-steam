<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nameUser' => $this->user->name,
            'avatar' => $this->user->avatar,
            'content' => $this->content,
            'timeUpload' => (string) $this->created_at,
            'heart' => $this->heart,
            'answer' => CommentResource::collection($this->answer),
        ];
    }
}
