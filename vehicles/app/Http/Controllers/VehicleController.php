<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::all();

        return VehicleResource::collection($vehicles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {

        $vehicle = Vehicle::create($request->validated());
    
        return redirect()->route('dashboard')->with('vehicle', new VehicleResource($vehicle));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return new VehicleResource($vehicle);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view ('vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {

        $vehicle->update($request->all());
    
        return redirect()->route('dashboard')->with('vehicle', new VehicleResource($vehicle));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    
            return response()->json([
                'data' => [],
                'message' => 'Vehicle was deleted'
            ]);   
    }
}
