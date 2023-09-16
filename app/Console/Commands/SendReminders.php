<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Reminder;
use Illuminate\Console\Command;
use App\Notifications\ReminderNotification;
use Illuminate\Support\Facades\Notification;

class SendReminders extends Command
{

    protected $description = 'Command description';
    protected $signature = 'app:send-reminders';


    public function handle()
    {
        $now = now();

        $reminders = Reminder::where('scheduled_at', '<=', $now)->get();

        foreach ($reminders as $reminder) {
            Notification::send($reminder->user, new ReminderNotification($reminder));
        }
    }
}
