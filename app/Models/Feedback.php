<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Таблица 'lk_feedback'
 *
 * @var int $id
 * @var int $clientId Id компании
 * @var int $rating Рейтинг
 * @var string $reviewText Текст отзыва
 * @var string $fullName ФИО клиента
 * @var string $phone Номер телефона
 * @var string $email Email
 * @var string $dateCreate Дата создания
 */
class Feedback extends Model
{
    protected $table = 'lk_feedback';

    protected $fillable = [
        'clientId',
        'rating',
        'reviewText',
        'fullName',
        'phone',
        'email',
        'dateCreate',
    ];

    /**
     * Клиент
     *
     * @return BelongsTo
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
