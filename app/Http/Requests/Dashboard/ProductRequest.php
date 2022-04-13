<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $id = $this->input('id');
        $special_price = $this->input('special_price');
        if ($special_price) {
            $start_date = 'required_with:special_price|date|before:end_date';
            $end_date = 'required_with:special_price|date|after:start_date';
        } else {
            $start_date = 'nullable';
            $end_date = 'nullable';
        }
        $rules = [
            'main_image'  => $image,
            'slug'         => 'required|unique:products,slug,' . $id,
            'sku'         => 'nullable|unique:products,sku,' . $id,
            'price' => 'required|min:0|numeric',
            'brand_id' => 'required',
            'country_id' => 'required',
            'quantity'   => 'required|numeric',
            'special_price' => 'nullable|numeric',
            'video' => 'nullable|mimes:mp4,mov,ogg | max:50000',
            'start_date' => $start_date,
            'end_date' =>  $end_date,
            'images' => 'nullable|array|min:1',
            'images.*' => 'mimes:jpeg,jpg,png,gif,svg|max:8000',
            "categories"    => "required|array|min:1",
            "categories.*"  => "required|string|min:1",
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
            $rules += [$locale . '.description' => ['required']];
            $rules += [$locale . '.summary' => ['required']];
        }
        return $rules;
    }
    public function messages()
    {
        $messages = [
            'main_image.required' =>  trans('admin.error_message.image_required'),
            'slug.required' =>  trans('admin.error_message.slug_required'),
            'slug.unique' =>  trans('admin.error_message.slug_unique'),
            'sku.required' =>  trans('admin.error_message.sku_required'),
            'sku.unique' =>  trans('admin.error_message.sku_unique'),
            'quantity.required' =>  trans('admin.error_message.quantity_required'),
            'quantity.numeric' =>  trans('admin.error_message.quantity_numeric'),
            'price.required' =>  trans('admin.error_message.price_required'),
            'price.numeric' =>  trans('admin.error_message.price_numeric'),
            'special_price.numeric' =>  trans('admin.error_message.special_price_numeric'),
            'start_date.required_with' =>  trans('admin.error_message.start_date_required_with'),
            'start_date.date' =>  trans('admin.error_message.start_date_date'),
            'start_date.before' =>  trans('admin.error_message.start_date_before'),
            'end_date.required_with' =>  trans('admin.error_message.end_date_required_with'),
            'end_date.date' =>  trans('admin.error_message.end_date_date'),
            'end_date.before' =>  trans('admin.error_message.end_date_after'),
            'brand_id.required' =>  trans('admin.error_message.brand_id_required'),
            'country_id.required' =>  trans('admin.error_message.country_id_required'),
            'categories.required' =>  trans('admin.error_message.categories_required'),
            'categories.array' =>  trans('admin.error_message.categories_array'),
            'images.array' =>  trans('admin.error_message.images_array'),
            'images.mimes' =>  trans('admin.error_message.images_mimes'),
            'video.mimes' =>  trans('admin.error_message.video_mimes'),
            'video.max' =>  trans('admin.error_message.video_max'),
            'main_image.mimes' =>  trans('admin.error_message.main_image_mimes'),
        ];
        foreach (config('translatable.locales') as $locale) {
            $messages += [$locale . '.name.required' => trans('admin.error_message.name_required_' . $locale)];
            $messages += [$locale . '.description.required' => trans('admin.error_message.description_required_' . $locale)];
            $messages += [$locale . '.summary.required' => trans('admin.error_message.summary_required_' . $locale)];
        }
        return $messages;
    }
}
