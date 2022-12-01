<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'code' => 'required|string|min:1|max:20',
			'name' => 'required|string|min:1|max:200',
			'category_id' => 'required|exists:App\Models\Category,id',
			'business_id' => 'required|exists:App\Models\Business,id',
			'bpom' => 'required|string|min:1|max:200',
			'description' => 'required|string',
			'photo' => 'required|image|max:1024',
        ];
    }
}
