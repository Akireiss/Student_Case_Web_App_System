<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminDelayedNotification extends Notification
{
    use Queueable;
    public function __construct($anecdotalData)
    {
        $this->anecdotal = $anecdotalData;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        $message = "This is to notify the report you resolved last 3 days ago";
        return [
            'message' => $message
        ];
    }
}
