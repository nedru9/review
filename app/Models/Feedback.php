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
 * @var string $reviewText Текст отзыва
 * @var string $fullName ФИО клиента
 * @var string $phone Номер телефона
 * @var string $email Email
 * @var string $dateCreate Дата создания
 */
class Feedback extends Model
{
    protected $table = 'lk_feedback';
    public $timestamps = false;

    protected $fillable = [
        'clientId',
        'reviewText',
        'fullName',
        'phone',
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
