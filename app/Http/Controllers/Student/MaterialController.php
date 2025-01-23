<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $modules = Module::with(['materials' => function($query) {
            $query->select('id', 'module_id', 'title', 'content', 'file_path', 'video_id', 'order')
                  ->orderBy('order');
        }])
        ->where('status', 'published')
        ->whereHas('course', function($query) use ($user) {
            $query->where('id', $user->course_id);
        })
        ->select('id', 'title', 'description')
        ->orderBy('order')
        ->get();

        return view('student.materials.index', compact('modules'));
    }

    public function show(Material $material)
    {
        if ($material->module->status !== 'published' || $material->module->course_id !== Auth::user()->course_id) {
            abort(404);
        }

        return view('student.materials.show', compact('material'));
    }

    public function download(Material $material)
    {
        if ($material->module->status !== 'published' || $material->module->course_id !== Auth::user()->course_id) {
            abort(404);
        }

        if (!$material->file_path) {
            abort(404);
        }

        return response()->download(storage_path('app/public/' . $material->file_path));
    }
}

