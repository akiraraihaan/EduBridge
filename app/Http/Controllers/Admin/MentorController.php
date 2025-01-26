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

        $mentors = User::where('role_id', 2)
            ->whereHas('enrollments', function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch?->id)
                    ->where('status', 'active');
            })
            ->with(['preferredCourse', 'enrollments' => function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch?->id)
                    ->where('status', 'active');
            }])
            ->latest()
            ->get();

        return view('admin.mentors.index', compact('mentors'));
    }

    public function activate(Request $request, User $mentor)
    {
        if (!$mentor->isMentor()) {
            return back()->with('error', 'User ini bukan mentor.');
        }

        $mentor->update([
            'is_active' => true,
            'course_id' => $mentor->preferred_course // Otomatis menggunakan preferred_course
        ]);

        return back()->with('success', 'Mentor berhasil diaktifkan.');
    }

    public function deactivate(User $mentor)
    {
        if (!$mentor->isMentor()) {
            return back()->with('error', 'User ini bukan mentor.');
        }

        $mentor->update([
            'is_active' => false,
            'course_id' => null // Reset course_id saat dinonaktifkan
        ]);

        return back()->with('success', 'Mentor berhasil dinonaktifkan.');
    }
}
