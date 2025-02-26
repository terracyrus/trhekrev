<?php

namespace App\Http\Controllers;

use App\Models\Gamechanger;
use Illuminate\Http\Request;

class GamechangerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gamechangers = Gamechanger::all();

        return view('gamechangers.index', ['gamechangers' => $gamechangers]);
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
    public function show(Gamechanger $gamechanger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gamechanger $gamechanger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gamechanger $gamechanger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gamechanger $gamechanger)
    {
        //
    }
}
