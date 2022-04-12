<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'email' => 'required|email',
            'phone' => 'required|string',
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.website_title' => ['required', 'string']];
            $rules += [$locale . '.meta_title' => ['required']];
            $rules += [$locale . '.meta_description' => ['required', 'string']];
            $rules += [$locale . '.meta_keywords' => ['required', 'string']];
            $rules += [$locale . '.address' => ['required', 'string']];
        }
        return  $rules;
    }
    public function messages()
    {
        $messages = [
            'facebook.required' => trans('admin.error_message.facebook_required'),
            'twitter.required' => trans('admin.error_message.twitter_required'),
            'instagram.required' => trans('admin.error_message.instagram_required'),
            'email.required' => trans('admin.error_message.email_required'),
            'phone.required' => trans('admin.error_message.phone_required'),
        ];
        foreach (config('translatable.locales') as $locale) {
            $messages += [$locale . '.website_title.required' => trans('admin.error_message.website_title_required_' . $locale)];
            $messages += [$locale . '.meta_title.required' => trans('admin.error_message.meta_title_required_' . $locale)];
            $messages += [$locale . '.meta_description.required' => trans('admin.error_message.meta_description_required_' . $locale)];
            $messages += [$locale . '.meta_keywords.required' => trans('admin.error_message.meta_keywords_required_' . $locale)];
            $messages += [$locale . '.address.required' => trans('admin.error_message.address_required_' . $locale)];
        }
        return $messages;
    }

}
