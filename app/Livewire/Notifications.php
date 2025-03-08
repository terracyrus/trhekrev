<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    public $unreadNotifications = [];
    public $readNotifications = [];

    public function mount()
    {
        $user = Auth::user();

        // 🔹 Get all notifications and split them into unread & read
        $this->unreadNotifications = $user->unreadNotifications()->orderByDesc('created_at')->get();
        $this->readNotifications = $user->readNotifications()->orderByDesc('created_at')->get();

        // 🔥 Mark all unread notifications as read when the page loads
        $this->markAllAsRead();
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->unreadNotifications = []; // Remove unread from top section
        $this->readNotifications = Auth::user()->readNotifications()->orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
