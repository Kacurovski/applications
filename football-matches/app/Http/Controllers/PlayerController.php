<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $players = Player::all();

        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all(); 

        return view('players.create', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(PlayerRequest $request)
     {
         Player::create($request->validated());
 
         return redirect()->route('players.index')->with('message', 'Player created successfully.');
     }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        $teams = Team::all();

        return view('players.edit', compact('player', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, Player $player)
    {
        $player->update($request->validated());

        return redirect()->route('players.index')->with('message', 'Player updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player->matches()->detach();

        $player->delete();
    
        return redirect()->route('players.index')->with('message', 'Player deleted successfully.');
    }
}
