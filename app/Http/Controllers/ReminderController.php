<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{

    public function create()
    {
        return view('schedule');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'scheduled_at' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return redirect()->route('reminders.create')
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        $reminder = Reminder::create([
            'user_id' => $user->id,
            'description' => $request->input('description'),
            'scheduled_at' => $request->input('scheduled_at'),
        ]);

        return redirect()->route('reminders.create')
            ->with('success', 'Reminder scheduled successfully');
    }
   private function scheduleReminderNotification(Reminder $reminder)
   {
       $scheduledAt = $reminder->scheduled_at;

       \Illuminate\Support\Facades\Artisan::call('schedule:run');

       \Illuminate\Support\Facades\Artisan::call('schedule:work');
   }
}
