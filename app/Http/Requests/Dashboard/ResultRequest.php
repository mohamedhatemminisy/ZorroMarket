<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
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
            'file'  => 'required',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return[
            'file.required' => trans('admin.error_message.file_required'),
            'date.required' => trans('admin.error_message.date_required'),
            'time.required' => trans('admin.error_message.time_required'),
        ];
    }
}
