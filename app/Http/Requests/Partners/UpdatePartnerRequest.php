<?php

namespace App\Http\Requests\Partners;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:20|unique:partners,code,' . $this->partner->id,
			'name' => 'required|string|min:1|max:100',
			'email' => 'required|email|unique:partners,email,' . $this->partner->id,
			'phone' => 'required|min:1|max:20',
			'pic' => 'required|string|min:1|max:100',
			'password' => 'nullable|confirmed',
			'address' => 'nullable|string',
            'photo' => 'nullable|image|max:1024',
        ];
    }
}
