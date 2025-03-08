<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Discipline;
use App\Models\Gamechanger;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboard extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        $ranks = User::getOverallLeaderboardRanks(); // Cached rank data

        return view('livewire.user-dashboard', [
            'firstLeaderboardPoints' => $this->user->firstLeaderboard->points ?? '-',
            'overallLeaderboardPoints' => $this->user->overallLeaderboard->total_points ?? '-',
            'difference' => abs(($this->user->overallLeaderboard?->total_points ?? 0) - ($this->user->firstLeaderboard?->points ?? 0)),
            'completedDisciplines' => $this->user->completedDisciplines(),
            'totalDisciplines' => Discipline::count(),
            'completedCategories' => $this->user->numberCompletedCategories(),
            'totalCategories' => Category::count(),
            'availableGamechangers' => Gamechanger::where('min_disciplines', '<=', $this->user->completedDisciplines())->get(),
            'overallRank' => $ranks[$this->user->id] ?? 'Unplatziert',
            'qualified' => $this->user->qualified,
        ]);
    }
}
