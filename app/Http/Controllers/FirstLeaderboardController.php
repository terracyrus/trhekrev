<?php

namespace App\Http\Controllers;

use App\Models\FirstLeaderboard;
use Illuminate\Http\Request;

class FirstLeaderboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leaderboard = FirstLeaderboard::with('user')->orderByDesc('points')->get();

        return view('first_leaderboard.index', ['leaderboard'->$leaderboard]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FirstLeaderboard $firstLeaderboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FirstLeaderboard $firstLeaderboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FirstLeaderboard $firstLeaderboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FirstLeaderboard $firstLeaderboard)
    {
        //
    }

    public function reset()
    {
        FirstLeaderboard::truncate();
        $users = User::getPlayers();

        foreach ($users as $user) {
            FirstLeaderboard::create([
                'user_id' => $user->id,
                'points' => rand(10, 100), // Zufällige Initialpunkte
            ]);
        }

        return redirect()->route('first_leaderboard.index')->with('success', 'Leaderboard neu generiert.');
    }
}
