<?php

namespace App\Http\Requests\UserContact;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserContactRequest extends FormRequest
{
    private array $contactType = ['email', 'phone'];

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
            'type' => ['required', 'in:' . implode(',', $this->contactType)],
            'contact' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }
}
