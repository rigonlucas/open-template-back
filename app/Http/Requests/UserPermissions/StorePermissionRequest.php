<?php

namespace App\Http\Requests\UserPermissions;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
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
            'user_permission' => ['required', 'string', 'max:200'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'guard' => ['required', 'string', 'json']
        ];
    }
}
