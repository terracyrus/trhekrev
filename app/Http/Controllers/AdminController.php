<?php

namespace App\Http\Controllers;

use App\Models\FirstLeaderboard;
use App\Models\User;
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

    public function createUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin,operator',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => bcrypt($validated['password']),
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        $text = 'Benutzer ' . $validated['name'] . ' mit Rolle ' . $user->role . ' wurde erfolgreich angelegt.';
        if ($validated['role'] === 'user') {
            $fl = Firstleaderboard::create([
                'user_id' => $user->id,
                'points' => rand(70, 110),
            ]);
            $text .= ' Der Benutzer hat ' . $fl->points . ' Punkte erhalten für First_Leaderboard.';
        }

        return redirect()->route('admin.index')->with('success', $text);
    }
}
