<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $activeBatch = Batch::where('is_active', true)->first();

        // Ambil semua mentor, baik yang sudah terdaftar di batch ini maupun belum
        $mentors = User::where('role_id', 2)
            ->with(['preferredCourse', 'enrollments' => function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch?->id);
            }])
            ->latest()
            ->get(); // Tanpa filter is_active agar menampilkan semua mentor

        return view('admin.mentors.index', compact('mentors'));
    }

    public function activate(Request $request, User $mentor)
    {
        if (!$mentor->isMentor()) {
            return back()->with('error', 'User ini bukan mentor.');
        }

        $activeBatch = Batch::where('is_active', true)->first();
        if (!$activeBatch) {
            return back()->with('error', 'Tidak ada batch yang aktif.');
        }

        $mentor->update([
            'is_active' => true,
            'course_id' => $mentor->preferred_course // Otomatis menggunakan preferred_course
        ]);

        // Cek apakah mentor sudah punya enrollment di batch ini
        $enrollment = $mentor->enrollments()
            ->where('batch_id', $activeBatch->id)
            ->first();

        if (!$enrollment) {
            // Jika belum ada enrollment, buat baru
            $mentor->enrollments()->create([
                'batch_id' => $activeBatch->id,
                'status' => 'active'
            ]);
        } else {
            // Jika sudah ada, aktifkan kembali
            $enrollment->update(['status' => 'active']);
        }

        return back()->with('success', 'Mentor berhasil diaktifkan.');
    }

    public function deactivate(User $mentor)
    {
        if (!$mentor->isMentor()) {
            return back()->with('error', 'User ini bukan mentor.');
        }

        $activeBatch = Batch::where('is_active', true)->first();
        if (!$activeBatch) {
            return back()->with('error', 'Tidak ada batch yang aktif.');
        }

        $mentor->update([
            'is_active' => false,
            'course_id' => null // Reset course_id saat dinonaktifkan
        ]);

        // Cek apakah mentor punya enrollment di batch ini
        $enrollment = $mentor->enrollments()
            ->where('batch_id', $activeBatch->id)
            ->first();

        if ($enrollment) {
            $enrollment->update(['status' => 'dropped']);
        }

        return back()->with('success', 'Mentor berhasil dinonaktifkan.');
    }
}
