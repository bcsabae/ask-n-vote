<?php

namespace App\Http\Controllers;

use App\Models\SessionCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SessionCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessions = SessionCode::all();
        return Inertia::render('Sessions', [
            "session_codes" => $sessions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        do {
            $code = Str::upper(Str::random(6));
        }
        while (SessionCode::where('session_code', $code)->exists());

        SessionCode::create([
            "session_code" => $code,
            "is_active" => true
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(SessionCode $sessionCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SessionCode $sessionCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SessionCode $sessionCode)
    {
        $validated = $request->validate([
            "is_active" => "nullable|boolean",
            "session_code" => "nullable|string|min:6|max:6"
        ]);

        $data = [
            "is_active" => $validated["is_active"] ?? $sessionCode->is_active,
            "session_code" => $validated["session_code"] ?? $sessionCode->session_code,
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
        //
    }
}
