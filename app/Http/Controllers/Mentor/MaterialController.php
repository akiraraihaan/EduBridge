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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentorCourses = Auth::user()->mentorCourses;
        $courseIds = $mentorCourses->pluck('course_id');
        $courses = Course::whereIn('id', $courseIds)->with('modules.materials')->get();

        return view('mentor.materials.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mentorCourses = Auth::user()->mentorCourses;
        $courseIds = $mentorCourses->pluck('course_id');
        $modules = Module::whereIn('course_id', $courseIds)->get();

        return view('mentor.materials.create', compact('modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:pdf,video',
            'file' => 'required_if:type,pdf|mimes:pdf|max:10240', // Max 10MB untuk PDF
            'video_url' => 'required_if:type,video|string|url',
            'order' => 'required|integer|min:1'
        ]);

        $material = new Material();
        $material->module_id = $request->module_id;
        $material->title = $request->title;
        $material->content = $request->content;
        $material->type = $request->type;
        $material->order = $request->order;

        if ($request->type === 'pdf' && $request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($request->title) . '.pdf';
            $path = $file->storeAs('materials', $filename, 'public');
            $material->file_path = $path;
        } elseif ($request->type === 'video') {
            // Extract YouTube video ID from URL
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $request->video_url, $matches);
            $videoId = $matches[1] ?? null;

            if (!$videoId) {
                return back()->withErrors(['video_url' => 'URL YouTube tidak valid']);
            }

            $material->file_path = $videoId;
        }

        $material->status = 'published';
        $material->save();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil ditambahkan');
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
    public function edit(Material $material)
    {
        $mentorCourses = Auth::user()->mentorCourses;
        $courseIds = $mentorCourses->pluck('course_id');
        $modules = Module::whereIn('course_id', $courseIds)->get();

        return view('mentor.materials.edit', compact('material', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'type' => 'required|in:pdf,video',
            'file' => 'nullable|mimes:pdf|max:10240', // Max 10MB untuk PDF
            'video_url' => 'required_if:type,video|string|url',
            'order' => 'required|integer|min:1'
        ]);

        $material->module_id = $request->module_id;
        $material->title = $request->title;
        $material->content = $request->content;
        $material->type = $request->type;
        $material->order = $request->order;

        if ($request->type === 'pdf' && $request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($material->file_path) {
                Storage::disk('public')->delete($material->file_path);
            }

            $file = $request->file('file');
            $filename = time() . '_' . Str::slug($request->title) . '.pdf';
            $path = $file->storeAs('materials', $filename, 'public');
            $material->file_path = $path;
        } elseif ($request->type === 'video') {
            // Extract YouTube video ID from URL
            preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user|shorts)\/))([^\?&\"'>]+)/", $request->video_url, $matches);
            $videoId = $matches[1] ?? null;

            if (!$videoId) {
                return back()->withErrors(['video_url' => 'URL YouTube tidak valid']);
            }

            $material->file_path = $videoId;
        }

        $material->save();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        if ($material->type === 'pdf' && $material->file_path) {
            Storage::disk('public')->delete($material->file_path);
        }

        $material->delete();

        return redirect()->route('mentor.materials.index')
            ->with('success', 'Materi berhasil dihapus');
    }
}
