<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationBadge extends Component
{
    protected $listeners = ['notificationAdded' => '$refresh']; // 🔄 Auto-refresh when triggered

    public function render()
    {
        return view('livewire.notification-badge', [
            'unreadCount' => Auth::user()->unreadNotifications()->count(),
        ]);
    }
}
