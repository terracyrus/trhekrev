<?php

namespace App\Http\Controllers;

use App\Enums\FirstLeaderboardPoints;
use App\Jobs\ResetUsersJob;
use App\Models\AuditLog;
use App\Models\Discipline;
use App\Models\DisciplineResult;
use App\Models\FirstLeaderboard;
use App\Models\GamechangerAction;
use App\Models\OverallLeaderboard;
use App\Models\User;
use Database\Seeders\DisciplineSeeder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function deleteUsers(Request $request)
    {
        // Definiere dein Kriterium (z.B. alle inaktive User löschen)
        $deletedCount = User::where('role', 'user')->delete();

        return redirect()->route('admin.index')->with('success', "Alle {$deletedCount} Benutzer wurden gelöscht.");
    }

    public function resetGame()
    {
        // Definiere dein Kriterium (z.B. alle inaktive User löschen)
        User::where('role', 'user')->delete();
        User::where('role', 'operator')->delete();
        FirstLeaderboard::truncate();
        OverallLeaderboard::truncate();
        Discipline::truncate();
        DisciplineResult::truncate();
        AuditLog::truncate();
        GamechangerAction::truncate();

        (new DisciplineSeeder)->run();

        return redirect()->route('admin.index')->with('success', 'Spiel zurückgesetzt.');
    }

    public function setGame()
    {
        ResetUsersJob::dispatch(); // Asynchronous execution

        return redirect()->route('admin.index')->with('success', 'User mit Rangliste erstellt als Job erstellt.');
    }

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin,operator',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['name'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        $text = 'Benutzer ' . $validated['name'] . ' mit Rolle ' . $user->role . ' wurde erfolgreich angelegt.';
        if ($validated['role'] === 'user') {
            $fl = Firstleaderboard::create([
                'user_id' => $user->id,
                'points' => rand(FirstLeaderboardPoints::MIN->value, FirstLeaderboardPoints::MAX->value),
            ]);
            $text .= ' Der Benutzer muss ' . $fl->points . ' Punkte erreichen.';
        }

        return redirect()->route('admin.index')->with('success', $text);
    }
}
