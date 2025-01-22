<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModuleController extends Controller
{
    public function index()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        return view('mentor.modules.index', compact('course'));
    }

    public function create()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        return view('mentor.modules.create', compact('course'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'status' => 'required|in:draft,published'
        ]);

        // Verifikasi bahwa mentor memiliki akses ke course ini
        if (Auth::user()->course_id === null) {
            return back()->withErrors(['course_id' => 'Anda belum ditugaskan ke kursus manapun']);
        }

        $module = new Module($request->all());
        $module->course_id = Auth::user()->course_id;
        $module->save();

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil ditambahkan');
    }

    public function edit(Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        if ($module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        return view('mentor.modules.edit', compact('module'));
    }

    public function update(Request $request, Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        if ($module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'required|integer|min:1',
            'status' => 'required|in:draft,published'
        ]);

        $module->update($request->only(['title', 'description', 'order', 'status']));

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil diperbarui');
    }

    public function destroy(Module $module)
    {
        // Verifikasi bahwa mentor memiliki akses ke modul ini
        if ($module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.modules.index')
                ->with('error', 'Anda tidak memiliki akses ke modul ini');
        }

        $module->delete();

        return redirect()->route('mentor.modules.index')
            ->with('success', 'Modul berhasil dihapus');
    }
}
