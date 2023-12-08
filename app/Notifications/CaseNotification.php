<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CaseNotification extends Notification
{
    use Queueable;
public $anecdotalOutcome;
    public function __construct($anecdotalOutcome)
    {
    $this->anecdotalOutcome = $anecdotalOutcome;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {

    // $createdDate = Carbon::parse($this->anecdotal->created_at);
    $message = "The case for {$this->anecdotalOutcome->anecdotal->student->first_name}
    {$this->anecdotalOutcome->anecdotal->student->last_name}
was done and the out is {$this->anecdotalOutcome->anecdotal->getStatusTextAttribute()}";

    return [
        'message' => $message,
    ];
    }
}
