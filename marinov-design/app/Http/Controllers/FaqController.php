<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\FaqRequest;



class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $faqs = Faq::all();

        return view('faqs.index', compact('faqs'));

    }

    public function create()
    {
        return view('faqs.create');
    }


    public function store(FaqRequest $request)
    {
        try {
            Faq::create($request->validated());
            return redirect()->route('faqs.index')->with('success', 'FAQ added successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('faqs.create')
                ->withErrors(['error' => 'Failed to add FAQ. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $requestq)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        return view('faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        try {
            $faq->update($request->validated());
            return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully!');
        } catch (\Exception $e) {
            return redirect()
                ->route('faqs.edit', $faq->id)
                ->withErrors(['error' => 'Failed to update FAQ. Please try again.'])
                ->withErrors($request->validated()->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully.');
    }
}
