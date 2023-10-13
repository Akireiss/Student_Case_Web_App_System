<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefferNotification extends Notification
{
    use Queueable;

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toArray(object $notifiable): array
    {
        $message = $this->student->first_name . ' ' . $this->student->last_name . ' has been referred to Grade:'
        . $this->student->classroom->grade_level . ' ' .  $this->student->classroom->section;

        return [
            'message' => $message,
        ];
    }
}
