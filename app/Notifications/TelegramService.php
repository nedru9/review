<?php

namespace App\Notifications;

use App\Interfaces\ServiceNotification;
use App\Models\App;

class TelegramService implements ServiceNotification
{
    public function __construct(public App $app)
    {
    }

    public function send()
    {
        $telegramId = json_decode($this->app->param)['telegramId'];

        echo $telegramId;
    }
}
