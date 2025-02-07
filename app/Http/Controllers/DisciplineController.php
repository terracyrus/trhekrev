<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showLeaderboard(Request $request, Discipline $discipline)
    {
        $results = $discipline->getLeaderboard();

        return view('leaderboard', ['results' => $results,
            'username' => $request->user()->name,
            'position' => $discipline->rank($request->user()),
            'disciplineName' => $discipline->name]);
    }
}
