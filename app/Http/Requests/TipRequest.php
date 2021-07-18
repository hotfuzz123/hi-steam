<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipRequest extends FormRequest
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
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
                    'status' => 'required|in:active,inactive',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg',
                    'status' => 'required|in:active,inactive',
                ];
            default:break;
        }
    }
}
