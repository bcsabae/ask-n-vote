<?php

namespace App\Http\Controllers;

use App\Models\SessionCode;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function showLoginForm()
    {
        return inertia('QAndA/Start'); // Render Vue component for login
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'session_code' => 'required|string|exists:session_codes,session_code,is_active,1',
        ]);

        session(['name' => $request->name, 'session_code' => $request->session_code]);

        return redirect()->route('questions.index');
    }
}
