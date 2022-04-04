<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone' => 'required',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        $messages = [
            'email.required' =>  trans('admin.error_message.email_required'),
            'name.required' =>  trans('admin.error_message.name_required'),
            'phone.required' =>  trans('admin.error_message.phone_required'),
            'password.required' =>  trans('admin.error_message.password_required'),
        ];
   
        return $messages;
    }
}

