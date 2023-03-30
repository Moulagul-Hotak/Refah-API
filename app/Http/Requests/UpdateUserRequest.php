<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required', 'min:1', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email,'.request()->route('id')],
            'password' => ['nullable', 'string', 'min:5', 'max:16'],
            'image' => ['nullable', 'file', 'mimes:png,jpg','between:15,3048']
        ];
    }
}
