<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterPartnerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:100',
            'email' => 'required|email|unique:partners,email',
            'address' => 'string|required|min:5',
            'phone' => 'string|max:20|min:10',
            'password' => $this->passwordRules(),
            'syarat' => 'required'
        ];
    }

    protected function passwordRules()
    {
        if (app()->isProduction()) {
            return [
                'required',
                'confirmed',
                Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()
            ];
        }

        return ['required', 'confirmed', 'min:5'];
    }
}
