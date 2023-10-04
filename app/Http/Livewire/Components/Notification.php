<?php

namespace App\Http\Livewire\Components;

use App\Models\Report;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{

    public $userId; // You can also use public $notifiableId;

    public function mount($userId)
{
    $this->userId = $userId;
}


public function render()
{
    // Get the currently authenticated user
    $user = Auth::user();

    // Fetch unread notifications for the user
    $notifications = $user->unreadNotifications;

    return view('livewire.components.notification', compact('notifications'));
}

}








