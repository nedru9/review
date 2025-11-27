<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormReviewRequest extends FormRequest
{
    /**
     * Правила валидации
     *
     * @return array{fullName: string, email: string, phone: array{0: string, 1: string}, token: string, message: array{0: string, 1: string, 2: string}}
     */
    public function rules(): array
    {
        return [
            'fullName' => 'required|min:2|max:50',
            'email' => 'required|email',
            'phone' => ['required', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/'],
            'token' => 'required',
            'message' => ['required', 'min:10', 'max:1000']
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
            'email' => 'Поле «:attribute» должно быть корректным email.',
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
            'fullName' => 'ФИО',
            'email' => 'E-mail',
            'phone' => 'Номер телефона',
            'token' => 'Токен',
            'message' => 'Отзыв',
        ];
    }
}
