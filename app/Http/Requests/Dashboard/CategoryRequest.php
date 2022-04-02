<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'slug'         => 'required',
            "parent_id"    => "required_if:category_type,sub_category",
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
        }
        return $rules;
    }

    public function messages()
    {
        $messages = [
            'slug.required' =>  trans('admin.error_message.slug_required'),
            'parent_id.required_if' =>  trans('admin.error_message.parent_id_required'),
        ];
        foreach (config('translatable.locales') as $locale) {
            $messages += [$locale . '.name.required' => trans('admin.error_message.name_required_' . $locale)];
        }
        return $messages;
    }
}
