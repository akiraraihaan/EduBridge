<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Module;
use App\Models\Course;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        $course->load(['modules.assignments' => function($query) {
            $query->orderBy('due_date');
        }]);

        return view('mentor.assignments.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        $modules = Module::where('course_id', $course->id)->orderBy('order')->get();
        return view('mentor.assignments.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'max_score' => 'required|integer|min:0|max:100',
            'status' => 'required|in:draft,published'
        ]);

        // Verifikasi bahwa modul yang dipilih adalah milik kursus mentor ini
        $module = Module::findOrFail($request->module_id);
        if ($module->course_id !== Auth::user()->course_id) {
            return back()->withErrors(['module_id' => 'Anda tidak memiliki akses ke modul ini']);
        }

        Assignment::create($request->all());

        return redirect()->route('mentor.assignments.index')
            ->with('success', 'Tugas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini milik kursus mentor
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        $assignment->load(['submissions.student', 'module']);
        return view('mentor.assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini milik kursus mentor
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        $modules = Module::where('course_id', Auth::user()->course_id)
            ->orderBy('order')
            ->get();

        return view('mentor.assignments.edit', compact('assignment', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini milik kursus mentor
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'max_score' => 'required|integer|min:0|max:100',
            'is_final_project' => 'boolean',
            'status' => 'required|in:draft,published'
        ]);

        // Verifikasi bahwa modul yang dipilih adalah milik kursus mentor ini
        $module = Module::findOrFail($request->module_id);
        if ($module->course_id !== Auth::user()->course_id) {
            return back()->withErrors(['module_id' => 'Anda tidak memiliki akses ke modul ini']);
        }

        $assignment->update($request->all());

        return redirect()->route('mentor.assignments.index')
            ->with('success', 'Tugas berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        // Verifikasi bahwa tugas ini milik kursus mentor
        if ($assignment->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.assignments.index')
                ->with('error', 'Anda tidak memiliki akses ke tugas ini');
        }

        $assignment->delete();

        return redirect()->route('mentor.assignments.index')
            ->with('success', 'Tugas berhasil dihapus');
    }

    public function gradeSubmission(Request $request, Submission $submission)
    {
        // Verifikasi bahwa submission ini adalah dari tugas di kursus mentor
        if ($submission->assignment->module->course_id !== Auth::user()->course_id) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menilai tugas ini');
        }

        $request->validate([
            'score' => 'required|integer|min:0|max:100',
            'feedback' => 'nullable|string'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'graded_by' => Auth::id(),
            'graded_at' => now()
        ]);

        return back()->with('success', 'Nilai berhasil disimpan');
    }
}
