<?php

namespace App\Notifications;

use Carbon\Carbon;
use App\Models\Anecdotal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

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

    // $createdDate = Carbon::parse($this->anecdotal->created_at);
    $message = "Your report to {$this->anecdotal->student->first_name}  {$this->anecdotal->student->last_name}
     about
    has been accepted";

    return [
        'message' => $message,
    ];
    }

}
