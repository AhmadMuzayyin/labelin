<?php

namespace App\Http\Requests\TypeQrs;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeQrRequest extends FormRequest
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
            'name' => 'required|string|min:1|max:100',
			'price' => 'required|numeric',
            'photo' => 'required|image|max:1024',
        ];
    }
}
