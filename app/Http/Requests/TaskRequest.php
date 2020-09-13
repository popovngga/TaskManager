<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        return [
            'header' => 'required',
            'description' => 'required',
            'to_user_id' => 'required',
            'status' => 'required',
            'deadline' => 'required',
            'comment' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'header.required' => 'Header is required',
            'description.required' => 'Description is required',
            'status.required' => 'Status is required',
            'deadline.required' => 'Deadline is required',
            'to_user_id.required' => 'Executor is required',
        ];
    }
}
