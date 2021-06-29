<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                    'name' => 'required|string',
                    'material' => 'nullable|string',
                    'description' => 'nullable|string',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'video_link' => 'nullable|string',
                    'view_count' => 'nullable|string',
                    'category_id' => 'nullable|integer',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string',
                    'material' => 'nullable|string',
                    'description' => 'nullable|string',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'video_link' => 'nullable|string',
                    'view_count' => 'nullable|string',
                    'category_id' => 'nullable|integer',
                ];
            default:break;
        }
    }
}