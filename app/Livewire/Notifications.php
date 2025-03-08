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

        // 🔹 Get unread & read notifications, but do NOT mark them as read yet
        $this->unreadNotifications = $user->unreadNotifications()->orderByDesc('created_at')->get();
        $this->readNotifications = $user->readNotifications()->orderByDesc('created_at')->get();
    }

    public function markAllAsRead()
    {
        $user = Auth::user();

        // 🔹 Mark all unread notifications as read
        $user->unreadNotifications->markAsRead();

        // 🔥 Refresh notifications list
        $this->unreadNotifications = [];
        $this->readNotifications = $user->readNotifications()->orderByDesc('created_at')->get();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
