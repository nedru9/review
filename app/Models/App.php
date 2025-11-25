<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Таблица 'lk_app'
 *
 * @var int $id
 * @var int $client_id
 * @var string $name
 * @var string $param
 * @var string $descr
 * @var string $type
 * @var int $status
 * @var string $dt
 * @var string $app
 * @var string $update_at
 */
class App extends Model
{
    protected $table = 'lk_app';

    protected $fillable = [
        'client_id',
        'name',
        'param',
        'descr',
        'type',
        'status',
        'dt',
        'app',
        'update_at',
    ];
}
