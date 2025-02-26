<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OverallLeaderboardController extends Controller
{
    /**
     * Show the form for creating the resource.
     */
    public function create(): never
    {
        abort(404);
    }

    /**
     * Store the newly created resource in storage.
     */
    public function store(Request $request): never
    {
        abort(404);
    }

    /**
     * Display the resource.
     */
    public function show()
    {

        // Alle Spieler mit Punkten aus beiden Leaderboards holen
        $players = User::where('role', 'user')
            ->with(['overallLeaderboard', 'firstLeaderboard'])
            ->get()
            ->map(function ($user) {
                $overallPoints = $user->overallLeaderboard->total_points ?? 0;
                $firstPoints = $user->firstLeaderboard->points ?? 0;
                $difference = abs($overallPoints - $firstPoints);
                $completedDisciplines = $user->completedDisciplines();

                return (object) [
                    'user' => $user,
                    'overall_points' => $overallPoints,
                    'first_points' => $firstPoints,
                    'difference' => $difference,
                    'completed_disciplines' => $completedDisciplines,
                ];
            });

        // Sortierung: Differenz -> erledigte Disziplinen -> Zeit
        $sortedPlayers = $players->sortBy([
            fn ($a, $b) => $a->difference <=> $b->difference,
            fn ($a, $b) => $b->completed_disciplines <=> $a->completed_disciplines,
        ]);

        return view('dashboard', ['sortedPlayers' => $sortedPlayers]);
    }

    /**
     * Show the form for editing the resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the resource from storage.
     */
    public function destroy(): never
    {
        abort(404);
    }
}
