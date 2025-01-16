<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::orderBy('year', 'desc')
            ->orderBy('period', 'desc')
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

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'year' => 'required|integer|min:2024',
                'period' => 'required|integer|min:1|max:4',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'capacity' => 'required|integer|min:1|max:1000',
                'is_open' => 'boolean',
                'is_active' => 'boolean'
            ]);

            // Periksa apakah sudah ada batch aktif untuk periode ini
            $existingBatch = Batch::where('is_active', true)
                ->where('year', $validated['year'])
                ->where('period', $validated['period'])
                ->first();

            if ($existingBatch) {
                throw new \Exception('Sudah ada batch aktif untuk periode yang sama');
            }

            // Set default values
            $validated['enrolled_count'] = 0;
            $validated['is_open'] = $request->has('is_open');
            $validated['is_active'] = $request->has('is_active');

            $batch = Batch::create($validated);

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Batch berhasil dibuat',
                    'data' => $batch
                ]);
            }

            return redirect()
                ->route('admin.batches.index')
                ->with('success', 'Batch berhasil dibuat');

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
                'year' => 'required|integer|min:2024',
                'period' => 'required|integer|min:1|max:4',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'capacity' => 'required|integer|min:1|max:1000',
                'is_open' => 'boolean',
                'is_active' => 'boolean'
            ]);

            // Periksa apakah ada batch aktif lain untuk periode ini (kecuali batch ini sendiri)
            $existingBatch = Batch::where('is_active', true)
                ->where('year', $validated['year'])
                ->where('period', $validated['period'])
                ->where('id', '!=', $batch->id)
                ->first();

            if ($existingBatch) {
                throw new \Exception('Sudah ada batch aktif untuk periode yang sama');
            }

            // Periksa kapasitas
            if ($validated['capacity'] < $batch->enrolled_count) {
                throw new \Exception('Kapasitas tidak boleh lebih kecil dari jumlah siswa yang sudah terdaftar');
            }

            $validated['is_open'] = $request->has('is_open');
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
            if (!$batch->is_active && $batch->enrolled_count > 0) {
                throw new \Exception('Tidak dapat menonaktifkan batch yang memiliki siswa terdaftar');
            }

            $batch->update([
                'is_active' => !$batch->is_active,
                'is_open' => !$batch->is_active ? false : $batch->is_open
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status batch berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }

    public function toggleRegistration(Batch $batch)
    {
        try {
            if (!$batch->is_active) {
                throw new \Exception('Batch harus aktif untuk membuka pendaftaran');
            }

            if (!$batch->hasAvailableSlots() && !$batch->is_open) {
                throw new \Exception('Batch sudah penuh');
            }

            $batch->update([
                'is_open' => !$batch->is_open
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Status pendaftaran berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
