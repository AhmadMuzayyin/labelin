<?php

namespace App\Http\Requests\RequestQrs;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequestQrRequest extends FormRequest
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
        // 'status' => 'required|in:waiting payment,pending payment,proses cetak QR,proses pengiriman',

        return [
            'product_id' => 'required|exists:App\Models\Product,id',
			'type_qr_id' => 'required|exists:App\Models\TypeQr,id',
			'qty' => 'required|numeric|min:1',
			'sn_length' => 'required|numeric|min:5|max:10',
            'code' => 'string|required|max:100'
            // 'tanggal_request' => 'required|date',
			// 'bukti_pembayaran' => 'nullable|mimes:png,jpg,jpeg,pdf,docx,doc|max:1024',
        ];
    }
}
