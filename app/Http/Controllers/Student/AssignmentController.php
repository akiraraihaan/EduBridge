<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::whereHas('module', function($query) {
                $query->where('course_id', Auth::user()->course_id);
            })
            ->where('status', 'published')
            ->with(['module', 'submissions' => function($query) {
                $query->where('user_id', Auth::id());
            }])
            ->orderBy('due_date')
            ->get();

        return view('student.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini adalah milik kursus student
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('student.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        // Ambil submission student jika ada
        $submission = $assignment->submissions()
            ->where('user_id', Auth::id())
            ->first();

        return view('student.assignments.show', compact('assignment', 'submission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function submit(Request $request, Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini adalah milik kursus student
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('student.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        // Validasi input
        $request->validate([
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Max 10MB
        ]);

        // Cek apakah sudah melewati tenggat
        if ($assignment->due_date->isPast()) {
            return back()->withErrors(['error' => 'Tugas sudah melewati tenggat waktu']);
        }

        // Cek apakah sudah pernah submit
        $submission = $assignment->submissions()
            ->where('user_id', Auth::id())
            ->first();

        if ($submission) {
            // Update submission yang ada
            $submission->content = $request->content;

            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($submission->file_path) {
                    Storage::disk('public')->delete($submission->file_path);
                }

                // Upload file baru
                $path = $request->file('file')->store('submissions', 'public');
                $submission->file_path = $path;
            }

            $submission->save();

            return redirect()->route('student.assignments.show', $assignment)
                ->with('success', 'Tugas berhasil diperbarui');
        }

        // Buat submission baru
        $submission = new Submission([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'submitted_at' => now()
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('submissions', 'public');
            $submission->file_path = $path;
        }

        $assignment->submissions()->save($submission);

        return redirect()->route('student.assignments.show', $assignment)
            ->with('success', 'Tugas berhasil dikumpulkan');
    }
}
