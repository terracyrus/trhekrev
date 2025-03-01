<?php

namespace App\Livewire;

use App\Models\OverallLeaderboard;
use Livewire\Component;

class LeaderboardTable extends Component
{
    protected $listeners = ['refreshTable' => '$refresh']; // Allows triggering refresh externally

    public function render()
    {
        // Fetch sorted leaderboard data
        $sortedPlayers = OverallLeaderboard::getOverallLeaderboard();

        return view('livewire.leaderboard-table', ['sortedPlayers' => $sortedPlayers]);
    }
}
