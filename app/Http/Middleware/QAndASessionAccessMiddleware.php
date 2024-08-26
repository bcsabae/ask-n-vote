<?php

namespace App\Http\Middleware;

use App\Models\Guest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class QAndASessionAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check()) return $next($request);

        if (!$request->session()->has('guest_id')) {
            return redirect()->route('q-and-a.login.form');
        }

        $guest = Guest::find(session('guest_id'));

        if ($guest == null) {
            session()->forget('guest_id');
            session()->flash('guest_message', 'Your session has expired. Please log in again.');
            return redirect()->route('q-and-a.login.form');
        }

        if ($guest->banned) {
            abort(403);
        }

        return $next($request);
    }
}
