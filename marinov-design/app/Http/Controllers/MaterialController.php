<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Http\Requests\MaterialRequest;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialRequest $request)
    {
        try {
            Material::create($request->validated());
            return redirect()->route('materials.index')->with('success', 'Material record added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('materials.create')
                ->withErrors(['error' => 'Failed to add material record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('materials.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materials.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialRequest $request, Material $material)
    {
        try {
            $material->update($request->validated());
            return redirect()->route('materials.index')->with('success', 'Material record updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('materials.edit', $material->id)
                ->withErrors(['error' => 'Failed to update material record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('materials.index')->with('success', 'Material deleted successfully.');
    }
}
