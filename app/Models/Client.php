<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Таблица 'lk_client'
 *
 * @var int $id
 * @var string $title
 * @var string $title_full
 * @var string $brand
 * @var string $logo
 * @var string $managment
 * @var string $phone
 * @var string $email
 * @var int $type
 * @var string $params
 * @var string $details
 * @var string $bank
 * @var string $addr
 * @var string $code
 * @var string $status
 * @var int $manager_id
 * @var string $tz
 * @var string $dt
 * @var string $token
 * @var int $balancecontrol
 * @var int $partner
 * @var string $server
 * @var string $filial
 * @var string $promised_payment
 * @var int $is_contract
 * @var int $is_notify
 * @var string $comment
 *
 * @var App[] $apps
 */
class Client extends Model
{
    protected $table = 'lk_client';

    protected $fillable = [
        'title', 'title_full', 'brand', 'logo', 'managment', 'phone', 'email', 'type', 'params', 'details', 'bank',
        'addr', 'code', 'status', 'manager_id', 'tz', 'dt', 'token', 'balancecontrol', 'partner', 'server', 'filial',
        'promised_payment', 'is_contract', 'is_notify', 'comment',
    ];

    /**
     * Получение интеграций
     *
     * @return HasMany
     *
     * @see $apps
     */
    public function apps(): HasMany
    {
        return $this->hasMany(App::class, 'client_id');
    }

    /**
     * Получение настроек приложения
     *
     * @return HasOne
     *
     * @see $apps
     */
    public function feedbackSettings(): HasOne
    {
        return $this->hasOne(FeedbackSettings::class, 'clientId', 'id');
    }

    /**
     * Какое поле модели использовать для поиска записи при Route Model Binding
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'token';
    }
}
