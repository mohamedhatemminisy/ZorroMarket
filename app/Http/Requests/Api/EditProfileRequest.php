<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'id_number'     => 'required',
            'name'          => 'required',
            'phone'         => 'required|unique:users,phone,'.Auth()->user()->id,
            'nationality'   => 'required',
            'birthrate'     => 'required',
            'age'           => 'required',
            'gender'        => 'required',
            'ID_image'      => 'required',
            'email'         => "required|email|unique:users,email,".Auth()->user()->id,

        ];
    }
    public function messages()
    {
        return [
            'id_number.required'    => trans('api.id_number_required'),
            'name.required'         => trans('api.name_required'),
            'email.required'        => trans('api.emil_requird'),
            'email.unique'          => trans('api.email_unique'),
            'password.required'     => trans('api.password_requred'),
            'phone.required'        => trans('api.phone_requred'),
            'phone.unique'          => trans('api.phone_unique'),
            'nationality.required'  => trans('api.nationality_requred'),
            'birthrate.required'    => trans('api.birthrate_required'),
            'age.required'          => trans('api.age_required'),
            'gender.required'       => trans('api.gender_required'),
            'ID_image.required'     => trans('api.ID_required'),

            
        ];
    }
}
