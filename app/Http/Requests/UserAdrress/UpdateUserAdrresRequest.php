<?php

namespace App\Http\Requests\UserAdrress;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserAdrresRequest extends FormRequest
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
            'postal_code' => ['required', 'string', 'max:300'],
            'address' => ['required', 'string'],
            'number' => ['required', 'integer'],
            'complement' => ['required', 'string', 'max:300'],
            'reference' => ['required','string'],
        ];
    }
}
