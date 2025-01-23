<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MentorController extends Controller
{
    public function index()
    {
        $mentors = User::where('role_id', 2)
            ->with('preferredCourse')
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
