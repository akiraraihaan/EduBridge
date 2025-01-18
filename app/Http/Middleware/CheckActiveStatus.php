<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isMentor() && !Auth::user()->is_active) {
            Auth::logout();

            return redirect()->route('login')->with('error', 'Akun mentor Anda belum diaktifkan oleh admin. Silakan hubungi admin untuk aktivasi.');
        }

        return $next($request);
    }
}
