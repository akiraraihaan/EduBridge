<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\User;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    public function index()
    {
        $activeBatch = Batch::where('is_active', true)->first();

        if (!$activeBatch) {
            return view('admin.certificates.index', [
                'mentors' => collect(),
                'courses' => collect(),
                'certificates' => collect()
            ]);
        }

        $mentors = User::where('role_id', 2)
            ->with(['preferredCourse', 'certificates', 'enrollments' => function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch->id);
            }])
            ->latest()
            ->get()
            ->filter(function($mentor) {
                return $mentor->is_active;
            });

        $courses = Course::with(['students' => function($query) use ($activeBatch) {
            $query->whereHas('enrollments', function($q) use ($activeBatch) {
                $q->where('batch_id', $activeBatch->id);
            })
            ->where('is_active', true)
            ->with('certificates');
        }])->get();

        $certificates = Certificate::whereHas('user', function($query) use ($activeBatch) {
            $query->whereHas('enrollments', function($q) use ($activeBatch) {
                $q->where('batch_id', $activeBatch->id);
            })
            ->where('is_active', true);
        })->with('user')->get();

        return view('admin.certificates.index', compact('mentors', 'courses', 'certificates'));
    }

    public function create()
    {
        $activeBatch = Batch::where('is_active', true)->first();

        if (!$activeBatch) {
            return back()->with('error', 'Tidak ada batch yang aktif');
        }

        $mentors = User::where('role_id', 2)
            ->with(['enrollments' => function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch->id);
            }])
            ->latest()
            ->get()
            ->filter(function($mentor) {
                return $mentor->is_active;
            });

        $students = User::where('role_id', 3)
            ->whereHas('enrollments', function($query) use ($activeBatch) {
                $query->where('batch_id', $activeBatch->id);
            })
            ->where('is_active', true)
            ->get();

        return view('admin.certificates.create', compact('students', 'mentors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:student,mentor',
            'description' => 'nullable|string',
            'certificate_file' => 'required|file|mimes:pdf|max:5120', // max 5MB
        ]);

        try {
            $user = User::findOrFail($request->user_id);

            // Generate certificate number
            $certificateNumber = 'CERT/' . strtoupper($request->type) . '/' . date('Y') . '/' . Str::random(8);

            // Store PDF file
            $file = $request->file('certificate_file');
            $filename = time() . '_' . Str::slug($user->first_name . '-' . $certificateNumber) . '.pdf';
            $path = $file->storeAs('certificates', $filename, 'public');

            Certificate::create([
                'user_id' => $request->user_id,
                'certificate_number' => $certificateNumber,
                'file_path' => $path,
                'type' => $request->type,
                'description' => $request->description,
                'issued_date' => now()
            ]);

            return back()->with('success', 'Sertifikat berhasil diterbitkan');

        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat menerbitkan sertifikat']);
        }
    }

    public function destroy(Certificate $certificate)
    {
        try {
            // Delete file
            if (Storage::disk('public')->exists($certificate->file_path)) {
                Storage::disk('public')->delete($certificate->file_path);
            }

            $certificate->delete();

            return back()->with('success', 'Sertifikat berhasil dihapus');
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat menghapus sertifikat']);
        }
    }
}
