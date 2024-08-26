<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\SessionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;
use const http\Client\Curl\AUTH_ANY;

class SessionCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = SessionCode::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return Inertia::render('Sessions', [
            "session_codes" => $sessions
        ]);
    }

    /**
     * Display a single resource.
     */
    public function view(SessionCode $sessionCode)
    {
        if(Auth::user()->cannot('view', $sessionCode)) abort(403);

        $active_questions = $sessionCode->questions()->where('is_answered', false)->with('guest')
            ->orderBy('upvotes', 'desc')->get();
        $answered_questions = $sessionCode->questions()->where('is_answered', true)->with('guest')
            ->orderBy('updated_at', 'desc')->get();
        $guests = $sessionCode->guests();

        return Inertia::render('SessionDashboard', [
            "session_code" => $sessionCode,
            "active_questions" => $active_questions,
            "answered_questions" => $answered_questions,
            "guest_count" => $guests->count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(Auth::user()->cannot('create', SessionCode::class)) abort(403);

        $validated = $request->validate([
            "title" => "nullable|string|max:256"
        ]);

        if (!array_key_exists('title', $validated))
        {
            $name = Auth::user()->name;
            $id = SessionCode::where('user_id', Auth::id())->count() + 1;
            $title = "{$name}'s session #{$id}";
        }
        else $title = $validated['title'];

        do {
            $code = Str::upper(Str::random(6));
        }
        while (SessionCode::where('session_code', $code)->exists());

        SessionCode::create([
            "session_code" => $code,
            "is_active" => true,
            "title" => $title,
            "user_id" => Auth::id(),
        ]);

        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SessionCode $sessionCode)
    {
        if(Auth::user()->cannot('update', $sessionCode)) abort(403);

        $validated = $request->validate([
            "is_active" => "nullable|boolean",
            "session_code" => "nullable|string|min:6|max:6",
            "title" => "nullable|string|max:256"
        ]);

        $data = [
            "is_active" => $validated["is_active"] ?? $sessionCode->is_active,
            "session_code" => $validated["session_code"] ?? $sessionCode->session_code,
            "title" => $validated["title"] ?? $sessionCode->title,
        ];

        $sessionCode->update($data);

        $sessionCode->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SessionCode $sessionCode)
    {
        if(Auth::user()->cannot('delete', $sessionCode)) abort(403);

        $sessionCode->delete();

        return redirect(route('sessions'));
    }
}
