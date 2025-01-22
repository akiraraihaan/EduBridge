<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentorCourses = Auth::user()->mentorCourses;
        $courseIds = $mentorCourses->pluck('course_id');
        $courses = Course::whereIn('id', $courseIds)->with('modules')->get();

        return view('mentor.modules.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mentorCourses = Auth::user()->mentorCourses;
        $courses = Course::whereIn('id', $mentorCourses->pluck('course_id'))->get();

        return view('mentor.modules.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'status' => 'required|in:draft,published'
        ]);

        // Verifikasi bahwa mentor memiliki akses ke course ini
        $mentorCourseIds = Auth::user()->mentorCourses->pluck('course_id');
        if (!$mentorCourseIds->contains($request->course_id)) {
            return back()->withErrors(['course_id' => 'Anda tidak memiliki akses ke kursus ini']);
        }

        Module::create($request->all());

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        $mentorCourseIds = Auth::user()->mentorCourses->pluck('course_id');
        if (!$mentorCourseIds->contains($module->course_id)) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        $mentorCourses = Auth::user()->mentorCourses;
        $courses = Course::whereIn('id', $mentorCourses->pluck('course_id'))->get();

        return view('mentor.modules.edit', compact('module', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        $mentorCourseIds = Auth::user()->mentorCourses->pluck('course_id');
        if (!$mentorCourseIds->contains($module->course_id)) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'status' => 'required|in:draft,published'
        ]);

        // Verifikasi bahwa mentor memiliki akses ke course yang baru
        if (!$mentorCourseIds->contains($request->course_id)) {
            return back()->withErrors(['course_id' => 'Anda tidak memiliki akses ke kursus ini']);
        }

        $module->update($request->all());

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        $mentorCourseIds = Auth::user()->mentorCourses->pluck('course_id');
        if (!$mentorCourseIds->contains($module->course_id)) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        $module->delete();

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil dihapus');
    }
}
