<?php

namespace App\Http\Controllers\Api;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'question' => 'required|string',
        ]);

        try {
            
            $question = Question::create($validatedData);

                        return response()->json([
                'status' => 'success',
                'message' => 'Question saved successfully',
                'data' => $question
            ], 201);
        } catch (QueryException $e) {
            
                 return response()->json([
                'status' => 'error',
                'message' => 'Failed to save the question',
                'data' => null, 
            ], 500);
        }
    }
}
