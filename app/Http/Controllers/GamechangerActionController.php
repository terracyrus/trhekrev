<?php

namespace App\Http\Controllers;

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

        return view('profile.history', ['actions' => $actions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'user')->get();

        return view('gamechanger_actions.create', ['users' => $users, 'targets' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'requested_by' => ['required', 'exists:users,id'],
            'gamechanger_id' => ['required', 'exists:gamechangers,id'],
            'target_user' => ['nullable', 'exists:users,id'],
            'count' => ['nullable', 'integer', 'min:1'],
        ]);

        $targetUser = $request->target_user ? User::find($request->target_user) : null;

        // Check if the target user is immune
        if ($targetUser && $targetUser->isImmune()) {
            return back()
                ->withInput()
                ->withErrors(['target_user' => 'Dieser Benutzer ist aktuell immun gegen Gamechanger.']);
        }

        $gamechanger = Gamechanger::findOrFail($request->gamechanger_id);

        // Ensure the count does not exceed the maximum allowed executions
        $maxExecutions = $gamechanger->max_executions;
        $count = min($request->count ?? 1, $maxExecutions); // Defaults to 1 if count is not provided

        // Überprüfen, ob der requestende Benutzer die Mindestanzahl an Disziplinen absolviert hat
        $requestingUser = User::findOrFail($request->requested_by);
        if ($requestingUser->completedDisciplines() < $gamechanger->min_disciplines) {
            return back()->withErrors(['requested_by' => 'Der Benutzer hat nicht genügend Disziplinen absolviert.']);
        }

        for ($i = 0; $i < $count; $i++) {
            GamechangerAction::create([
                'gamechanger_id' => $gamechanger->id,
                'requested_by' => $request->requested_by,
                'executed_by' => auth()->id(), // Operator führt es direkt aus
                'target_user' => $request->target_user,
            ]);

            // Führe den Gamechanger aus
            $gamechanger->execute($requestingUser, User::find($request->target_user));
        }

        return redirect()->route('profile.history')->with('success', 'Gamechanger ' . $gamechanger->name . ' wurde ' . $count . ' erfolgreich ausgeführt!');
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

    public function allowedGamechangers(int $userId)
    {
        $user = User::findOrFail($userId);
        $gamechangers = Gamechanger::where('min_disciplines', '<=', $user->completedDisciplines())->get();

        return response()->json($gamechangers);
    }
}
