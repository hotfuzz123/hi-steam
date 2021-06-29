<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
                    'url' => 'nullable|string',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'description' => 'nullable|string',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required|string',
                    'url' => 'nullable|string',
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'description' => 'nullable|string',
                ];
            default:break;
        }
    }
}