<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrolledResource extends JsonResource
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
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'theme' => $this->course->title,
            'teacher' => $this->admin->name,
            'avatar' => $this->admin->avatar,
            // 'status' => $this->whenPivotLoaded('course_user', function (){
            //     return $this->review->first->content->pivot->content;
            // }),
            'status' => $this->admin->status,
        ];
    }
}
