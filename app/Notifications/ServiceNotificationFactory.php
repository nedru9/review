<?php

namespace App\Notifications;

use App\Models\App;
use Telegram\Bot\Exceptions\TelegramSDKException;

class ServiceNotificationFactory
{
    private const string TELEGRAM_SERVICE = 'telegram';
    private const string EMAIL_SERVICE = 'email';

    /**
     * Создание сервиса
     *
     * @param App $app
     *
     * @return EmailService|TelegramService
     *
     * @throws TelegramSDKException
     */
    static function create(App $app): EmailService|TelegramService
    {
        return match ($app->name) {
            self::TELEGRAM_SERVICE => new TelegramService($app),
            self::EMAIL_SERVICE => new EmailService($app)
        };
    }
}
