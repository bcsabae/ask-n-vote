<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
    {
        $guest = Guest::findOrFail(session("guest_id"));
        $name = $guest->name;

        $userQuestions = $guest->questions()->orderBy('created_at', 'desc')->orderBy('question_text')->get();

        $answeredQuestions = $guest->sessionCode->questions()->where('guest_id', '!=', $guest->id)
            ->where('is_answered', true)
            ->orderBy('upvotes', 'desc')->orderBy('question_text')
            ->with('guest')->get();
        $unansweredQuestions = $guest->sessionCode->questions()->where('guest_id', '!=', $guest->id)
            ->where('is_answered', false)
            ->orderBy('upvotes', 'desc')->orderBy('question_text')
            ->with('guest')->get();

        $upvoted = session()->get('upvoted', []);
        return Inertia::render('QAndA/Index', [
            'answeredQuestions' => $answeredQuestions,
            'unansweredQuestions' => $unansweredQuestions,
            'userQuestions' => $userQuestions,
            'upvoted' => $upvoted,
            'name' => $name,
            'id' => $guest->id,
            'active' => (bool)$guest->sessionCode->is_active,
        ]);
    }

    public function store(Request $request)
    {
        $guest = Guest::find(session("guest_id"));
        $validated = $request->validate([
            'question_text' => 'required|string|max:255',
        ]);

        Question::create([
            'question_text' => $validated['question_text'],
            'guest_id' => $guest->id,
        ]);

        return back();
    }

    public function delete(Question $question)
    {
        $shouldAllow = false;

        if (Auth::check())
        {
            if (Auth::id() == $question->sessionCode->user_id) $shouldAllow = true;
        }
        else
        {
            $guest = Guest::find(session("guest_id"));
            if ($question->guest_id == $guest->id) $shouldAllow = true;
        }

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
