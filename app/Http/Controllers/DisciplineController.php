<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\DisciplineResult;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplines = Discipline::all();

        return view('disciplines.index', ['disciplines' => $disciplines]);
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
    public function show(Discipline $discipline)
    {
        return view('disciplines.show', ['discipline' => $discipline]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Discipline $discipline)
    {
        $result = DisciplineResult::where('discipline_id', $discipline->id)
            ->where('user_id', auth()->id())
            ->firstOrNew([
                'user_id' => auth()->id(),
                'discipline_id' => $discipline->id,
                //'points' => 0 // Standardwert, falls kein Eintrag existiert
            ]);

        return view('disciplines.edit', ['discipline' => $discipline, 'result' => $result]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discipline $discipline)
    {
        // Validate
        $request->validate([
            'minutes' => 'nullable|integer|min:0|max:59',
            'seconds' => 'nullable|integer|min:0|max:59',
            'points' => 'nullable|integer|min:0',
        ]);

        $points = $discipline->isTime() ? $request->minutes * 60 + $request->seconds : $request->points;

        $result = DisciplineResult::firstOrNew([
            'user_id' => auth()->id(),
            'discipline_id' => $discipline->id,
        ]);

        // Update result
        $result->points = $points;

        $result->save();

        return redirect()->route('disciplines.leaderboard', $discipline)->with('success', 'Ergebnis aktualisiert!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Show the Leaderboard of the discipline.
     */
    public function showLeaderboard(Request $request, Discipline $discipline)
    {
        return view('disciplines.leaderboard', ['results' => $discipline->getLeaderboard(),
            'position' => $discipline->rank($request->user()),
            'discipline' => $discipline]);
    }
}
