<?php

namespace App\Notifications;

use App\Interfaces\ServiceNotification;
use App\Models\App;
use App\Models\Feedback;

class EmailService implements ServiceNotification
{
    public function __construct(public App $app, public Feedback $feedback)
    {

    }

    public function send()
    {
        return true;
    }
}
