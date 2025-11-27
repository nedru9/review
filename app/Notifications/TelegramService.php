<?php

namespace App\Notifications;

use App\Interfaces\ServiceNotification;
use App\Models\App;
use App\Models\Feedback;
use Exception;
use RuntimeException;
use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;

class TelegramService implements ServiceNotification
{
    protected Api $telegram;

    /**
     * @throws TelegramSDKException
     */
    public function __construct(public App $app, public Feedback $feedback)
    {
        $this->telegram = new Api(config('telegram.bot_token'));
    }

    public function send(): true
    {
        $params = json_decode($this->app->param);

        if (!isset($params->chatId)) {
            throw new RuntimeException("chatId не указан для интеграции");
        }

        $chatId = $params->chatId;

        $text = "Новый отзыв!\n"
            . "Клиент: \n"
            . "Приложение: ";

        try {
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => $text,
                'parse_mode' => 'HTML'
            ]);
        } catch (Exception $e) {
            throw new RuntimeException("Ошибка отправки отзыва в интеграции");
        }

        return true;
    }
}
