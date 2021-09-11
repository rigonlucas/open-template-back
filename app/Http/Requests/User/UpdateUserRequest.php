<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'min:5', 'max:255', 'unique:users,name,'.$this->id.',id'],
            'email' => ['required', 'string', 'max:255', 'unique:users,email,'.$this->id.',id'],
        ];
    }
}
