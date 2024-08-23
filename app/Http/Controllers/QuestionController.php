<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('upvotes', 'desc')->get();
        return inertia('Questions/Index', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
        ]);

        Question::create($request->only('question_text'));

        return redirect()->route('questions.index');
    }

    public function upvote(Question $question)
    {
        $upvoted = session()->get('upvoted', []);
        if (!in_array($question->id, $upvoted)) {
            $question->increment('upvotes');
            session()->push('upvoted', $question->id);
        }

        return redirect()->route('questions.index');
    }
}
