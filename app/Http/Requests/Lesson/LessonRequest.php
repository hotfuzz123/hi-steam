<?php

namespace App\Http\Requests\Lesson;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'name' => 'required',
                    'material' => 'nullable',
                    'image' => 'nullable',
                    'video_link' => 'nullable',
                    'view_count' => 'nullable',
                    'status' => 'required|in:active,inactive',
                    'course_id' => 'required|integer',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required',
                    'material' => 'nullable',
                    'image' => 'nullable',
                    'video_link' => 'nullable',
                    'view_count' => 'nullable',
                    'status' => 'required|in:active,inactive',
                    'course_id' => 'required|integer',
                ];
            default:break;
        }
    }
}
