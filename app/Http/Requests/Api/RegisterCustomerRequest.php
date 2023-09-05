<?php

namespace App\Http\Requests\Api;

use App\Models\Customer;
use App\Rules\Api\EncryptedEmail;
use App\Rules\Api\EncryptedPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterCustomerRequest extends FormRequest
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
            'last_name' => 'required|max:255|string',
            'first_name' => 'required|max:255|string',
            'middle_name' => 'max:255|string|nullable',
            'email' => ['required', 'max:255', 'string', 'email', 'unique:customers'],
            'phone_number' => ['required', 'max:45', 'string', new EncryptedPhoneNumber()],
            'agreement' => 'required|boolean|accepted',
            'password' => 'required|max:255|string|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => 'Поле обязательно',
            'last_name.max' => 'Максмильная дина поля 255 символов',
            'last_name.string' => 'Поле должно содержать строку',

            'first_name.required' => 'Поле обязательно',
            'first_name.max' => 'Максмильная дина поля 255 символов',
            'first_name.string' => 'Поле должно содержать строку',

            'middle_name.max' => 'Максмильная дина поля 255 символов',
            'middle_name.string' => 'Поле должно содержать строку',

            'email.required' => 'Поле обязательно',
            'email.max' => 'Максмильная дина поля 255 символов',
            'email.string' => 'Поле должно содержать строку',
            'email.email' => 'Не корретно введен email',
            'email.unique' => 'Этот email уже используется',

            'phone_number.required' => 'Поле обязательно',
            'phone_number.max' => 'Максмильная дина поля 45 символов',
            'phone_number.string' => 'Поле должно содержать строку',

            'agreement.required' => 'Поле обязательно',
            'agreement.boolean' => 'Поле должно быть логическим',
            'agreement.accepted' => 'Поле обязательно',

            'password.required' => 'Поле обязательно',
            'password.max' => 'Максмильная дина поля 255 символов',
            'password.string' => 'Поле должно содержать строку',
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
