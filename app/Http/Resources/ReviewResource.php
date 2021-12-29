<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'star' => $this->star,
            'timeUpload' => (string) $this->created_at,
            'answer' => AdminReviewResource::collection($this->admin),
        ];
    }
}
