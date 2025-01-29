<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        try {
            $request->authenticate();

            // Check if user is mentor or student and not active
            if ((Auth::user()->role_id == 2 || Auth::user()->role_id == 3) && !Auth::user()->is_active) {
                $message = Auth::user()->role_id == 2
                    ? 'Anda belum diterima atau telah dinyatakan nonaktif'
                    : 'Anda telah dinyatakan nonaktif';

                Auth::logout();

                if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
                    return response()->json([
                        'error' => $message
                    ], 403);
                }

                return redirect()->route('login')
                    ->with('error', $message);
            }

            $request->session()->regenerate();

            if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login berhasil',
                    'redirect' => route('home')
                ]);
            }

            // Redirect based on user role
            return redirect()->route('home');
        } catch (ValidationException $e) {
            if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'error' => 'Email atau password salah.',
                    'details' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
                return response()->json([
                    'error' => 'Terjadi kesalahan saat login.',
                    'message' => $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($request->expectsJson() || $request->is('api/*') || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Logout berhasil'
            ]);
        }

        return redirect('/');
    }
}
