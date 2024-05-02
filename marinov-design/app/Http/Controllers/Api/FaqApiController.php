<?php

namespace App\Http\Controllers\Api;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class FaqApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();

        if ($faqs->isEmpty()) {
            return Response::json([
                'status' => 'error',
                'message' => 'FAQs not found.',
                'data' => null,
            ], 404);
        }

        return Response::json([
            'status' => 'success',
            'message' => 'FAQs retrieved successfully.',
            'data' => $faqs,
        ], 200);

        return view('faqs.show', compact('faq'));
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
    public function show(string $id)
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
}
