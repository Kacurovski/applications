<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Metch;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::all();

        return view('teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        Team::create($request->validated());

        return redirect()->route('teams.index')->with('message', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->validated());

        return redirect()->route('teams.index')->with('message', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        Metch::where('guest_team_id', $team->id)->update(['guest_team_id' => null]);

        Metch::where('home_team_id', $team->id)->update(['home_team_id' => null]);

        Player::where('team_id', $team->id)->update(['team_id' => null]);

        $team->delete();

        return redirect()->route('teams.index')->with('message', 'Team deleted successfully.');
    }
}
