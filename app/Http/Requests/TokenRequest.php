<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenRequest extends FormRequest
{
    /**
     * Правила валидации
     *
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'token' => ['required', 'exists:lk_client,token'],
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
            'token' => 'Токен',
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
            'token.required' => 'Отсутствует токен.',
            'token.exists'   => 'Токен не найден.',
        ];
    }
}
