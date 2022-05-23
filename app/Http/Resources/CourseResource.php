<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'title' => $this->title,
            'teacher' => $this->admin->name,
            'role' => $this->admin->role,
            'timeUpload' => (string) $this->created_at,
            'thumbnail' => $this->thumbnail,
            'details' => LessonResource::collection($this->lesson),
        ];
    }
}
