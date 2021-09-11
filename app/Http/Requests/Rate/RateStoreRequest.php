<?php

namespace App\Http\Requests\Rate;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RateStoreRequest extends FormRequest
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
            'text' => ['string','max:100'],
            'rate_points' => ['required','numeric','between:0,5'],
        ];
    }
}
