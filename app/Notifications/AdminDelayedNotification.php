<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminDelayedNotification extends Notification
{
    use Queueable;
    protected $anecdotalData;
    protected $reminderDays;

    public function __construct($anecdotalData, $reminderDays)
    {
        $this->anecdotalData = $anecdotalData;
        $this->reminderDays = $reminderDays;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "This is to notify the report you resolved {$this->reminderDays} days ago",
        ];
    }



}
