<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function enroll(Request $request, Batch $batch)
    {
        try {
            // Cek status batch
            if (!$batch->is_active) {
                throw new \Exception('Batch tidak aktif');
            }

            if (!$batch->is_open) {
                throw new \Exception('Pendaftaran batch sudah ditutup');
            }

            if (!$batch->hasAvailableSlots()) {
                throw new \Exception('Batch sudah penuh');
            }

            // Cek apakah user sudah terdaftar
            if ($batch->students()->where('user_id', auth()->user()->id)->exists()) {
                throw new \Exception('Anda sudah terdaftar di batch ini');
            }

            DB::beginTransaction();

            // Tambahkan user ke batch
            $batch->students()->attach(auth()->user()->id);

            // Increment enrolled_count
            $batch->increment('enrolled_count');

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mendaftar ke batch'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}

