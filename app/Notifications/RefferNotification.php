<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RefferNotification extends Notification
{
    use Queueable;

    public $student;
    public $classroom;

    public function __construct($student, $classroom)
    {
        $this->student = $student;
        $this->classroom = $classroom;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        $message = "{$this->student->first_name} {$this->student->last_name} has been referred to another classroom: {$this->classroom->grade_level} {$this->classroom->section}";
        return [
            'message' => $message,
        ];
    }
}
