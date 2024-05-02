<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Http\Requests\MaintenanceRequest;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::all();
        return view('maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        return view('maintenances.create');
    }

    public function store(MaintenanceRequest $request)
    {
        try {
            Maintenance::create($request->validated());
            return redirect()->route('maintenances.index')->with('success', 'Maintenance record added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('maintenances.create')
                ->withErrors(['error' => 'Failed to add maintenance record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenances.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaintenanceRequest $request, Maintenance $maintenance)
    {
        try {
            $maintenance->update($request->validated());
            return redirect()->route('maintenances.index')->with('success', 'Maintenance record updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('maintenances.edit', $maintenance->id)
                ->withErrors(['error' => 'Failed to update maintenance record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('maintenances.index')->with('success', 'Maintenance record deleted successfully!');
    }
}
