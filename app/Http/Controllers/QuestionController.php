<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SessionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        $name = session("name");
        $userQuestions = Question::where('asked_by', $name)->orderBy('created_at', 'desc')->get();
        $otherQuestions = Question::where('asked_by', '!=', $name)->orderBy('upvotes', 'desc')->get();
        $upvoted = session()->get('upvoted', []);
        return Inertia::render('QAndA/Index', [
            'questions' => $otherQuestions,
            'userQuestions' => $userQuestions,
            'upvoted' => $upvoted,
            'name' => $name,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_text' => 'required|string|max:255',
            'asked_by' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) use ($request) {
                if ($value !== $request->session()->get('name')) {
                    $fail('You can only post questions for yourself.');
                }
            }],
        ]);

        $sessionCode = SessionCode::where('session_code', session('session_code'))->firstOrFail();

        Question::create([
            'question_text' => $validated['question_text'],
            'asked_by' => $validated['asked_by'],
            'session_code_id' => $sessionCode->id,
        ]);

        return redirect()->route('questions.index');
    }

    public function delete(Question $question)
    {
        $name = session("name");
        if ($question->asked_by != $name)
        {
            return back()->withErrors([
                "question" => "You can only delete your questions"
            ]);
        }

        $question->delete();

        return back();
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
