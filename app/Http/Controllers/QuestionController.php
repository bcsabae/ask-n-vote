<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('upvotes', 'desc')->get();
        $upvoted = session()->get('upvoted', []);
        return Inertia::render('QAndA/Index', [
            'questions' => $questions,
            'upvoted' => $upvoted,
        ]);
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

        return back();
    }

    public function downvote(Question $question)
    {
        $upvoted = session()->get('upvoted', []);
        if (in_array($question->id, $upvoted)) {
            if (($key = array_search($question->id, $upvoted)) !== false) {
                unset($upvoted[$key]);
                session()->put('upvoted', array_values($upvoted));
            }
            $question->decrement('upvotes');
        }

        return back();
    }
}
