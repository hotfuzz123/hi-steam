<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
                    'content' => 'required',
                    'review_id' => 'required',
                    'admin_id' => 'required',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'content' => 'required',
                    'review_id' => 'required',
                    'admin_id' => 'required',
                ];
            default:break;
        }
    }
}
