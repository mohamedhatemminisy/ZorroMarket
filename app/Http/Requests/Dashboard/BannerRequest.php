<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        $image = request()->isMethod('put') ? 'nullable|mimes:jpeg,jpg,png,gif,svg|max:8000' : 'required|mimes:jpeg,jpg,png,gif,svg|max:8000';

        $rules = [
            'image'  => $image,
            'type'   => 'required',
        ];
        return $rules;
    }
    public function messages()
    {
        $messages = [
            'image.required' =>  trans('admin.error_message.image_required'),
            'type.required'  =>  trans('admin.error_message.type_required'),
        ];

        return $messages;
    }
}
