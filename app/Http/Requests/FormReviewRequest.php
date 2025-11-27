<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormReviewRequest extends FormRequest
{

    /**
     * Правила валидации
     *
     * @return array{fullName: string, phone: array{0: string, 1: string}, reviewText: array{0: string, 1: string, 2: string}}
     */
    public function rules(): array
    {
        return [
            'fullName' => 'required|min:2|max:50',
            'phone' => ['required', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'reviewText' => ['required', 'min:10', 'max:1000']
        ];
    }

    /**
     * Сообщения об ошибках
     *
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'required' => 'Поле «:attribute» обязательно.',
            'min' => 'Поле :attribute» должно быть не короче :min символов.',
            'max' => 'Поле «:attribute» должно быть не больше :max символов.',
            'regex' => 'Поле «:attribute» имеет неверный формат.',
        ];
    }

    /**
     * Имена атрибутов
     *
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'fullName' => 'Имя',
            'phone' => 'Номер телефона',
            'reviewText' => 'Отзыв',
        ];
    }
}
