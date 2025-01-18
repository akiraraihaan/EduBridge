<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.batches.index', compact('batches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'capacity' => 'required|integer|min:1|max:1000'
            ]);

            // Jika batch baru akan aktif, nonaktifkan batch lain
            if ($request->has('is_active')) {
                Batch::query()->update([
                    'is_active' => false,
                    'is_open' => false
                ]);
            }

            $batch = new Batch();
            $batch->name = $request->name;
            $batch->start_date = $request->start_date;
            $batch->end_date = $request->end_date;
            $batch->capacity = $request->capacity;
            $batch->enrolled_count = 0;
            $batch->is_active = $request->has('is_active');
            $batch->is_open = $request->has('is_open') && $request->has('is_active');

            if($batch->save()) {
                DB::commit();
                return redirect()
                    ->route('admin.batches.index')
                    ->with('success', 'Batch berhasil dibuat');
            }

            throw new \Exception('Gagal menyimpan batch');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating batch: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Batch $batch)
    {
        return view('admin.batches.show', compact('batch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batch $batch)
    {
        return view('admin.batches.edit', compact('batch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batch $batch)
    {
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'capacity' => 'required|integer|min:1|max:1000',
                'is_open' => 'boolean',
                'is_active' => 'boolean'
            ]);

            // Periksa kapasitas
            if ($validated['capacity'] < $batch->enrolled_count) {
                throw new \Exception('Kapasitas tidak boleh lebih kecil dari jumlah siswa yang sudah terdaftar');
            }

            // Jika batch akan diaktifkan, nonaktifkan batch lain
            if ($request->has('is_active') && !$batch->is_active) {
                Batch::where('id', '!=', $batch->id)
                    ->update([
                        'is_active' => false,
                        'is_open' => false
                    ]);
            }

            $validated['is_open'] = $request->has('is_open') && $request->has('is_active');
            $validated['is_active'] = $request->has('is_active');

            $batch->update($validated);

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Batch berhasil diperbarui',
                    'data' => $batch
                ]);
            }

            return redirect()
                ->route('admin.batches.index')
                ->with('success', 'Batch berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 422);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batch $batch)
    {
        try {
            if ($batch->enrolled_count > 0) {
                throw new \Exception('Tidak dapat menghapus batch yang sudah memiliki siswa terdaftar');
            }

            $batch->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Batch berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function toggleStatus(Batch $batch)
    {
        try {
            DB::beginTransaction();

            // Cek jika batch akan dinonaktifkan dan memiliki siswa
            if ($batch->is_active && $batch->enrolled_count > 0) {
                throw new \Exception('Tidak dapat menonaktifkan batch yang memiliki siswa terdaftar');
            }

            // Jika akan mengaktifkan batch, nonaktifkan semua batch lain
            if (!$batch->is_active) {
                Batch::where('id', '!=', $batch->id)
                    ->update([
                        'is_active' => false,
                        'is_open' => false
                    ]);
            }

            // Update status batch
            $batch->update([
                'is_active' => !$batch->is_active,
                // Jika batch dinonaktifkan, tutup pendaftaran
                'is_open' => $batch->is_active ? false : $batch->is_open
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Status batch berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function toggleRegistration(Batch $batch)
    {
        try {
            DB::beginTransaction();

            // Cek apakah batch aktif
            if (!$batch->is_active) {
                throw new \Exception('Batch harus aktif untuk membuka pendaftaran');
            }

            // Cek kapasitas hanya jika akan membuka pendaftaran
            if (!$batch->is_open && !$batch->hasAvailableSlots()) {
                throw new \Exception('Batch sudah penuh');
            }

            // Jika akan membuka pendaftaran, tutup pendaftaran batch lain
            if (!$batch->is_open) {
                Batch::where('id', '!=', $batch->id)
                    ->update(['is_open' => false]);
            }

            // Update status pendaftaran
            $batch->update([
                'is_open' => !$batch->is_open
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Status pendaftaran berhasil diperbarui'
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
