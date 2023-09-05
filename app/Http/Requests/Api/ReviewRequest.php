<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'comment' => 'required|string|max:1000',
            'advantages' => 'nullable|string|max:1000',
            'disadvantages' => 'nullable|string|max:1000',
            'rating' => 'required|numeric|between:1,5'
        ];
    }

    public function messages()
    {
        return [
            'comment.required' => 'Поле обязательно',
            'comment.string' => 'Поле должно содержать строку',
            'comment.max' => 'Максимальная длина поля 1000 символов',

            'advantages.string' => 'Поле должно содержать строку',
            'advantages.max' => 'Максимальная длина поля 1000 символов',

            'disadvantages.string' => 'Поле должно содержать строку',
            'disadvantages.max' => 'Максимальная длина поля 1000 символов',

            'rating.required' => 'Поле обязательно',
            'rating.numeric' => 'Поле должно содержать десятичное число ',
            'rating.between' => 'Поле должно находиться в диапазоне от 1 до 5',
        ];
    }
}
