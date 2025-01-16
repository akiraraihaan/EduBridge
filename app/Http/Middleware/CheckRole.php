<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // if(Auth::check())
        // {
        //     if('admin' == $role)
        //     {
        //         return $next($request);
        //     }
        // }
        // abort(401);

        if (!$request->user()) {
            abort(403, 'Unauthorized action.');
        }

        // Check role based on role name
        switch ($role) {
            case 'admin':
                if (!$request->user()->isAdmin()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            case 'mentor':
                if (!$request->user()->isMentor()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            case 'student':
                if (!$request->user()->isStudent()) {
                    abort(403, 'Unauthorized action.');
                }
                break;
            default:
                abort(403, 'Invalid role specified.');
        }

        return $next($request);
    }
}
