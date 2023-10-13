<?php

namespace App\Http\Livewire\Components;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    public $selectedNotificationId;

    public $userId; // You can also use public $notifiableId;


public function mount($userId)
{
    $this->userId = $userId;
    $this->listeners['refreshNotifications'] = 'refreshNotifications';
}

public function refreshNotifications()
{
    $this->notifications = Auth::user()->unreadNotifications;
}


public function markAsRead($notificationId)
{
    $notification = \App\Models\Notification::find($notificationId);

    if ($notification) {
        $notification->markAsRead();
    }
    $this->selectedNotificationId = null;
    $this->emit('refreshNotifications');
}

public function render()
{
    $user = Auth::user();
    $currentTime = now(); // Get the current timestamp
    $notifications = $user->unreadNotifications->filter(function ($notification) use ($currentTime) {
        return $notification->created_at <= $currentTime;
    });

    return view('livewire.components.notification', compact('notifications'));
}


}








