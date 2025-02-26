<?php

namespace App\Http\Controllers;

use App\Models\FirstLeaderboard;
use App\Models\Gamechanger;
use App\Models\GamechangerAction;
use App\Models\User;
use Illuminate\Http\Request;

class GamechangerActionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actions = GamechangerAction::with(['gamechanger', 'requestedBy', 'executedBy', 'targetUser'])->get();

        return view('gamechanger_actions.index', ['actions' => $actions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Gamechanger $gamechanger)
    {
        $users = User::where('role', 'user')->get();

        return view('gamechanger_actions.create', ['gamechanger' => $gamechanger, 'users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Gamechanger $gamechanger, User $user)
    {
        $request->validate([
            'target_user' => 'nullable|exists:users,id',
        ]);

        GamechangerAction::create([
            'gamechanger_id' => $gamechanger->id,
            'requested_by' => $user->id,
            'executed_by' => auth()->id(), // Operator führt es direkt aus
            'target_user' => $request->target_user,
        ]);

        return redirect()->route('gamechanger_actions.index')->with('success', 'Gamechanger ausgeführt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(GamechangerAction $gamechangerAction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GamechangerAction $gamechangerAction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GamechangerAction $gamechangerAction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GamechangerAction $gamechangerAction)
    {
        //
    }

    public function execute(Gamechanger $gamechanger)
    {
        switch ($gamechanger->type) {
            case 'Geschenk!':
                FirstLeaderboard::where('user_id', $gamechanger->target_user)
                    ->decrement('points', 5);
                FirstLeaderboard::where('user_id', $gamechanger->requested_by)
                    ->increment('points', 5);
                break;
            case 'Diebstahl!':
                FirstLeaderboard::where('user_id', $gamechanger->target_user)
                    ->decrement('points', 5);
                FirstLeaderboard::where('user_id', $gamechanger->requested_by)
                    ->increment('points', 5);
                break;
            case 'Gleichstellung!':
                $points = FirstLeaderboard::where('user_id', $gamechanger->requested_by)->value('points');
                FirstLeaderboard::where('user_id', $gamechanger->target_user)->update(['points' => $points]);
                break;
            case 'Identitätsklau!':
                $points1 = FirstLeaderboard::where('user_id', $gamechanger->requested_by)->value('points');
                $points2 = FirstLeaderboard::where('user_id', $gamechanger->target_user)->value('points');
                FirstLeaderboard::where('user_id', $gamechanger->requested_by)->update(['points' => $points2]);
                FirstLeaderboard::where('user_id', $gamechanger->target_user)->update(['points' => $points1]);
                break;
        }

        $gamechanger->update(['executed' => true]);

        return redirect()->back()->with('success', 'Gamechanger erfolgreich ausgeführt.');
    }
}
