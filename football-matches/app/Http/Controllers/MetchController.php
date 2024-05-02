<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Metch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MetchRequest;

class MetchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metches = Metch::all();

        return view ('metches.index', compact('metches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all(); 

        $minDate = now()->toDateString();

        return view('metches.create', compact('teams', 'minDate'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MetchRequest $request)
    {
        DB::beginTransaction();
    
        try {
            $metch = Metch::create($request->validated());
    
            $homeTeamPlayers = Team::findOrFail($metch->home_team_id)->players()->pluck('id')->toArray();
    
            $guestTeamPlayers = Team::findOrFail($metch->guest_team_id)->players()->pluck('id')->toArray();
    
            $allPlayers = array_merge($homeTeamPlayers, $guestTeamPlayers);
    
            $metch->players()->sync($allPlayers);
    
            DB::commit();
    
            return redirect()->route('metches.index')->with('message', 'Match created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with('error', 'Error creating match: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Metch $metch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Metch $metch)
    {
        $teams = Team::all(); 

        $minDate = now()->toDateString();

        return view('metches.edit', compact('metch', 'teams', 'minDate'));
    }

    public function update(MetchRequest $request, Metch $metch)
    {

        $request->validate([
            'result' => 'required', 
        ]);

        $data = $request->validated();
        $data['result'] = $request->input('result'); 

        $metch->update($data);

        return redirect()->route('metches.index')->with('message', 'Match updated successfully.');
    }

    public function destroy(Metch $metch)
    {

        $metch->players()->detach();
    
        $metch->delete();
    
        return redirect()->route('metches.index')->with('message', 'Match deleted successfully.');
    }
}
