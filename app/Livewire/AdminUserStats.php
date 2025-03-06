<?php

namespace App\Livewire;

use App\Enums\UserRole;
use App\Models\User;
use Livewire\Component;

class AdminUserStats extends Component
{
    protected $listeners = ['refreshStats' => '$refresh']; // Allows external refreshing

    public function render()
    {
        $userStats = User::selectRaw('role, COUNT(*) as total')
            ->groupBy('role')
            ->pluck('total', 'role');

        return view('livewire.admin-user-stats', [
            'userStats' => $userStats,
            'roles' => UserRole::cases(), // If using an Enum for roles
        ]);

        return view('livewire.admin-user-stats');
    }
}
