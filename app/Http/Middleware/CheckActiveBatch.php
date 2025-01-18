<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Batch;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveBatch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya cek untuk registrasi student
        if ($request->is('register') || $request->is('register/*')) {
            // Jika ada parameter role dan bukan student, lewati pengecekan
            if ($request->query('role') && $request->query('role') !== 'student') {
                return $next($request);
            }

            // Jika ada role_id di request dan bukan student, lewati pengecekan
            if ($request->has('role_id') && $request->role_id != 3) {
                return $next($request);
            }

            $activeBatch = Batch::where('is_active', true)
                ->where('is_open', true)
                ->first();

            if (!$activeBatch) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Pendaftaran student saat ini sedang ditutup.'
                    ], 403);
                }

                return redirect()->route('login')
                    ->with('error', 'Pendaftaran student saat ini sedang ditutup.');
            }

            // Cek kapasitas batch
            if (!$activeBatch->hasAvailableSlots()) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Batch saat ini sudah penuh.'
                    ], 403);
                }

                return redirect()->route('login')
                    ->with('error', 'Batch saat ini sudah penuh.');
            }
        }

        return $next($request);
    }
}
