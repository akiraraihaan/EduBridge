<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Batch;

class CheckBatchStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil batch_id dari request
        $batchId = $request->route('batch') ? $request->route('batch')->id : $request->batch_id;

        if (!$batchId) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Batch tidak ditemukan'
                ], 404);
            }
            return redirect()->back()->with('error', 'Batch tidak ditemukan');
        }

        $batch = Batch::find($batchId);

        if (!$batch) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Batch tidak ditemukan'
                ], 404);
            }
            return redirect()->back()->with('error', 'Batch tidak ditemukan');
        }

        // Cek apakah batch aktif
        if (!$batch->is_active) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Batch tidak aktif'
                ], 403);
            }
            return redirect()->back()->with('error', 'Batch tidak aktif');
        }

        // Cek apakah pendaftaran dibuka
        if (!$batch->is_open) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pendaftaran batch sudah ditutup'
                ], 403);
            }
            return redirect()->back()->with('error', 'Pendaftaran batch sudah ditutup');
        }

        // Cek apakah masih ada slot tersedia
        if (!$batch->hasAvailableSlots()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Batch sudah penuh'
                ], 403);
            }
            return redirect()->back()->with('error', 'Batch sudah penuh');
        }

        return $next($request);
    }
}

