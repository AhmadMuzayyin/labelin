<?php

namespace App\Http\Requests\RequestQrs;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequestQrRequest extends FormRequest
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
            'product_id' => 'required|exists:App\Models\Product,id',
			'type_qr_id' => 'required|exists:App\Models\TypeQr,id',
			'qty' => 'required|numeric|min:1',
			'sn_length' => 'required|numeric|min:5|max:10',
        ];
    }
}
