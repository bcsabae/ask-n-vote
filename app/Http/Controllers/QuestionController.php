<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SessionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $shouldAllow = false;

        if (Auth::id() == $question->sessionCode->user_id) $shouldAllow = true;
        if ($question->asked_by == session("name", "")) $shouldAllow = true;

        if (!$shouldAllow) abort(403);

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

    public function update(Request $request, Question $question)
    {
        if(Auth::id() !== $question->sessionCode->user_id) abort(403);

        $validated = $request->validate([
            'is_answered' => 'boolean'
        ]);

        $data = [
            "is_answered" => $validated["is_answered"] ?? $question->is_answered,
        ];

        $question->update($data);
        $question->save();

        return back();
    }
}
