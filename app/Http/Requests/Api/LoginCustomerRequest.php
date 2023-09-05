<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Поле обязательно',
            'email.email' => 'Не корретно введен email',
            'email.string' => 'Поле должно содержать строку',
            'email.max' => 'Максимальная длина поля 255 символов',

            'password.required' => 'Поле обязательно',
            'password.string' => 'Поле должно содержать строку',
            'password.max' => 'Максимальная длина поля 255 символов',
        ];
    }
}
