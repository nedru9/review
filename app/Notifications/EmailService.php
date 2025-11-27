<?php

namespace App\Notifications;

use App\Interfaces\ServiceNotification;
use App\Models\App;

class EmailService implements ServiceNotification
{
    public function __construct(public App $app)
    {
        $start = microtime(true);
        $end = microtime(true);
        $time = $end - $start;
        file_put_contents(__DIR__.'/log.txt', 'Время запроса: '.$time. "\n \n". print_r($request_params, true), FILE_APPEND);
    }

    public function send()
    {
        try {
            $email = json_decode($this->app->param)['email'];
        }


        echo $email;
    }
}
