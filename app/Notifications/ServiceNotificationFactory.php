<?php

namespace App\Notifications;

use App\Models\App;
use App\Models\Feedback;
use Telegram\Bot\Exceptions\TelegramSDKException;

class ServiceNotificationFactory
{
    private const string TELEGRAM_SERVICE = 'telegram';
    private const string EMAIL_SERVICE = 'email';

    /**
     * Создание сервиса
     *
     * @param App $app
     * @param Feedback $feedback
     *
     * @return EmailService|TelegramService
     *
     * @throws TelegramSDKException
     */
    static function create(App $app, Feedback $feedback): EmailService|TelegramService
    {
        return match ($app->name) {
            self::TELEGRAM_SERVICE => new TelegramService($app, $feedback),
            self::EMAIL_SERVICE => new EmailService($app, $feedback)
        };
    }
}
