<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
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
        $rules=[
            'duration'   =>  'required',
            'price'      =>  'required'
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => ['required']];
            $rules += [$locale . '.type' => ['required']];
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'duration.required'   => trans('admin.error_message.duration_required'),
            'price.required'      => trans('admin.error_message.price_required')
        ];
        foreach (config('translatable.locales') as $locale) {
            $messages += [$locale . '.name.required' => trans('admin.error_message.name_required_' . $locale)];
            $messages += [$locale . '.description.required' => trans('admin.error_message.description_required_' . $locale)];
            $messages += [$locale . '.type.required' => trans('admin.error_message.type_required_' . $locale)];
        }
        return $messages;
    }

}
