<?php

namespace App\Notifications;

use App\Models\Anecdotal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusNotification extends Notification
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


    public function toArray($notifiable)
    {
        return [
            'message' => 'Your anecdotal has been accepted.',
        ];
    }
}
