<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminReviewResource extends JsonResource
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
            'nameTeacher' => $this->name,
            'avatar' => $this->avatar,
            'content' => $this->whenPivotLoaded('admin_review', function () {
                return $this->pivot->content;
            }),
            'timeUpload' => (string) $this->created_at,
        ];
    }
}
