<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\SessionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class GuestController extends Controller
{
    public function create()
    {
        return inertia('QAndA/Start');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'session_code' => [
                'required',
                'exists:session_codes,session_code',
                function ($attribute, $value, $fail) {
                    if (!DB::table('session_codes')->where('session_code', $value)->where('is_active', true)->exists()) {
                        $fail('The session must be active.');
                    }
                },
            ],
            'name' => [
                'required',
                Rule::unique('guests')->where(function ($query) use ($request) {
                    $query->where('session_code_id', function ($subQuery) use ($request) {
                        $subQuery->select('id')
                            ->from('session_codes')
                            ->where('session_code', $request->session_code)
                            ->limit(1);
                    });
                }),
            ],
        ]);

        $sessionCode = SessionCode::where('session_code', $validated["session_code"])->first();

        $guest = Guest::create([
            "name" => $validated["name"],
            "session_code_id" => $sessionCode->id,
        ]);

        session(['guest_id' => $guest->id]);

        return redirect()->route('questions.index');
    }

    public function ban(Request $request, Guest $guest)
    {
        if(! Auth::user()->sessionCodes()->where('id', $guest->sessionCode->id)->exists()) abort(403);

        $validated = $request->validate([
            "ban" => "required|boolean"
        ]);

        $guest->update([
            "banned" => $validated["ban"],
        ]);
        $guest->save();

        return back();
    }
}
