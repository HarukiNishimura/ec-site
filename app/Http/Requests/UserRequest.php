<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'postal_code' => 'required|regex:/^[0-9]{3}-[0-9]{4}$/',
            'pref_id' => 'required',
            'city' => 'required|max:50',
            'town' => 'required|max:50',
            'building' =>'max:50',
            'phone_number' =>'required|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{4}$/',
        ];
    }
}
