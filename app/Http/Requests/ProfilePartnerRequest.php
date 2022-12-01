<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilePartnerRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:20|unique:partners,code,' . request()->id,
			'name' => 'required|string|min:1|max:100',
			'email' => 'required|email|unique:partners,email,' . request()->id,
			'phone' => 'required|min:1|max:20',
			'pic' => 'required|string|min:1|max:100',
			'password' => 'nullable|confirmed',
			'address' => 'nullable|string',
            'photo' => 'nullable|image|max:1024',
        ];
    }
}
