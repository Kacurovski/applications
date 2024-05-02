<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();

        return view('questions.index', compact('questions'));
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }

    public function edit(Question $question)
    {
        return view('questions.answer', compact('question'));
    }
    public function update(Question $question)
    {
        
    }
}
