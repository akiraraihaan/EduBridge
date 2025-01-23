<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Module;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    public function index()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        $course->load(['modules.materials' => function($query) {
            $query->orderBy('order');
        }]);

        return view('mentor.materials.index', compact('course'));
    }

    public function create()
    {
        $course = Course::find(Auth::user()->course_id);
        if (!$course) {
            return redirect()->route('mentor.dashboard')
                ->with('error', 'Anda belum ditugaskan ke kursus manapun');
        }

        $modules = Module::where('course_id', $course->id)->orderBy('order')->get();
        return view('mentor.materials.create', compact('course', 'modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB untuk PDF
            'video_url' => 'nullable|string|url',
            'order' => 'required|integer|min:1'
        ]);

        // Verifikasi bahwa modul yang dipilih adalah milik kursus mentor ini
        $module = Module::findOrFail($request->module_id);
        if ($module->course_id !== Auth::user()->course_id) {
            return back()->withErrors(['module_id' => 'Anda tidak memiliki akses ke modul ini']);
        }

        $material = new Material();
        $material->module_id = $request->module_id;
        $material->title = $request->title;
        $material->content = $request->content;
        $material->order = $request->order;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($request->title) . '.pdf';
            $path = $file->storeAs('materials', $filename, 'public');
            $material->file_path = $path;
        }

        if ($request->video_url) {
            // Extract YouTube video ID from URL
            preg_match("/^(?:http(?:s)?:\\/\\/)?(?:www\\.)?(?:m\\.)?(?:youtu\\.be\\/|youtube\\.com\\/(?:(?:watch)?\\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\\/))([^\\?&\"'>]+)/", $request->video_url, $matches);
            $videoId = $matches[1] ?? null;

            if (!$videoId) {
                return back()->withErrors(['video_url' => 'URL YouTube tidak valid']);
            }

            $material->video_id = $videoId;
        }

        $material->save();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil ditambahkan')
            ->with('scrollTo', 'module-' . $module->id);
    }

    public function edit(Material $material)
    {
        // Verifikasi bahwa material ini milik kursus mentor
        if ($material->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.materials.index')
                ->with('error', 'Anda tidak memiliki akses ke materi ini');
        }

        $modules = Module::where('course_id', Auth::user()->course_id)->orderBy('order')->get();
        return view('mentor.materials.edit', compact('material', 'modules'));
    }

    public function update(Request $request, Material $material)
    {
        // Verifikasi bahwa material ini milik kursus mentor
        if ($material->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.materials.index')
                ->with('error', 'Anda tidak memiliki akses ke materi ini');
        }

        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB untuk PDF
            'video_url' => 'nullable|string|url',
            'order' => 'required|integer|min:1'
        ]);

        // Verifikasi bahwa modul yang dipilih adalah milik kursus mentor ini
        $module = Module::findOrFail($request->module_id);
        if ($module->course_id !== Auth::user()->course_id) {
            return back()->withErrors(['module_id' => 'Anda tidak memiliki akses ke modul ini']);
        }

        $material->module_id = $request->module_id;
        $material->title = $request->title;
        $material->content = $request->content;
        $material->order = $request->order;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($request->title) . '.pdf';
            $path = $file->storeAs('materials', $filename, 'public');
            $material->file_path = $path;
        }

        if ($request->video_url) {
            // Extract YouTube video ID from URL
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $request->video_url, $matches);
            $videoId = $matches[1] ?? null;

            if (!$videoId) {
                return back()->withErrors(['video_url' => 'URL YouTube tidak valid']);
            }

            $material->video_id = $videoId;
        }

        $material->save();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil diperbarui')
            ->with('scrollTo', 'module-' . $module->id);
    }

    public function destroy(Material $material)
    {
        // Verifikasi bahwa material ini milik kursus mentor
        if ($material->module->course_id !== Auth::user()->course_id) {
            return redirect()->route('mentor.materials.index')
                ->with('error', 'Anda tidak memiliki akses ke materi ini');
        }

        $moduleId = $material->module_id;

        if ($material->type === 'pdf' && $material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil dihapus')
            ->with('scrollTo', 'module-' . $moduleId);
    }
}
