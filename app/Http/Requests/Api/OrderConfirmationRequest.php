<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderConfirmationRequest extends FormRequest
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
            'payment' => 'required|integer|between:0,1',
            'shipping' => 'required|boolean',
            'address' => ['string', 'required_if:shipping,true', 'max:1000'],
            'details' => 'nullable|string|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'payment.required' => 'Поле обязательно',
            'payment.integer' => 'Поле должно содержать целое число',
            'payment.between' => 'Поле должно содержать целое число от 0 до 1',

            'shipping.required' => 'Поле обязательно',
            'shipping.boolean' => 'Поле представляет собой логический тип',

            'address.string' => 'Данные должны быть представлены в формате строки',
            'address.required_if' => 'Поле обязательно',
            'address.max' => 'Максимальная длина поля 1000 символов',

            'details.string' => 'Поле должно содержать строку',
            'details.max' => 'Максимальная длина поля 5000 символов'
        ];
    }
}
