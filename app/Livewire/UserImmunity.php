<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserImmunity extends Component
{
    protected $listeners = ['refreshImmunity' => '$refresh']; // Refresh when immunity changes

    public function render()
    {
        $user = User::find(Auth::id());

        // Calculate remaining time
        $remainingTime = null;
        if ($user->immunity_until && now()->lt($user->immunity_until)) {
            $diffInSeconds = now()->diffInSeconds($user->immunity_until);
            $minutes = floor($diffInSeconds / 60);
            $seconds = $diffInSeconds % 60;
            $remainingTime = sprintf('%02d:%02d', $minutes, $seconds);
        }

        return view('livewire.user-immunity', [
            'isImmune' => $user->isImmune(),
            'remainingTime' => $remainingTime,
        ]);
    }
}
