<?php

namespace App\Http\Requests\Business;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:20|unique:businesses,code,' . $this->business->id,
			'name' => 'required|string|min:1|max:100',
			'brand' => 'required|string|min:1|max:100',
			'logo' => 'nullable|image|max:1024',
			'manufacture' => 'required|string|min:1|max:255',
        ];
    }
}
