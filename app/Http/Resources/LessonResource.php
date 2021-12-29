<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LessonResource extends JsonResource
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
            'tool' => $this->tool,
            'description' => $this->description,
            'thumbnail' => $this->thumbnail,
            'video' => $this->video_link,
            'view' => $this->view,
        ];
    }
}
