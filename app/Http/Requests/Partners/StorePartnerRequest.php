<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnerRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:20|unique:partners,code',
			'name' => 'required|string|min:1|max:100',
			'email' => 'required|email|unique:partners,email',
			'phone' => 'required|min:1|max:20',
			'pic' => 'required|string|min:1|max:100',
			'password' => 'required|confirmed',
			'address' => 'nullable|string',
            'photo' => 'required|image|max:1024',
        ];
    }
}
