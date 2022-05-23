<?php

namespace App\Http\Requests\Homework;

use Illuminate\Foundation\Http\FormRequest;

class HomeworkRequest extends FormRequest
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
                    'file' => 'required',
                    'lesson_id' => 'required|integer',

                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required',
                    'file' => 'nullable',
                    'lesson_id' => 'required|integer',
                ];
            default:break;
        }
    }
}
