<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Category;
use App\Http\Requests\TypeRequest;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('types.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TypeRequest $request)
    {
        try {
            Type::create($request->validated());
            return redirect()->route('types.index')->with('success', 'Maintenance record added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('types.create')
                ->withErrors(['error' => 'Failed to add maintenance record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        $types = Type::all();
        $categories = Category::all();
        return view('types.edit', compact('type', 'types', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TypeRequest $request, Type $type)
    {
        try {
            $type->update($request->validated());
            return redirect()->route('types.index')->with('success', 'Type record updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('types.edit', $type->id)
                ->withErrors(['error' => 'Failed to update type record. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Type deleted successfully.');
    }
}

